@extends('layouts.admin')

@section('content')
    @csrf
    <div id="messages"></div>
    <div class="row">
        <div class="col-xs-6">
            <select id="studySelect"></select>
        </div>
        <div class="col-xs-6">
            <ul id="majorList"></ul>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var messagesField = $('#messages');
            var studySelect = $('#studySelect');
            var majorList = $('#majorList');

            var studies = [];

            studySelect.change(function () {
                var selectValue = studySelect.val();
                alert(selectValue);
            });

            loadStudies();

            function loadStudies() {
                console.log('loadStudies()')

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "study/getStudies",
                    data: '',
                }).done(function (result) {
                    if (result) {
                        studies = result['aStudies'];

                        updateStudies();
                    }
                });
            }

            function updateStudies() {
                for (var study of studies) {
                    studySelect.append($('<option>')
                        .attr('value', study.study_id)
                        .text(study.study_name));
                }

                studySelect.attr('size', studies.length);
            }
        });
    </script>
@endsection