<?php

declare(strict_types=1);

namespace spaceonfire\Collection;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use spaceonfire\Criteria\Criteria;
use stdClass;

abstract class AbstractCollectionTest extends TestCase
{
    abstract protected function factory($items = []): CollectionInterface;

    public function testFromArray()
    {
        $collection = $this->factory([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $collection->all());
    }

    public function testFromOtherCollection()
    {
        $first = $this->factory([1, 2, 3]);
        $second = $this->factory($first);
        $this->assertEquals($first->all(), $second->all());
    }

    public function testClear(): void
    {
        $collection = $this->factory([1, 2, 3]);
        $collection->clear();
        $this->assertEquals([], $collection->all());
    }

    public function testSum()
    {
        $collection = $this->factory([1, 2, 3]);
        $this->assertEquals(6, $collection->sum());
    }

    public function testSumException()
    {
        $this->expectException(BadMethodCallException::class);
        $collection = $this->factory([1, 'test', 3]);
        $collection->sum();
    }

    public function testSumWithField()
    {
        $collection = $this->factory([
            ['field' => 1],
            ['field' => 2],
            ['field' => 3],
        ]);
        $this->assertEquals(6, $collection->sum('field'));
    }

    public function testMax()
    {
        $collection = $this->factory([1, 2, 3]);
        $this->assertEquals(3, $collection->max());
    }

    public function testMaxException()
    {
        $this->expectException(BadMethodCallException::class);
        $collection = $this->factory([1, 'test', 3]);
        $collection->max();
    }

    public function testMaxWithField()
    {
        $collection = $this->factory([
            ['field' => 1],
            ['field' => 2],
            ['field' => 3],
        ]);
        $this->assertEquals(3, $collection->max('field'));
    }

    public function testMin()
    {
        $collection = $this->factory([1, 2, -3]);
        $this->assertEquals(-3, $collection->min());
    }

    public function testMinException()
    {
        $this->expectException(BadMethodCallException::class);
        $collection = $this->factory([1, 'test', 3]);
        $collection->min();
    }

    public function testMinWithField()
    {
        $collection = $this->factory([
            ['field' => 1],
            ['field' => 2],
            ['field' => -3],
        ]);
        $this->assertEquals(-3, $collection->min('field'));
    }

    public function testIsEmpty()
    {
        $collection = $this->factory([1, 2, -3]);
        $this->assertFalse($collection->isEmpty());
        $collection = $this->factory();
        $this->assertTrue($collection->isEmpty());
    }

    public function testMerge()
    {
        $first = $this->factory([
            'one' => 1,
            'two' => 2,
        ]);
        $second = $this->factory([10, 20, 30]);
        $result = $first->merge($second, [['field' => 1]]);
        $this->assertEquals([
            'one' => 1,
            'two' => 2,
            10,
            20,
            30,
            ['field' => 1]
        ], $result->all());
    }

    public function testRemap()
    {
        $collection = $this->factory([
            ['id' => 'user-1', 'value' => 'John Doe'],
            ['id' => 'user-2', 'value' => 'Jane Doe'],
        ]);
        $this->assertEquals([
            'user-1' => 'John Doe',
            'user-2' => 'Jane Doe',
        ], $collection->remap('id', 'value')->all());
    }

    public function testIndexBy()
    {
        $collection = $this->factory([
            ['id' => 'user-1', 'value' => 'John Doe'],
            ['id' => 'user-2', 'value' => 'Jane Doe'],
        ]);
        $items = $collection->indexBy('id')->all();
        $this->assertArrayHasKey('user-1', $items);
        $this->assertArrayHasKey('user-2', $items);
    }

    public function testGroupBy()
    {
        $collection = $this->factory([
            ['id' => 'user-1', 'value' => 'John Doe', 'group' => 'group-1'],
            ['id' => 'user-2', 'value' => 'Jane Doe', 'group' => 'group-1'],
            ['id' => 'user-3', 'value' => 'Johnson Doe', 'group' => 'group-2'],
            ['id' => 'user-4', 'value' => 'Janifer Doe', 'group' => 'group-2'],
        ]);

        $groupedCollection = $collection->groupBy('group');

        $this->assertArrayHasKey('group-1', $groupedCollection->all());
        $this->assertArrayHasKey('group-2', $groupedCollection->all());
        $this->assertInstanceOf(Collection::class, $groupedCollection['group-1']);
        $this->assertInstanceOf(Collection::class, $groupedCollection['group-2']);

        $groupedCollection = $collection->groupBy('group', false);

        $this->assertArrayHasKey('group-1', $groupedCollection->all());
        $this->assertArrayHasKey('group-2', $groupedCollection->all());
        $this->assertInstanceOf(Collection::class, $groupedCollection['group-1']);
        $this->assertInstanceOf(Collection::class, $groupedCollection['group-2']);
    }

    public function testContains()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertTrue($collection->contains(2));
        $this->assertFalse($collection->contains(2, true));
        $this->assertFalse($collection->contains(10));
        $this->assertTrue($collection->contains(static function ($item) {
            return $item === '2';
        }));
        $this->assertFalse($collection->contains(static function ($item) {
            return $item === 2;
        }));
    }

