@extends('layouts.app')
@section('content')

    <h1>{{$advert !== null ? 'Редактривание объявления №' . $advert->id : 'Добавление объявления' }}</h1>
    <form action="/{{$action}}" id="advert">

        {{csrf_field()}}

        @if($advert !== null)
            <input type="hidden" name="id" value="{{$advert->id}}">
        @endif

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" id="name" name="name" value="{{!is_null($advert) ? $advert->name : ''}}">
        </div>

        <div class="form-group">
            <label for="year">Год выпуска</label>
            <select name="year" id="year">
                @for($year = $year_min; $year <= $year_max; $year++)
                    <option value="{{$year}}"
                            {{ $advert !== null && $advert->year === $year
                            ? 'selected="selected"'
                            : '' }}
                    >{{$year}}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="mark_id">Марка</label>
            <select name="mark_id" id="mark_id">
                <option value="">Не выбрано</option>
                @foreach($marks as $mark)
                    <option value="{{$mark->id}}"
                            {{ $advert !== null && $advert->mark->id === $mark->id
                            ? 'selected="selected"'
                            : '' }}
                    >{{$mark->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="transmission_id">Коробка передач</label>
            <select name="transmission_id" id="transmission_id">
                <option value="">Не выбрано</option>
                @foreach($transmissions as $transmission)
                    <option value="{{$transmission->id}}"
                            {{ $advert !== null && $advert->transmission->id === $transmission->id
                                            ? 'selected="selected"'
                                            : '' }}
                    >{{$transmission->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="engine_id">Тип двигателя</label>
            <select name="engine_id" id="engine_id">
                <option value="">Не выбрано</option>
                @foreach($engines as $engine)
                    <option value="{{$engine->id}}"
                            {{ $advert !== null && $advert->engine->id === $engine->id
                                    ? 'selected="selected"'
                                    : '' }}
                    >{{$engine->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>

        @if($advert !== null)
            <a href="/delete/{{$advert->id}}" class="btn btn-danger delete" id="{{$advert->id}}">Удалить</a>
        @endif
    </form>
@endsection