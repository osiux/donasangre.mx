<?php
namespace DonaSangre\Http\Controllers\Api;

use Dingo\Api\Exception\UpdateResourceFailedException;
use DonaSangre\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as Validator;

/**
 * Class UserController
 * @package DonaSangre\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * @return \Dingo\Api\Http\Response
     */
    public function getProfile()
    {
        $user = $this->user;

        return $this->response->item($user, new UserTransformer);
    }

    /**
     * @param Request $request
     */
    public function updateProfile(Request $request, Validator $validator)
    {
        $user = $this->user;

        $validation = $validator->make($request->all(), [
            'name'  =>  'required',
            'email' =>  'required|email|unique:users,email,' . $user->id,
            'password' => 'confirmed',
        ]);

        if ( $validation->fails() ) {
            throw new UpdateResourceFailedException('Could not update profile.', $validation->errors());
        }

        $data = $request->only('name', 'email', 'password');

        $user->name = $data['name'];
        $user->email = $data['email'];

        if ( ! empty($data['password']) ) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return $this->response->item($user, new UserTransformer);
    }
}