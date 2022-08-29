@extends('layouts.app')
@extends('layouts.sidebar')
@section('title','Manage Subject')
@section('content-title','Manage Subject')
@section('content')
<div>
    @can('update')
        <a href="{{route('subjects.create')}}" class="btn btn-success">Create New</a>
    @endcan
</div>
<br>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                @can('update')
                <td>Act</td>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{$subject->id}}</td>
                    <td>{{$subject->name}}</td>
                    @can('update')
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
                    @endcan
                </tr>    
            @endforeach
        </tbody>
    </table>
    <div>
        {{$subjects->links()}}
    </div>
    <br>
@endsection