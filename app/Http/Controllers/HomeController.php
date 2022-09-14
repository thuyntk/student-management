<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Students\StudentRepositoryInterface;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\This;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()

    // {
    //     // $ro = Role::findById(2);
    //     $u = User::find(1);
    //     $u->assignRole('teacher');
    //     return view('home');
    // }
    public function index()
    {
        return view('home');
        if (Auth::check()) {
            $student = $this->studentRepo->whereByUserId(Auth::id());
            if ($student) {
                return view('personal', compact('student'));
            }
        }
    }
    public function updateStudent(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $destination_path = 'public/images/students/';
            $avatar = $request->file('avatar');
            $avatar_name = $avatar->getClientOriginalName();
            $path = $request->file('avatar')->storeAs($destination_path, $avatar_name);
            $data['avatar'] = $avatar_name;
        }

        $this->studentRepo->update($id,$data);
        Session::flash('success', 'Updated successfully.');

        return redirect()->back();
    }
}
