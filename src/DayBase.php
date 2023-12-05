<?php declare(strict_types=1);

namespace Aoc2023;

abstract class DayBase
{
    protected InputFile $file;

    public function __construct() {}

    protected function setIndata(string $indata): void
    {
        $this->file = new InputFile(__DIR__ . '/../res/' . $indata);
    }

    abstract public function part1(): int;
    abstract public function part2(): int;
}
