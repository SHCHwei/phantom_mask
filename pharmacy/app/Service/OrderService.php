<?php

namespace App\Service;


use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\Repositories\pharmacyRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderService  extends BaseService
{
    private $pharmacyRepository;
    private $userRepository;

    public function __construct(OrderRepository $repository, PharmacyRepository $pharmacyRepository, UserRepository $userRepository){
        $this->repository = $repository;
        $this->pharmacyRepository = $pharmacyRepository;
        $this->userRepository = $userRepository;
    }


    public function buyMask($conditions): array
    {

        $lock = Cache::lock('new_order', 60);

        $userData = $this->userRepository->one($conditions['userID']);

        if($userData['cashBalance'] <= 0)
        {
            $lock->release();
            return ['status' => false, 'msg' => 'cash is not enough'];
        }


        DB::beginTransaction();

        $newOrder = [
            'pharmacyName' => $conditions['pharmacyName'],
            'maskName' => $conditions['maskName'],
            'transactionAmount' => $conditions['amount'],
            'transactionDate' => $conditions['date'],
            'userID' => $conditions['userID'],
            'maskID' => $conditions['maskID'],
            'pharmacyID' => $conditions['pharmacyID'],
        ];

        $orderResult = $this->repository->create($newOrder);

        if(!$orderResult)
        {
            DB::rollBack();
            $lock->release();
            return ['status' => false, 'msg' => 'order is failed'];
        }


        $upData = ['cashBalance' => $userData['cashBalance'] - $conditions['amount']];
        $debitResult = $this->userRepository->update($upData, $conditions['userID']);

        if(!$debitResult)
        {
            DB::rollBack();
            $lock->release();
            return ['status' => false, 'msg' => 'debit is failed'];
        }


        $pharmacyData = $this->pharmacyRepository->one($conditions['pharmacyID']);

        $upData = ['cashBalance' => $pharmacyData['cashBalance'] + $conditions['amount']];
        $result = $this->pharmacyRepository->update($upData, $conditions['userID']);

        if(!$result)
        {
            DB::rollBack();
            $lock->release();
            return ['status' => false, 'msg' => 'Collection is failed'];
        }

        DB::commit();
        $lock->get();

        return ['status' => true, 'msg' => $orderResult];
    }

    public function statisticsByDate($conditions)
    {
        return $this->repository->statisticsByDate($conditions);
    }

}
