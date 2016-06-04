<?php
namespace DonaSangre\Http\Controllers\Api;

use DonaSangre\Models\State;
use DonaSangre\Transformers\StateTransformer;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    /**
     * @var
     */
    protected $request;

    /**
     * GeoController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function getStates()
    {
        $states = State::all();

        return $this->response->collection($states, new StateTransformer);
    }

    /**
     * @return \Dingo\Api\Http\Response|void
     */
    public function getState($code)
    {
        $state = State::where('code', $code)->first();

        if ( ! $state ) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($state, new StateTransformer);
    }
}