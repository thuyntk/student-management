@extends('layouts.app')
@extends('layouts.sidebar')
@section('title',  $subject->id ? 'Edit Subject' : 'Create Subject')
@section('content-title', $subject->id ? 'Edit Subject' :'Create Subject')
@section('content')
@if ($subject->id)
    {!! Form::model($subject, ['method' => 'PUT', 'route' => ['subjects.update', $subject->id]]) !!}
@else
    {!! Form::model($subject, ['method' => 'POST', 'route' => ['subjects.store']]) !!}
@endif
<div class="form-group">
    {!! Form::label('name', 'Subject Name') !!}
    {!! Form::text('name',$subject->name , ['class' => 'form-control']) !!}
</div>
<div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection