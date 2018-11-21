@extends('layouts.admin')

@section('content')
    @if(session()->has('message'))
        <div id="removeTimer" class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <h1 class="my-5 text-center">Infopagina Aanpassen</h1>

    <div class="form-group">
    {{ Form::open(array('action' => 'AdminInfoController@updateInfo', 'method' => 'post')) }}
    {{ Form::textArea('content', $oPageContent->content, ['class' => 'form-control']) }}
    <div class="actions">
        {{ Form::submit('Opslaan') }}
        <input type="button" onclick="history.go(0)" value="Annuleren"/>
    </div>
    {{ Form::close() }}
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        setTimeout(function(){
            if ($('#removeTimer').length > 0) {
                $('#removeTimer').remove();
            }
        }, 5000)
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
        };
        $('textarea').ckeditor(options);
        CKEDITOR.config.contentsCss="{{ asset('css/app.css') }}";
        CKEDITOR.config.height="380px";

    </script>
@endsection