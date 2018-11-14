
@extends('layouts.app')

@section('content')
    <div class="text-center">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <br>
                <div class="form-group">
                    {!! Form::label('reis', 'Kies reis:')!!}
                    {!! Form::select('reis', $categories, null, ['placeholder' => 'Reizen'])!!}
                </div>

                <div class="form-group">
                    {!! Form::label('begeleider', 'Kies begeleider:')!!}
                    {!! Form::select('begeleider', [], null, ['placeholder' => 'Begeleiders'])!!}
                </div>

            </div>
            <div class="col"></div>
        </div>
    </div>

    <script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
    <script>
        $('#parent').change(function(e) {
            var parent = e.target.value;
            $.get('/categories/children?parent=' + parent, function(data) {
                $('#children').empty();
                $.each(data, function(key, value) {
                    var option = $("<option></option>")
                        .attr("value", key)
                        .text(value);

                    $('#children').append(option);
                });
            });
        });
    </script>

@endsection