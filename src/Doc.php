<?php

namespace App\Doc;

use Docopt;

use function Differ\Differ\genDiff;

function start()
{
    $doc = <<<'DOCOPT'
Generate diff


Usage:
  gendiff (-h|--help)
  gendiff (-v|--version)
  gendiff [--format <fmt>] <firstFile> <secondFile>
  gendiff <firstFile> <secondFile>

Options:
  -h --help                show this help message and exit
  -v --version                show version and exit
  --format <fmt>                Report format [default: stylish]



DOCOPT;

    $result = Docopt::handle($doc, array('version' => '1.0.0rc2'));
//    foreach ($result as $k => $v)
//        echo $k . ': ' . json_encode($v) . PHP_EOL;
    $file1 = $result['<firstFile>'];
    $file2 = $result['<secondFile>'];
    print_r("{ \n" . genDiff($file1, $file2) . "\n}\n");
}
