@extends('layouts.app')
@extends('layouts.sidebar')
@section('title', $student->id ? 'Edit Student' :  'Create Student')
@section('content-title', $student->id ? 'Edit Student' : 'Create Student')
@section('content')
@if ( $student->id)
{!! Form::model($student, ['method' => 'PUT', 'route' => ['students.update', $student->id]])!!}
@else
{!! Form::model($student, ['method' => 'POST', 'route' => ['students.store']]) !!}
@endif
<div class="form-group">
    {!! Form::label('name', 'Student Name') !!}
    {!! Form::text('name', $student->name, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', $student->email), ['class' => 'form-control'] !!}
</div>

<div class="form-group">
    {!! Form::label('phone', 'Phone') !!}
    {!! Form::text('phone', $student->phone, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('avata', 'Avatar') !!}
 
</div>

<div class="form-group">
    {!! Form::label('gender', 'Gender') !!}
    {!! Form::text('gender', $student->gender, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', 'Address') !!}
    {!! Form::text('address', $student->address, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('birthday', 'Birthday') !!}
    {!! Form::text('birthday', $student->birthday, ['class' => 'form-control']) !!}
</div>

<div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection