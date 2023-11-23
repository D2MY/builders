<?php

namespace D2my\Builders;

use Illuminate\Database\Eloquent\Builder;

class BaseEloquentBuilder extends Builder
{
    use BuilderTrait;

    /**
     * @param $method
     * @param $parameters
     * @return BaseQueryBuilder|mixed
     */
    public function __call($method, $parameters)
    {
        if (str_starts_with($method, 'has')) {
            return $this->whereHas($this->replaceMethodName($method, 'has'), ...$parameters);
        }

        if (str_starts_with($method, 'or')) {
            return $this->orWhere(fn (self $query) =>
                $query->{$this->replaceMethodName($method, 'or')}(...$parameters)
            );
        }

        return parent::__call($method, $parameters);
    }
}