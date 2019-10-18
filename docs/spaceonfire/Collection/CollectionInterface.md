# Interface CollectionInterface

- Full name: `\spaceonfire\Collection\CollectionInterface`
- This interface extends:
    - `\ArrayAccess`
    - `\Countable`
    - `\IteratorAggregate`

## Methods

### all()

Get all of the items in the collection.

|Param|Type|Description|
|---|---|---|
|**Return**|*array*||

```php
public function CollectionInterface::all(): array
```

File location: `src/CollectionInterface.php:18`

### contains()

Check whether the collection contains a specific item.

|Param|Type|Description|
|---|---|---|
|`$item`|*mixed&#124;\Closure*|the item to search for. You may also pass a closure that returns a boolean.
The closure will be called on each item and in case it returns `true`, the item will be considered to
be found.|
|**Return**|*bool*|`true` if the collection contains at least one item that matches, `false` if not.|

```php
public function CollectionInterface::contains(mixed $item): bool
```

File location: `src/CollectionInterface.php:202`

### each()

Execute a callback over each item.

|Param|Type|Description|
|---|---|---|
|`$callback`|*callable*||
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::each(callable $callback): mixed
```

File location: `src/CollectionInterface.php:25`

### filter()

Filter items from the collection.

|Param|Type|Description|
|---|---|---|
|`$callback`|*callable&#124;null*|the callback function to decide which items to remove.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::filter(callable $callback = null): mixed
```

File location: `src/CollectionInterface.php:32`

### find()

Find item in the collection

|Param|Type|Description|
|---|---|---|
|`$callback`|*callable*|Testing function|
|**Return**|*mixed&#124;null*|First element that satisfies provided `$callback` or `null`|

```php
public function CollectionInterface::find(callable $callback): mixed
```

File location: `src/CollectionInterface.php:39`

### flip()

Flip keys and values of all collection items.

|Param|Type|Description|
|---|---|---|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::flip(): mixed
```

File location: `src/CollectionInterface.php:156`

### groupBy()

Group items by a specified field.

|Param|Type|Description|
|---|---|---|
|`$groupField`|*string&#124;\Closure*|the field of the item to use as the group value.
This can be a closure that returns such a value.|
|`$preserveKeys`|*bool*|whether to preserve item keys in the groups. Defaults to `true`.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::groupBy(mixed $groupField, mixed $preserveKeys = true): mixed
```

File location: `src/CollectionInterface.php:193`

### indexBy()

Assign a new key to each item in the collection.

|Param|Type|Description|
|---|---|---|
|`$key`|*string&#124;\Closure*|the field of the item to use as the new key.
This can be a closure that returns such a value.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::indexBy(mixed $key): mixed
```

File location: `src/CollectionInterface.php:184`

### isEmpty()

Determine if the collection is empty or not.

|Param|Type|Description|
|---|---|---|
|**Return**|*bool*||

```php
public function CollectionInterface::isEmpty(): bool
```

File location: `src/CollectionInterface.php:74`

### keys()

Return keys of all collection items.

|Param|Type|Description|
|---|---|---|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::keys(): mixed
```

File location: `src/CollectionInterface.php:150`

### map()

Run a map over each of the items

|Param|Type|Description|
|---|---|---|
|`$callback`|*callable*||
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::map(callable $callback): mixed
```

File location: `src/CollectionInterface.php:81`

### max()

Calculate the maximum value of a field of the models in the collection.

|Param|Type|Description|
|---|---|---|
|`$field`|*mixed*|the name of the field to calculate.|
|**Return**|*int&#124;float&#124;null*|the calculated maximum value. `null` if the collection is empty.|

```php
public function CollectionInterface::max(mixed $field = null): mixed
```

File location: `src/CollectionInterface.php:61`

### merge()

Merge one or more arrays or collections with current collection.

|Param|Type|Description|
|---|---|---|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::merge(): mixed
```

File location: `src/CollectionInterface.php:162`

### min()

Calculate the minimum value of a field of the models in the collection

|Param|Type|Description|
|---|---|---|
|`$field`|*mixed*|the name of the field to calculate.|
|**Return**|*int&#124;float&#124;null*|the calculated minimum value. `null` if the collection is empty.|

```php
public function CollectionInterface::min(mixed $field = null): mixed
```

File location: `src/CollectionInterface.php:68`

### reduce()

Reduce the collection to a single value.

|Param|Type|Description|
|---|---|---|
|`$callback`|*callable*|the callback function to compute the reduce value.|
|`$initialValue`|*mixed*|initial value to pass to the callback on first item.|
|**Return**|*mixed*||

```php
public function CollectionInterface::reduce(callable $callback, mixed $initialValue = null): mixed
```

File location: `src/CollectionInterface.php:47`

### remap()

Convert collection data by selecting a new key and a new value for each item.

Builds a map (key-value pairs) from a multidimensional array or an array of objects.
The `$from` and `$to` parameters specify the key names or property names to set up the map.

