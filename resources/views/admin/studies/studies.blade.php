@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="field field-study">
                {{--{{var_dump($aStudies)}}--}}
                <select id="studySelect" size="{{ $iStudyCount }}" style="overflow-y: -moz-hidde-unscrollable">
                    @foreach($aStudies as $oStudie)
                        <option value="{{$oStudie->study_id}}">{{ $oStudie->study_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <script>
        var studySelect = $('#studySelect');

        studySelect.change(function () {
            alert('test');
        });
    </script>
@endsection