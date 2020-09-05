<?php

namespace App\Http\Controllers;
use App\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;


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
        $siswa = User::where('id', Auth::user()->id)->first();

        // $siswa = Siswa::with('user')->get();
        // dd($siswa);
        return view('welcome', compact('siswa'));
    }

    public function tambah(){
        return view('tambahsurvey');
    }

    public function inputdata(Request $request){

        $tanggal = Carbon::now();
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
            'alamat' => $request->alamat,
            'tanggal' => $tanggal,
            'id_data' => $request->id_data

        ]);
        return redirect('survey');
    }
    public function tampil(){
        // $siswa = DB::table('siswa')->get();
        $siswa = Siswa::with('user')->get();
        // dd($siswa);
        return view('survey', compact('siswa'));
    }

    public function palindrome(){
        return view ('palindrome');
    }
}
