<?php

namespace App\Service;


use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
    private $orderRepository;

    public function __construct(UserRepository $repository, OrderRepository $orderRepository){
        $this->repository = $repository;
        $this->orderRepository = $orderRepository;
    }

    public function checkUser($id)
    {
        $data = $this->repository->one($id);

        return (bool)$data;
    }


    public function topBuyer($conditions)
    {
        $sqlStr = "select `userID`, sum(transactionAmount) as amount from `order` where `transactionDate` >= :startDate and `transactionDate` <= :endDate Group By `userID` Order By amount Limit :top";

        return $this->orderRepository->query($sqlStr, $conditions);
    }
}
