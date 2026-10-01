# ScaleSphere

Marketing website for ScaleSphere, written in plain PHP (no framework, no database,
no Node.js). Pages, services and blog posts are PHP files; contact form messages are
stored as JSON in `storage/` and emailed through SMTP (PHPMailer).

## Contents

1. [Requirements](#1-requirements)
2. [Run it locally](#2-run-it-locally)
3. [The `.env` file](#3-the-env-file)
4. [Getting each credential](#4-getting-each-credential)
5. [Blog admin](#5-blog-admin)
6. [Go live on cPanel](#6-go-live-on-cpanel)
7. [Updating the live site](#7-updating-the-live-site)
8. [Images](#8-images)
9. [Temporary public link (optional)](#9-temporary-public-link-optional)
10. [Troubleshooting](#10-troubleshooting)
11. [Project structure](#11-project-structure)

---

## 1. Requirements

| What | Version / notes |
|---|---|
| PHP | 8.1 or newer (8.3 recommended) |
| PHP extensions | `gd` (with WebP), `fileinfo`, `dom`, `mbstring`, `openssl`, `json`, `session`. `zip` only for `src/scripts/install-phpmailer.php` |
| Composer | Any recent version, to install PHPMailer. Optional, see [step 2.3](#23-install-phpmailer) |
| Git | Only if you clone the repository |

Check PHP and the extensions:

```bash
php -v
php -m
```

Node.js is **not** needed. Utility CSS ships prebuilt in `src/assets/css/tailwind.css`.

## 2. Run it locally

### 2.1 Install PHP

**Windows**

1. Download PHP 8.3 "VS16 x64 Thread Safe" ZIP from <https://windows.php.net/download/>.
2. Extract it to `%LOCALAPPDATA%\Programs\php-8.3` (this is where `src\scripts\start-site.cmd`
   looks first; XAMPP at `C:\xampp\php` also works).
3. In that folder copy `php.ini-development` to `php.ini`, open it and remove the `;`
   in front of these lines:
   ```ini
   extension_dir = "ext"
   extension=fileinfo
   extension=gd
   extension=mbstring
   extension=openssl
   extension=zip
   ```
4. Optional: add the folder to your `PATH` so `php` works in any terminal.

**macOS / Linux**

```bash
# macOS (Homebrew)
brew install php
# Ubuntu / Debian
sudo apt install php8.3-cli php8.3-gd php8.3-mbstring php8.3-xml php8.3-zip
```

### 2.2 Get the code

```bash
git clone https://github.com/itsmeamitjhag2g/ScaleSphere.git
cd ScaleSphere
```

Or download the ZIP from GitHub and extract it.

### 2.3 Install PHPMailer

PHPMailer is used to email contact form messages. `vendor/` is not committed.

```bash
composer install
```

No Composer? Run the bundled installer instead (downloads PHPMailer 6.9.3 into `vendor/`):

```bash
php src/scripts/install-phpmailer.php
```

The site still runs without PHPMailer; contact messages are then only saved to
`storage/contacts.json`.

### 2.4 Create `.env`

Copy `.env.example` to `.env` in the project root (next to `index.php`) and fill it in.
Every key is explained in [section 3](#3-the-env-file).

```bash
# Windows
copy .env.example .env
# macOS / Linux
cp .env.example .env
```

For a first local run you only need:

```ini
APP_ENV=development
SITE_URL=http://localhost:3000
BLOG_CREDENTIAL_EMAIL=you@example.com
BLOG_CREDENTIAL_PASSWORD=choose-a-long-password-here
```

### 2.5 Start the site

```bash
# Windows (double-clicking src\scripts\start-site.cmd also works)
src\scripts\start-site.cmd

# macOS / Linux / Git Bash
./src/scripts/start-site.sh

# or directly
php -S localhost:3000 index.php
```

Open <http://localhost:3000>.

Use `localhost`, not `127.0.0.1`, in the browser. The scripts bind to `localhost`;
mixing the two on Windows adds a ~200 ms delay to every request (or fails).

## 3. The `.env` file

`.env` holds settings and secrets. It is git-ignored and must **never** be committed
or shared. Values may be wrapped in double quotes; lines starting with `#` are comments
(put comments on their own line, not after a value). A key that is present but empty
counts as empty: it does **not** fall back to the default.

The same template ships as `.env.example` in the project root:

```ini
# ---------------------------------------------------------------- site
# development locally, production on the live server
APP_ENV=development
# Full public URL, no trailing slash. Used for canonical links, sitemap, Open Graph, schema.
SITE_URL=http://localhost:3000
SITE_NAME=ScaleSphere
SITE_TAGLINE="Scale Smarter. Grow Further."
SITE_EMAIL=info@your-domain.com
SITE_PHONE="+91 90000 00000"
SITE_ADDRESS="Kota, Rajasthan, India"
# Optional footer line, e.g. "ISO 9001:2015 certified". Leave empty if none.
SITE_CERTIFICATIONS=

# Optional numbers on the About page. 0 hides the counter.
STAT_PROJECTS=0
STAT_TEAM=0
STAT_YEARS=0

# Social profiles. Set the real URLs; leave a value empty to remove that icon.
SOCIAL_FACEBOOK=
SOCIAL_TWITTER=
SOCIAL_LINKEDIN=
SOCIAL_INSTAGRAM=
# Set to 1 only when the site sits behind a proxy/CDN that terminates HTTPS (e.g. Cloudflare proxy).
TRUST_PROXY=

# ---------------------------------------------------------------- contact form email (SMTP)
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
# tls for port 587, ssl for port 465
MAIL_ENCRYPTION=tls
MAIL_USERNAME=you@gmail.com
MAIL_PASSWORD="xxxx xxxx xxxx xxxx"
# Sender shown on the email. Gmail requires this to be MAIL_USERNAME.
MAIL_FROM=you@gmail.com
MAIL_FROM_NAME=ScaleSphere Website
# Inbox that receives contact form messages (defaults to SITE_EMAIL)
MAIL_TO=info@your-domain.com

# ---------------------------------------------------------------- blog admin
# Secret part of the admin URL: /blog/<BLOG_ADMIN_PATH>/login
# 8-64 letters, numbers, - or _. Make it random, never use the default.
BLOG_ADMIN_PATH=
BLOG_CREDENTIAL_EMAIL=you@your-domain.com
# Either a plain password (14+ characters)...
BLOG_CREDENTIAL_PASSWORD=
# ...or, better, a bcrypt hash of it. When set, the hash is used and the plain password is ignored.
BLOG_CREDENTIAL_PASSWORD_HASH=
```

### What each key does

| Key | Required | Notes |
|---|---|---|
| `APP_ENV` | Yes | `production` turns on HSTS and HTTPS upgrade headers and the admin HTTPS warning. The older name `NODE_ENV` is still read. |
| `SITE_URL` | **Yes on live** | Without it, canonical URLs and the sitemap point to `localhost` and Google won't index the site. |
| `SITE_NAME`, `SITE_TAGLINE` | No | Brand name and tagline used in titles and schema. |
| `SITE_EMAIL`, `SITE_PHONE`, `SITE_ADDRESS` | Recommended | Shown in header, footer, contact page and schema. |
| `SITE_CERTIFICATIONS` | No | Footer text; empty hides it. Only list real certifications. |
| `STAT_PROJECTS`, `STAT_TEAM`, `STAT_YEARS` | No | About page counters; `0` hides them. Only use real numbers. |
| `SOCIAL_*` | Recommended | Footer icons and `sameAs` in schema. Read only from `.env`; a missing or empty key hides that icon. |
| `TRUST_PROXY` | No | `1` makes cookies `Secure` when HTTPS is terminated by a proxy. |
| `MAIL_*` | For email | Email is sent only when `MAIL_HOST`, `MAIL_USERNAME` and `MAIL_PASSWORD` are all set. Otherwise messages are just saved to `storage/contacts.json`. |
| `BLOG_ADMIN_PATH` | **Yes on live** | Falls back to a default that is published in this repo, so always set your own. |
| `BLOG_CREDENTIAL_EMAIL` | For blog admin | Login email. |
| `BLOG_CREDENTIAL_PASSWORD` / `_HASH` | For blog admin | Set one. Without them nobody can sign in. |
| `LIVE_ASSETS`, `CLIENT_URL` | No | Legacy. Leave unset; `SITE_URL` covers both. |

## 4. Getting each credential

### 4.1 `SITE_URL`

Your domain with `https://` and no trailing slash, e.g. `https://scalesphere.in`.
Locally use `http://localhost:3000`.

### 4.2 SMTP: option A, Gmail / Google Workspace

Gmail does not accept your normal password over SMTP; it needs an **App Password**.

1. Open <https://myaccount.google.com/security> with the Gmail account that will send mail.
2. Turn on **2-Step Verification** (required for app passwords).
3. Open <https://myaccount.google.com/apppasswords>, enter a name such as
   `ScaleSphere website` and click **Create**.
4. Copy the 16-character password into `MAIL_PASSWORD` (keep it in quotes if it has spaces).
5. Use:
   ```ini
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_ENCRYPTION=tls
   MAIL_USERNAME=the-gmail-address@gmail.com
   MAIL_FROM=the-gmail-address@gmail.com
   ```

If the app password page says it's unavailable, 2-Step Verification is off, or a
Workspace admin has disabled app passwords.

### 4.3 SMTP: option B, cPanel email account (recommended on live)

Sending from your own domain lands in inboxes more reliably.

1. cPanel → **Email Accounts** → **Create**, e.g. `no-reply@your-domain.com`, and set a password.
2. Next to the account click **Connect Devices**. Under *Secure SSL/TLS Settings*
   note the **Outgoing Server** and **SMTP Port**.
3. Use:
   ```ini
   MAIL_HOST=mail.your-domain.com
   MAIL_PORT=465
   MAIL_ENCRYPTION=ssl
   MAIL_USERNAME=no-reply@your-domain.com
   MAIL_PASSWORD="the mailbox password"
   MAIL_FROM=no-reply@your-domain.com
   MAIL_TO=info@your-domain.com
   ```

### 4.4 `BLOG_ADMIN_PATH`

Generate a random value and keep it private. It's the secret part of the admin URL.

```bash
php -r "echo bin2hex(random_bytes(12)), PHP_EOL;"
```

Example result: `9f2c4a1be07d53a8c61e4b90` → admin at `/blog/9f2c4a1be07d53a8c61e4b90/login`.

### 4.5 Blog password hash (recommended)

Store a bcrypt hash instead of the plain password:

```bash
php -r "echo password_hash('your-long-password', PASSWORD_DEFAULT), PHP_EOL;"
```

Paste the output (starts with `$2y$`) into `BLOG_CREDENTIAL_PASSWORD_HASH` and clear
`BLOG_CREDENTIAL_PASSWORD`. You still sign in with `your-long-password`.

Use `password_hash` exactly as above. A SHA-256 hash (`sha256sum`, online generators) will **not** work.

## 5. Blog admin

- Sign in at `SITE_URL/blog/<BLOG_ADMIN_PATH>/login` with `BLOG_CREDENTIAL_EMAIL` and the password.
- The dashboard lists all posts. **New post** creates one; each post has edit, preview and delete.
- Each post has a title, slug, excerpt, cover image, body, FAQs and SEO fields. Status is
  *draft* or *published*; a published post with a future date stays hidden until that date (IST).
- Saving writes a PHP file to `src/pages/blog/posts/<slug>.php` and images to
  `src/assets/images/blog/<slug>/`. Backups and deleted posts go to `storage/blog-admin/`.
- New posts appear on `/blog`, the home page and `sitemap.xml` immediately. **No redeploy is needed.**
- Security: 5 wrong passwords lock the login for 15 minutes (longer if repeated); sessions
  end after 30 minutes idle or 12 hours. On a live server sign in over HTTPS only.

## 6. Go live on cPanel

1. **PHP version**
   cPanel → **MultiPHP Manager**: set the domain to PHP 8.1+ (8.3 if available).
   cPanel → **Select PHP Version → Extensions**: tick `gd`, `fileinfo`, `dom`, `mbstring`, `openssl`, `zip`.

2. **Upload the code** to the domain's document root (usually `public_html/`). The root
   must be the folder that contains `index.php` and `.htaccess`. Use one of:
   - **File Manager:** zip the project locally, without `.git`, `.env` and `storage/*.json`.
     Then upload the zip and click **Extract**.
   - **Git:** cPanel → **Git™ Version Control** → **Create**, paste the repository URL and use
     the document root as the path. Private repos need an SSH deploy key.

3. **PHPMailer.** Pick one:
   - cPanel → **Terminal**: `cd public_html && composer install --no-dev`.
   - Run `php src/scripts/install-phpmailer.php` in Terminal.
   - Run `composer install` locally and upload the `vendor/` folder.

4. **Create `.env`** in the document root (File Manager → **+ File**) using
   [section 3](#3-the-env-file), with at least:
   ```ini
   APP_ENV=production
   SITE_URL=https://your-domain.com
   MAIL_...           (section 4.2 or 4.3)
   BLOG_ADMIN_PATH=   (section 4.4)
   BLOG_CREDENTIAL_EMAIL=...
   BLOG_CREDENTIAL_PASSWORD_HASH=   (section 4.5)
   ```
   `.env` is blocked from the web by `.htaccess` and `src/app.php`.

5. **Permissions.** These folders must be writable by PHP (`755`; use `775` only if writes fail):
   - `storage/`: contact messages, rate limits, admin login guard, backups.
   - `src/pages/blog/posts/`: blog posts saved from the admin.
   - `src/assets/images/` (and `src/assets/images/blog/`): uploads and generated WebP images.

6. **HTTPS.** cPanel → **SSL/TLS Status** → run **AutoSSL** for the domain.
   Then cPanel → **Domains** → turn on **Force HTTPS Redirect**.

7. **Check it works:**
   - `https://your-domain.com/health` shows `{"ok":true,...}`.
   - The home page, a service page and `/blog` open.
   - `https://your-domain.com/.env` and `/storage/contacts.json` return 403 or 404.
   - Send a test message from `/contact` and confirm the email arrives.
   - Sign in to the blog admin.

8. **Search engines.** Add the domain in [Google Search Console](https://search.google.com/search-console)
   and [Bing Webmaster Tools](https://www.bing.com/webmasters). Submit
   `https://your-domain.com/sitemap.xml` in both. `robots.txt` and the sitemap are generated automatically.

## 7. Updating the live site

Re-upload or `git pull` only when code or design changes; blog posts never need it.

Posts and uploads created on the live server are **not in git**. When you update, do
**not** overwrite or delete these on the server:

- `.env`
- `storage/`
- `src/pages/blog/posts/` (posts written in the admin)
- `src/assets/images/blog/` (their images)

Download these folders from time to time as a backup.

## 8. Images

Photos in `src/assets/images` (except `brand/` and `blog/`) get WebP copies: a same-size
`photo.webp` and a card-size `photo-640.webp`. They are generated files (git-ignored).
The server builds them the first time a page shows the photo and rebuilds them when the
original changes. Pages switch `<img>` tags to them automatically, and browsers fall back
to the original if needed. This needs `gd` with WebP and a writable `src/assets/images`.

To build them all at once (e.g. after uploading many photos):

```bash
php src/scripts/make-image-variants.php
```

To add a photo, put the JPG/PNG (about 1200 px wide is enough) in `src/assets/images/...`
and reference the `.jpg`/`.png` path in the template; the WebP switch happens on its own.

## 9. Temporary public link (optional)

Shows the local site on another device or to a client, without hosting.

1. Install Cloudflare Tunnel once: `winget install Cloudflare.cloudflared`.
   If WinGet fails with `0x80072eff`, download `cloudflared-windows-amd64.exe` from
   <https://github.com/cloudflare/cloudflared/releases/latest> and save it as
   `%LOCALAPPDATA%\cloudflared\cloudflared.exe`.
2. Run `src\scripts\share-site.cmd` (Windows) or `./src/scripts/share-site.sh` (macOS/Linux). It
   starts PHP and prints a `https://….trycloudflare.com` URL.

If you already started the site with `src\scripts\start-site.cmd`, run the tunnel against `localhost`:

```bash
cloudflared tunnel --url http://localhost:3000
```

The link works only while both the PHP server and the tunnel run, and is slower than real
hosting because everything goes through your internet upload and PHP's single-threaded
dev server. Stop with `Ctrl+C`.

## 10. Troubleshooting

| Problem | Fix |
|---|---|
| `PHP not found` from `src\scripts\start-site.cmd` | Install PHP into `%LOCALAPPDATA%\Programs\php-8.3` or XAMPP (step 2.1). |
| Every page/image is slow locally | Open `http://localhost:3000`, not `127.0.0.1:3000`. |
| Tunnel shows **502 Bad gateway** | The PHP server isn't running, or the tunnel URL host differs from the server's (`localhost` vs `127.0.0.1`). Start the server, then run the tunnel against the same host. |
| Contact form says it saved but couldn't send email | Check the `MAIL_*` values. Gmail needs an App Password (4.2). On cPanel try port 465 + `ssl`. Some hosts block outgoing 587; use the cPanel mailbox. |
| Blog admin URL shows 404 | The URL must use your `BLOG_ADMIN_PATH` value exactly. |
| Blog login says invalid even with the right password | The hash must come from `password_hash` (4.5). Remove stray spaces in `.env`. |
| Blog login says "Too many attempts" | Wait for the time shown (15 minutes after 5 wrong tries, doubling on repeat). As the site owner you can also delete `storage/blog-admin/guard.json`. |
| Canonical / sitemap shows `localhost` on the live site | Set `SITE_URL` in the live `.env`. |
| Images stay `.jpg` instead of `.webp` | Enable `gd` (with WebP) and make `src/assets/images` writable. |
| Saving a blog post fails | Make `src/pages/blog/posts/`, `src/assets/images/blog/` and `storage/` writable. |
| `500 Server error` | Check the PHP error log (cPanel → **Errors** or `error_log` in the document root). |

## 11. Project structure

Everything the site needs lives in `src/`. Only `index.php` and the files that tools expect
at the top level (Apache, Composer, Git, `.env`) stay in the root, which is also the cPanel
document root.

```
ScaleSphere/                          cPanel document root (public_html)
├── index.php                         Entry point: every request goes through here
├── .htaccess                         Apache: URL rewrites, blocks private files, caching, compression
├── .env                              Settings and secrets (never committed)
├── .env.example                      Template for .env
├── .gitignore                        Files Git must not track (.env, vendor/, storage data, WebP copies)
├── composer.json                     PHP dependencies (PHPMailer)
├── README.md                         This guide
│
├── src/                              Source code and assets (direct web access blocked by src/.htaccess)
│   ├── app.php                       Front controller: blocks private paths, serves assets, loads and routes pages
│   ├── bootstrap.php                 Loads .env and sends security headers (CSP, HSTS in production)
│   │
│   ├── config/
│   │   └── env.php                   Reads .env into ts_env()
│   │
│   ├── core/                         Shared helpers used by every page
│   │   ├── router.php                URL → page file, 404s, blog admin routes
│   │   ├── render.php                ts_layout(), contact form handling, responsive images
│   │   ├── seo.php                   Titles, meta, Open Graph, JSON-LD schema, sitemap.xml, robots.txt
│   │   ├── site.php                  Site settings from .env, main navigation, services menu
│   │   ├── mail.php                  SMTP email through PHPMailer
│   │   ├── path.php                  Request path cleanup, static files, cache headers (ETag / 304)
│   │   ├── image-variants.php        Builds WebP copies of photos
│   │   └── work-content.php          "Our Work" projects and FAQs
│   │
│   ├── layout/                       Shared page shell
│   │   ├── layout.php                <html>, <head>, CSS/JS includes
│   │   ├── header.php                Top bar, navigation, mega menu
│   │   └── footer.php                Footer, social icons
│   │
│   ├── pages/                        One folder per URL
│   │   ├── page.php                  /            (home)
│   │   ├── not-found.php             404 page
│   │   ├── about-us/page.php         /about-us
│   │   ├── contact/page.php          /contact
│   │   ├── our-work/page.php         /our-work
│   │   ├── services/
│   │   │   ├── page.php              /services
│   │   │   ├── hub.php               /services/{category}         → src/services/<category>/hub.php
│   │   │   └── detail.php            /services/{category}/{slug}  → src/services/<category>/<service>.php
│   │   └── blog/
│   │       ├── page.php              /blog
│   │       ├── posts/                /blog/{slug}: one PHP file per article (written by the admin)
│   │       └── admin/                Blog admin screens: login, dashboard, editor (+ their CSS/JS)
│   │
│   ├── blog/                         Blog engine
│   │   ├── blog.php                  Loads and lists posts
│   │   ├── blog-view.php             Renders an article page
│   │   └── blog-admin.php            Private admin: login, security, save/delete posts, image uploads
│   │
│   ├── services/                     Service pages
│   │   ├── service-pages.php         Picks the template for each service URL
│   │   ├── services-content.php      Service lists and category data
│   │   ├── service-data.php          Shared service copy
│   │   ├── online-marketing/         hub.php, template.php (shared layout), seo.php, sem.php,
│   │   │                             social-media.php, content-marketing.php, pay-per-click.php,
│   │   │                             email-campaigns.php, analytics.php
│   │   ├── development/              hub.php, common.php, detail-skin.php, website.php, software.php,
│   │   │                             crm.php, ecommerce.php, sharepoint.php, netsuite.php
│   │   ├── mobile-apps/              hub.php, common.php, android.php, ios.php, react-native.php,
│   │   │                             flutter.php, support.php
│   │   └── creative-design/          hub.php, common.php, ui-ux.php, brand-identity.php, logo-design.php,
│   │                                 design-systems.php, motion-graphics.php, product-design.php, prototypes.php
│   │
│   ├── assets/                       Files browsers download (the only public part of src/)
│   │   ├── .htaccess                 Allows static files, denies scripts
│   │   ├── css/                      Stylesheets (tailwind.css is generated, see below)
│   │   ├── js/                       Scripts (animations, menus, home page)
│   │   ├── images/                   brand/, blog/ (admin uploads), dev/, mobile/, stock/, team/, …
│   │   └── favicon.ico, favicon.png, apple-touch-icon.png, site.webmanifest
│   │
│   ├── tailwind/                     Tailwind source + config (only to rebuild assets/css/tailwind.css)
│   │   ├── tailwind.css
│   │   └── tailwind.config.js
│   │
│   └── scripts/                      Tools, not part of the website
│       ├── start-site.cmd / .sh      Start the local server
│       ├── share-site.cmd / .sh      Local server + temporary public link
│       ├── install-phpmailer.php     Installs PHPMailer without Composer
│       └── make-image-variants.php   Pre-builds WebP copies of all photos
│
├── storage/                          Runtime data, created by the site (not committed, keep on updates)
│   ├── contacts.json                 Contact form messages
│   ├── contact-rate.json             Contact form rate limit
│   └── blog-admin/                   Login guard, auth log, backups, deleted posts
│
└── vendor/                           PHPMailer, installed by Composer (not committed)
```

`storage/` and `vendor/` stay in the root on purpose: they hold generated data and Composer
packages, not source code, and must survive code updates.

### How a request is handled

1. `.htaccess` sends every request to `index.php`, except files under `/css`, `/js`, `/images`
   and the icons, which Apache serves straight from `src/assets/`.
2. `index.php` calls `src/app.php`, which blocks private paths (`/src`, `/storage`, `/vendor`,
   `/.env`, …) and fixes duplicate URLs (trailing slashes, `/index.php`).
3. `src/bootstrap.php` loads `.env` and sends the security headers.
4. `src/core/router.php` maps the URL to a file in `src/pages/` (or the blog admin).
5. The page builds its HTML and passes it to `ts_layout()` (`src/core/render.php`), which wraps it in
   `src/layout/layout.php` with the header, footer, SEO tags and responsive images.

Public URLs never include `src/assets`: `/css/style.css` is the file `src/assets/css/style.css`.

### Where to change things

| To change… | Edit |
|---|---|
| Phone, email, address, social links | `.env` |
| Header / footer | `src/layout/header.php`, `src/layout/footer.php` |
| Home page | `src/pages/page.php` |
| About, Contact, Our Work page | `src/pages/<page>/page.php` |
| Our Work projects | `src/core/work-content.php` |
| A service page, e.g. SEO | `src/services/online-marketing/seo.php` |
| A service category page | `src/services/<category>/hub.php` |
| Services in the menu | `TS_SERVICE_MEGA` in `src/core/site.php` |
| Page titles / schema / sitemap | `src/core/seo.php` |
| Styles / scripts / images | `src/assets/css/`, `src/assets/js/`, `src/assets/images/` |
| Blog posts | The blog admin (section 5), or the files in `src/pages/blog/posts/` |

### Adding a page or a service

- **New page** (e.g. `/careers`): create `src/pages/careers/page.php` (copy `contact/page.php` as a
  starting point), add the URL to the page list at the top of `src/core/router.php` and to the
  sitemap list in `src/core/seo.php`.
- **New service**: add its name to the right column of `TS_SERVICE_MEGA` in `src/core/site.php`.
  It then appears in the menu and at `/services/<category>/<slug>` with the generic layout. For a
  custom page, create `src/services/<category>/<service>.php` and register it in
  `ts_render_service_detail()` in `src/services/service-pages.php`.

### Rebuilding Tailwind CSS (rarely needed)

Needed only if you add Tailwind classes that aren't in `src/assets/css/tailwind.css` yet.
Download the standalone Tailwind CLI **v3** binary from
<https://github.com/tailwindlabs/tailwindcss/releases> (no npm needed) and run:

```bash
tailwindcss -c ./src/tailwind/tailwind.config.js -i ./src/tailwind/tailwind.css -o ./src/assets/css/tailwind.css --minify
```
