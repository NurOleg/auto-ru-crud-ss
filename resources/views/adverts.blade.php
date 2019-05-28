@extends('layouts.app')
@section('content')

    <h1>Объявления о продаже автомобилей</h1>
    <form method="post" id="filter">

        {{csrf_field()}}

        <div class="form-group">
            <label for="year_from">Год выпуска, от</label>
            <select name="year_from" id="year_from">
                @for($year = $year_min; $year <= $year_max; $year++)
                    <option value="{{$year}}">{{$year}}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="year_to">Год выпуска, до</label>
            <select name="year_to" id="year_to">
                @for($year = $year_min; $year <= $year_max; $year++)
                    <option value="{{$year}}">{{$year}}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="mark_id">Марка</label>
            <select name="mark_id" id="mark_id">
                <option value="">Не выбрано</option>
                @foreach($marks as $mark)
                    <option value="{{$mark->id}}">{{$mark->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="transmission_id">Коробка передач</label>
            <select name="transmission_id" id="transmission_id">
                <option value="">Не выбрано</option>
                @foreach($transmissions as $transmission)
                    <option value="{{$transmission->id}}">{{$transmission->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="engine_id">Тип двигателя</label>
            <select name="engine_id" id="engine_id">
                <option value="">Не выбрано</option>
                @foreach($engines as $engine)
                    <option value="{{$engine->id}}">{{$engine->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Фильтровать</button>
    </form>

    <div id="adverts">
        @if($adverts->count() <= 0)
            К сожалению, подходящих Вам объявлений пока нет.
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название</th>
                    <th scope="col">Модель</th>
                    <th scope="col">Коробка передач</th>
                    <th scope="col">Двигатель</th>
                    <th scope="col">Год выпуска</th>
                    <th scope="col">Детальный просмотр</th>
                    <th scope="col">Редактирование</th>
                </tr>
                </thead>
                <tbody>

                @foreach($adverts as $advert)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$advert->name}}</td>
                        <td>{{$advert->mark->name}}</td>
                        <td>{{$advert->transmission->name}}</td>
                        <td>{{$advert->engine->name}}</td>
                        <td>{{$advert->year}}</td>
                        <td><a href="{{route('advert.detail', ['id' => $advert->id])}}">Перейти</a></td>
                        <td><a href="{{route('form', ['id' => $advert->id])}}">Редактировать</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @endif
    </div>
    <script>

    </script>
@endsection