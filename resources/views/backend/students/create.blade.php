@extends('layouts.app')
@extends('layouts.sidebar')
@section('title', $students->id ? 'Edit Student' :  'Create Student')
@section('content-title', $students->id ? 'Edit Student' : 'Create Student')
@section('content')
@if ( $students->id)
{!! Form::model($students, ['method' => 'PUT', 'route' => ['students.update', $students->id]])!!}
@else
{!! Form::model($students, ['method' => 'POST', 'route' => ['students.store']]) !!}
@endif
<div class="form-group">
    {!! Form::label('name', 'Student Name') !!}
    {!! Form::text('name', $students->name, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', $students->email), ['class' => 'form-control'] !!}
</div>

<div class="form-group">
    {!! Form::label('phone', 'Phone') !!}
    {!! Form::text('phone', $students->phone, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('avata', 'Avatar') !!}
 
</div>

<div class="form-group">
    {!! Form::label('gender', 'Gender') !!}
    {!! Form::text('gender', $students->gender, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', 'Address') !!}
    {!! Form::text('address', $students->address, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('birthday', 'Birthday') !!}
    {!! Form::text('birthday', $students->birthday, ['class' => 'form-control']) !!}
</div>

<div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection