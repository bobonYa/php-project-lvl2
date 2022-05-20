<?php

namespace Differ\Differ;

function genDiff($file1Path, $file2Path)
{
    if (!file_exists($file1Path)) {
        print ("File --{$file1Path}-- not found");
        return;
    }

    if (!file_exists($file2Path)) {
        print ("File --{$file2Path}-- not found");
        return;
    }
    $file1 = getData($file1Path);
    $file2 = getData($file2Path);
//    var_dump($file1);
//    var_dump($file2);
    $keyListFirst = array_keys($file1);
    $keyListSecond = array_keys($file2);
    $keyList = array_unique(array_merge($keyListFirst, $keyListSecond));
    asort($keyList);
    $response = [];
//    var_dump($keyList);
    foreach ($keyList as $key) {
//        echo $k . ': ' . json_encode($v) . PHP_EOL;
        if (isset($file1[$key]) && isset($file2[$key])) {
            if ($file1[$key] === $file2[$key]) {
                $response[] = generateString($key, json_encode($file2[$key]));
            } else {
                $response[] = generateString(" - " . $key, json_encode($file1[$key]));
                $response[] = generateString(" + " . $key, json_encode($file2[$key]));
            }
        }
        elseif (isset($file1[$key]) && !isset($file2[$key])) {
            $response[] = generateString(" - " . $key, json_encode($file1[$key]));
        } elseif (!isset($file1[$key]) && isset($file2[$key])) {
            $response[] = generateString(" + " . $key, json_encode($file2[$key]));
        }


    }
    $string = implode(PHP_EOL,$response);
    return $string;
//    print_r(json_encode($response));
//    var_dump($response);
}

function getData($filePath)
{
    $file = file_get_contents($filePath);
    $file = json_decode($file, true);
    return ($file);
}

function generateString($key, $val)
{
    return "{$key}: {$val}";
}

//function getS
