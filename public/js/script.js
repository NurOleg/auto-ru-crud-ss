$(document).ready(function () {
    $('form#advert').on('submit', function (e) {
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

    $('.delete').on('click', function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $(this).attr('href'),
            processData: false,
            contentType: false,
            type: 'post',
            success: function (response) {
                if (response.success === 1) {
                    Swal.fire({
                            title: 'Поздравляем!',
                            text: 'Ваше объявление успешно удалено!',
                            type: 'success'
                        },
                        function () {
                            window.location.href = '/';
                        });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Ой...',
                        text: response.message,
                    })
                }
            }
        });
    });

    $('form#filter').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData($(this)[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            data: formData,
            processData: false,
            contentType: false,
            type: 'post',
            success: function (response) {
                $('#adverts').html('').html(response);
            }
        });
    });
});