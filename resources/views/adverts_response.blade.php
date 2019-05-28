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