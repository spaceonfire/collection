<?php

declare(strict_types=1);

namespace spaceonfire\Collection\Types;

use InvalidArgumentException;
use Webmozart\Assert\Assert;

final class BuiltinType implements Type
{
    public const INT = 'int';
    public const FLOAT = 'float';
    public const STRING = 'string';
    public const BOOL = 'bool';
    public const RESOURCE = 'resource';
    public const OBJECT = 'object';
    public const ARRAY = 'array';
    public const NULL = 'null';
    public const CALLABLE = 'callable';
    public const ITERABLE = 'iterable';

    /**
     * @var string
     */
    private $type;

    /**
     * BuiltinType constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        if (!self::supports($type)) {
            throw new InvalidArgumentException(sprintf('Type "%s" is not supported by %s', $type, __CLASS__));
        }

        $this->type = self::prepareType($type);
    }

    /**
     * @inheritDoc
     */
    public function assert($value): bool
    {
        try {
            switch ($this->type) {
                case self::INT:
                    Assert::integer($value);
                    break;

                case self::FLOAT:
                    Assert::float($value);
                    break;

                case self::STRING:
                    Assert::string($value);
                    break;

                case self::BOOL:
                    Assert::boolean($value);
                    break;

                case self::RESOURCE:
                    Assert::resource($value);
                    break;

                case self::OBJECT:
                    Assert::object($value);
                    break;

                case self::ARRAY:
                    Assert::isArray($value);
                    break;

                case self::NULL:
                    Assert::null($value);
                    break;

                case self::CALLABLE:
                    Assert::isCallable($value);
                    break;

                case self::ITERABLE:
                    Assert::isIterable($value);
                    break;
            }

            return true;
        } catch (InvalidArgumentException $exception) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->type;
    }

    private static function prepareType(string $type): string
    {
        $type = strtolower($type);

        if (strpos($type, 'resource') === 0) {
            $type = self::RESOURCE;
        }

        $map = [
            'boolean' => self::BOOL,
            'integer' => self::INT,
            'double' => self::FLOAT,
        ];

        return $map[$type] ?? $type;
    }

    /**
     * @inheritDoc
     */
    public static function supports(string $type): bool
    {
        $type = self::prepareType($type);

        $supported = [
            self::INT => true,
            self::FLOAT => true,
            self::STRING => true,
            self::BOOL => true,
            self::RESOURCE => true,
            self::OBJECT => true,
            self::ARRAY => true,
            self::NULL => true,
            self::CALLABLE => true,
            self::ITERABLE => true,
        ];

        return array_key_exists($type, $supported);
    }

    /**
     * @inheritDoc
     */
    public static function create(string $type): Type
    {
        return new self($type);
    }
}
