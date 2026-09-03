<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\Exception as MailException;
use PHPMailer\PHPMailer\PHPMailer;

function ts_mail_bootstrap(): bool
{
    static $ready = null;
    if ($ready !== null) {
        return $ready;
    }

    $autoload = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
    if (!is_file($autoload)) {
        $ready = false;
        return false;
    }

    require_once $autoload;
    $ready = class_exists(PHPMailer::class);
    return $ready;
}

function ts_mail_configured(): bool
{
    return ts_env("MAIL_HOST") !== null
        && ts_env("MAIL_USERNAME") !== null
        && ts_env("MAIL_PASSWORD") !== null;
}

function ts_send_contact_mail(string $name, string $email, string $phone, string $message): bool
{
    if (!ts_mail_bootstrap() || !ts_mail_configured()) {
        return false;
    }

    $site = ts_site();
    $host = (string) ts_env("MAIL_HOST");
    $user = (string) ts_env("MAIL_USERNAME");
    $pass = (string) ts_env("MAIL_PASSWORD");
    $port = (int) (ts_env("MAIL_PORT", "587") ?? "587");
    $encryption = (string) (ts_env("MAIL_ENCRYPTION", "tls") ?? "tls");
    $from = (string) (ts_env("MAIL_FROM", $site["email"]) ?? $site["email"]);
    $fromName = (string) (ts_env("MAIL_FROM_NAME", $site["name"]) ?? $site["name"]);
    $to = (string) (ts_env("MAIL_TO", $site["email"]) ?? $site["email"]);

    $safeName = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
    $safeEmail = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
    $safePhone = htmlspecialchars($phone, ENT_QUOTES, "UTF-8");
    $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, "UTF-8"));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $user;
        $mail->Password = $pass;
        $mail->SMTPSecure = $encryption;
        $mail->Port = $port;
        $mail->CharSet = "UTF-8";

        $mail->setFrom($from, $fromName);
        $mail->addAddress($to);
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New inquiry — " . $site["name"];
        $mail->Body = <<<HTML
<!DOCTYPE html>
<html><body style="font-family:Arial,sans-serif;color:#0f172a;line-height:1.6">
  <h2 style="color:#0066FF;margin:0 0 16px">New contact form submission</h2>
  <p><strong>Name:</strong> {$safeName}</p>
  <p><strong>Email:</strong> {$safeEmail}</p>
  <p><strong>Phone:</strong> {$safePhone}</p>
  <p><strong>Message:</strong><br>{$safeMessage}</p>
  <hr style="border:none;border-top:1px solid #e2e8f0;margin:24px 0">
  <p style="font-size:12px;color:#64748b">Sent from {$site["name"]} contact form</p>
</body></html>
HTML;
        $mail->AltBody = "Name: {$safeName}\nEmail: {$safeEmail}\nPhone: {$safePhone}\n\nMessage:\n"
            . htmlspecialchars($message, ENT_QUOTES, "UTF-8");

        $mail->send();
        return true;
    } catch (MailException $error) {
        error_log("ScaleSphere mail: " . $error->getMessage());
        return false;
    }
}
