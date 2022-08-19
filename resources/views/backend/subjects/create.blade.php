@extends('layout.master')
@section('title',  isset($subject) ? 'Update Subject' : 'Create Subject')
@section('content-title', isset($subjects) ? 'Sửa Subject' :'Tạo Subject')
@section('content')
{!! Form::model($subjects, ['method' => 'POST', 'route' => ['subjects.store']]) !!}
<div class="form-group">
    {!! Form::label('name', 'Subject Name') !!}
    {!! Form::text('name','', ['class' => 'form-control']) !!}
    @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
</div>
<div>
    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
</div>
{!! Form::close() !!}


{{-- {!! Form::model($subjects, ['method' => 'PUT', 'route' => ['subjects.update', $subjects->id]]) !!}
<div class="form-group">
    {!! Form::label('name', 'Subject Name') !!}
    {!! Form::text('name',$subjects->name, ['class' => 'form-control']) !!}
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
{!! Form::close() !!} --}}
@endsection