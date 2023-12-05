<?php declare(strict_types=1);

namespace Aoc2023;

require __DIR__ . '/../vendor/autoload.php';

class Day3 extends DayBase
{
    public static function run()
    {
        $self = new self();
        $self->part1();
    }

    private function hasSymbol(int $lineIx, int $colIx, int $value)
    {
        return $this->hasSymbolTop($lineIx, $colIx, $value)
            || $this->hasSymbolRight($lineIx, $colIx, $value)
            || $this->hasSymbolBottom($lineIx, $colIx, $value)
            || $this->hasSymbolLeft($lineIx, $colIx, $value);
    }

    private function hasSymbolBottom(int $lineIx, int $colIx, int $value)
    {
        if ($lineIx + 1 >= count($this->file->getLines())) {
            return false;
        }
        $line = $this->file->getLine($lineIx + 1);
        return preg_match(
            '/[^\.]/',
            substr($line, $colIx - 1, strlen((string) $value) + 2)) === 1;
    }

    private function hasSymbolLeft(int $lineIx, int $colIx, int $value)
    {
        if ($colIx - strlen((string) $value) < 1) {
            return false;
        }
        $line = $this->file->getLine($lineIx);
        return preg_match(
            '/[^\.]/',
            substr($line, $colIx -1, 1)) === 1;
    }

    private function hasSymbolRight(int $lineIx, int $colIx, int $value)
    {
        $line = $this->file->getLine($lineIx);
        if ($colIx + strlen((string) $value) >= strlen($line)) {
            return false;
        }
        return preg_match(
            '/[^\.]/',
            substr($line, $colIx + strlen((string) $value), 1)) === 1;
    }

    private function hasSymbolTop(int $lineIx, int $colIx, int $value)
    {
        if ($lineIx === 0) {
            return false;
        }
        $line = $this->file->getLine($lineIx - 1);
        return preg_match(
            '/[^\.]/',
            substr($line, $colIx - 1, strlen((string) $value) + 2)) === 1;
    }

    private function parseValues(): int
    {
        $lines = $this->file->getLines();
        $lineNo = 0;
        $sum = 0;
        foreach ($lines as $line) {
            preg_match_all('/\d+/', $line, $matches, PREG_OFFSET_CAPTURE);
            foreach ($matches as $set) {
                foreach ($set as $match) {
                    if ($this->hasSymbol($lineNo, (int) $match[1], (int) $match[0])) {
                        $sum += (int) $match[0];
                    }
                }
            }
            $lineNo++;
        }
        return $sum;
    }

    public function part1(): int
    {
        $this->setIndata('day3p1.txt');
        echo $this->parseValues(); // 530495
        return 0;
    }

    public function part2(): int
    {
        $this->setIndata('day3p2.txt');
        return 0;
    }
}

Day3::run();
