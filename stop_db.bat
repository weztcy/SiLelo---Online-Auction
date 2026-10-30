@echo off
set "MARIADB_ADMIN=%USERPROFILE%\mariadb\MariaDB 13.0\bin\mariadb-admin.exe"

if exist "%MARIADB_ADMIN%" (
    echo Stopping MariaDB server gracefully...
    "%MARIADB_ADMIN%" -u root shutdown
) else (
    echo MariaDB admin utility not found. Stopping via taskkill...
    taskkill /F /IM mysqld.exe
)
echo MariaDB stopped.
