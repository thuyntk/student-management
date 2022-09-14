@extends('layouts.app')
@extends('layouts.sidebar')
@section('title', 'Manage Student')
@section('content-title', 'Manage Student')
@section('content')
    <div>
        <a href="{{ route('students.create') }}" class="btn btn-success">Create New</a>
    </div>
    <br>
    <div class="search">
        <form action="{{ route('search') }}" method="get" style="display: inline">
            @csrf
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="">From old</label>
                        <input type="text" class="form-control input-sm" id="fromOld" name="age_from" require>
                    </div>
                    <div class="col-sm-3">
                        <label for="">To old</label>
                        <input type="text" class="form-control input-sm" id="toOld" name="age_to" require>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="">From point</label>
                        <input type="text" class="form-control input-sm" id="fromPoint" name="point_from" require>
                    </div>
                    <div class="col-sm-3">
                        <label for="">To point</label>
                        <input type="text" class="form-control input-sm" id="toPoint" name="point_to" require>
                    </div>
                </div>
                <br>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-outline-dark" name="search">Search</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Avatar</td>
                <td>Gender</td>
                <td>Address</td>
                <td>Birthday</td>
                <td>Number of regSub</td>
                <td></td>
                <td>Act</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td><img src="{{ asset($student->avatar) }}" alt="" width="100px"></td>
                    <td>{{ $student->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->birthday }}</td>
                    <td></td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}">
                            <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        </a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline"
                            onsubmit="return confirm('Are you sure delete ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $students->appends(Request::all())->links() }}
    </div>
    <br>
@endsection
