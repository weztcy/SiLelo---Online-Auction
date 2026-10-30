@echo off
set "MARIADB_PATH=%USERPROFILE%\mariadb\MariaDB 13.0\bin\mysqld.exe"
set "MARIADB_INI=%USERPROFILE%\mariadb\data\my.ini"

if not exist "%MARIADB_PATH%" (
    echo MariaDB executable not found at %MARIADB_PATH%
    exit /b 1
)

echo Starting MariaDB server...
start "" /B "%MARIADB_PATH%" --defaults-file="%MARIADB_INI%"
timeout /t 2 >nul
tasklist /fi "imagename eq mysqld.exe" | findstr /i "mysqld.exe" >nul
if %errorlevel% == 0 (
    echo MariaDB is running on port 3306.
) else (
    echo Failed to start MariaDB.
)
