@extends('layout.master')
@section('title','Manage Faculty')
@section('content-title','Manage Faculty')
@section('content')
<div>
    <a href="{{ route('faculties.create') }}" class="btn btn-success">Create New</a>
</div>
<br>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Act</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($faculties as $faculty)
                <tr>
                    <td>{{ $faculty->id }}</td>
                    <td>{{ $faculty->name }}</td>
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
                </tr>    
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $faculties->links() }}
    </div>
   <br>
@endsection
