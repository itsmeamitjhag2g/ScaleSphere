@echo off
set PHP=%LOCALAPPDATA%\Programs\php-8.3\php.exe
if not exist "%PHP%" set PHP=C:\xampp\php\php.exe
if not exist "%PHP%" (
  echo PHP not found. Install PHP 8.3 or use XAMPP, then reopen the terminal.
  exit /b 1
)
cd /d "%~dp0"
echo ScaleSphere: http://localhost:3000
"%PHP%" -S localhost:3000 index.php
