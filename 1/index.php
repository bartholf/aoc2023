<?php declare(strict_types=1);

$input = fopen(__DIR__ . "/input.txt", "r");

$sum = 0;

while (($line = fgets($input)) !== false) {
    preg_match_all('/\d+/', $line, $matches);
    $sum += (int) ($matches[0][0][0]
        . substr(end($matches[0]), -1));
}

fclose($input);

echo $sum; // 54877
