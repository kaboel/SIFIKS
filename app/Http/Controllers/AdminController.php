<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('adm-home');
    }

//    public function index() {
//        return view('pages.dashboard');
//    }


    public function article() {
        $articles = Articles::all();
        $data = [
            'articles' => $articles
        ];
        return view('pages.article')->with('data', $data);
    }

    //CRUD
    public function store(){

    }

    public function create(){
        //CRUD
        $data = [
            'role' => session('role')
        ];
        return view ('pages.ext.add-admin')->with('data',$data);
    }

    //CRUD

    public function thread() {
        return view('pages.thread');
    }

    public function admin() {
        return view('pages.admin');
    }

    public function doctor() {
        return view('pages.doctor');
    }

    public function member() {
        return view('pages.member');
    }

    public function hospital() {
        return view('pages.hospital');
    }
}
