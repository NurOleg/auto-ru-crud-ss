<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 26.05.2019
 * Time: 21:27
 */

namespace App\Service;

use App\Advert;
use Illuminate\Http\Request;

class AdvertService
{
    private $builder;

    /**
     * AdvertService constructor.
     */
    public function __construct()
    {
        $this->builder = $this->getBuilder();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getBuilder()
    {
        return Advert::query();
    }

    /**
     * @param int $yearFrom
     * @param int $yearTo
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function filterByYear(int $yearFrom = Advert::MAX_YEAR, int $yearTo = null)
    {
        return is_null($yearTo)
            ? $this->builder->where('year', '>=', $yearFrom)
            : $this->builder->whereBetween('year', [$yearFrom, $yearTo]);
    }

    /**
     * @param int|null $engine_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function filterByEngine(int $engine_id = null)
    {
        return is_null($engine_id) ? $this->builder : $this->builder->where('engine_id', $engine_id);
    }

    /**
     * @param int|null $transmission_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function filterByTransmission(int $transmission_id = null)
    {
        return is_null($transmission_id) ? $this->builder : $this->builder->where('transmission_id', $transmission_id);
    }

    /**
     * @param int|null $mark_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function filterByMark(int $mark_id = null)
    {
        return is_null($mark_id) ? $this->builder : $this->builder->where('mark_id', $mark_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyFilter(Request $request)
    {
        if ($request->ajax()) {
            $this->filterByYear($request->year_from, $request->year_to);
            $this->filterByEngine($request->engine_id);
            $this->filterByMark($request->mark_id);
            $this->filterByTransmission($request->transmission_id);
        }

        return $this->builder;
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function find(int $id)
    {
        return $this->builder->with(['mark', 'engine', 'transmission'])->findOrFail($id);
    }
}