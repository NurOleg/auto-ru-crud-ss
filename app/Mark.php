<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function advert()
    {
        return $this->hasOne(Advert::class);
    }
}
