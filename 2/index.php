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

print_r(array_sum($valid)); // 2563
