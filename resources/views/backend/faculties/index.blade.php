@extends('layouts.app')
@extends('layouts.sidebar')
@section('title','Manage Faculty')
@section('content-title','Manage Faculty')
@section('content')
<div>
    @can('update')
        <a href="{{ route('faculties.create') }}" class="btn btn-success">Create New</a>
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
            @foreach ($faculties as $faculty)
                <tr>
                    <td>{{ $faculty->id }}</td>
                    <td>{{ $faculty->name }}</td>
                    @can('update')
                    <td>
                        <a href="{{ route('faculties.edit', $faculty->id) }}"> 
                            <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        </a>
                      
                        <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure delete ?')">
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
        {{ $faculties->links() }}
    </div>
   <br>
@endsection
