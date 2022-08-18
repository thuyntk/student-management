@extends('layout.master')
@section('title', 'Tạo Faculty')
@section('content-title','Tạo Faculty')
@section('content')
{!! Form::open(['method' => 'POST', 'route' => ['faculties.store']])!!}
<div class="form-group">
    {!! Form::label('name', 'Faculty Name') !!}
    {!! Form::text('name', ['class' => 'form-control']) !!}
</div>
<div>
    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection