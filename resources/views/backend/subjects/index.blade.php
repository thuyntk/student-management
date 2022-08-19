@extends('layout.master')
@section('title','Quản lý Subject')
@section('content-title','Quản lý Subject')
@section('content')
<div>
    <a href="{{route('subjects.create')}}" class="btn btn-warning">Tạo mới</a>
</div>
<div class="col-lg-12">
    @if (Session::has('flash_message'))
        <div class="alert alert-light">
            {!! Session::get('flash_message') !!}
        </div>
    @endif
</div>
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Hành động</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{$subject->id}}</td>
                    <td>{{$subject->name}}</td>
                    <td>
                        <a href="{{route('subjects.edit', $subject->id)}}"> 
                            <button class="btn btn-primary">Edit</button>
                        </a>
                      
                        <form action="{{route('subjects.destroy', $subject->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
    <div>
        {{$subjects->links()}}
    </div>
@endsection