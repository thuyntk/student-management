<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Mail\SendMail;
use App\Models\Faculty;
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
use Spatie\Permission\Models\Role;

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
        return view('backend.students.index', compact('students'));
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
                    Session::flash('success', 'Successfully registered for the course');
                }
                return redirect()->back();
            }
        }

        Session::flash('error', 'This course is already registered');

        return redirect()->back();
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
    // public function regSubject($id)
    // {
    //     if (Auth::check()) {
    //         $user = Auth::user();
    //         $student = Student::where('user_id', $user->id)->first();
    //         $subject_student = $student->subjects()->get();

    //         foreach ($subject_student  as $value) {
    //             if ($id == $value->pivot->subject_id) {
    //                 Session::flash('error', 'This course is already registered');

    //                 return redirect()->back();
    //             }
    //         }

    //         $register = $student->subjects()->attach($student->id, ['subject_id' => $id]);
    //         Session::flash('success', 'Successfully registered for the course');

    //         return redirect()->back();
    //     }
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    // public function update_profile(Request $request, $id)
    // {
    //     dd($request);
    // }

}
