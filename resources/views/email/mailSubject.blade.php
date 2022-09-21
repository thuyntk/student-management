<h1>[Notify]Mail for school</h1>
<h2>Register subject</h2>
<h3>The subjects you have not registered yet</h3>
<ul>
    @foreach ($subjectsNotYet as $item)
    <li>{{$item->name}}</li>
    @endforeach
</ul>