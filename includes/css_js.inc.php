<?php
if (isset($_SERVER["admin"])) {
    $manifestUrl = "../dist/.vite/manifest.json";
    $source = "admin/js/index.js";
    $dist = "../dist/";
} else {
    $manifestUrl = "./dist/.vite/manifest.json";
    $source = "js/index.js";
    $dist = "./dist/";
}
$manifestJson = file_get_contents($manifestUrl);
$manifestObj = json_decode($manifestJson, true);


function getCSS($src)
{
    global $manifestObj, $dist;
    return $dist . $manifestObj["js/link_$src.js"]["css"][0];
}

function getJS($src)
{
    global $manifestObj, $dist;
    return $dist . $manifestObj["js/link_$src.js"]["file"];
}
