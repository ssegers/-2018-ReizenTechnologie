@extends('layouts.admin')

@section('content')
    <div id="messages"></div>
    <div class="row">
        <div class="col-xs-6">
            <div class="field field-study">
                <select id="studySelect"></select>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var messagesField = $('#messages');
            var studySelect = $('#studySelect');

            studySelect.change(function () {
                alert('test');
            });

            loadStudies();

            function loadStudies() {
                console.log('loadStudies()')

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "studies/",
                }).done(function (result) {
                    var studies = result['aStudies'];
                    console.log(studies);
                });
            }
        });
    </script>
@endsection