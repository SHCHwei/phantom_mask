<?php

namespace App\Repositories;

use App\Models\Mask;

class MaskRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Mask::class);
    }
}
