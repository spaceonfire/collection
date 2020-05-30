<?php

declare(strict_types=1);

namespace spaceonfire\Collection\Types;

use InvalidArgumentException;
use Iterator;
use JsonSerializable;
use PHPUnit\Framework\TestCase;
use Traversable;

class ConjunctionTypeTest extends TestCase
{
    public function testSupports()
    {
        self::assertTrue(ConjunctionType::supports(JsonSerializable::class . '&' . Traversable::class));
        self::assertFalse(ConjunctionType::supports(JsonSerializable::class));
    }

    public function testCreate()
    {
        ConjunctionType::create(JsonSerializable::class . '&' . Traversable::class);
        self::assertTrue(true);
    }

    public function testCreateFail()
    {
        $this->expectException(InvalidArgumentException::class);
        ConjunctionType::create(JsonSerializable::class);
    }

    public function testAssert()
    {
        $type = ConjunctionType::create(JsonSerializable::class . '&' . Traversable::class);

        $jsonSerializable = $this->prophesize(JsonSerializable::class)->reveal();
        $jsonSerializableAndTraversable = $this->prophesize(JsonSerializable::class)->willImplement(Iterator::class)->reveal();

        self::assertTrue($type->assert($jsonSerializableAndTraversable));
        self::assertFalse($type->assert($jsonSerializable));
    }

    public function testStringify()
    {
        $type = ConjunctionType::create(JsonSerializable::class . '&' . Traversable::class);
        self::assertEquals(JsonSerializable::class . '&' . Traversable::class, (string)$type);
    }
}
