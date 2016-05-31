<?php
namespace DonaSangre\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostalCode
 * @package DonaSangre\Models
 */
class PostalCode extends Model
{
    /**
     * @var string
     */
    protected $table = 'postal_codes';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }
}