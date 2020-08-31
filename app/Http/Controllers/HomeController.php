<?php

namespace App\Http\Controllers;
use App\Siswa;
use Illuminate\Http\Request;
use DB;


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
    public function index()
    {
        return view('survey');
    }

    public function tambah(){
        return view('tambahsurvey');
    }

    public function inputdata(Request $request){
        $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|max:255',
            'number' => 'required|max:20',
            'jurusan' => 'required',
            'gender' => 'required',
            'hoby' => 'required|min:2',
            'alamat' => 'required'
        ]);


        DB::table('siswa')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'jurusan' => $request->jurusan,
            'gender' => $request->gender,
            'hoby' => $request->hoby,
            'alamat' => $request->alamat

        ]);
        return redirect('survey');
    }
}
