@extends('layouts.admin')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <h1 class="my-5 text-center">PDF Toevoegen</h1>

    <div class="form-group">
    {{ Form::open(array('action' => 'AdminPdfController@updateContent', 'method' => 'post','files' => true)) }}
    <select class="form-control" name="pageSelector" class="form-control">
        @foreach($aPages as $oPage)
            <option value="{{ $oPage->page_id }}">{{ $oPage->name }}</option>
        @endforeach
    </select>
        <br/>
        <div class="input-group">
           <span class="input-group-btn">
             <a id="lfm" data-input="thumbnail" data-preview="preview" class="btn btn-primary">
               <i class="fa fa-picture-o"></i> Choose
             </a>
           </span>
            <input id="thumbnail" class="form-control" type="text" name="filepath">
        </div>
        <br/>
        <div class="actions">
            {{ Form::submit('Opslaan',array('class'=>"btn btn-primary")) }}
            <input type="button" class="btn btn-primary" onclick="history.go(0)" value="Annuleren"/>
        </div>
    {{ Form::close()}}
    </div>
    <div class="embed-responsive embed-responsive-4by3">
    <embed class="embed-responsive-item" id="preview" src="" type='application/pdf'>
    </div>

    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script type="text/javascript">
        $('#lfm').filemanager('file');
        var select = document.getElementsByName('pageSelector')[0];
        var pdf = document.getElementById('preview');

        select.addEventListener('change', function(){
            switchPdf();
        });

        function switchPdf() {
            var pageData = <?php echo $aPages ?>;
            for(var page of pageData){
                if (page.page_id == select.value){
                    pdf.src = page.content;
                }
            }
        };
        switchPdf();
    </script>
@endsection