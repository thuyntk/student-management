<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Faculty;
use App\Models\Student;
use App\Repositories\Faculties\FacultyRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    protected $studentsRepo;
    protected $facultiesRepo;
    protected $subjectsRepo;
    public function __construct(StudentRepository $studentsRepo, FacultyRepository $facultiesRepo, SubjectRepository $subjectsRepo)
    {
        $this->studentsRepo = $studentsRepo;
        $this->facultiesRepo = $facultiesRepo;
        $this->subjectsRepo = $subjectsRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->studentsRepo->getLatestRecord()->paginate(20);
        $faculties = $this->facultiesRepo->getAll()->pluck('name', 'id');
        return view('backend.students.index', compact('students','faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = $this->studentsRepo->newStudent();
        $faculty = $this->facultiesRepo->getAll()->pluck('name', 'id');
        return view('backend.students.create', compact('student','faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        if ($request->hasFile('avatar'))
        {
           $file = $request->file('avatar');
           $extention = $file->getClientOriginalExtension();
           $filename = time().'.'.$extention;
           $file->move('public/storage/images/students/', $filename);
        }
        $this->studentsRepo->create($request->all());
        return redirect()->route('students.index')->with(['flash_message' => 'Create successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentsRepo->find($id);
        $faculty = $this->facultiesRepo->getAll()->pluck('name', 'id');
        return view('backend.students.create', compact('student','faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $student = $this->studentsRepo->find($id);
        $student->update($request->all());
        if ($request->hasFile('avatar')) {
            $destination_path = 'public/images/students/';
            $avatar = $request->file('avatar');
            $avatar_name = $avatar->getClientOriginalName();
            $path = $request->file('avatar')->storeAs($destination_path, $avatar_name);
            $data['avatar'] = $avatar_name;
        }
        return redirect()->route('students.index')->with(['flash_message' => 'Update successfully!']);    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students = $this->studentsRepo->find($id);
        $students->delete();
        return redirect()->route('students.index')->with(['flash_message' => 'Delete successfully!']);
    }
}
