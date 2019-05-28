@extends('layouts.app')
@section('content')

    <h1>{{!is_null($advert) ? 'Редактривание объявления №' . $advert->id : 'Добавление объявления' }}</h1>
    <form action="/{{$action}}">

        {{csrf_field()}}

        @if(!is_null($advert))
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
                            {{ !is_null($advert) && $advert->year === $year
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
                            {{ !is_null($advert) && $advert->mark->id === $mark->id
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
                            {{ !is_null($advert) && $advert->transmission->id === $transmission->id
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
                            {{ !is_null($advert) && $advert->engine->id === $engine->id
                                    ? 'selected="selected"'
                                    : '' }}
                    >{{$engine->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

    <script>
        $('form').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData($(this)[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function (response) {
                    if (response.success === 1) {
                        Swal.fire(
                            'Поздравляем!',
                            'Ваше объявление успешно размещено!',
                            'success'
                        )

                        if ($(this).attr('action') === '/store') {
                            $('form')[0].reset();
                        }
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Ой...',
                            text: response.message,
                        })
                    }
                },
                error: function (response) {
                    let errors = response.responseJSON.errors;
                    console.log(typeof errors);
                    $.each(errors, function (element, errorText) {
                        $('<p style="color: red">' + errorText + '</p>').insertAfter('label[for="' + element + '"]');
                    });
                }
            });
        });
    </script>
@endsection