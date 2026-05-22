@echo off
REM Start development server

echo.
echo ======================================
echo Sistem Booking Hotel - Dev Server
echo ======================================
echo.
echo Development server starting...
echo Open browser: http://localhost:8000
echo.

d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe artisan serve

pause
