<?php
// scripts/optimize-logo.php
$sourceFile = __DIR__ . '/../marsu.png';
$destFile   = __DIR__ . '/../public/assets/img/marsu.png';
$destFileSm = __DIR__ . '/../public/assets/img/marsu-sm.png';

if (!file_exists($sourceFile)) {
    echo "Source logo not found.\n";
    exit(1);
}

// 256x256
$src = imagecreatefrompng($sourceFile);
$w = imagesx($src);
$h = imagesy($src);

$dst = imagecreatetruecolor(256, 256);
imagealphablending($dst, false);
imagesavealpha($dst, true);
imagecopyresampled($dst, $src, 0, 0, 0, 0, 256, 256, $w, $h);
imagepng($dst, $destFile, 8);
imagedestroy($dst);

// 64x64 favicon / avatar
$dstSm = imagecreatetruecolor(64, 64);
imagealphablending($dstSm, false);
imagesavealpha($dstSm, true);
imagecopyresampled($dstSm, $src, 0, 0, 0, 0, 64, 64, $w, $h);
imagepng($dstSm, $destFileSm, 8);
imagedestroy($dstSm);

imagedestroy($src);

echo "Optimized logo created: " . filesize($destFile) . " bytes\n";
echo "Small logo created: " . filesize($destFileSm) . " bytes\n";
