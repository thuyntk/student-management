@extends('layouts.app')
@extends('layouts.sidebar')
@section('title','Manage Student')
@section('content-title','Manage Student')
@section('content')
<div>
    <a href="{{route('students.create')}}" class="btn btn-success">Create New</a>
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
                <td>Hành động</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->phone}}</td>
                    <td><img src="{{ asset( $student->avatar )}}" alt="" width="100px"></td>
                    <td>{{$student->gender == 1 ? 'Nam' : 'Nữ'}}</td>
                    <td>{{$student->address}}</td>
                    <td>{{$student->birthday}}</td>
                    <td>
                        <a href="{{route('students.edit', $student->id)}}"> 
                            <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        </a>
                        <form action="{{route('students.destroy', $student->id)}}" method="POST" style="display:inline">
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
        {{$students->links()}}
    </div>
   <br>
@endsection
