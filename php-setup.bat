@echo off
REM PHP Setup Script - Install Composer dependencies
REM Pastikan composer sudah installed globally

echo Installing PHP dependencies...
d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe -r "if (file_exists('composer.phar')) { echo 'composer.phar exists'; exit(0); } else { echo 'Installing Composer'; }"

if exist composer.phar (
    d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe composer.phar install
) else (
    d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe -r "$in=fopen('https://getcomposer.org/installer','r');$out=fopen('composer-setup.php','w');while($chunk=fread($in,1024))fwrite($out,$chunk);fclose($in);fclose($out);"
    d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe composer-setup.php
    d:\laragon\bin\php\php-8.5.6-nts-Win32-vs17-x64\php.exe composer.phar install
    del composer-setup.php
)

echo PHP dependencies installed.
