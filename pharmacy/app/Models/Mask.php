<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mask extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mask';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'price', 'pharmacyID', 'created_at', 'updated_at'];
}
