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
     * @var Request
     */
    protected $request;

    /**
     * @var JWTAuth
     */
    protected $jwtauth;

    /**
     * AuthController constructor.
     * @param Request $request
     * @param JWTAuth $jwtauth
     */
    public function __construct(Request $request, JWTAuth $jwtauth) {
        $this->request = $request;
        $this->jwtauth = $jwtauth;
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    public function register(Validator $validator)
    {
        $validation = $validator->make($this->request->all(), [
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

        $token = $this->jwtauth->fromUser($user);

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->response->array($response);
    }

    /**
     * @return mixed
     */
    public function login()
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