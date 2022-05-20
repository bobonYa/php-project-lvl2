<?php

namespace App\Gendiff;

use Docopt;

//require __DIR__ . '/../src/docopt.php';
function start()
{
$doc = <<<'DOCOPT'
Generate diff


Usage:
  gendiff (-h|--help)
  gendiff (-v|--version)
  gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
  -h --help                show this help message and exit
  -v --version                show version and exit
  --format <fmt>                Report format [default: stylish]


DOCOPT;

    $result = Docopt::handle($doc, array('version' => '1.0.0rc2'));
    foreach ($result as $k => $v)
        echo $k . ': ' . json_encode($v) . PHP_EOL;
}