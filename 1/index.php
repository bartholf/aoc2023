<?php declare(strict_types=1);

$words = [
    'one' => 'one1one',
    'two' => 'two2two',
    'three' => 'three3three',
    'four' => 'four4four',
    'five' => 'five5five',
    'six' => 'six6six',
    'seven' => 'seven7seven',
    'eight' => 'eight8eight',
    'nine' => 'nine9nine',
];

function translate(string $word): string
{
    global $words;
    foreach ($words as $k => $v) {
        $word = str_replace($k, $v, $word);
    }
    return $word;
}

$input = fopen(__DIR__ . "/input.txt", "r");

$sum = 0;

while (($line = fgets($input)) !== false) {
    preg_match_all('/\d+/', $line, $matches);
    $sum += (int) ($matches[0][0][0]
        . substr(end($matches[0]), -1));
}

fclose($input);

echo $sum . PHP_EOL; // 54877

// Part 2
$input = fopen(__DIR__ . "/input2.txt", "r");

$sum = 0;
while (($line = fgets($input)) !== false) {
    $line = translate($line);
    preg_match_all(
        '/(\d+|one|two|three|four|five|six|seven|eight|nine)/',
        $line,
        $matches);

    $res = array_filter(array_map(
        function ($x) {
            return preg_replace('/[^\d]/', '', $x);
        }, $matches[0]));

    $res = array_values($res);

    $out[] = (int) ($res[0][0] . substr(end($res), -1));
}

echo array_sum($out); // 54100
