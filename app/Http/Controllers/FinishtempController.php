<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sacon;
use App\Models\Finish;
use App\Models\Finishtemp;
use Yajra\Datatables\Datatables;
use Excel;

class FinishtempController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('finishtemp');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sacon = Sacon::where('kp', $request->sacon)->where('koreksi', '>', 1)->first();

        if ($sacon == '' or $sacon == null) {
            return 'er1';
        }

        $finish = Finish::where('id',$request->id)->where('koreksi', 2)->first();

        if ($finish == '' or $finish == null) {
            return 'er2';
        }

        $finishtemp = Finishtemp::where('finish_id', $request->id)->first();

        if ($finishtemp != '' or $finishtemp != null) {
            return 'already';
        }

        $new_finish              = new Finishtemp;
        $new_finish->title       = strtoupper($finish->title);
        $new_finish->potong      = strtoupper($finish->potong);
        $new_finish->lot         = strtoupper($finish->lot);
        $new_finish->grade       = strtoupper($finish->grade);
        $new_finish->point       = strtoupper($finish->point);
        $new_finish->yds         = strtoupper($finish->yds);
        $new_finish->kg          = strtoupper($finish->kg);
        $new_finish->lebar       = strtoupper($finish->lebar);
        $new_finish->sn          = strtoupper($finish->sn);
        $new_finish->k3l         = strtoupper($finish->k3l);
        $new_finish->inisial     = strtoupper($finish->inisial);
        $new_finish->k           = strtoupper($finish->k);
        $new_finish->susutlusi   = strtoupper($finish->susutlusi);
        $new_finish->actual      = strtoupper($finish->actual);
        $new_finish->tgl         = strtoupper($finish->tgl);
        $new_finish->greige_id   = strtoupper($finish->greige_id);
        $new_finish->sacon_id    = strtoupper($finish->sacon_id);
        $new_finish->finish_id   = strtoupper($finish->id);
        $new_finish->save();

        return 'done';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $finishtemp = Finishtemp::find($id);
        $finishtemp->delete();

        return 'done';
    }

    public function hapus(Request $request)
    {
        $finishtemp = Finishtemp::find($request->id);
        $finishtemp->delete();

        return 'done';
    }

    public function truncate(Request $request)
    {
        Finishtemp::query()->truncate();

        return 'done';
    }

    public function getdata(){
        $finish = FinishTemp::with('greige')->with('sacon')->get();

        return Datatables::of($finish)
        ->addColumn('action', function ($finish) {
            return "
             <button id='delete' class='btn btn-danger btn-sm' 
                onclick='deletebarcode(".$finish->id.")'
                >
                <i class='fa fa-trash-alt'></i> Hapus
             </button>
             ";
        })
        ->addColumn('kp', function ($finish) {
            return $finish->sacon->kp;
        })
        ->addColumn('potongan', function ($finish) {
            return $finish->greige->potongan;
        })
        ->addColumn('item', function ($finish) {
            return $finish->sacon->item;
        })
        ->editColumn('created_at', function($finish) {
            return date_format($finish->created_at,'d-M-Y h:i:s');
        })
        ->rawColumns(['id', 'action'])
        ->addIndexColumn()
        ->make(true); 
    }

    public function export(){
        $datas = FinishTemp::with('greige')->with('sacon')->get();

        // Excel::create('Laporan Excel Tri Putra'.date('d-m-y H:i:s'), function($excel) use($datas){

        //     $excel->sheet('New sheet', function($sheet) use($datas){
        
        //         $sheet->loadView('admin.laporan.finishtemp', compact('datas'));
        
        //     });
        
        // })->export('xls');;
    }
}
