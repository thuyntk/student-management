<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Repositories\Student\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentsRepo;
    public function __construct(StudentRepository $studentsRepo)
    {
        $this->studentsRepo = $studentsRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentsRepo = $this->studentsRepo->getLatestRecord()->paginate(20);
        return view('backend.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = new Student();
        return view('backend.students.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
