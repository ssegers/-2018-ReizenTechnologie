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
        <table>
            <tr>
                <td width="300px">
                    <select class="form-control" id="pageSelector" name="pageSelector">
                        @foreach($aPages as $oPage)
                            <option value="{{ $oPage->page_id }}">{{ $oPage->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="padding-left: 100px">
                    <div class="form-inline">
                        <label class="control-label" for="typeSelector" style="padding-right: 10px">Type:</label>
                        <select name="typeSelector" id="typeSelector" class="form-control">
                            <option value="pdf">PDF</option>
                            <option value="html">HTML</option>
                        </select>
                    </div>
                </td>
                <td style="padding-left: 100px">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="Zichtbaar" id="Zichtbaar">
                        <label class="form-check-label" for="Zichtbaar">Zichtbaar</label>
                    </div>
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