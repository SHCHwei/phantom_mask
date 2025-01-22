<?php

namespace App\Service;


use App\Repositories\PharmacyRepository;
use App\Repositories\OpeningRepository;
use Illuminate\Database\Eloquent\Collection;

class PharmacyService extends BaseService
{
    private $openingRepository;

    public function __construct(PharmacyRepository $repository, OpeningRepository $openingRepository){
        $this->repository = $repository;
        $this->openingRepository = $openingRepository;
    }

    public function searchPharmacyByDay($day): Collection
    {
        $data = $this->openingRepository->searchPharmacyByDay($day);

        foreach ($data as $item){
            $item->name = $item->pharmacies->name;
            $item->openingHours = $item->pharmacies->openingHours;
            unset($item->pharmacies);
        }

        return $data;
    }

    public function searchPharmacyByHours($hours): Collection
    {
        $data = $this->openingRepository->searchPharmacyByHours($hours);

        foreach ($data as $item){
            $item->name = $item->pharmacies->name;
            $item->openingHours = $item->pharmacies->openingHours;
            unset($item->pharmacies);
        }

        return $data;
    }

    public function keywordSearch($keyword): Collection
    {
        return $this->repository->keywordSearch($keyword);
    }

}