|Param|Type|Description|
|---|---|---|
|`$from`|*string&#124;\Closure*|the field of the item to use as the key of the created map.
This can be a closure that returns such a value.|
|`$to`|*string&#124;\Closure*|the field of the item to use as the value of the created map.
This can be a closure that returns such a value.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::remap(mixed $from, mixed $to): mixed
```

File location: `src/CollectionInterface.php:176`

### remove()

Remove a specific item from the collection.

|Param|Type|Description|
|---|---|---|
|`$item`|*mixed&#124;\Closure*|the item to search for. You may also pass a closure that returns a boolean.
The closure will be called on each item and in case it returns `true`, the item will be removed.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::remove(mixed $item): mixed
```

File location: `src/CollectionInterface.php:211`

### replace()

Replace a specific item in the collection with another one.

|Param|Type|Description|
|---|---|---|
|`$item`|*mixed*|the item to search for.|
|`$replacement`|*mixed*|the replacement to insert instead of the item.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::replace(mixed $item, mixed $replacement): mixed
```

File location: `src/CollectionInterface.php:220`

### reverse()

Reverse the order of items.

|Param|Type|Description|
|---|---|---|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::reverse(): mixed
```

File location: `src/CollectionInterface.php:138`

### slice()

Slice the set of elements by an offset and number of items to return.

|Param|Type|Description|
|---|---|---|
|`$offset`|*int*|starting offset for the slice.|
|`$limit`|*int&#124;null*|the number of elements to return at maximum.|
|`$preserveKeys`|*bool*|whether to preserve item keys.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::slice(mixed $offset, mixed $limit = null, mixed $preserveKeys = true): mixed
```

File location: `src/CollectionInterface.php:229`

### sort()

Sort collection data by value.

If the collection values are not scalar types, use `sortBy()` instead.

|Param|Type|Description|
|---|---|---|
|`$direction`|*int*|sort direction, either `SORT_ASC` or `SORT_DESC`.|
|`$sortFlag`|*int*|type of comparison, either `SORT_REGULAR`, `SORT_NUMERIC`, `SORT_STRING`,
`SORT_LOCALE_STRING`, `SORT_NATURAL` or `SORT_FLAG_CASE`.
See [the PHP manual](http://php.net/manual/en/function.sort.php#refsect1-function.sort-parameters)
for details.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::sort(mixed $direction = SORT_ASC, mixed $sortFlag = SORT_REGULAR): mixed
```

File location: `src/CollectionInterface.php:95`

### sortBy()

Sort collection data by one or multiple values.

|Param|Type|Description|
|---|---|---|
|`$key`|*string&#124;\Closure&#124;array*|the key(s) to be sorted by. This refers to a key name of the sub-array
elements, a property name of the objects, or an anonymous function returning the values for comparison
purpose. The anonymous function signature should be: `function($item)`.
To sort by multiple keys, provide an array of keys here.|
|`$direction`|*int&#124;array*|the sorting direction. It can be either `SORT_ASC` or `SORT_DESC`.
When sorting by multiple keys with different sorting directions, use an array of sorting directions.|
|`$sortFlag`|*int&#124;array*|the PHP sort flag. Valid values include
`SORT_REGULAR`, `SORT_NUMERIC`, `SORT_STRING`, `SORT_LOCALE_STRING`, `SORT_NATURAL` and `SORT_FLAG_CASE`.
Please refer to the [PHP manual](http://php.net/manual/en/function.sort.php)
for more details. When sorting by multiple keys with different sort flags, use an array of sort flags.|
|**Return**|*static*|a new collection containing the sorted items.|

```php
public function CollectionInterface::sortBy(mixed $key, mixed $direction = SORT_ASC, mixed $sortFlag = SORT_REGULAR): mixed
```

File location: `src/CollectionInterface.php:132`

### sortByKey()

Sort collection data by key.

|Param|Type|Description|
|---|---|---|
|`$direction`|*int*|sort direction, either `SORT_ASC` or `SORT_DESC`.|
|`$sortFlag`|*int*|type of comparison, either `SORT_REGULAR`, `SORT_NUMERIC`, `SORT_STRING`,
`SORT_LOCALE_STRING`, `SORT_NATURAL` or `SORT_FLAG_CASE`.
See [the PHP manual](http://php.net/manual/en/function.sort.php#refsect1-function.sort-parameters)
for details.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::sortByKey(mixed $direction = SORT_ASC, mixed $sortFlag = SORT_REGULAR): mixed
```

File location: `src/CollectionInterface.php:106`

### sortNatural()

Sort collection data by value using natural sort comparison.

If the collection values are not scalar types, use `sortBy()` instead.

|Param|Type|Description|
|---|---|---|
|`$caseSensitive`|*bool*|whether comparison should be done in a case-sensitive manner. Defaults to `false`.|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::sortNatural(mixed $caseSensitive = false): mixed
```

File location: `src/CollectionInterface.php:116`

### sum()

Calculate the sum of a field of the models in the collection.

|Param|Type|Description|
|---|---|---|
|`$field`|*mixed*|the name of the field to calculate.|
|**Return**|*int&#124;float*|the calculated sum.|

```php
public function CollectionInterface::sum(mixed $field = null): mixed
```

File location: `src/CollectionInterface.php:54`

### values()

Return items without keys.

|Param|Type|Description|
|---|---|---|
|**Return**|*\spaceonfire\Collection\CollectionInterface*||

```php
public function CollectionInterface::values(): mixed
```

File location: `src/CollectionInterface.php:144`

---

This file automatically generated by [Simple PHP ApiDoc](https://github.com/spaceonfire/simple-php-apidoc)