<?php

namespace App\Http\Controllers;

use App\Advert;
use App\Engine;
use App\Http\Requests\StoreAdvert;
use App\Mail\AdvertAdded;
use App\Mark;
use App\Service\AdvertService;
use App\Transmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdvertController extends Controller
{
    private $advertService;

    public function __construct(AdvertService $advertService)
    {
        $this->advertService = $advertService;
    }

    public function index(Request $request)
    {
        $template = $request->ajax() ? 'adverts_response' : 'adverts';

        return view($template,
            [
                'adverts' => $this->advertService
                    ->applyFilter($request)
                    ->with(['mark', 'engine', 'transmission'])
                    ->get(),
                'transmissions' => Transmission::all(),
                'marks' => Mark::orderBy('name', 'asc')->get(),
                'engines' => Engine::all(),
                'year_min' => Advert::MIN_YEAR,
                'year_max' => Carbon::now()->year
            ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('advert',
            [
                'advert' => $this->advertService
                    ->find($id)
            ]);
    }

    /**
     * @param StoreAdvert $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(StoreAdvert $request)
    {
        $advert = Advert::create($request->all());

        if ($advert->exists) {
            Mail::to('oleg.nur94@gmail.com')
                ->send(new AdvertAdded($advert));

            return response()->json(['success' => 1, 'message' => 'Объявление успешно создано']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Что-то пошло не так']);
        }
    }

    public function edit(StoreAdvert $request)
    {
        $advert = Advert::find($request->id);
        $advert->fill($request->all());

        if ($advert->save()) {
            return response()->json(['success' => 1, 'message' => 'Объявление успешно обновлено']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Что-то пошло не так']);
        }


    }

    public function delete()
    {

    }

    /**
     * @param int|null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getForm(int $id = null)
    {
        $advert = !is_null($id)
            ? $this->advertService
                ->find($id)
            : null;

        $action = !is_null($id) ? 'edit' : 'store';

        return view('form', [
            'advert' => $advert,
            'action' => $action,
            'transmissions' => Transmission::all(),
            'marks' => Mark::orderBy('name', 'asc')->get(),
            'engines' => Engine::all(),
            'year_min' => Advert::MIN_YEAR,
            'year_max' => Carbon::now()->year
        ]);
    }
}
