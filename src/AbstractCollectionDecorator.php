<?php

declare(strict_types=1);

namespace spaceonfire\Collection;

use spaceonfire\Criteria\CriteriaInterface;

/**
 * Class AbstractCollectionDecorator
 * @package spaceonfire\Collection
 * @method string join(string|null $glue = null, $field = null) alias to implode()
 * @method int|float avg($field = null) alias to average()
 */
abstract class AbstractCollectionDecorator implements CollectionInterface
{
    use CollectionAliasesTrait;

    /**
     * @var CollectionInterface
     */
    protected $collection;

    /**
     * AbstractCollectionDecorator constructor.
     * @param CollectionInterface|array|iterable|mixed $items
     */
    public function __construct($items)
    {
        $this->collection = $items instanceof CollectionInterface ? $items : new Collection($items);
    }

    /**
     * Creates new instance of collection
     * @param array|iterable|mixed $items
     * @return static
     */
    protected function newStatic($items)
    {
        return new static($items);
    }

    /**
     * Converts current collection to lower level collection without type check
     * @param bool $recursive
     * @return CollectionInterface
     */
    public function downgrade(bool $recursive = false): CollectionInterface
    {
        if ($this->collection instanceof self && $recursive) {
            return $this->collection->downgrade($recursive);
        }

        return $this->collection;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->collection->all();
    }

    /**
     * @inheritDoc
     */
    public function clear(): CollectionInterface
    {
        $this->collection->clear();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function each(callable $callback)
    {
        $this->collection->each($callback);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter(?callable $callback = null)
    {
        return $this->newStatic($this->collection->filter($callback));
    }

    /**
     * @inheritDoc
     */
    public function find(callable $callback)
    {
        return $this->collection->find($callback);
    }

    /**
     * @inheritDoc
     */
    public function reduce(callable $callback, $initialValue = null)
    {
        return $this->collection->reduce($callback, $initialValue);
    }

    /**
     * @inheritDoc
     */
    public function sum($field = null)
    {
        return $this->collection->sum($field);
    }

    /**
     * @inheritDoc
     */
    public function average($field = null)
    {
        return $this->collection->average($field);
    }

    /**
     * @inheritDoc
     */
    public function median($field = null)
    {
        return $this->collection->median($field);
    }

    /**
     * @inheritDoc
     */
    public function max($field = null)
    {
        return $this->collection->max($field);
    }

    /**
     * @inheritDoc
     */
    public function min($field = null)
    {
        return $this->collection->min($field);
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return $this->collection->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function map(callable $callback)
    {
        return $this->newStatic($this->collection->map($callback));
    }

    /**
     * @inheritDoc
     */
    public function sort($direction = SORT_ASC, $sortFlag = SORT_REGULAR)
    {
        return $this->newStatic($this->collection->sort($direction, $sortFlag));
    }

    /**
     * @inheritDoc
     */
    public function sortByKey($direction = SORT_ASC, $sortFlag = SORT_REGULAR)
    {
        return $this->newStatic($this->collection->sortByKey($direction, $sortFlag));
    }

    /**
     * @inheritDoc
     */
    public function sortNatural($caseSensitive = false)
    {
        return $this->newStatic($this->collection->sortNatural($caseSensitive));
    }

    /**
     * @inheritDoc
     */
    public function sortBy($key, $direction = SORT_ASC, $sortFlag = SORT_REGULAR)
    {
        return $this->newStatic($this->collection->sortBy($key, $direction, $sortFlag));
    }

    /**
     * @inheritDoc
     */
    public function reverse()
    {
        return $this->newStatic($this->collection->reverse());
    }

    /**
     * @inheritDoc
     */
    public function values()
    {
        return $this->newStatic($this->collection->values());
    }

    /**
     * @inheritDoc
     */
    public function keys()
    {
        return $this->newStatic($this->collection->keys());
    }

    /**
     * @inheritDoc
     */
    public function flip()
    {
        return $this->newStatic($this->collection->flip());
    }

    /**
     * @inheritDoc
     */
    public function merge(...$collections)
    {
        return $this->newStatic($this->collection->merge(...$collections));
    }

    /**
     * @inheritDoc
     */
    public function remap($from, $to)
    {
        return $this->newStatic($this->collection->remap($from, $to));
    }

    /**
     * @inheritDoc
     */
    public function indexBy($key)
    {
        return $this->newStatic($this->collection->indexBy($key));
    }

    /**
     * @inheritDoc
     */
    public function groupBy($groupField, $preserveKeys = true)
    {
        return $this->newStatic($this->collection->groupBy($groupField, $preserveKeys));
    }

    /**
     * @inheritDoc
     */
    public function contains($item, bool $strict = false): bool
    {
        return $this->collection->contains($item, $strict);
    }

    /**
     * @inheritDoc
     */
    public function remove($item, bool $strict = false)
    {
        return $this->newStatic($this->collection->remove($item, $strict));
    }

    /**
     * @inheritDoc
     */
    public function replace($item, $replacement, bool $strict = false)
    {
        return $this->newStatic($this->collection->replace($item, $replacement, $strict));
    }

    /**
     * @inheritDoc
     */
    public function slice($offset, $limit = null, $preserveKeys = true)
    {
        return $this->newStatic($this->collection->slice($offset, $limit, $preserveKeys));
    }

    /**
     * @inheritDoc
     */
    public function unique(int $sortFlags = SORT_REGULAR)
    {
        return $this->newStatic($this->collection->unique($sortFlags));
    }

    /**
     * @inheritDoc
     */
    public function implode(?string $glue = null, $field = null): string
    {
        return $this->collection->implode($glue, $field);
    }

    /**
     * @inheritDoc
     */
    public function first()
    {
        return $this->collection->first();
    }

    /**
     * @inheritDoc
     */
    public function firstKey()
    {
        return $this->collection->firstKey();
    }

    /**
     * @inheritDoc
     */
    public function last()
    {
        return $this->collection->last();
    }

    /**
     * @inheritDoc
     */
    public function lastKey()
    {
        return $this->collection->lastKey();
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return $this->collection->getIterator();
    }

    /**
     * @inheritDoc
     * @param mixed $offset
     */
    public function offsetExists($offset)
    {
        return $this->collection->offsetExists($offset);
    }

    /**
     * @inheritDoc
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->collection->offsetGet($offset);
    }

    /**
     * @inheritDoc
     * @param mixed|null $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->collection->offsetSet($offset, $value);
    }

    /**
     * @inheritDoc
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        $this->collection->offsetUnset($offset);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return $this->collection->count();
    }

    /**
     * @inheritDoc
     */
    public function matching(CriteriaInterface $criteria)
    {
        return $this->newStatic($this->collection->matching($criteria));
    }

    /**
     * @inheritDoc
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->collection;
    }

    /**
     * @inheritDoc
     */
    public function toJson(int $options = 0): string
    {
        return $this->collection->toJson($options);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string)$this->collection;
    }
}
