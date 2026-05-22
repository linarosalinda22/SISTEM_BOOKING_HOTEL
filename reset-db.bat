@echo off
REM Database refresh and reseed

echo.
echo ======================================
echo Resetting Database
echo ======================================
echo.

d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe artisan migrate:refresh --seed

if %ERRORLEVEL% EQU 0 (
    echo.
    echo ======================================
    echo Database reset berhasil!
    echo ======================================
    echo Default credentials:
    echo Email: admin@hotel.com
    echo Password: password
) else (
    echo.
    echo ======================================
    echo Database reset gagal!
    echo ======================================
    exit /b 1
)

pause
