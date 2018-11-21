@extends('layouts.admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('alert-message'))
        <div class="alert alert-danger">
            {{ session()->get('alert-message') }}
        </div>
    @endif

    <h1 class="my-5 text-center">Voeg hier een nieuwe postcode toe:</h1>
    {{Form::open(array('action' => 'AdminZipController@createZip', 'method' => 'post' ))}}
    <div class="form-group">
        {{Form::label('zip_code', 'Postcode: ', ['class' => ''])}}
        {{ Form::number('zip_code', null, array("class" => "form-control", "required", "min" => "1000", "max" => "9999", "oninvalid" => "this.setCustomValidity('Deze postcode is ongeldig')", "oninput" => "this.setCustomValidity('')", "placeholder" => "bv. 3660" )) }}
        <br/>
        {{Form::label('city', 'Stad of Gemeente: ', ['class' => ''])}}
        {{ Form::text('city', null, array("class" => "form-control", "required","maxlength" => "50", "oninvalid" => "this.setCustomValidity('Deze gemeente is ongeldig')", "oninput" => "this.setCustomValidity('')", "placeholder" => "bv: Opglabbeek")) }}
    </div>
    <div class="actions float-right">
        {{Form::submit('Postcode Toevoegen', ['class' =>'btn btn-primary mr-5 p-3' ])}}
        <input type="button" class="btn btn-danger p-3" onclick="history.go(0)" value="Annuleren"/>
    </div>
    {{Form::close()}}

   <div id="tabel" clas="col">
       <table class="table" >
           <tr>
               <td>
                   <table cellspacing="0"; cellpadding="0" border="0">
                        <tr>
                            <th scope="col">Postcode</th>
                            <th scope="col">Gemeente</th>
                        </tr>
                   </table>
               </td>

           </tr>
           <tr>
             <td>
                 <div style="width:100%; height:250px; overflow:auto;">
                     <table cellspacing="0"; cellpadding="1" border="0" width="300">
                         <tbody>
                         @foreach($aZipData as $oZip)
                             <tr>
                                 <td  >{{$oZip->zip_code}}</td>
                                 <td >{{$oZip->city}}</td>
                             </tr>
                         @endforeach
                         </tbody>
                     </table>
                 </div>
             </td>
           </tr>
       </table>
   </div>

    <style type="text/css" rel="stylesheet">


    </style>








    @endsection