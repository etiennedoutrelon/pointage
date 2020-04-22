<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employes = DB::Table('users')
            ->select('*')
            ->where('type','=','default')
            ->get();
        return view('employes.index',['employes' => $employes]);
    }
}
