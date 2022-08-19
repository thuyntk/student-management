@extends('layout.master')
@section('title','Quản lý Faculty')
@section('content-title','Quản lý Faculty')
@section('content')
<div>
    <a href="{{route('faculties.create')}}" class="btn btn-warning">Tạo mới</a>
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
            @foreach ($faculties as $faculty)
                <tr>
                    <td>{{$faculty->id}}</td>
                    <td>{{$faculty->name}}</td>
                    <td>
                        <a href="{{route('faculties.edit', $faculty->id)}}"> 
                            <button class="btn btn-primary">Edit</button>
                        </a>
                      
                        <form action="{{route('faculties.destroy', $faculty->id)}}" method="POST">
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
        {{$faculties->links()}}
    </div>
   
@endsection
