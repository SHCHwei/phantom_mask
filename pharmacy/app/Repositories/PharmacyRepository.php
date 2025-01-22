<?php

namespace App\Repositories;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Collection;

class PharmacyRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Pharmacy::class);
    }

    /**
     * @param $keyword
     * @return Collection
     */
    public function keywordSearch($keyword): Collection
    {
        $builder = $this->model::query()
            ->select("pharmacy.id as pharmacyID" , "pharmacy.name as pharmacyName", "mask.id as MaskID", "mask.name as maskName", "mask.price as maskPrice")
            ->join("mask", "pharmacy.id", "=", "mask.pharmacyID")
            ->where("pharmacy.name", "like", "%" . $keyword . "%")
            ->orWhere("mask.name", "like", "%" . $keyword . "%");

        return $builder->get();
    }

}
