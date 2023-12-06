<?php declare(strict_types=1);

namespace Aoc2023;

abstract class DayBase
{
    protected InputFile $file;

    public function __construct()
    {
        $this->setIndata();
    }

    protected function getIndataPath(): string
    {
        $dayNo = preg_replace('/.*Day(\d+).*/', '$1', get_class($this));
        return __DIR__ . "/../res/day{$dayNo}.txt";
    }

    protected function setIndata(?string $path = null): void
    {
        if (!$path) {
            $path = $this->getIndataPath();
        }
        $this->file = new InputFile($path);
    }

    public static function run()
    {
        $self = new static();
        $self->part1();
        $self->part2();
    }

    abstract public function part1(): int;
    abstract public function part2(): int;
}
