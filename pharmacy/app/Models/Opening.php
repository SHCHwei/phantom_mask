<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opening extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'opening';

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
    protected $fillable = ['pharmacyID', 'day', 'timeStart', 'timeEnd'];

    /**
     * @return BelongsTo
     */
    public function pharmacies(): BelongsTo
    {
        return $this->belongsTo(Pharmacy::class, 'pharmacyID', 'id');
    }

}
