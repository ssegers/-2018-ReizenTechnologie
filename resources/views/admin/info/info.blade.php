@extends('layouts.admin')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <h1 class="my-5 text-center">Infopagina Aanpassen</h1>

    <div class="form-group">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=f1b7vjd1xordm1kfj32o5h93ox2x8i0dxr9capjyc1axdalb"></script>
    {{ Form::open(array('action' => 'AdminInfoController@updateInfo', 'method' => 'post')) }}
    {{ Form::textArea('content', $oPageContent->content, ['class' => 'form-control']) }}
    <div class="actions">
        {{ Form::submit('Opslaan') }}
        <input type="button" onclick="history.go(0)" value="Annuleren"/>
    </div>
    {{ Form::close() }}
    </div>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea',
            height: 350,
            theme: 'modern',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
@endsection