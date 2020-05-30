<?php

declare(strict_types=1);

namespace spaceonfire\Collection\Types;

use InvalidArgumentException;
use JsonSerializable;
use PHPUnit\Framework\TestCase;
use stdClass;

class InstanceOfTypeTest extends TestCase
{
    public function testSupports()
    {
        self::assertTrue(InstanceOfType::supports(JsonSerializable::class));
        self::assertTrue(InstanceOfType::supports(stdClass::class));
        self::assertFalse(InstanceOfType::supports('NonExistingClass'));
    }

    public function testCreate()
    {
        InstanceOfType::create(JsonSerializable::class);
        self::assertTrue(true);
    }

    public function testCreateFail()
    {
        $this->expectException(InvalidArgumentException::class);
        InstanceOfType::create('NonExistingClass');
    }

    public function testAssert()
    {
        $type = InstanceOfType::create(stdClass::class);
        self::assertTrue($type->assert((object)[]));
        self::assertFalse($type->assert([]));
    }

    public function testStringify()
    {
        $type = InstanceOfType::create(stdClass::class);
        self::assertEquals(stdClass::class, (string)$type);
    }
}
