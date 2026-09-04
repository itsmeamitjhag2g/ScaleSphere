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
    $host = trim((string) (ts_env("MAIL_HOST") ?? ""));
    $user = trim((string) (ts_env("MAIL_USERNAME") ?? ""));
    $pass = (string) (ts_env("MAIL_PASSWORD") ?? "");

    return $host !== ""
        && $user !== ""
        && $pass !== ""
        && !str_contains($host, "example.com");
}

/**
 * Destination inbox for contact form (override with MAIL_TO in .env).
 */
function ts_mail_inbox(): string
{
    $to = trim((string) (ts_env("MAIL_TO", "aj8751045@gmail.com") ?? "aj8751045@gmail.com"));
    return $to !== "" ? $to : "aj8751045@gmail.com";
}

function ts_send_contact_mail(string $name, string $email, string $phone, string $message, string $service = ""): bool
{
    if (!ts_mail_bootstrap() || !ts_mail_configured()) {
        return false;
    }

    $site = ts_site();
    $host = trim((string) ts_env("MAIL_HOST"));
    $user = trim((string) ts_env("MAIL_USERNAME"));
    $pass = (string) ts_env("MAIL_PASSWORD");
    $port = (int) (ts_env("MAIL_PORT", "587") ?? "587");
    $encryption = strtolower(trim((string) (ts_env("MAIL_ENCRYPTION", "tls") ?? "tls")));
    $from = trim((string) (ts_env("MAIL_FROM", $user) ?? $user));
    $fromName = trim((string) (ts_env("MAIL_FROM_NAME", $site["name"]) ?? $site["name"]));
    $to = ts_mail_inbox();

    $safeName = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
    $safeEmail = htmlspecialchars($email, ENT_QUOTES, "UTF-8");
    $safePhone = htmlspecialchars($phone !== "" ? $phone : "—", ENT_QUOTES, "UTF-8");
    $safeService = htmlspecialchars($service !== "" ? $service : "—", ENT_QUOTES, "UTF-8");
    $safeMessage = $message !== ""
        ? nl2br(htmlspecialchars($message, ENT_QUOTES, "UTF-8"))
        : "<em style=\"color:#94A3B8\">No description provided</em>";
    $when = htmlspecialchars(date("d M Y, h:i A T"), ENT_QUOTES, "UTF-8");
    $ip = htmlspecialchars((string) ($_SERVER["REMOTE_ADDR"] ?? "—"), ENT_QUOTES, "UTF-8");
    $siteName = htmlspecialchars($site["name"], ENT_QUOTES, "UTF-8");
    $siteUrl = htmlspecialchars($site["url"] ?? "", ENT_QUOTES, "UTF-8");

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $user;
        $mail->Password = $pass;
        $mail->Port = $port;
        $mail->CharSet = "UTF-8";

        if ($encryption === "ssl") {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } elseif ($encryption === "tls" || $encryption === "starttls") {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        } else {
            $mail->SMTPSecure = false;
            $mail->SMTPAutoTLS = false;
        }

        $mail->setFrom($from !== "" ? $from : $user, $fromName !== "" ? $fromName : $site["name"]);
        $mail->addAddress($to);
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "Appointment request — {$name}" . ($service !== "" ? " · {$service}" : "") . " — {$site["name"]}";
        $mail->Body = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:0;background:#EEF4FF;font-family:Arial,Helvetica,sans-serif;color:#0F172A;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#EEF4FF;padding:28px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 12px 40px rgba(15,23,42,.08);">
          <tr>
            <td style="background:linear-gradient(135deg,#0066FF,#2e7cff);padding:22px 28px;">
              <p style="margin:0;font-size:12px;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.85);font-weight:700;">{$siteName} · Book appointment</p>
              <h1 style="margin:8px 0 0;font-size:22px;line-height:1.25;color:#fff;font-weight:800;">New appointment request</h1>
            </td>
          </tr>
          <tr>
            <td style="padding:24px 28px 8px;">
              <p style="margin:0 0 18px;font-size:14px;line-height:1.55;color:#64748B;">Someone requested an appointment from the website. Reply to this email to reach them.</p>
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #E2E8F0;border-radius:12px;overflow:hidden;">
                <tr>
                  <td style="padding:12px 16px;background:#F8FAFC;border-bottom:1px solid #E2E8F0;width:34%;font-size:12px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:.06em;">Name</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #E2E8F0;font-size:15px;font-weight:700;color:#0F172A;">{$safeName}</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;background:#F8FAFC;border-bottom:1px solid #E2E8F0;font-size:12px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:.06em;">Email</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #E2E8F0;font-size:15px;"><a href="mailto:{$safeEmail}" style="color:#0066FF;text-decoration:none;font-weight:600;">{$safeEmail}</a></td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;background:#F8FAFC;border-bottom:1px solid #E2E8F0;font-size:12px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:.06em;">Phone</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #E2E8F0;font-size:15px;color:#0F172A;">{$safePhone}</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;background:#F8FAFC;border-bottom:1px solid #E2E8F0;font-size:12px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:.06em;">Service</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #E2E8F0;font-size:15px;font-weight:700;color:#0066FF;">{$safeService}</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;background:#F8FAFC;border-bottom:1px solid #E2E8F0;font-size:12px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:.06em;">Submitted</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #E2E8F0;font-size:14px;color:#475569;">{$when}</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;background:#F8FAFC;font-size:12px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:.06em;">IP</td>
                  <td style="padding:12px 16px;font-size:14px;color:#475569;">{$ip}</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:8px 28px 24px;">
              <p style="margin:0 0 8px;font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#64748B;">Description</p>
              <div style="padding:16px 18px;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:12px;font-size:15px;line-height:1.65;color:#0F172A;">{$safeMessage}</div>
              <p style="margin:20px 0 0;">
                <a href="mailto:{$safeEmail}?subject=Re:%20Your%20appointment%20request%20to%20{$siteName}" style="display:inline-block;padding:12px 20px;background:#0066FF;color:#fff;text-decoration:none;border-radius:999px;font-size:13px;font-weight:700;">Reply to {$safeName}</a>
              </p>
            </td>
          </tr>
          <tr>
            <td style="padding:16px 28px 22px;background:#F8FAFC;border-top:1px solid #E2E8F0;">
              <p style="margin:0;font-size:12px;color:#94A3B8;line-height:1.5;">Sent automatically from the {$siteName} website<?= $siteUrl !== "" ? " · <a href=\"{$siteUrl}\" style=\"color:#64748B;\">{$siteUrl}</a>" : "" ?>.</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;

        $plainPhone = $phone !== "" ? $phone : "—";
        $plainService = $service !== "" ? $service : "—";
        $plainMessage = $message !== "" ? $message : "(No description provided)";
        $mail->AltBody = "Appointment request — {$site["name"]}\n\n"
            . "Name: {$name}\n"
            . "Email: {$email}\n"
            . "Phone: {$plainPhone}\n"
            . "Service: {$plainService}\n"
            . "Submitted: " . date("c") . "\n"
            . "IP: " . (string) ($_SERVER["REMOTE_ADDR"] ?? "—") . "\n\n"
            . "Description:\n{$plainMessage}\n";

        $mail->send();
        return true;
    } catch (MailException $error) {
        error_log("ScaleSphere mail: " . $error->getMessage());
        return false;
    }
}
