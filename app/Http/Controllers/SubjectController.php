<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Repositories\Subject\SubjectsRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjectsRepo;
    public function __construct(SubjectsRepository $subjectsRepo)
    {
        $this->subjectsRepo = $subjectsRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = $this->subjectsRepo->getLatestRecord()->paginate(15);
        return view('backend.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = new Subject();
        return view('backend.subjects.create', compact('subjects'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects = $this->subjectsRepo->find($id);
        return view('backend.subjects.edit', compact('subjects'));
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
        $subjects = $this->subjectsRepo->find($id);
        $subjects->update($request->all());
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
        $subjects = $this->subjectsRepo->find($id);
        $subjects->delete();
        return redirect()->route('subjects.index')->with(['flash_message' => 'Delete successfully!']);
    }
}
