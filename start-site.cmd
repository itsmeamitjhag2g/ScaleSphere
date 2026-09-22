@echo off
set PHP=%LOCALAPPDATA%\Programs\php-8.3\php.exe
if not exist "%PHP%" set PHP=C:\xampp\php\php.exe
if not exist "%PHP%" (
  echo PHP not found. Install PHP 8.3 or use XAMPP, then reopen the terminal.
  exit /b 1
)
if "%HOST%"=="" set HOST=127.0.0.1
if "%PORT%"=="" set PORT=3000
cd /d "%~dp0"
echo ScaleSphere: http://%HOST%:%PORT%
"%PHP%" -S %HOST%:%PORT% index.php
