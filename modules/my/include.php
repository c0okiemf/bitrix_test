<?php

$path = __DIR__ . '/lib';

function getDirContents($dir, &$results = array()){
    $files = scandir($dir);
    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = $path;
        } else if($value != "." && $value != "..") {
            getDirContents($path, $results);
        }
    }
    return $results;
}

foreach (getDirContents($path) as $file)
{
    require_once($file);
}