<?php

declare(strict_types=1);

namespace spaceonfire\Collection\Types;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use spaceonfire\Collection\Collection;
use stdClass;

class BuiltinTypeTest extends TestCase
{
    public function testSupports()
    {
        self::assertTrue(BuiltinType::supports('int'));
        self::assertTrue(BuiltinType::supports('integer'));
        self::assertTrue(BuiltinType::supports('bool'));
        self::assertTrue(BuiltinType::supports('boolean'));
        self::assertTrue(BuiltinType::supports('float'));
        self::assertTrue(BuiltinType::supports('double'));
        self::assertTrue(BuiltinType::supports('string'));
        self::assertTrue(BuiltinType::supports('resource'));
        self::assertTrue(BuiltinType::supports('resource (closed)'));
        self::assertTrue(BuiltinType::supports('null'));
        self::assertTrue(BuiltinType::supports('object'));
        self::assertTrue(BuiltinType::supports('array'));
        self::assertTrue(BuiltinType::supports('callable'));
        self::assertTrue(BuiltinType::supports('iterable'));
        self::assertFalse(BuiltinType::supports('unknown'));
        self::assertFalse(BuiltinType::supports(stdClass::class));
    }

    public function testCreate()
    {
        BuiltinType::create('integer');
        self::assertTrue(true);
    }

    public function testCreateFail()
    {
        $this->expectException(InvalidArgumentException::class);
        BuiltinType::create('unknown type');
    }

    public function testAssert()
    {
        $integer = BuiltinType::create('integer');
        self::assertTrue($integer->assert(1));
        self::assertFalse($integer->assert('1'));

        $float = BuiltinType::create('float');
        self::assertTrue($float->assert(1.0));
        self::assertFalse($float->assert('1'));

        $string = BuiltinType::create('string');
        self::assertTrue($string->assert('lorem ipsum'));
        self::assertFalse($string->assert(1));

        $bool = BuiltinType::create('bool');
        self::assertTrue($bool->assert(true));
        self::assertFalse($bool->assert(1));

        $object = BuiltinType::create('object');
        self::assertTrue($object->assert((object)[]));
        self::assertFalse($object->assert(1));

        $array = BuiltinType::create('array');
        self::assertTrue($array->assert([]));
        self::assertFalse($array->assert(1));

        $null = BuiltinType::create('null');
        self::assertTrue($null->assert(null));
        self::assertFalse($null->assert(1));

        $callable = BuiltinType::create('callable');
        self::assertTrue($callable->assert(static function () {
        }));
        self::assertFalse($callable->assert(1));

        $iterable = BuiltinType::create('iterable');
        self::assertTrue($iterable->assert(new Collection()));
        self::assertFalse($iterable->assert(1));

        $f = fopen(__FILE__, 'rb');
        $resource = BuiltinType::create('resource');
        self::assertTrue($resource->assert($f));
        self::assertFalse($resource->assert(1));
        fclose($f);
    }

    public function testStringify()
    {
        $type = BuiltinType::create('integer');
        self::assertEquals('int', (string)$type);
    }
}
