<?php


namespace App\Http\Controllers;


use App\Models\Service;
use Carbon\Carbon;
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
     * Commits a service call
     *
     * @param Request $request
     * @return null|Service
     */
    public function store(Request $request)
    {
        if ($request->has('name')) {
            return Service::create($request->only(['name']));
        }

        return null;
    }

    /**
     * Returns all called services between dates
     *
     * @param string $sinceDate
     * @param string $toDate
     *
     * @returns array
     */
    public function byDateRange(string $sinceDate, string $toDate = '')
    {
        if (!$sinceDate) {
            return [];
        }

        $since = Carbon::parse($sinceDate);
        $to = $toDate ? Carbon::parse($toDate) : Carbon::now();

        return Service::orWhereBetween('created_at', [$since, $to])
            ->get();
    }
}