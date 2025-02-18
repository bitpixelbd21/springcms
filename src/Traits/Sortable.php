<?php

namespace BitPixel\SpringCms\Traits;

trait Sortable
{
    /**
     * Scope a query to order the results by the `sort_order` column in ascending order.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Scope a query to order the results by the `sort_order` column in descending order.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOrderDesc($query)
    {
        return $query->orderBy('sort_order', 'desc');
    }
}
