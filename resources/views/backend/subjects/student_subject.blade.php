@extends('layouts.app')
@extends('layouts.sidebar')
@section('title', 'List student subject')
@section('content-title', 'List student subject')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{ $subject->name }}</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('subjects.index') }}" class="btn btn-primary float-end">Back</a>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Point</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($subject->students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->pivot->point }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <div class="row">
            <div id="coss" class="col mr-2">
                <form enctype="multipart/form-data" action="{{ route('subjects.import', $subject->id) }}" method="POST">
                    @csrf
                    <div class="file-upload">
                        <div class="file-upload-select">
                            <div class="file-select-name">No file chosen...</div>
                            <input type="file" name="import_file" style="display:show;" onClick="toggleButton()"
                                id="file-upload-input">
                        </div>
                        <button type="submit" class="btn btn-success" id="button">
                            <i class='fa fa-upload'>Import Data</i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col mr-2">
                <a data-bs-toggle="tooltip" data-bs-placement="right" title="Export Excel" class="btn btn-warning"
                    href="{{ route('subjects.export', $subject->id) }}">
                    <i class="fas fa-file-download">Export Data</i>
                </a>
            </div>
        </div>
    </div>
    <br>
    <script>
        let fileInput = document.getElementById("file-upload-input");
        let fileSelect = document.getElementsByClassName("file-upload-select")[0];
        fileSelect.onclick = function () {
            fileInput.click();
        }
        fileInput.onchange = function () {
            let filename = fileInput.files[0].name;
            let selectName = document.getElementsByClassName("file-select-name")[0];
            selectName.innerText = filename;
        }
    </script>
    <script type="text/JavaScript"
            src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
    </script>
    <script>
        function toggleButton() {
            setTimeout(function () {
                document.querySelector("#button").classList.toggle('hidden');
            }, 2000);
        }
    </script>
@endsection
