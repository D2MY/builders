<?php

namespace D2my\Builders;

use Closure;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class BaseQueryBuilder extends QueryBuilder
{
    use BuilderTrait;

    /**
     * @param string $column
     * @param array|int|string|null $value
     * @param string $expression
     * @return Closure|null
     */
    public function normalizedWhere(string $column, array|int|string|null $value, string $expression = '='): ?Closure
    {
        [$method, $args] = match (true) {
            is_array($value) => ['whereIn', [$column, $value]],
            is_null($value) => ['whereNull', [$column]],
            default => ['where', [$column, $expression, $value]]
        };

        return function (EloquentBuilder|QueryBuilder $query) use ($args, $method) {
            $query->$method(...$args);
        };
    }
}