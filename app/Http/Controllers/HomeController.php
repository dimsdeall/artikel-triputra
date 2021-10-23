<?php

namespace App\Http\Controllers;

use App\Models\Finish;
use App\Models\Greige;
use App\Models\Indigo;
use App\Models\Log;
use App\Models\Sacon;
use App\Models\User;
use App\Models\Warping;
use App\Models\Weaving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

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
    public function index(Request $request)
    {
        $datetime1 = date_create('2021-12-12');
        $datetime2 = date_create(date('Y-m-d'));
        $interval = date_diff($datetime1, $datetime2);
        $result = $interval->format('%R%a');
        
        if ($result > 0) {
            return view('errors.404');
        }

        $sacon      = Sacon::where('koreksi', '>', '1')->get();
        $warping    = Warping::where('koreksi', '>', '1')->get();
        $indigo     = Indigo::where('koreksi', '>', '1')->get();
        $weaving    = Weaving::where('koreksi', '>', '1')->get();
        $greige     = Greige::where('koreksi', '>', '1')->get();
        $finish     = Finish::where('koreksi', '>', '1')->get();
        $user       = User::get();

        // return Auth::user()->id;
        // return view('operator1', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));    

        if (Auth::user()->roles->first()->name == 'Admin') {
            return view('admin', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Sacon'){
            return view('operator1', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Warping & Indigo'){
            return view('operator1', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Weaving'){
            return view('operator1', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Greige'){
            return view('operator1', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Finish'){
            return view('operator1', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Admin Warping & Indigo'){
            return view('operator2', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Admin Weaving'){
            return view('operator2', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Admin Greige'){
            return view('operator2', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }elseif(Auth::user()->roles->first()->name == 'Admin Finish'){
            return view('operator2', compact('sacon', 'warping', 'indigo', 'weaving', 'greige', 'finish', 'user'));
        }else{
            return view('errors.404');
        }          

    }

    public function logadmin(){
        $log = Log::with('user')->get();

        return Datatables::of($log)
        ->editColumn('created_at', function($log){
            return date_format($log->created_at,'d-M-Y h:i:s');
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }

}
