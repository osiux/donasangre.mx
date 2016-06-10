<?php
namespace DonaSangre\Transformers;

use DonaSangre\Models\PostalCode;
use League\Fractal\TransformerAbstract;

/**
 * Class PostalCodeTransformer
 * @package DonaSangre\Transformers
 */
class PostalCodeTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'state',
    ];

    /**
     * @param PostalCode $postalcode
     * @return array
     */
    public function transform(PostalCode $postalcode)
    {
        return [
            'code'  =>  $postalcode->code,
            'name'  =>  $postalcode->name,
            'suburb'    =>  $postalcode->suburb,
        ];
    }

    /**
     * @param PostalCode $postalcode
     * @return \League\Fractal\Resource\Item
     */
    public function includeState(PostalCode $postalcode)
    {
        return $this->item($postalcode->state, new StateTransformer);
    }
}