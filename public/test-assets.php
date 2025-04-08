<?php
// Check if the style.css file exists
$stylePath = __DIR__ . '/Admin/assets/css/style.css';
$styleExists = file_exists($stylePath);
$styleSize = $styleExists ? filesize($stylePath) : 0;

// List all files in the Admin directory
$adminDir = __DIR__ . '/Admin';
$adminFiles = scandir($adminDir);

// List all files in the Admin/assets directory
$assetsDir = __DIR__ . '/Admin/assets';
$assetsFiles = scandir($assetsDir);

// List all files in the Admin/assets/css directory
$cssDir = __DIR__ . '/Admin/assets/css';
$cssFiles = scandir($cssDir);

// Output the results
echo '<h1>Asset Test Results</h1>';

echo '<h2>Style.css File</h2>';
echo '<p>Path: ' . $stylePath . '</p>';
echo '<p>Exists: ' . ($styleExists ? 'Yes' : 'No') . '</p>';
echo '<p>Size: ' . $styleSize . ' bytes</p>';

echo '<h2>Admin Directory Contents</h2>';
echo '<pre>';
print_r($adminFiles);
echo '</pre>';

echo '<h2>Admin/assets Directory Contents</h2>';
echo '<pre>';
print_r($assetsFiles);
echo '</pre>';

echo '<h2>Admin/assets/css Directory Contents</h2>';
echo '<pre>';
print_r($cssFiles);
echo '</pre>';

// Try to include the style.css file directly
if ($styleExists) {
    echo '<h2>Direct Style.css Inclusion</h2>';
    echo '<style>';
    include $stylePath;
    echo '</style>';
    echo '<p>If you see styling applied to this page, the style.css file is accessible.</p>';
}
?> 