<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\SubjectRequest;
use App\Imports\StudentsImport;
use App\Jobs\SendMailSubject;
use App\Jobs\SendMailSubjectsJob;
use App\Mail\SendMailSubject as MailSendMailSubject;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Matcher\Subset;

class SubjectController extends Controller
{
    protected $subjectsRepo;
    protected $studentsRepo;
    public function __construct(SubjectRepository $subjectsRepo, StudentRepository $studentsRepo)
    {
        $this->subjectsRepo = $subjectsRepo;
        $this->studentsRepo = $studentsRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('student')) {

                $student = Student::where('user_id', $user->id)->first();

                if ($student) {
                    $studentSubjects = $student->subjects;
                }
            } else {
                $studentSubjects = '';
            }
        }
        $subjects = $this->subjectsRepo->getLatestRecord();

        return view('backend.subjects.index', compact('subjects', 'studentSubjects'));
    }

    public function show($id)
    {
        $subject = $this->subjectsRepo->find($id);
        return view('backend.subjects.student_subject', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = $this->subjectsRepo->newModel();
        return view('backend.subjects.create', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $this->subjectsRepo->create($request->all());

        return redirect()->route('subjects.index')->with(['flash_message' => 'Create successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->subjectsRepo->find($id);
        return view('backend.subjects.create', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, $id)
    {
        $subject = $this->subjectsRepo->find($id);
        $subject->update($request->all());

        return redirect()->route('subjects.index')->with(['flash_message' => 'Update successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = $this->subjectsRepo->find($id);
        if ($subject->students()->count('*')) {
            Session::flash('error', 'Cannot Delete Subjects Successful');
        }
        $this->subjectsRepo->delete($id);
        return redirect()->route('subjects.index')->with(['flash_message' => 'Delete successfully!']);
    }

    public function mail($id)
    {
        $subjects = $this->subjectsRepo->getAll();
        $student = $this->studentsRepo->find($id);
        $subject = $student->subjects;
        $listSubject = [];
        if ($subject->count() == 0) {
            $listSubject = $subjects;
        } else {
            foreach ($subjects as $value) {
                for ($i = 0; $i < $subject->count(); $i++) {
                    if ($value->id == $subject[$i]->id) {
                        break;
                    } elseif ($i == $subject->count() - 1) {
                        $listSubject[] = $value;
                    }
                }
            }
        }
        $sendMail = new MailSendMailSubject($listSubject);
        Mail::to($student->email)->queue($sendMail);
        return redirect()->back();
    }

    public function export($id) 
    {
        return Excel::download(new StudentsExport($id), 'StudentsPoin.xlsx');
    }

    public function import(ImportRequest $request, $id)
    {
        $subject = $this->subjectsRepo->relationship(['students'])->find($id);
        $fileImport = Excel::toCollection(new StudentsImport($id), request()->file('import_file'));
        foreach ($fileImport[0] as $import) {
            foreach ($subject->students as $student) {
                if ($import['id'] == $student['id']) {
                    $student->pivot->where('student_id', '=', $student['id'])->where('subject_id', $id)->update([
                        'point' => $import['point'],
                    ]);
                }
            }
        }
        Session::flash('success', 'Subject Imported Successfully');
        return redirect()->back();
    }
}
