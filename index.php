<?php
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
$basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/.');
if ($basePath === '/') {
    $basePath = '';
}
header('Location: ' . $basePath . '/front-end/index.php', true, 302);
exit;
