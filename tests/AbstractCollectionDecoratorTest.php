<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

declare(strict_types=1);

namespace spaceonfire\Collection;

class AbstractCollectionDecoratorTest extends AbstractCollectionTest
{
    protected function factory($items = []): CollectionInterface
    {
        return new class($items) extends AbstractCollectionDecorator {
        };
    }
}
