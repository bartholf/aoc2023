<?php declare(strict_types=1);

namespace Aoc2023;

class InputFile
{
    private array $lines;

    public function __construct(private string $path)
    {
    }

    public function getLine(int $lineNo): ?string
    {
        return $this->getLines()[$lineNo] ?? null;
    }

    public function getLines(): array
    {
        return isset($this->lines)
            ? $this->lines
            : $this->lines = file($this->path, FILE_IGNORE_NEW_LINES);
    }
}
