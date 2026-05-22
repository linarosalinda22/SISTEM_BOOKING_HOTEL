@echo off
REM NPM Setup Script - Install Node dependencies

echo Installing NPM dependencies...
where node >nul 2>nul
if %ERRORLEVEL% EQU 0 (
    npm install
    echo NPM dependencies installed.
) else (
    echo ERROR: Node.js tidak ditemukan. Silakan install Node.js terlebih dahulu.
    exit /b 1
)
