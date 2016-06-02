<?php
namespace DonaSangre\Http\Controllers\Api;

use Dingo\Api\Exception\StoreResourceFailedException;
use DonaSangre\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class AuthController
 * @package DonaSangre\Http\Controllers\Api
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @param Validator $validator
     * @param JWTAuth $jwtauth
     * @return mixed
     */
    public function register(Request $request, Validator $validator, JWTAuth $jwtauth)
    {
        $validation = $validator->make($request->all(), [
            'name'  =>  'required',
            'email' =>  'required|email|unique:users',
            'password'  =>  'required|confirmed',
        ]);

        if ( $validation->fails() ) {
            throw new StoreResourceFailedException('Could not create account.', $validation->errors());
        }

        $data = $this->request->only('name', 'email', 'password');
        $data['password'] = bcrypt($data['password']);

        // TODO: Change to repositories
        $user = User::create($data);

        $token = $jwtauth->fromUser($user);

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->response->array($response);
    }

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
        $credentials = $this->request->only('email', 'password');

        try {
            if ( ! $token = $this->jwtauth->attempt($credentials) ) {
                return $this->response->errorUnauthorized('invalid_credentials');
            }
        } catch( JWTException $e ) {
            return $this->response->errorInternal('could_not_create_token');
        }

        return $this->response->array(compact('token'));
    }

    public function refreshToken()
    {
        // TODO
    }
}