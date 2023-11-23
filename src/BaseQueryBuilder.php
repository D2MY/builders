<?php

namespace D2my\Builders;

use Illuminate\Database\Query\Builder;

class BaseQueryBuilder extends Builder
{
    use BuilderTrait;

    /**
     * @param $method
     * @param $parameters
     * @return BaseQueryBuilder|mixed
     */
    public function __call($method, $parameters)
    {
        return parent::__call($method, $parameters);
    }
}