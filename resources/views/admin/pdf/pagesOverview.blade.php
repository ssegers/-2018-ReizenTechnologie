@extends('layouts.admin')

@section('content')
    @if(session()->has('message'))
        <div id="removeTimer" class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
<h1 class="my-5">Beheer Pagina's</h1>

<div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="pageModalLabel">Pagina aanmaken</h4>
                {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
            </div>
            {{ Form::open(array('action' => 'AdminPagesController@createPage', 'method' => 'post')) }}
            <div class="modal-body">
                <div class="form-group">
                    {{Form::label('Name','Pagina Naam:')}}
                    {{Form::text('Name', null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="modal-footer">
                {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                {{Form::button('Opslaan',array('class' => 'btn btn-primary', 'type' => 'submit'))}}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
    {{Form::button('Nieuwe Pagina Aanmaken',array('class' => 'mb-5 p-3 float-right btn btn-primary', 'type' => 'button','data-toggle'=>'modal','data-target'=>'#pageModal'))}}
<table class="table">
    <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Type</th>
            <th scope="col">Pagina Zichtbaar</th>
            <th scope="col">Bewerken</th>
            <th scope="col">Verwijderen</th>
        </tr>
    </thead>
    <tbody>
    @foreach($aPages as $oPage)
        <tr>
            <td>{{$oPage->name}}</td>
            <td>{{$oPage->type}}</td>
            @if($oPage->is_visible)
                <td>Zichtbaar</td>
            @else
                <td>Niet Zichtbaar</td>
            @endif
            <td>
                {{ Form::open(array('action' => 'AdminPagesController@editPage', 'method' => 'post')) }}
                {{ Form::hidden('pageId', $oPage->page_id) }}
                {{ Form::submit('Edit',array('class'=>"btn btn-primary")) }}
                {{ Form::close()}}
            </td>
            <td>
                {{ Form::open(array('action' => 'AdminPagesController@deletePage', 'method' => 'post','onsubmit' => 'return ConfirmDelete()')) }}
                {{ Form::hidden('pageId', $oPage->page_id) }}
                {{ Form::submit('Delete',array('class'=>"btn btn-primary")) }}
                {{ Form::close()}}
            </td>
        </tr>
    @endForeach
    </tbody>
</table>
<script>
    setTimeout(function(){
        if ($('#removeTimer').length > 0) {
            $('#removeTimer').remove();
        }
    }, 5000);

    function ConfirmDelete(){
        return confirm('Are you sure?');
    }
</script>
@endsection