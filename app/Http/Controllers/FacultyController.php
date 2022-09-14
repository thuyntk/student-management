<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Repositories\Faculties\FacultyRepository;

class FacultyController extends Controller
{
    protected $facultiesRepo;

    public function __construct(FacultyRepository $facultiesRepo)
    {
        $this->facultiesRepo = $facultiesRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = $this->facultiesRepo->getLatestRecord();

        return view('backend.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculty = $this->facultiesRepo->newModel();
        return view('backend.faculties.create', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRequest $request)
    {
        $this->facultiesRepo->create($request->all());
        return redirect()->route('faculties.index')->with(['flash_message' => 'Create successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = $this->facultiesRepo->find($id);
        return view('backend.faculties.create', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyRequest $request, $id)
    {
        $faculty = $this->facultiesRepo->find($id);
        $faculty->update($request->all());

        return redirect()->route('faculties.index')->with(['flash_message' => 'Update successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty =$this->facultiesRepo->find($id);
        $faculty->delete();
        return redirect()->route('faculties.index')->with(['flash_message' => 'Delete successfully!']);
    }
}
