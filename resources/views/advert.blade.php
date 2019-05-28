@extends('layouts.app')
@section('content')

    <h1>Объявление: {{$advert->name}}</h1>

    <p>Марка: {{$advert->mark->name}}</p>
    <p>Коробка: {{$advert->transmission->name}}</p>
    <p>Двигатель: {{$advert->engine->name}}</p>
    <p>Год выпуска: {{$advert->year}}</p>

    <a href="{{route('form', ['id' => $advert->id])}}" class="btn btn-primary">Редактировать</a>
@endsection