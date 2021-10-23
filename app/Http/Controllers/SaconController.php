<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sacon;
use App\Models\Warping;
use App\Models\Indigo;
use App\Models\Log;
use App\Models\Weaving;
use App\Models\Greige;
use App\Models\Finish;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class SaconController extends Controller
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
        $number = 100;
        $kp     = '';
        $tgl1   = date('Y-m-').'01';
        $tgl2   = date('Y-m-d');
        $sacon = Sacon::where('koreksi', '>', 1)->orderby('created_at')->get();

        if (Auth::user()->roles->first()->name == 'Admin') {
            return view('admin.sacon.index', compact('number'));
        }elseif(Auth::user()->roles->first()->name == 'Sacon'){
            return view('operator1.sacon.index', compact('sacon','number', 'kp', 'tgl1', 'tgl2'));
        }elseif(Auth::user()->roles->first()->name == 'Operator2'){
            return view('operator2.sacon.index');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->roles->first()->name == 'Admin') {
            return view('admin.sacon.create');
        }elseif(Auth::user()->roles->first()->name == 'Sacon'){
            return view('operator1.sacon.create');
        }elseif(Auth::user()->roles->first()->name == 'Operator2'){
            return view('operator2');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sacon_kp' => 'required|unique:sacon,kp',
        ],
        ['sacon_kp.unique' => 'Data Kp sudah ada!']);

        $create_sacon           = new Sacon;
        $create_sacon->lot      = strtoupper($request->sacon_lot);
        $create_sacon->kp       = strtoupper($request->sacon_kp);
        $create_sacon->item     = strtoupper($request->sacon_item);
        $create_sacon->lusi     = strtoupper($request->sacon_lusi);
        $create_sacon->ball1    = strtoupper($request->sacon_ball1);
        $create_sacon->kg1      = strtoupper($request->sacon_kg1);
        $create_sacon->cones1   = strtoupper($request->sacon_cones1);
        $create_sacon->pakan    = strtoupper($request->sacon_pakan);
        $create_sacon->ball2    = strtoupper($request->sacon_ball2);
        $create_sacon->kg2      = strtoupper($request->sacon_kg2);
        $create_sacon->cones2   = strtoupper($request->sacon_cones2);
        $create_sacon->sisir    = strtoupper($request->sacon_sisir);
        $create_sacon->te       = strtoupper($request->sacon_te);
        $create_sacon->w        = strtoupper($request->sacon_w);
        $create_sacon->p        = strtoupper($request->sacon_p);
        $create_sacon->susut    = strtoupper($request->sacon_susut);
        $create_sacon->actual   = strtoupper($request->sacon_actual);
        $create_sacon->user_id  = Auth::user()->id;
        $create_sacon->koreksi  = 2;
        $create_sacon->save();  

        $create_logs                = new Log;
        $create_logs->no_bukti      = strtoupper($request->sacon_item);
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Membuat Sacon';
        $create_logs->save();

        return redirect('/sacon');
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
        $sacon_delete           = Sacon::find($id);
        $sacon_delete->koreksi  = 1;
        $sacon_delete->save();

        $create_sacon           = new Sacon;
        $create_sacon->lot      = strtoupper($request->sacon_lot);
        $create_sacon->kp       = strtoupper($request->sacon_kp);
        $create_sacon->item     = strtoupper($request->sacon_item);
        $create_sacon->lusi     = strtoupper($request->sacon_lusi);
        $create_sacon->ball1    = strtoupper($request->sacon_ball1);
        $create_sacon->kg1      = strtoupper($request->sacon_kg1);
        $create_sacon->cones1   = strtoupper($request->sacon_cones1);
        $create_sacon->pakan    = strtoupper($request->sacon_pakan);
        $create_sacon->ball2    = strtoupper($request->sacon_ball2);
        $create_sacon->kg2      = strtoupper($request->sacon_kg2);
        $create_sacon->cones2   = strtoupper($request->sacon_cones2);
        $create_sacon->sisir    = strtoupper($request->sacon_sisir);
        $create_sacon->te       = strtoupper($request->sacon_te);
        $create_sacon->w        = strtoupper($request->sacon_w);
        $create_sacon->p        = strtoupper($request->sacon_p);
        $create_sacon->susut    = strtoupper($request->sacon_susut);
        $create_sacon->actual   = strtoupper($request->sacon_actual);
        $create_sacon->user_id  = Auth::user()->id;
        $create_sacon->koreksi  = $request->sacon_koreksi;
        $create_sacon->created_at = $sacon_delete->created_at;
        $create_sacon->save();  
        
        $update_warping = Warping::where('sacon_id', $id)->where('koreksi', '>', 1)
                          ->update(['sacon_id' => $create_sacon->id]);
        $update_indigo = Indigo::where('sacon_id', $id)->where('koreksi', '>', 1)
                          ->update(['sacon_id' => $create_sacon->id]);
        $update_weaving = Weaving::where('sacon_id', $id)->where('koreksi', '>', 1)
                          ->update(['sacon_id' => $create_sacon->id]);
        $update_greige = Greige::where('sacon_id', $id)->where('koreksi', '>', 1)
                          ->update(['sacon_id' => $create_sacon->id]);
        $update_finish = Finish::where('sacon_id', $id)->where('koreksi', '>', 1)
                          ->update(['sacon_id' => $create_sacon->id, 'actual' => strtoupper($request->sacon_actual)]);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->sacon_item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Edit Sacon ('.$request->sacon_keterangan.')';
        $create_logs->save();

        return redirect('/sacon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $validate = Warping::where('sacon_id', $id)->where('koreksi', '>', 1)->get();

        if ($validate->count() > 0) {
            throw ValidationException::withMessages(['id' => 'Data Item ini sedang di pakai mohon di cek pada proses selanjutnya']);
        }else{
            $sacon = Sacon::find($id);

            $create_logs                = new Log;
            $create_logs->no_bukti      = $sacon->kp;
            $create_logs->user_id       = Auth::user()->id;
            $create_logs->keterangan    = 'Hapus Sacon ('.$request->keterangan.')';
            $create_logs->save();

            $sacon->koreksi = '1';
            $sacon->save();
    
            return redirect('/sacon');
        }

        return $id;
    }

    public function admingetdata(Request $request){
        $sacon = Sacon::where('koreksi', '>', 1)->take($request->take)->get();

        if ($request->kp <> '') $sacon = $sacon->where('kp', $request->kp);
        if ($request->tgl1 <> '') $sacon = $sacon->where('created_at', '>=', $request->tgl1. " 00:00:00");
        if ($request->tgl2 <> '') $sacon = $sacon->where('created_at', '<=', $request->tgl2. " 23:59:59");

        // return $sacon;

        return Datatables::of($sacon)
        ->addColumn('action', function ($sacon) {
            // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
            return "
             <button data-toggle='modal' class='btn btn-primary btn-sm' id='btnprint'
                data-id='".$sacon->id."'
                data-nama='".$sacon->kp."'
             ><i class='fa fa-print'></i> Print</button>

             <button id='editmodal' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='".$sacon->id."'
                data-kp='".$sacon->kp."'
                data-item='".$sacon->item."'
                data-lot='".$sacon->lot."'
                data-lusi='".$sacon->lusi."'
                data-ball1='".$sacon->ball1."'
                data-kg1='".$sacon->kg1."'
                data-cones1='".$sacon->cones1."'
                data-pakan='".$sacon->pakan."'
                data-ball2='".$sacon->ball2."'
                data-kg2='".$sacon->kg2."'
                data-cones2='".$sacon->cones2."'
                data-sisir='".$sacon->sisir."'
                data-te='".$sacon->te."'
                data-w='".$sacon->w."'
                data-p='".$sacon->p."'
                data-susut='".$sacon->susut."'
                data-actual='".$sacon->actual."'
                data-koreksi='".$sacon->koreksi."'
                data-print='".$sacon->print."'
                >
                <i class='fa fa-edit'></i> Edit
             </button>
             
             <button id='delete' data-toggle='modal' data-target='#deletemodal' data-id='".$sacon->id."' class='btn btn-sm btn-danger' >
                <i class='fa fa-trash-alt'></i> Delete
             </button>
             ";
        })
        ->editColumn('created_at', function($sacon) {
            return date_format($sacon->created_at,'d-M-Y h:i:s');
        })
        ->editColumn('user_id', function($sacon) {
            return $sacon->users->name;
            // return $sacon->users->name;
        })
        ->editColumn('print', function($sacon) {
            if($sacon->print == 0){
                return 'Belum Print';
            }else{
                return 'Sudah Print';
            }
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }

    public function export_data(Request $request)
    {
        $datas = Sacon::with('users')->where('koreksi', '>', 1)->take($request->export_take)->get();

        if ($request->export_kp <> '') $datas = $datas->where('kp', $request->export_kp);
        if ($request->export_tgl1 <> '') $datas = $datas->where('created_at', '>=', $request->export_tgl1. " 00:00:00");
        if ($request->export_tgl2 <> '') $datas = $datas->where('created_at', '<=', $request->export_tgl2. " 23:59:59");  
        
        // return $request;

        // Excel::create('Laporan Excel Sacon Tri Putra'.date('d-m-y H:i:s'), function($excel) use($datas){

        //     $excel->sheet('New sheet', function($sheet) use($datas){
        
        //         $sheet->loadView('operator1.sacon.excel', compact('datas'));
        
        //     });
        
        // })->export('xlsx');;
    }
}
