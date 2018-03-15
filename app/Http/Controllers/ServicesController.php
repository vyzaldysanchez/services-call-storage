<?php


namespace App\Http\Controllers;


use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    const TOP_TIME = '23:59:59';

    /**
     * Returns all called services
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request): Collection
    {
        return $this->getByDateRangeQuery(Service::query(), $request)
            ->get();
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
     * @param string  $name
     * @param Request $request
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function filter(string $name, Request $request): Collection
    {
        $query = Service::where('name', $name);

        return $this->getByDateRangeQuery($query, $request)->get();
    }

    /**
     * @param Builder $query
     * @param Request $request
     *
     * @return Builder
     */
    private function getByDateRangeQuery(Builder $query, Request $request): Builder
    {
        $sinceDate = $request->get('since');
        $toDate = $request->get('to');

        if (!$sinceDate) {
            return $query;
        }

        $since = Carbon::parse($sinceDate)
            ->toDateTimeString();
        $to = ($toDate ? Carbon::parse($toDate . ' ' . static::TOP_TIME) : Carbon::now())
            ->toDateTimeString();

        return $query
            ->whereBetween('created_at', [$since, $to]);
    }
}