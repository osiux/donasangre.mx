<?php
namespace DonaSangre\Http\Controllers;

/**
 * Class HomeController
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}