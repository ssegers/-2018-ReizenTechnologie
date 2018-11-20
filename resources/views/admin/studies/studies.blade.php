@extends('layouts.admin')

@section('content')
    @csrf
    <div id="messages"></div>
    <div class="row">
        <div class="col-xs-6">
            <select id="studySelect"></select>
            <div>
                <input id="studyInput" type="text">
                <button id="studyAdd">Add</button>
            </div>
        </div>
        <div class="col-xs-6">
            <ul id="majorList"></ul>
            <div>
                <input id="majorInput" type="text">
                <button id="majorAdd">Add</button>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            var studySelect = $('#studySelect');
            var majorList = $('#majorList');

            var studyField = $('#studyInput');
            var majorField = $('#majorInput');

            var studyButton = $('#studyAdd');
            var majorButton = $('#majorAdd');

            var studies = [];
            var majors = [];

            studySelect.change(function () {
                var selectValue = studySelect.val();
                loadMajors(selectValue);
            });

            studyButton.click(function () {
                addStudy(studyField.val());
            });

            majorButton.click(function () {
                addMajor(studySelect.val(), majorField.val())
            });

            loadStudies();
            loadMajors();

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

                function updateStudies() {
                    studySelect.empty();

                    for (var study of studies) {
                        studySelect.append($('<option>')
                            .attr('value', study.study_id)
                            .text(study.study_name));
                    }

                    studySelect.attr('size', studies.length);
                }
            }

            function loadMajors(studyId) {
                console.log('loadMajors()');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "study/getMajors",
                    data: {
                        study_id: studyId,
                    },
                }).done(function (result) {
                    if (result) {
                        majors = result['aMajors'];

                        updateMajors();
                    }
                });

                function updateMajors() {
                    majorList.empty();

                    for (var major of majors) {
                        majorList.append($('<li>')
                            .text(major.major_name));
                    }
                }
            }

            function addStudy(studyName) {
                console.log('addStudy(' + studyName + ')');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "study/addStudy",
                    data: {
                        study_name: studyName,
                    },
                }).done(function (result) {
                    if (result) {
                        loadStudies();
                    }
                });
            }

            function addMajor(studyId, majorName) {
                console.log('addMajor(' + studyId + ',' + majorName + ')');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "study/addMajor",
                    data: {
                        study_id: studyId,
                        major_name: majorName,
                    },
                }).done(function (result) {
                    if (result) {
                        loadMajors(studyId);
                    }
                });
            }
        });
    </script>

@endsection