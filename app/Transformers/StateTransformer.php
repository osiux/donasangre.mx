<?php
namespace DonaSangre\Transformers;

use DonaSangre\Models\State;
use League\Fractal\TransformerAbstract;

/**
 * Class StateTransformer
 * @package DonaSangre\Transformers
 */
class StateTransformer extends TransformerAbstract
{
    /**
     * @param State $state
     * @return array
     */
    public function transform(State $state)
    {
        return [
            'code' => $state->code,
            'name' => $state->name,
        ];
    }
}