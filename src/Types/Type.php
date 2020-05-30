<?php

declare(strict_types=1);

namespace spaceonfire\Collection\Types;

interface Type
{
    /**
     * Assert given value type
     * @param mixed $value
     * @return bool
     */
    public function assert($value): bool;

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @param string $type
     * @return bool
     */
    public static function supports(string $type): bool;

    /**
     * @param string $type
     * @return static|self
     */
    public static function create(string $type): self;
}
