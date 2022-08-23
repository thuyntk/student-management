@extends('layout.master')
@section('title',  $subjects->id ? 'Edit Subject' : 'Create Subject')
@section('content-title', $subjects->id ? 'Edit Subject' :'Create Subject')
@section('content')
@if ($subjects->id)
    {!! Form::model($subjects, ['method' => 'PUT', 'route' => ['subjects.update', $subjects->id]]) !!}
@else
    {!! Form::model($subjects, ['method' => 'POST', 'route' => ['subjects.store']]) !!}
@endif
<div class="form-group">
    {!! Form::label('name', 'Subject Name') !!}
    {!! Form::text('name',$subjects->name , ['class' => 'form-control']) !!}
</div>
<div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection