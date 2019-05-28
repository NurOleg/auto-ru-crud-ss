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
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class AdvertController extends Controller
{
    /**
     * @var AdvertService
     */
    private $advertService;

    /**
     * AdvertController constructor.
     * @param AdvertService $advertService
     */
    public function __construct(AdvertService $advertService)
    {
        $this->advertService = $advertService;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $template = $request->ajax() ? 'adverts_response' : 'adverts';

        return view($template,
            [
                'adverts' => $this
                    ->advertService
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
     * @return View
     */
    public function show(int $id): View
    {
        return view('advert',
            [
                'advert' => $this
                    ->advertService
                    ->find($id)
            ]);
    }

    /**
     * @param StoreAdvert $request
     * @return JsonResponse
     */
    public function store(StoreAdvert $request): JsonResponse
    {
        $advert = Advert::create($request->all());

        if ($advert->exists) {
            Mail::to(AdvertAdded::MAIL_TO)
                ->send(new AdvertAdded($advert));

            return response()->json(['success' => 1, 'message' => 'Объявление успешно создано']);
        }
        return response()->json(['success' => 0, 'message' => 'Что-то пошло не так']);

    }

    /**
     * @param StoreAdvert $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(StoreAdvert $request): JsonResponse
    {
        $advert = Advert::find($request->id);
        $advert->fill($request->all());

        if ($advert->save()) {
            return response()->json(['success' => 1, 'message' => 'Объявление успешно обновлено']);
        }
        return response()->json(['success' => 0, 'message' => 'Что-то пошло не так']);


    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        if (Advert::destroy($id)) {
            return response()->json(['success' => 1, 'message' => 'Объявление успешно удалено']);
        }
        return response()->json(['success' => 0, 'message' => 'Что-то пошло не так']);
    }

    /**
     * @param int|null $id
     * @return View
     */
    public function getForm(int $id = null): View
    {
        $advert = $id !== null
            ? $this
                ->advertService
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
