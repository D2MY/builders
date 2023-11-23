<?php

namespace D2my\Builders;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait ExtendedBuilders
{
    /**
     * @param $query
     * @return EloquentBuilder
     */
    public function newEloquentBuilder($query): EloquentBuilder
    {
        $builder = $this->eloquentBuilder ??
            sprintf(
                '%s\\%s\\%sEloquentBuilder',
                config('builders.base_namespace', 'App\\Builders'),
                $class = class_basename($this),
                config('builders.model_name_in_builders_names') ? $class : ''
            );

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
            sprintf(
                '%s\\%s\\%sQueryBuilder',
                config('builders.base_namespace', 'App\\Builders'),
                $class = class_basename($this),
                config('builders.model_name_in_builders_names') ? $class : ''
            );

        if (class_exists($builder)) {
            return new $builder(
                ($connection = $this->getConnection()), $connection->getQueryGrammar(), $connection->getPostProcessor()
            );
        }

        return $this->getConnection()->query();
    }
}