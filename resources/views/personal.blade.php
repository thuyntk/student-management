@extends('layouts.app')
@extends('layouts.sidebar')
@section('title','Personal')
@section('content-title','Personal')
@section('content')
<div class="row">
    <div class="col-sm-4">
        <img src="{{asset( Auth::user()->avatar )}}" class="img-circle elevation-2" alt="User Image">
        <div>
            <a href=""><i class="bi bi-camera"></i></a>
        </div>  
        <div class="kt-widget__info">
            <span class="kt-widget__label">Name:</span>
            <a href="#" class="kt-widget__data" style="text-decoration: none; color:black">{{ Auth::user()->name }}</a>
        </div>
        <div class="kt-widget__info">
            <span class="kt-widget__label">Email:</span>
            <a href="#" class="kt-widget__data" style="text-decoration: none; color:black">{{ Auth::user()->email }}</a>
        </div>
        <div class="kt-widget__info">
            <span class="kt-widget__label">Phone:</span>
            <a href="#" class="kt-widget__data" style="text-decoration: none; color:black">{{ Auth::user()->phone }}</a>
        </div>
    </div>
    <div class="col-sm-8">
        <h3>Personal information</h3>
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Name:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="{{ Auth::user()->name }}" readonly="readonly" class="form-control">
            </div>
         </div>
         <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Email:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="{{ Auth::user()->email }}" readonly="readonly" class="form-control">
            </div>
         </div>
         <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Phone:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="{{ Auth::user()->phone }}" readonly="readonly" class="form-control">
            </div>
         </div><div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Gender:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="{{ Auth::user()->gender }}" readonly="readonly" class="form-control">
            </div>
         </div><div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Address:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="{{ Auth::user()->address }}" readonly="readonly" class="form-control">
            </div>
         </div><div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Birthday:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="{{ Auth::user()->birthday }}" readonly="readonly" class="form-control">
            </div>
         </div>       
    </div>
</div>
@endsection