    public function testRemove()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertEquals([1, 2 => 3], $collection->remove(2)->all());
        $collection = $this->factory([1, '2', 3]);
        $this->assertEquals([1, '2', 3], $collection->remove(2, true)->all());
        $collection = $this->factory([1, '2', '3']);
        $this->assertEquals([1], $collection->remove(static function ($item) {
            return is_string($item);
        })->all());
    }

    public function testFilter()
    {
        $collection = $this->factory([1, 2, 3, 4, 5, 6, 0]);
        $this->assertEquals([1, 2, 3, 4, 5, 6], $collection->filter()->all());
    }

    public function testFilterWithCallback()
    {
        $collection = $this->factory([1, 2, 3, 4, 5, 6]);
        $this->assertEquals([1 => 2, 3 => 4, 5 => 6], $collection->filter(static function ($item) {
            return $item % 2 === 0;
        })->all());
    }

    public function testFind()
    {
        $collection = $this->factory([1, 2, 3, 4, 5, 6]);
        $this->assertEquals(2, $collection->find(static function ($item) {
            return $item % 2 === 0;
        }));
        $this->assertNull($collection->find(static function ($item) {
            return $item === 100;
        }));
    }

    public function testReplace()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertEquals([1, 5, 3], $collection->replace(2, 5)->all());
        $this->assertNotEquals([1, 5, 3], $collection->replace(2, 5, true)->all());
    }

    public function testSlice()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertEquals([1 => '2', 2 => 3], $collection->slice(1)->all());
    }

    public function testMatching()
    {
        $items = array_map(static function ($val) {
            $object = new stdClass();
            $object->value = $val;
            return $object;
        }, range(0, 100));
        $collection = $this->factory($items);

        $criteria = new Criteria(
            Criteria::expr()->property('value', Criteria::expr()->greaterThan(25)),
            ['value' => SORT_DESC],
            0,
            25
        );

        $result = $collection->matching($criteria);

        $this->assertCount(25, $result);
    }

    public function testUnique()
    {
        $collection = $this->factory([1, 2, 2, 3, 3, 3]);
        $this->assertEquals([0 => 1, 1 => 2, 3 => 3], $collection->unique()->all());
    }

    public function testImplodeStrings()
    {
        $collection = $this->factory(['hello', 'world']);
        $this->assertEquals('hello world', $collection->implode(' '));
    }

    public function testImplodeObjects()
    {
        $stringableFactory = function (string $value) {
            return new class($value) {
                private $value;

                public function __construct($value)
                {
                    $this->value = $value;
                }

                public function __toString(): string
                {
                    return $this->value;
                }
            };
        };
        $collection = $this->factory([
            $stringableFactory('hello'),
            $stringableFactory('world'),
        ]);
        $this->assertEquals('hello world', $collection->implode(' '));
    }

    public function testImplodeWihField()
    {
        $objectFactory = function (string $value) {
            return new class($value) {
                public $value;

                public function __construct($value)
                {
                    $this->value = $value;
                }
            };
        };

        $collection = $this->factory([
            $objectFactory('hello'),
            $objectFactory('world'),
        ]);

        $this->assertEquals('hello world', $collection->implode(' ', 'value'));
    }

    public function testImplodeFail()
    {
        $objectFactory = function (string $value) {
            return new class($value) {
                public $value;

                public function __construct($value)
                {
                    $this->value = $value;
                }
            };
        };
        $this->expectException(BadMethodCallException::class);
        $collection = $this->factory([
            $objectFactory('hello'),
            $objectFactory('world'),
        ]);
        $collection->implode(' ');
    }

    public function testJoinAlias()
    {
        $collection = $this->factory(['hello', 'world']);
        $this->assertEquals('hello world', $collection->join(' '));
    }

    public function testFirst()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertEquals(1, $collection->first());
    }

    public function testFirstEmpty()
    {
        $collection = $this->factory();
        $this->assertEquals(null, $collection->first());
    }

    public function testFirstKey()
    {
        $collection = $this->factory(['one' => 1, 'two' => '2', 'three' => 3]);
        $this->assertEquals('one', $collection->firstKey());
    }

    public function testFirstKeyEmpty()
    {
        $collection = $this->factory();
        $this->assertEquals(null, $collection->firstKey());
    }

    public function testLast()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertEquals(3, $collection->last());
    }

    public function testLastEmpty()
    {
        $collection = $this->factory();
        $this->assertEquals(null, $collection->last());
    }

    public function testLastKey()
    {
        $collection = $this->factory(['one' => 1, 'two' => '2', 'three' => 3]);
        $this->assertEquals('three', $collection->lastKey());
    }

    public function testLastKeyEmpty()
    {
        $collection = $this->factory();
        $this->assertEquals(null, $collection->lastKey());
    }

    public function testAverage()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertEqualsWithDelta(2, $collection->average(), 0.01);
    }

    public function testAverageWithField()
    {
        $collection = $this->factory([
            ['field' => 1],
            ['field' => 2],
            ['field' => 3],
        ]);
        $this->assertEqualsWithDelta(2, $collection->average('field'), 0.01);
    }

    public function testAvgAlias()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertEqualsWithDelta(2, $collection->avg(), 0.01);
    }

    public function testMedian()
    {
        $dataSet = [12, 21, 34, 34, 44, 54, 55, 77];
        shuffle($dataSet);
        $collection = $this->factory($dataSet);
        $this->assertEqualsWithDelta(39, $collection->median(), 0.01);
    }

    public function testMedianEmpty()
    {
        $collection = $this->factory();
        $this->assertEquals(null, $collection->median());
    }

    public function testToJson()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertJson($collection->toJson());
    }

    public function testStringify()
    {
        $collection = $this->factory([1, '2', 3]);
        $this->assertJson((string)$collection);
    }

    public function testCallUndefinedMethod()
    {
        $this->expectException(BadMethodCallException::class);
        $collection = $this->factory([1, '2', 3]);

        /** @noinspection PhpUndefinedMethodInspection */
        $collection->undefindeMethod();
    }
}
