<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters
{

    /**
     * HTTP Request Instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Query builder instance
     *
     * @var
     */
    protected $builder;

    /**
     * Array of possible filters
     *
     * @var string[]
     */
    protected $filters = ['by'];

    /**
     * ThreadFilters constructor.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filters to the query
     *
     * @param $builder
     *
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->filters as $filter) {
            if ($this->hasFilter($filter)) {
                $this->$filter($this->request->$filter);
            }
        }
        return $this->builder;
    }

    /**
     * Filter by username function
     *
     * @param string $username
     *
     * @return mixed
     */
    protected function by(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * @param string $filter
     *
     * @return bool
     */
    protected function hasFilter(string $filter): bool
    {
        return method_exists($this, $filter) && $this->request->has($filter);
    }
}
