@extends('layouts.app')
@extends('layouts.sidebar')
@section('title', 'Add point')
@section('content')
    
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4>ADD POINT</h4>
            </div>
            <div class="col-md-6">
                <a href="{{route('students.index')}}" class="btn btn-primary float-end">Back</a>
                {!! Form::button('Add Subject', ['class'=>['btn2','btn btn-success float-end'],'style'=>'margin-right: 10px']) !!}

                <p id="count-subject" hidden>{{count($getSubjects)}} </p>
            </div>
        </div>
    </div>
</div>

<div class="card-body">
    {{Form::open(['route'=>['students.savePoint',$findStudentId->id], 'method'=>'POST','enctype' => "multipart/form-data" ])}}
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="text-align: center">Subject</th>
            <th style="text-align: center">Point</th>
            <th style="text-align: center">#</th>
        </tr>
        </thead>

        <tbody id="formadd">
        @foreach($getSubjectsById as $subject)
            <tr>
                <td>
                    {!! Form::select('subject_id[]', [$subject->id => $subject->name], null, ['class'=>'form-select']) !!}
                </td>
                <td>
                    {!! Form::text('point[]', $subject->pivot->point, ['class' => 'form-control']) !!}
                </td>
                <td>
                    {!! Form::button('DELETE', ['class'=>['delete','btn btn-danger']]) !!}
                </td>
            </tr>
        @endforeach
        <tr class= "addform" style="display: none">
            <td>
                {!! Form::select('subject_id[]' , $getSubjects->pluck('name','id'),null, ['class'=>'form-select']) !!}
            </td>
            <td>
                {!! Form::text('point[]','0', ['class' => 'form-control']) !!}
            </td>
            <td>
                {!! Form::button('DELETE', ['class'=>['delete','btn btn-danger']]) !!}
            </td>
        </tr>
        </tbody>
    </table>
    {!! Form::submit('Submit', ['class' => 'btn btn-info','id'=>'saveform']) !!}
    {!! Form::close() !!}
</div>
<script>
    $(document).ready(function () {
    form = $('tr.addform').html();
    $(".btn2").click(function () {
        var len = $('tbody#formadd tr').length;
        var subject = $('p#count-subject').html();
        if (len - 1 < subject) {
            $("tbody").append('<tr>' + form + '</tr>');
        } else {
            alert('End of course')
        }
    });
    $(document).on('click', '.delete', function () {
        $(this).parent().parent().remove();
        var $select = $("select");
        var selected = [];
        $.each($select, function (index, select) {
            if (select.value !== "") {
                selected.push(select.value).hide();
            }
        });
    });
    $('#saveform').on('click', function () {
        $('tr.addform').remove();
    });
    $(document).on('click', 'select', function () {
        var $select = $("select");
        var selected = [];
        $.each($select, function (index, select) {
            if (select.value !== "") {
                selected.push(select.value);
            }
        });
        $('select > option').not(this).css('display', 'block');
        $("option").prop("disabled", false);
        for (var index in selected) {
            $('option[value="' + selected[index] + '"]').css("display", "none");
        }
        $(this).parent().parent().find('td > i.remove-item').on('click', function () {
            var del = $(this).val();
            selected.splice(selected.indexOf(del.toString()), 1);
            for (var index in selected) {
                $('option[value="' + selected[index] + '"]').css("display", "block");
            }
        });
    });
});
</script>
@endsection
