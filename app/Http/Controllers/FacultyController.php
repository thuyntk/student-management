<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Repositories\Faculty\FacultiesRepository;

class FacultyController extends Controller
{
   protected $facultiesRepo;
    public function __construct(FacultiesRepository $facultiesRepo)
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
        $faculties = $this->facultiesRepo->getLatestRecord()->paginate(15);
        return view('backend.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = new Faculty();
        return view('backend.faculties.create', compact('faculties'));
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
        $faculties = $this -> facultiesRepo->find($id);
        return view('backend.faculties.edit',compact('faculties'));
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
        $faculties = $this ->facultiesRepo->find($id);
        $faculties->update($request->all());
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
        $faculties =$this->facultiesRepo->find($id);
        $faculties->delete();
        return redirect()->route('faculties.index')->with(['flash_message' => 'Delete successfully!']);
    }
}
