<?php

namespace App\Repositories;


use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Order::class);
    }

    public function statisticsByDate($conditions)
    {
        return $this->model::query()
            ->select("maskID")
            ->selectRaw("count(id) as count")
            ->selectRaw("sum(transactionAmount) as amount")
            ->whereBetween('transactionDate', $conditions)
            ->groupBy(["maskID"])
            ->get();
    }

}
