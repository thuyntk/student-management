@extends('layout.master')
@section('title', $faculty->id ? 'Edit Faculty' : 'Create Faculty')
@section('content-title', $faculty->id ? 'Edit Faculty' : 'Create Faculty')
@section('content')
@if ($faculty->id)
{!! Form::model($faculty, ['method' => 'PUT', 'route' => ['faculties.update', $faculty]])!!}
@else
{!! Form::model($faculty, ['method' => 'POST', 'route' => ['faculties.store']]) !!}
@endif
<div class="form-group">
    {!! Form::label('name', 'Faculty Name') !!}
    {!! Form::text('name', $faculty->name, ['class' => 'form-control']) !!}
</div>
<div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection