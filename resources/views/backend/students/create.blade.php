@extends('layouts.app')
@extends('layouts.sidebar')
@section('title', $student->id ? 'Edit Student' :  'Create Student')
@section('content-title', $student->id ? 'Edit Student' : 'Create Student')
@section('content')
@if ( $student->id)
{!! Form::model($student, ['method' => 'PUT', 'route' => ['students.update', $student->id], 'enctype' => 'multipart/form-data'])!!}
@else
{!! Form::model($student, ['method' => 'POST', 'route' => ['students.store'], 'enctype' => 'multipart/form-data']) !!}
@endif
<div class="form-group">
    {!! Form::label('name', 'Student Name') !!}
    {!! Form::text('name', $student->name, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    @if ($student->id)
    {!! Form::email('email', $student->email, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
    @else
    {!! Form::email('email', $student->email, ['class' => 'form-control']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('phone', 'Phone') !!}
    {!! Form::text('phone', $student->phone, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('avata', 'Avatar') !!}
    {!! Form::file('avatar',['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('gender', 'Gender') !!}
    <div class="form-check">
        {!! Form::radio('gender', '1', true) !!}
        <label class="form-check-label" for="exampleRadios1">
            Nam
        </label>
    </div>
    <div class="form-check">
        {!! Form::radio('gender', '0', true) !!}
        <label class="form-check-label" for="exampleRadios2">
            Nữ
        </label>
    </div>
</div>

<div class="form-group">
    {!! Form::label('address', 'Address') !!}
    {!! Form::text('address', $student->address, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('birthday', 'Birthday') !!}
    {!! Form::text('birthday', $student->birthday, ['class' => 'form-control']) !!}
</div>

<div class='form-group'>
    {!! Form::label('faculty', 'Faculty') !!}
    {!! Form::select('faculty_id', $faculty, null, ['class' => 'form-control', 'placeholder' => 'Choose a faculty.']) !!}
</div>

<div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}
@endsection