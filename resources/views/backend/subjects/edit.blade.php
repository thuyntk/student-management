@extends('layout.master')
@section('title', 'Sửa Subject')
@section('content-title','Sửa Subject')
@section('content')
{!! Form::model($subjects, ['method' => 'PUT', 'route' => ['subjects.update', $subjects->id]]) !!}
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
{!! Form::close() !!}
@endsection