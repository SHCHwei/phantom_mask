<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pharmacy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pharmacy';

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
    protected $fillable = ['name', 'cashBalance', 'openingHours', 'created_at', 'updated_at'];

    /**
     * @return HasMany
     */
    protected function hasMask(): HasMany
    {
        return $this->hasMany(Mask::class, 'pharmacyID', 'id');
    }

    /**
     * @return HasMany
     */
    protected function hasOpeningHours(): HasMany
    {
        return $this->hasMany(opening::class, 'pharmacyID', 'id');
    }

}
