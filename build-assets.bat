@echo off
REM Build assets for production

echo.
echo ======================================
echo Building Assets for Production
echo ======================================
echo.

npm run build

if %ERRORLEVEL% EQU 0 (
    echo.
    echo ======================================
    echo Build berhasil!
    echo ======================================
) else (
    echo.
    echo ======================================
    echo Build gagal!
    echo ======================================
    exit /b 1
)

pause
