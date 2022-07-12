<?php

namespace BVB\Domain\Ticker;

use Exception;

class TickerInfo
{
    public function __construct(private string $name, private string $description, private string $ticker)
    {
        $this->validate();
    }

    private function validate(): void
    {
        if ("" === $this->name) {
            throw new Exception("Name should not be null");
        }
        if ("" === $this->ticker) {
            throw new Exception("Ticker should not be null");
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }
}
