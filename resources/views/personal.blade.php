@extends('layouts.app')
@extends('layouts.sidebar')
@section('title','Personal')
@section('content-title','Personal')
@section('content')
<div class="row">
    <div class="col-sm-4">
        <img src="{{asset('dist/img/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        <div class="kt-widget__info">
            <span class="kt-widget__label">Name:</span>
            <a href="#" class="kt-widget__data" style="text-decoration: none; color:black">Nguyễn Thị Kim Thúy</a>
        </div>
        <div class="kt-widget__info">
            <span class="kt-widget__label">Email:</span>
            <a href="#" class="kt-widget__data" style="text-decoration: none; color:black">student@gmail.com</a>
        </div>
        <div class="kt-widget__info">
            <span class="kt-widget__label">Phone:</span>
            <a href="#" class="kt-widget__data" style="text-decoration: none; color:black">0134324241</a>
        </div>
    </div>
    <div class="col-sm-8">
        <h3>Personal information</h3>
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Name:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="Nguyễn Thị Kim Thúy" readonly="readonly" class="form-control">
            </div>
         </div>
         <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Email:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="student@gmail.com" readonly="readonly" class="form-control">
            </div>
         </div>
         <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Phone:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="0134324241" readonly="readonly" class="form-control">
            </div>
         </div><div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Gender:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="Nữ" readonly="readonly" class="form-control">
            </div>
         </div><div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Address:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="thôn trung kiên, xã Hải Lưu, huyện Sông Lô, tỉnh Vĩnh Phúc" readonly="readonly" class="form-control">
            </div>
         </div><div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label" for="">Birthday:</label>
            <div class="col-lg-9 col-xl-6">
                <input type="text" value="19-11-2002" readonly="readonly" class="form-control">
            </div>
         </div>
    </div>
</div>
@endsection