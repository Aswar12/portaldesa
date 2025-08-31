# Clean SQL File Script
# This PowerShell script removes problematic characters from SQL files

param(
    [Parameter(Mandatory=$true)]
    [string]$InputFile,
    [Parameter(Mandatory=$true)]
    [string]$OutputFile
)

Write-Host "Cleaning SQL file: $InputFile"
Write-Host "Output file: $OutputFile"

try {
    # Read the file with UTF-8 encoding
    $content = Get-Content -Path $InputFile -Raw -Encoding UTF8
    
    # Remove null characters and other problematic characters
    $content = $content -replace '\x00', ''  # Remove null characters
    $content = $content -replace '\x01', ''  # Remove SOH characters
    $content = $content -replace '\x02', ''  # Remove STX characters
    $content = $content -replace '\x03', ''  # Remove ETX characters
    $content = $content -replace '\x04', ''  # Remove EOT characters
    $content = $content -replace '\x05', ''  # Remove ENQ characters
    $content = $content -replace '\x06', ''  # Remove ACK characters
    $content = $content -replace '\x07', ''  # Remove BEL characters
    $content = $content -replace '\x08', ''  # Remove BS characters
    $content = $content -replace '\x0E', ''  # Remove SO characters
    $content = $content -replace '\x0F', ''  # Remove SI characters
    $content = $content -replace '\x10', ''  # Remove DLE characters
    $content = $content -replace '\x11', ''  # Remove DC1 characters
    $content = $content -replace '\x12', ''  # Remove DC2 characters
    $content = $content -replace '\x13', ''  # Remove DC3 characters
    $content = $content -replace '\x14', ''  # Remove DC4 characters
    $content = $content -replace '\x15', ''  # Remove NAK characters
    $content = $content -replace '\x16', ''  # Remove SYN characters
    $content = $content -replace '\x17', ''  # Remove ETB characters
    $content = $content -replace '\x18', ''  # Remove CAN characters
    $content = $content -replace '\x19', ''  # Remove EM characters
    $content = $content -replace '\x1A', ''  # Remove SUB characters
    $content = $content -replace '\x1B', ''  # Remove ESC characters
    $content = $content -replace '\x1C', ''  # Remove FS characters
    $content = $content -replace '\x1D', ''  # Remove GS characters
    $content = $content -replace '\x1E', ''  # Remove RS characters
    $content = $content -replace '\x1F', ''  # Remove US characters
    
    # Normalize line endings to Unix style
    $content = $content -replace "`r`n", "`n"
    $content = $content -replace "`r", "`n"
    
    # Write the cleaned content to output file with UTF-8 encoding
    $content | Set-Content -Path $OutputFile -Encoding UTF8 -NoNewline
    
    Write-Host "✅ File cleaned successfully!"
    Write-Host "Original size: $((Get-Item $InputFile).Length) bytes"
    Write-Host "Cleaned size: $((Get-Item $OutputFile).Length) bytes"
    
} catch {
    Write-Host "❌ Error cleaning file: $($_.Exception.Message)" -ForegroundColor Red
}
