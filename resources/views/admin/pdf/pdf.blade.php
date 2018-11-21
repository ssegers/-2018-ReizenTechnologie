@extends('layouts.admin')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <h1 class="my-5 text-center">Pagina's Aanpassen/Toevoegen</h1>

    <div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="pageModalLabel">Pagina aanmaken</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {{ Form::open(array('action' => 'AdminPdfController@createPage', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('Name','Pagina Naam:')}}
                        {{Form::text('Name', null, array('class' => 'form-control'))}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="form-group">
    {{ Form::open(array('action' => 'AdminPdfController@updateContent', 'method' => 'post','files' => true)) }}
        <table id="inlineFormTable">
            <tr>
                <td>
                    <select class="form-control" id="pageSelector" name="pageSelector">
                        @foreach($aPages as $oPage)
                            <option value="{{ $oPage->page_id }}">{{ $oPage->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <div class="form-inline">
                        <label class="control-label" for="typeSelector" style="padding-right: 10px">Type:</label>
                        <select name="typeSelector" id="typeSelector" class="form-control">
                            <option value="pdf">PDF</option>
                            <option value="html">HTML</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="Zichtbaar" id="Zichtbaar">
                        <label class="form-check-label" for="Zichtbaar">Zichtbaar</label>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pageModal">Nieuwe Pagina Aanmaken</button>
                </td>
            </tr>
        </table>
        <div id="pdf1">
            <br/>
            <div class="input-group">
               <span class="input-group-btn">
                 <a id="lfm" data-input="thumbnail" data-preview="preview" class="btn btn-primary">
                   <i class="fa fa-picture-o"></i> Kies Pdf
                 </a>
               </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath">
            </div>
        </div>
        <br/>
        <div class="actions">
            {{ Form::submit('Opslaan',array('class'=>"btn btn-primary")) }}
            <input type="button" class="btn btn-primary" onclick="history.go(0)" value="Annuleren"/>
        </div>
        <br/>
        <div id="pdf2">
            <div class="embed-responsive embed-responsive-4by3">
                <embed class="embed-responsive-item" id="preview" src="" type='application/pdf'>
            </div>
        </div>

        <div id="html" class="form-group">
            {{ Form::textArea('content',"", ['class' => 'form-control','id'=>'content']) }}
        </div>

    {{ Form::close()}}
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        $('#pageModal').on('show.bs.modal', function (event) {
        });
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}'
        };
        $('textarea').ckeditor(options);
        CKEDITOR.config.contentsCss="{{ asset('css/app.css') }}";
        CKEDITOR.config.height="360px";
    </script>
    <script type="text/javascript">
        $('#lfm').filemanager('file');
        var select = document.getElementById('pageSelector');
        var pdf = document.getElementById('preview');
        var editor=document.getElementById('content');
        var typeSelect=document.getElementById('typeSelector');
        var visibleCheckbox=document.getElementById('Zichtbaar');
        var pdfDiv1=document.getElementById('pdf1');
        var pdfDiv2=document.getElementById('pdf2');
        var htmlDiv=document.getElementById('html');
        var filepath=document.getElementById('thumbnail');

        select.addEventListener('change', function(){
            switchPage();
        });

        typeSelect.addEventListener("change",function (){
            switchType();
        });

        function switchType() {
            if (typeSelect.value=='html'){
                pdfDiv1.style.display="none"
                pdfDiv2.style.display="none"
                htmlDiv.style.display="block"
            }
            else {
                htmlDiv.style.display="none"
                pdfDiv1.style.display="block"
                pdfDiv2.style.display="block"
            }
        }
        function switchPage(){
          var pageData=<?php echo $aPages ?>;
            for(var page of pageData){
                if (page.page_id == select.value){
                    typeSelect.value=page.type;
                    if(page.type=='pdf'){
                        pdf.src = page.content;
                        filepath.value=page.content;
                        CKEDITOR.instances["content"].setData("");
                    }
                    else {
                        CKEDITOR.instances["content"].setData(page.content);
                        pdf.src = "";
                        filepath.value="";
                    }
                    if (page.is_visible==true){
                        visibleCheckbox.checked=true;
                    }
                    else {
                        visibleCheckbox.checked=false;
                    }
                }
                }
                switchType();
        };
        switchPage();
        switchType();
    </script>
@endsection