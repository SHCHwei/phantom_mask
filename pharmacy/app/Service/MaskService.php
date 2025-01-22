<?php

namespace App\Service;

use App\Repositories\MaskRepository;

class MaskService extends BaseService
{

    public function __construct(MaskRepository $repository){
        $this->repository = $repository;
    }

    /**
     * @param integer  $pharmacyID
     * @return array
     */
    public function getMasks(int $pharmacyID): array
    {
        $conditions = [
            'pharmacyID' => $pharmacyID,
        ];

        return $this->repository->search($conditions);
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function priceAndKind(array $conditions): mixed
    {
        $operators = $conditions['operators'];

        $sql = "select
                    subTable.pharmacyID , subTable.maskType, pharmacy.name, pharmacy.openingHours
                from (
                         select
                             pharmacyID, count(id) as `maskType`
                         from
                             mask
                         where
                             price >= :bottom and price <= :top
                         group by pharmacyID
                ) AS subTable
                LEFT JOIN pharmacy on subTable.pharmacyID = pharmacy.id
                WHERE `maskType` $operators :kinds";

        $values = ["top" => $conditions["topLimit"], "bottom" => $conditions["bottomLimit"], "kinds" => $conditions["kinds"]];

        return $this->repository->query($sql, $values);
    }
}
