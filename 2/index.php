<?php declare(strict_types=1);

$file = fopen(__DIR__ . "/input.txt", 'r');
$data = [];

function isValid(array $set): bool
{
    $r = $set['r'];
    $g = $set['g'];
    $b = $set['b'];

    return $r <= 12 && $g <= 13 && $b <= 14;
}

function parseLine(string $line)
{
    global $data;
    $ix = preg_replace('/^Game (\d+).*/', '$1', $line);

    $groups = [preg_split('/;/', $line)];

    foreach ($groups as $group) {
        foreach ($group as $item) {
            preg_match_all('/(\d+) red/', $item, $red);
            preg_match_all('/(\d+) green/', $item, $green);
            preg_match_all('/(\d+) blue/', $item, $blue);
            $data[$ix][] = [
                'r' => array_sum($red[1]),
                'g' => array_sum($green[1]),
                'b' => array_sum($blue[1]),
            ];
        }
    }
}

while (($line = fgets($file)) !== false) {
    parseLine(trim($line));
}

$inValid = [];
foreach ($data as $k => $v) {
    foreach ($v as $item) {
        if (!isValid($item)) {
            $inValid[] = (int) $k;
        }
    }
}

$valid = [];

foreach (range(1, 100) as $i) {
    if (!in_array($i, $inValid)) {
        $valid[] = $i;
    }
}

fclose($file);

echo array_sum($valid) . PHP_EOL; // 2563

// Part 2
$file = fopen(__DIR__ . "/input2.txt", 'r');

function getTotals(array $set): int
{
    $r = $set['r'];
    $g = $set['g'];
    $b = $set['b'];

    return $r + $g + $b;
}

$data = [];
while (($line = fgets($file)) !== false) {
    parseLine(trim($line));
}
fclose($file);

$totals = [];

$pow = 0;

foreach ($data as $k => $v) {
    $totals[$k] = [
        'r' => 0,
        'g' => 0,
        'b' => 0,
    ];

    foreach ($v as $item) {
        $totals[$k]['r'] = ($item['r'] ?? 0) > $totals[$k]['r'] ? $item['r'] : $totals[$k]['r'];
        $totals[$k]['g'] = ($item['g'] ?? 0) > $totals[$k]['g'] ? $item['g'] : $totals[$k]['g'];
        $totals[$k]['b'] = ($item['b'] ?? 0) > $totals[$k]['b'] ? $item['b'] : $totals[$k]['b'];
    }
    $pow += array_product(array_values($totals[$k]));
}

print_r($totals);
echo $pow; // 70768
