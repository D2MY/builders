<?php

namespace D2my\Builders;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait CustomBuilders
{
    /**
     * @var string
     */
    public static string $buildersPath = 'App\\Builders';

    /**
     * @param $query
     * @return EloquentBuilder
     */
    public function newEloquentBuilder($query): EloquentBuilder
    {
        $builder = $this->eloquentBuilder ??
            sprintf('%s\\%s\\%sEloquentBuilder', self::$buildersPath, $class = class_basename($this), $class);

        if (class_exists($builder)) {
            return new $builder($query);
        }

        return new EloquentBuilder($query);
    }

    /**
     * @return QueryBuilder
     */
    protected function newBaseQueryBuilder(): QueryBuilder
    {
        $builder = $this->queryBuilder ??
            sprintf('%s\\%s\\%sQueryBuilder', self::$buildersPath, $class = class_basename($this), $class);

        if (class_exists($builder)) {
            return new $builder(
                ($connection = $this->getConnection()), $connection->getQueryGrammar(), $connection->getPostProcessor()
            );
        }

        return $this->getConnection()->query();
    }
}