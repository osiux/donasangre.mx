<?php

namespace DonaSangre\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * @package DonaSangre\Models
 */
class State extends Model
{
    /**
     * @var string
     */
    protected $table = 'states';

    /**
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postalCodes()
    {
        return $this->hasMany(PostalCode::class, 'state');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function donators()
//    {
//        return $this->hasMany(Donator::class);
//    }
}