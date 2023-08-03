<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractFilter
{
    public const SEARCH = 'search';
    public const STATUS = 'status';
    public const CONTENT = 'content';
    public const PRIORITY_FROM = 'priority_from';
    public const PRIORITY_TO = 'priority_to';
    public const SORT_BY = 'sort_by';
    public const ORDER = 'order';

    protected function getCallbacks(): array
    {
        return [
            self::SEARCH => [$this, 'search'],
            self::STATUS => [$this, 'status'],
            self::CONTENT => [$this, 'content'],
            self::PRIORITY_FROM => [$this, 'priority_from'],
            self::PRIORITY_TO => [$this, 'priority_to'],
            self::SORT_BY => [$this, 'sort_by'],
            self::ORDER => [$this, 'order'],
        ];
    }

    public function search(Builder $builder, $value): void
    {
        $builder->whereRaw("MATCH(`title`, `description`) AGAINST(? IN BOOLEAN MODE)", [$value]);
    }

    public function status(Builder $builder, $value): void
    {
        $builder->where('status', $value);
    }

    public function priority_from(Builder $builder, $value): void
    {
        $builder->where('priority', '>=', $value);
    }

    public function priority_to(Builder $builder, $value): void
    {
        $builder->where('priority', '<=', $value);
    }

    public function sort_by(Builder $builder, $value): void
    {
        $builder->orderBy($value);
    }

    public function order(Builder $builder, $value): void
    {
        $builder->reorder(null, $value);
    }
}
