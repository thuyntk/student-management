<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Mail\SendMail;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Faculties\FacultyRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    protected $studentsRepo;
    protected $facultiesRepo;
    protected $subjectsRepo;
    protected $usersRepo;
    public function __construct(StudentRepository $studentsRepo, FacultyRepository $facultiesRepo, SubjectRepository $subjectsRepo, UserRepository $usersRepo)
    {
        $this->studentsRepo = $studentsRepo;
        $this->facultiesRepo = $facultiesRepo;
        $this->subjectsRepo = $subjectsRepo;
        $this->usersRepo = $usersRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $students = $this->studentsRepo->getLatestRecord();
        $subjects = $this->subjectsRepo->count('*');
        return view('backend.students.index', compact('students', 'subjects'));
    }

    public function regSubject(Request $request)
    {
        $data = $request->regSubjects;

        if (Auth::check()) {

            $user = Auth::user();
            $student = $this->studentsRepo->whereByUserId($user->id);

            if ($data) {

                foreach ($data as $value) {
                    $student->subjects()->attach($student->id, ['subject_id' => $value]);
                }
                return redirect()->back();
            }
        }


        return redirect()->back();
    }

    public function search(Request $request)
    {
        $students = $this->studentsRepo->search($request->all());
        $subjects = $this->subjectsRepo->count('*');

        return view('backend.students.index', compact('students','subjects'))->with('i');
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
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('student');
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $fileHashName = $file->hashName();
            $filename = $request->name . '-' . $fileHashName;
            $data['avatar'] = $file->move('images/students', $filename);
        }
        $this->studentsRepo->create($data);
        $mail = new SendMail($user);
        Mail::to($request->email)->send($mail);

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

    // public function updatePoint($id, Request $request)
    // {
    //     $student = $this->studentsRepo->find($id);
    //     $subjects = $student->subjects;
  
    //     return view('backend.students.add-point', compact('student', 'subjects'));
    // }

    // public function savePoint(Request $request, $id)
    // {
    //     $subject = $this->subjectsRepo->find($id);
    //     $subject->update($request->all());

    //     return redirect()->route('updatePoint',$subject->id);
    // }

    public function addPoint($id)
    {
        $getSubjects = $this->subjectsRepo->getAll();
        $findStudentId = $this->studentsRepo->find($id);
        $getSubjectsById = $findStudentId->subjects;

        return view('backend.students.add-point', compact('getSubjects', 'findStudentId', 'getSubjectsById',));
    }

    public function savePoint(Request $request, $id)
    {
        $data = [];
        foreach ($request->subject_id as $item => $value) {
            array_push($data, [
                'subject_id' => $request->subject_id[$item],
                'point' => $request->point[$item],
            ]);
        }
        $point = [];
        foreach ($data as $key => $value) {
            $point[$value['subject_id']] = ['point' => $value['point']];
        }
        $this->studentsRepo->find($id)->subjects()->sync($point);

        return redirect()->route('students.index');
    }
}
