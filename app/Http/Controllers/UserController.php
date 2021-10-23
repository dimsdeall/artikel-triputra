<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Sacon;
use App\Models\Warping;
use App\Models\Indigo;
use App\Models\Weaving;
use App\Models\Greige;
use App\Models\Finish;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = Role::all();

        return view('admin.manage.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();

        return view('admin.manage.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = User::where('username', $request->user_username)->get();
        if ($validate->count() > 0) {
            return 'ada';
        }
     
        $role = Role::find($request->user_role);

        $create_user = new User();
        $create_user->name      = $request->user_nama;
        $create_user->username  = $request->user_username;
        $create_user->email     = '-';
        $create_user->password  = bcrypt($request->user_password);
        $create_user->save();
        $create_user->roles()->attach($role);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->user_username;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Buat User';
        $create_logs->save();

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $validate = User::where('username', $request->user_edit_username)->whereNotIn('id', [$id])->get();
        if ($validate->count() > 0 ) {
            return 'ada';
        }

        $role = Role::find($request->user_edit_role);

        $update_user            = User::find($id);
        $update_user->name      = $request->user_edit_nama;
        $update_user->username  = $request->user_edit_username;
        $update_user->email     = '-';

        if($request->password != ''){
            $update_user->password  = bcrypt($request->user_edit_password);
        }
        
        $update_user->save();
        $update_user->roles()->attach($role);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->user_edit_username;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Edit User';
        $create_logs->save();

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $validate_sacon = Sacon::where('user_id', $id)->get();
        if ($validate_sacon->count() > 0) return 'User di gunakan sacon';

        $validate_warping = Warping::where('user_id', $id)->get();
        if ($validate_warping->count() > 0) return 'User di gunakan warping';

        $validate_indigo = Indigo::where('user_id', $id)->get();
        if ($validate_indigo->count() > 0) return 'User di gunakan indigo';

        $validate_weaving = Weaving::where('user_id', $id)->get();
        if ($validate_weaving->count() > 0) return 'User di gunakan weaving';

        $validate_greige = Greige::where('user_id', $id)->get();
        if ($validate_greige->count() > 0) return 'User di gunakan greige';

        $validate_finish = Finish::where('user_id', $id)->get();
        if ($validate_finish->count() > 0) return 'User di gunakan finish';
        
        if (Auth::user()->id == $id) return 'Tidak bisa hapus user di pakai';

        $user_delete = User::find($id);
        $user_delete->delete();

        return 'success';
    }

    public function admingetdata(){
        $user = User::with('roles')->get();

        // return $user->roles->first()->id;

        return Datatables::of($user)
        ->addColumn('action', function ($user) {
            // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
            return "
             <button data-toggle='modal' id='editmodal' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modal-user-edit'
                data-id='".$user->id."'
                data-name='".$user->name."'
                data-username='".$user->username."'
                data-role='".$user->roles->first()->id."'
                >
                Edit
             </button>";
        })
        ->editColumn('created_at', function($user) {
            return date_format($user->created_at,'d-M-Y h:i:s');
        })
        ->addColumn('roles', function($user){
            return $user->roles->first()->name;
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }

    public function role_getdata(Request $request){
        $role = Role::all();
        $datas = '';

        $id = ($request->role <> '') ? $request->role : 0 ;

        foreach ($role as $value) {
            if ($value->id == $id) {
                $datas = $datas."<option selected value='".$value->id."' >".$value->name."</option>";
            }else{
                $datas = $datas."<option value='".$value->id."' >".$value->name."</option>";
            }
            
        }

        return $datas;
    }

    public function divisi(Request $request){
        $datas = '';
        $status = array('1' => 'Divisi 1', '2' => 'Divisi 2', '5' => 'Divisi Finish');

        if($request->role == 1){
            foreach ($status as $key => $value) {
                if ($key == $request->status) {
                    $datas = $datas."<option selected value='".$key."'>".$value."</option>";
                }else{
                    $datas = $datas."<option value='".$key."'>".$value."</option>";
                }
                
            }
        }elseif ($request->role == 2) {
            $datas = $datas."<option value='3'>Divisi Print</option>";
        }elseif ($request->role == 3) {
            $datas = $datas."<option value='9'>Admin</option>";
        }

        return $datas;
    }


}
