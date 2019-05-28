<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    const MIN_YEAR = 1990;

    public $fillable = ['name', 'year', 'mark_id', 'engine_id', 'transmission_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mark()
    {
        return $this->belongsTo(Mark::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function engine()
    {
        return $this->belongsTo(Engine::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transmission()
    {
        return $this->belongsTo(Transmission::class);
    }
}
