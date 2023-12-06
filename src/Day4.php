<?php declare(strict_types=1);

namespace Aoc2023;

require __DIR__ . '/../vendor/autoload.php';

class Day4 extends DayBase
{
    private function getPairs(): array
    {
        $dispatchedRows = [];
        foreach ($this->file->getLines() as $line) {
            $data = preg_replace('/^.*: (.*)$/', '$1', $line);
            $data = str_replace('  ', ' ', $data);
            $data = preg_split('/\|/', trim($data));
            $dispatchedRows[] = [
                explode(' ', trim($data[0])),
                explode(' ', trim($data[1])),
            ];
        }
        return $dispatchedRows;
    }

    private function processPart1(): int
    {
        $total = 0;
        foreach($this->getPairs() as $pair) {
            $value = 0;
            $cnt = count(array_values(array_intersect($pair[1], $pair[0])));
            for ($i = 0; $i < $cnt; $i++) {
                if ($value === 0) {
                    $value = 1;
                    continue;
                }
                $value *= 2;
            }
            $total += $value;
        }
        return (int) $total;
    }

    public function part1(): int // 21088
    {
        echo $this->processPart1();
        return 0;
    }

    public function part2(): int
    {
        return 0;
    }
}

Day4::run();
