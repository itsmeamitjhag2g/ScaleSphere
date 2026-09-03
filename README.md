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
# copy .env.example → .env and edit
php -S localhost:3000 index.php
```

Or run `start-site.cmd` / `start-site.sh`.

## Deploy (cPanel)

1. Document root = this repo folder (where `index.php` lives)
2. Upload files, set `storage/` writable
3. Configure `.env`
4. Run `composer install --no-dev`
