<?php


namespace App\Http\Controllers;


use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Returns all called services
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Service::all();
    }

    /**
     * @param Request $request
     * @return null
     */
    public function store(Request $request)
    {
        if ($request->has('name')) {
            return Service::create($request->only(['name']));
        }

        return null;
    }
}