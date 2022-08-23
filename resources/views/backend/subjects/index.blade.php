@extends('layout.master')
@section('title','Manage Subject')
@section('content-title','Manage Subject')
@section('content')
<div>
    <a href="{{route('subjects.create')}}" class="btn btn-success">Create New</a>
</div>
<br>
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Act</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{$subject->id}}</td>
                    <td>{{$subject->name}}</td>
                    <td>
                        <a href="{{route('subjects.edit', $subject->id)}}"> 
                            <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        </a>
                      
                        <form action="{{route('subjects.destroy', $subject->id)}}" method="POST" style="display:inline">
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
        {{$subjects->links()}}
    </div>
    <br>
@endsection