# =====================================================================
#  CAF — Script para empaquetar el código final del sitio web
#  Genera: CAF-Sitio-Web-AAAA-MM-DD.zip listo para entregar al cliente
# =====================================================================
#  USO (en PowerShell, desde la raíz del proyecto):
#    .\entrega-cliente\empaquetar-entrega.ps1
# =====================================================================

$ErrorActionPreference = "Stop"

# Carpeta raíz = la del proyecto (un nivel arriba del script)
$projectRoot = (Resolve-Path "$PSScriptRoot\..").Path
$projectName = "CAF-Sitio-Web"
$fecha       = Get-Date -Format "yyyy-MM-dd"
$zipName     = "$projectName-$fecha.zip"
$tempDir     = Join-Path $env:TEMP "caf-package-$fecha"
$destDir     = Join-Path $tempDir $projectName

# Limpia ejecuciones previas
if (Test-Path $tempDir) { Remove-Item $tempDir -Recurse -Force }
New-Item -ItemType Directory -Path $destDir | Out-Null

Write-Host "Empaquetando proyecto desde: $projectRoot" -ForegroundColor Cyan
Write-Host "Destino temporal: $destDir" -ForegroundColor Cyan

# Carpetas y archivos a excluir
$exclude = @(
    "node_modules",
    "vendor",
    ".git",
    ".idea",
    ".vscode",
    ".env",
    ".phpunit.result.cache",
    "storage\framework\cache\data",
    "storage\framework\sessions",
    "storage\framework\views",
    "storage\logs",
    "public\storage"
)

# Copiar todo el proyecto excluyendo lo anterior
$excludeArgs = $exclude | ForEach-Object { "/XD"; (Join-Path $projectRoot $_) }
robocopy $projectRoot $destDir /E /NFL /NDL /NJH /NJS @excludeArgs | Out-Null

# Asegurar que .env NO viaja, pero .env.example sí
if (Test-Path (Join-Path $destDir ".env")) { Remove-Item (Join-Path $destDir ".env") -Force }

# Crear el ZIP en la carpeta entrega-cliente
$zipPath = Join-Path $projectRoot "entrega-cliente\$zipName"
if (Test-Path $zipPath) { Remove-Item $zipPath -Force }

Write-Host "Comprimiendo a: $zipPath" -ForegroundColor Cyan
Compress-Archive -Path "$destDir\*" -DestinationPath $zipPath -CompressionLevel Optimal

# Limpieza
Remove-Item $tempDir -Recurse -Force

$size = (Get-Item $zipPath).Length / 1MB
Write-Host ""
Write-Host "Listo." -ForegroundColor Green
Write-Host "Archivo: $zipPath" -ForegroundColor Green
Write-Host ("Tamano:  {0:N2} MB" -f $size) -ForegroundColor Green
Write-Host ""
Write-Host "Este ZIP NO incluye:" -ForegroundColor Yellow
Write-Host "  - vendor/        (el cliente lo regenera con 'composer install')"
Write-Host "  - .env           (contiene secretos)"
Write-Host "  - storage/cache  (se regeneran solos)"
Write-Host ""
Write-Host "El cliente solo debe descomprimir y seguir las instrucciones de README.md / ENTREGA.md."
