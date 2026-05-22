@echo off
REM Setup script untuk Sistem Booking Hotel
REM Pastikan Anda sudah di folder project root sebelum menjalankan script ini

echo ======================================
echo Sistem Booking Hotel - Setup Script
echo ======================================
echo.

echo [1/5] Menginstall PHP dependencies...
call php-setup.bat
if errorlevel 1 goto error

echo [2/5] Menginstall NPM dependencies...
call npm-setup.bat
if errorlevel 1 goto error

echo [3/5] Generate application key...
d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe artisan key:generate
if errorlevel 1 goto error

echo [4/5] Running database migrations & seeds...
d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe artisan migrate --seed
if errorlevel 1 goto error

echo [5/5] Building assets...
cmd /c npm run build
if errorlevel 1 goto error

echo.
echo ======================================
echo Setup berhasil! 
echo ======================================
echo.
echo Langkah selanjutnya:
echo 1. Buka browser: http://localhost:8000
echo 2. Login dengan:
echo    Email: admin@hotel.com
echo    Password: password
echo 3. Jalankan server dengan: php artisan serve
echo.
pause
goto end

:error
echo.
echo ======================================
echo ERROR: Setup gagal!
echo ======================================
pause
exit /b 1

:end
exit /b 0
