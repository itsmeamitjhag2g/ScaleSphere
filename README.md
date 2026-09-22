# ScaleSphere

Marketing website (PHP 8.1+).

## Structure

```
/
├── index.php          # Entry (keep at root for cPanel)
├── front.php          # Front controller
├── public/            # CSS, JS, images (web assets)
├── app/
│   ├── pages/         # Page templates
│   ├── components/    # Header, Footer, layout
│   ├── lib/           # Router, mail, SEO, helpers
│   └── bootstrap.php  # Security headers
├── config/            # env.php loader
├── storage/           # contacts / rate-limit JSON
├── vendor/            # Composer (PHPMailer)
├── .env               # Secrets (not committed)
└── .htaccess
```

## Local

```bash
composer install
npm install
npm run build:css
# copy .env.example → .env and edit
php -S localhost:3000 index.php
```

Or run `start-site.cmd` / `start-site.sh`.

After changing Tailwind classes in PHP templates, rebuild utilities:

```bash
npm run build:css
# or while editing:
npm run watch:css
```

Built CSS lives at `public/css/tailwind.css` (no CDN).

## Temporary public link

To open the running site from another device or network, install Cloudflare
`cloudflared` once, then run `share-site.cmd` on Windows or `share-site.sh` on
Linux/macOS. The command starts PHP and prints a temporary `https://` URL.

```powershell
winget install Cloudflare.cloudflared
share-site.cmd
```

In Git Bash, run the batch file from the current directory with:

```bash
./share-site.cmd
```

You can also use `./share-site.sh` when PHP and `cloudflared` are available in
your Git Bash `PATH`.

If WinGet shows `0x80072eff`, download `cloudflared-windows-amd64.exe` from
the official Cloudflare release page and save it as
`%LOCALAPPDATA%\cloudflared\cloudflared.exe`. Then run `share-site.cmd` again.

The link works only while both the PHP server and tunnel are running. It is a
development preview, not permanent hosting. Stop the command with `Ctrl+C`.

## Deploy (cPanel)

1. Document root = this repo folder (where `index.php` lives)
2. Upload files, set `storage/` writable
3. Configure `.env`
4. Run `composer install --no-dev`
5. If you changed Tailwind classes, run `npm install && npm run build:css` before upload (or upload the already-built `public/css/tailwind.css`)
