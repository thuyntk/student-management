@extends('layouts.app')
@extends('layouts.sidebar')
@section('title', $student->id ? 'Edit Student' : 'Create Student')
@section('content-title', $student->id ? 'Edit Student' : 'Create Student')
@section('content')
    @if ($student->id)
        {!! Form::model($student, ['method' => 'PUT', 'route' => ['students.update', $student->id], 'enctype' => 'multipart/form-data', ]) !!}
    @else
        {!! Form::model($student, ['method' => 'POST', 'route' => ['students.store'], 'enctype' => 'multipart/form-data',]) !!}
    @endif
    <div class="form-group">
        {!! Form::label('name', 'Student Name') !!}
        {!! Form::text('name', $student->name, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Student Email') !!}
        @if ($student->id)
            {!! Form::email('email', $student->email, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        @else
            {!! Form::email('email', $student->email, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('phone', 'Student Phone') !!}
        {!! Form::text('phone', $student->phone, ['class' => 'form-control', 'placeholder' => 'Phone']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('avatar', 'Student Avatar') !!}
        {!! Form::file('avatar', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('gender', 'Student Gender') !!}
        <div class="form-check">
            {!! Form::radio('gender', '1', true) !!}
            {!! Form::label('exampleRadios1', 'Nam', ['class' => 'form-check-label']) !!}
        </div>
        <div class="form-check">
            {!! Form::radio('gender', '0', true) !!}
            {!! Form::label('exampleRadios2', 'Nữ', ['class' => 'form-check-label']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('address', 'Student Address') !!}
        {!! Form::text('address', $student->address, ['class' => 'form-control', 'placeholder' => 'Address']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('birthday', 'Student Birthday') !!}
        {!! Form::date('birthday', $student->birthday, ['class' => 'form-control', 'placeholder' => 'Birthday']) !!}
    </div>

    <div class='form-group'>
        {!! Form::label('faculty', 'Student Faculty') !!}
        {!! Form::select('faculty_id', $faculty, null, [
            'class' => 'form-control',
            'placeholder' => 'Choose a faculty.',
        ]) !!}
    </div>

   <div>
        {!! Form::hidden('password', '1') !!}
   </div>

    <div>
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
    </div>
    {!! Form::close() !!}
@endsection
