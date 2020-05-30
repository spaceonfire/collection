<?php

declare(strict_types=1);

namespace spaceonfire\Collection\Types;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DisjunctionTypeTest extends TestCase
{
    public function testSupports()
    {
        self::assertTrue(DisjunctionType::supports('int|null'));
        self::assertFalse(DisjunctionType::supports('int'));
    }

    public function testCreate()
    {
        DisjunctionType::create('int|null');
        self::assertTrue(true);
    }

    public function testCreateFail()
    {
        $this->expectException(InvalidArgumentException::class);
        DisjunctionType::create('int');
    }

    public function testAssert()
    {
        $type = DisjunctionType::create('integer|null');
        self::assertTrue($type->assert(1));
        self::assertTrue($type->assert(null));
        self::assertFalse($type->assert('1'));
    }

    public function testStringify()
    {
        $type = DisjunctionType::create('integer|null');
        self::assertEquals('int|null', (string)$type);
    }
}
