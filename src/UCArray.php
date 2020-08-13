<?php

declare(strict_types=1);

namespace UnderCover;

class UCArray implements \ArrayAccess, \Iterator
{
    protected array $array = [];
    protected int $position = 0;

    public LogBook $logBook;

    public function __construct(array $array = [])
    {
        $this->logBook = new LogBook();
        $this->array = $array;
        $this->logBook->push('__construct');
    }

    public function offsetExists($offset): bool
    {
        $this->logBook->push('offsetExists', $offset);
        return isset($list[$offset]);
    }

    public function offsetGet($offset)
    {
        $this->logBook->push('offsetGet', $offset);
        return $this->array[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->logBook->push('offsetSet', $offset, $value);
        if (is_null($offset)) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        $this->logBook->push('offsetUnset', $offset, null);
        $this->position = 0;
    }

    public function rewind()
    {
        $this->logBook->push('rewind');
        $this->position = 0;
    }

    public function current()
    {
        $this->logBook->push('current', $this->position, $this->array[$this->position]);
        return $this->array[$this->position];
    }

    public function key()
    {
        $this->logBook->push('current', $this->position);
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
        $this->logBook->push('next', $this->position);
    }

    public function valid()
    {
        $this->logBook->push('valid', $this->position, isset($this->array[$this->position]));
        return isset($this->array[$this->position]);
    }
}