@echo off
setlocal
set PHP=%LOCALAPPDATA%\Programs\php-8.3\php.exe
if not exist "%PHP%" set PHP=C:\xampp\php\php.exe
if not exist "%PHP%" (
  echo PHP not found. Install PHP 8.3 or use XAMPP, then reopen the terminal.
  exit /b 1
)
set CLOUDFLARED=cloudflared.exe
where cloudflared >nul 2>nul
if errorlevel 1 set CLOUDFLARED=%LOCALAPPDATA%\cloudflared\cloudflared.exe
if not exist "%CLOUDFLARED%" (
  echo cloudflared not found.
  echo Download cloudflared-windows-amd64.exe from:
  echo https://github.com/cloudflare/cloudflared/releases/latest
  echo Save it as: %LOCALAPPDATA%\cloudflared\cloudflared.exe
  echo Or install it with: winget install Cloudflare.cloudflared
  exit /b 1
)
if "%PORT%"=="" set PORT=3000
cd /d "%~dp0"
echo Starting ScaleSphere on http://127.0.0.1:%PORT% ...
start "ScaleSphere PHP" /D "%~dp0" "%PHP%" -S 127.0.0.1:%PORT% index.php
echo Starting public tunnel. Copy the https:// URL printed by cloudflared.
"%CLOUDFLARED%" tunnel --url http://127.0.0.1:%PORT%