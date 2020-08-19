<?php

namespace Jubilee\Auth\Entries;

use Closure;
use Illuminate\Database\Eloquent\Builder as ORMBuilder;

/**
 * Trait ORMDocHelp
 * @package App\Entries
 * @method static null|$this find($id)
 * @method static null|$this first($columns = ['*'])
 * @method static ORMBuilder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static ORMBuilder whereIn($column, $value = null, $boolean = 'and', $not = false)
 * @method static ORMBuilder whereHas($relation, Closure $callback = null, $operator = '>=', $count = 1)
 * @method static ORMBuilder with($relations)
 * @method static $this updateOrCreate(array $attributes, array $values = [])
 * @mixin ORMBuilder
 * @see https://docs.phpdoc.org/latest/references/phpdoc/index.html
 * @see https://laravel.com/api/5.5/Illuminate/Database/Eloquent/Builder.html 更多model靜態方法參照
 */
trait ORMDocHelp
{
}
