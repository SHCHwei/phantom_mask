<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model $model
     */
    protected $model;


    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        try{
            $result = $this->model::query()->create($data);
        }catch (\Exception $e){
            return ['status' => false, 'message' => "Database error", "system" => $e->getMessage()];
        }

        return ['status' => true, 'data' => $result];
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id)
    {
        $builder = $this->model::query()->where('id', $id)->first();

        foreach ($data as $key => $value)
        {
            $builder->$key = $value;
        }

        return $builder->save();
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function one($id)
    {
        return $this->model::query()->where('id', $id)->first();
    }

    /**
     * @param $conditions
     * @param $columns
     * @param $orderBy
     * @param $groupBy
     * @param $limit
     * @param $offset
     * @return array
     */
    public function search($conditions, $columns = ['*'], $orderBy = '', $groupBy = '', $limit = 0, $offset = 0)
    {
        $builder = $this->model::query();

        if(array_key_exists(0, $conditions)){
            $builder->where($conditions);
        }else{
            foreach ($conditions as $key => $value) {
                $builder->where($key, $value);
            }
        }

        $builder->select($columns);

        if ($groupBy) $builder->groupBy($groupBy);

        if ($orderBy) $builder->orderBy($orderBy);

        $builderCount = clone $builder;

        if($offset > 0) $builder->skip($offset);

        if($limit > 0) $builder->take($limit);

        $data = $builder->get();

        return ['count' => $builderCount->count('id'), 'data' => $data];
    }

    /**
     * @param $conditions
     * @param $params
     * @return mixed
     */
    public function query($conditions, $params = [])
    {
        return DB::selectResultSets($conditions, $params);
    }
}
