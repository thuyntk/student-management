@extends('layout.master')
@section('title',  'Sửa Faculty')
@section('content-title', 'Sửa Faculty')
@section('content')
{!! Form::open(['method' => 'PUT', 'route' => ['faculties.update', $faculties->id]])!!}
<div class="form-group">
    {!! Form::label('name', 'Faculty Name') !!}
    {!! Form::text('name',$faculties->name, ['class' => 'form-control']) !!}
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
</div>
<div>
    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection