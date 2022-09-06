<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Faculty;
use App\Models\Student;
use App\Repositories\Faculties\FacultyRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use Illuminate\Http\Request;

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
        $students = $this->studentsRepo->getLatestRecord()->paginate(15);
        return view('backend.students.index', compact('students'));
    }

    public function search(Request $request)
    {
        $students = $this->studentsRepo->search($request->all());

        return view('backend.students.index', compact('students'))->with('i');
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
        return view('backend.students.create', compact('student', 'faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $fileHashName = $file->hashName();
            $filename = $request->name . '-' . $fileHashName;
            $data['avatar'] = $file->move('images/students', $filename);
        }

        $this->studentsRepo->create($data);
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
        return view('backend.students.create', compact('student', 'faculty'));
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
        $data = $this->studentsRepo->find($id);
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $fileHashName = $file->hashName();
            $filename = $request->name . '-' . $fileHashName;
            $data['avatar'] = $file->move('images/students', $filename);
        }

        $this->studentsRepo->update($id, $data);
        return redirect()->route('students.index')->with(['flash_message' => 'Update successfully!']);
    }

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
