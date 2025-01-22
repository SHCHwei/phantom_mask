<?php

namespace App\Repositories;

use App\Models\Opening;
use Illuminate\Database\Eloquent\Collection;

class OpeningRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Opening::class);
    }

    /**
     * @param $day
     * @return Collection
     */
    public function searchPharmacyByDay($day): Collection
    {
         $data = $this->model::query()
             ->select('pharmacyID')
             ->where("days", $day)
             ->GroupBy('pharmacyID')
             ->get();

         foreach ($data as $item)
         {
             $item->pharmacies;
         }

        return $data;
    }

    /**
     * @param $hours
     * @return Collection
     */
    public function searchPharmacyByHours($hours): Collection
    {
        $data = $this->model::query()
            ->select('pharmacyID')
            ->whereBetween("timeStart", $hours)
            ->orWhereBetween("timeEnd", $hours)
            ->GroupBy('pharmacyID')
            ->get();

        foreach ($data as $item){
           $item->pharmacies;
        }

        return $data;
    }

}
