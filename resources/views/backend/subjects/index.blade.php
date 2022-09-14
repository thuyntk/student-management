@extends('layouts.app')
@extends('layouts.sidebar')
@section('title', 'Manage Subject')
@section('content-title', 'Manage Subject')
@section('content')
    <div>
        @can('update')
            <a href="{{ route('subjects.create') }}" class="btn btn-success">Create New</a>
        @endcan
    </div>
    <br>
    <form action="{{ route('registerSubject') }}" method="POST">
        @csrf
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    @can('update')
                        <td>Act</td>
                    @endcan
                    @cannot('update')
                        <td>Point</td>
                        <td>Status</td>
                        <td>Act</td>
                    @endcannot
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        @can('update')
                            <td>
                                <a href="{{ route('subjects.edit', $subject->id) }}">
                                    <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                                </a>

                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline"
                                    onsubmit="return confirm('Are you sure delete ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        @endcan
                        @cannot('update')
                            @if ($studentSubjects->isEmpty())
                                <td>Null</td>
                                <td><span class="text-danger">Haven't studied yet</span></td>
                                <td><input type="checkbox" name="regSubjects[]" value="{{ $subject->id }}"></td>
                                </td>
                            @else
                                @for ($i = 0; $i < $studentSubjects->count(); $i++)
                                    @if ($subject->id == $studentSubjects[$i]->id)
                                        @if ($studentSubjects[$i]->pivot->point == null)
                                            <td>Null</td>
                                            <td><span class="text-success">Studying</span> </td>
                                            <td><input type="checkbox" name="" id="" checked disabled></td>
                                        @else
                                            <td>{{ $studentSubjects[$i]->pivot->point }}</td>
                                            <td><span class="text-primary">Learned</span></td>
                                            <td><input type="checkbox" name="" id="" checked disabled></td>
                                        @endif
                                    @break

                                @elseif($i == $studentSubjects->count() - 1)
                                    @if ($subject->id !== $studentSubjects[$i]->id)
                                        <td>Null</td>
                                        <td> <span class="text-danger">Haven't studied yet</span></td>
                                        <td><input type="checkbox" name="regSubjects[]" value="{{ $subject->id }}"></td>
                                    @endif
                                @endif
                            @endfor
                        @endif
                    @endcannot
                </tr>
            @endforeach
        </tbody>
    </table>
    @cannot('update')
        <div>
            <button class="btn btn-primary" id="register-all">Register</button>
        </div>
    @endcannot
</form>
<div>
    {{ $subjects->links() }}
</div>
<br>
@endsection
