<?php
namespace DonaSangre\Transformers;

use DonaSangre\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer
 * @package DonaSangre\Transformers
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'created' => $user->created_at,
        ];
    }
}