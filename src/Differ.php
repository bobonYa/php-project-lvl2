<?php

namespace Differ\Differ;

/**
 * @param string $file1Path
 * @param string $file2Path
 * @return string
 */
function genDiff(string $file1Path, string $file2Path)
{

    $file1 = getData($file1Path);
    $file2 = getData($file2Path);
    $keyListFirst = array_keys($file1);
    $keyListSecond = array_keys($file2);
    $keyList = array_unique(array_merge($keyListFirst, $keyListSecond));
    asort($keyList);
    $response = [];
    foreach ($keyList as $key) {
        if (isset($file1[$key]) && isset($file2[$key])) {
            if ($file1[$key] === $file2[$key]) {
                $response[] = generateString($key, json_encode($file2[$key]));
            } else {
                $response[] = generateString(" - " . $key, json_encode($file1[$key]));
                $response[] = generateString(" + " . $key, json_encode($file2[$key]));
            }
        } elseif (isset($file1[$key]) && !isset($file2[$key])) {
            $response[] = generateString(" - " . $key, json_encode($file1[$key]));
        } elseif (!isset($file1[$key]) && isset($file2[$key])) {
            $response[] = generateString(" + " . $key, json_encode($file2[$key]));
        }
    }
    $string = implode(PHP_EOL, $response);
    return $string;
}

/**
 * @param string $filePath
 * @return array
 */
function getData(string $filePath): array
{
    $file = file_get_contents($filePath);
    if (!$file) {
        return [];
    }
    $file = json_decode($file, true);
    return ($file);
}

/**
 * @param string $key
 * @param string|bool $val
 * @return string
 */
function generateString(string $key, string|bool $val)
{
    return "{$key}: {$val}";
}
