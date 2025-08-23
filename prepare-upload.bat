@echo off
echo ==========================================
echo PORTAL DESA - PREPARE FOR UPLOAD SCRIPT
echo ==========================================

REM Create backup folder
if not exist "backup" mkdir backup

REM Backup current .env file
if exist ".env" (
    echo Backing up current .env file...
    copy ".env" "backup\.env.backup.%date:~-4,4%-%date:~-10,2%-%date:~-7,2%"
)

REM Copy production environment file
echo Setting up production environment...
copy ".env.production" ".env"

REM Clear development caches (if any)
echo Clearing development caches...
if exist "bootstrap\cache\*.php" del /q "bootstrap\cache\*.php"
if exist "storage\framework\cache\*" del /q /s "storage\framework\cache\*"
if exist "storage\framework\sessions\*" del /q /s "storage\framework\sessions\*"
if exist "storage\framework\views\*" del /q /s "storage\framework\views\*"

REM Create upload-ready folder
echo Creating upload-ready folder...
if exist "upload-ready" rmdir /s /q "upload-ready"
mkdir "upload-ready"

REM Copy essential files (excluding unnecessary ones)
echo Copying files for upload...
robocopy . upload-ready /E /XD node_modules .git vendor backup upload-ready storage\logs storage\framework\cache storage\framework\sessions storage\framework\views /XF *.log *.temp .env.local .env.example composer.lock

REM Copy the production .env file
copy ".env" "upload-ready\.env"

REM Copy deployment scripts
copy "deploy-hostinger.sh" "upload-ready\"
copy "DEPLOYMENT_GUIDE.md" "upload-ready\"

REM Create storage directories structure (empty)
mkdir "upload-ready\storage\app\public" 2>nul
mkdir "upload-ready\storage\framework\cache" 2>nul
mkdir "upload-ready\storage\framework\sessions" 2>nul
mkdir "upload-ready\storage\framework\views" 2>nul
mkdir "upload-ready\storage\logs" 2>nul

REM Create placeholder files for empty directories
echo. > "upload-ready\storage\app\public\.gitkeep"
echo. > "upload-ready\storage\framework\cache\.gitkeep"
echo. > "upload-ready\storage\framework\sessions\.gitkeep"
echo. > "upload-ready\storage\framework\views\.gitkeep"
echo. > "upload-ready\storage\logs\.gitkeep"

echo.
echo ==========================================
echo PREPARATION COMPLETED!
echo ==========================================
echo.
echo Files are ready in 'upload-ready' folder
echo.
echo NEXT STEPS:
echo 1. Compress the 'upload-ready' folder to ZIP/TAR
echo 2. Upload to your Hostinger hosting
echo 3. Extract in public_html directory
echo 4. Run deploy-hostinger.sh script via SSH
echo 5. Update database credentials in .env
echo.
echo IMPORTANT: 
echo - Update .env file with your actual database credentials
echo - Make sure to set correct APP_URL
echo - Don't forget to set APP_DEBUG=false for production
echo.
pause
