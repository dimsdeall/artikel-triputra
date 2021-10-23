<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sacon;
use App\Models\Finish;
use App\Models\Greige;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class FinishController extends Controller
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
        if (Auth::user()->roles->first()->name == 'Finish') {
            $sacon = Sacon::where('kp', $_GET['kp'])
                ->where('koreksi', '>', 1)
                ->get()
                ->first();

            $datas = Finish::where('sacon_id', $sacon->id)->get();

            return view('operator1.finish.index', compact('datas', 'sacon'));
        } elseif (Auth::user()->roles->first()->name == 'Admin Finish') {
            $number = 100;
            $kp     = '';
            $tgl1   = date('Y-m-') . '01';
            $tgl2   = date('Y-m-d');
            $sacon = Sacon::where('koreksi', '>', 1)->orderby('created_at')->get();
            return view('operator2.finish.index', compact('sacon', 'number', 'kp', 'tgl1', 'tgl2'));
        } else {
            redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::user()->roles->first()->name == 'Finish') {
            $sacon = Sacon::where('kp', $_GET['kp'])
                ->where('koreksi', '>', 1)
                ->get()
                ->first();

            $datas = Finish::where('sacon_id', $sacon->id)->where('koreksi', '>', 1)->get();
            $greige = Greige::find($request->greige_id);
            return view('operator1.finish.create', compact('datas', 'sacon', 'greige'));
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

        $new_finish              = new Finish;
        $new_finish->title       = strtoupper($request->title);
        $new_finish->potong      = strtoupper($request->potong);
        $new_finish->lot         = strtoupper($request->lot);
        $new_finish->grade       = strtoupper($request->grade);
        $new_finish->point       = strtoupper($request->point);
        $new_finish->yds         = strtoupper($request->yds);
        $new_finish->kg          = strtoupper($request->kg);
        $new_finish->lebar       = strtoupper($request->lebar);
        $new_finish->sn          = strtoupper($request->sn);
        $new_finish->k3l         = strtoupper($request->k3l);
        $new_finish->inisial     = strtoupper($request->inisial);
        $new_finish->k           = strtoupper($request->k);
        $new_finish->susutlusi   = strtoupper($request->susutlusi);
        $new_finish->actual      = strtoupper($request->actual);
        $new_finish->tgl         = strtoupper($request->tgl);
        $new_finish->koreksi     = 2;
        $new_finish->user_id     = Auth::user()->id;
        $new_finish->greige_id   = strtoupper($request->greige_id);
        $new_finish->sacon_id    = strtoupper($request->id);
        $new_finish->save();

        $update_sacon           = Sacon::find($request->id);
        if ($update_sacon->koreksi < '7') {
            $update_sacon->koreksi  = 7;
            $update_sacon->save();
        }

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Membuat Finish ( Data Potong ' . $request->potong . ' )';
        $create_logs->save();

        if ($request->btnstatus == 'next') {
            return back();
        } else {
            $sacon = Sacon::find($request->id);
            return redirect('/finish?kp=' . $sacon->kp);
        }
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
        $delete_finish  = Finish::find($id);
        $delete_finish->koreksi = 1;
        $delete_finish->save();

        $new_finish              = new Finish;
        $new_finish->title       = strtoupper($request->title);
        $new_finish->potong      = strtoupper($request->potong);
        $new_finish->lot         = strtoupper($request->lot);
        $new_finish->grade       = strtoupper($request->grade);
        $new_finish->point       = strtoupper($request->point);
        $new_finish->yds         = strtoupper($request->yds);
        $new_finish->kg          = strtoupper($request->kg);
        $new_finish->lebar       = strtoupper($request->lebar);
        $new_finish->sn          = strtoupper($request->sn);
        $new_finish->k3l         = strtoupper($request->k3l);
        $new_finish->inisial     = strtoupper($request->inisial);
        $new_finish->k           = strtoupper($request->k);
        $new_finish->susutlusi   = strtoupper($request->susutlusi);
        $new_finish->actual      = strtoupper($request->actual);
        $new_finish->tgl         = strtoupper($request->tgl);
        $new_finish->koreksi     = 2;
        $new_finish->user_id     = Auth::user()->id;
        $new_finish->greige_id   = strtoupper($request->greige_id);
        $new_finish->sacon_id    = strtoupper($request->idsacon);
        $new_finish->created_at  = $delete_finish->created_at;
        $new_finish->save();

        $sacon = Sacon::find($request->idsacon);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $sacon->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Edit Finish (' . $request->keterangan . ')';
        $create_logs->save();

        return redirect('/finish');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $delete_finish              = Finish::find($id);

        $sacon = Sacon::find($delete_finish->sacon_id);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $sacon->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Hapus Finish (' . $request->keterangan . ')';
        $create_logs->save();

        $delete_finish->koreksi     = 1;
        $delete_finish->save();

        return redirect('/finish');
    }

    public function operator1getdata($sacon_id)
    {
        $finish = Finish::with('greige')->with('sacon')->where('koreksi', '>', 1)->where('sacon_id', $sacon_id)->get();

        return Datatables::of($finish)
            ->addColumn('kp', function ($finish) {
                return $finish->sacon->kp;
            })
            ->addColumn('item', function ($finish) {
                return $finish->sacon->item;
            })
            ->editColumn('created_at', function ($finish) {
                return date_format($finish->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($finish) {
                return $finish->user->name;
                // return $finish->users->name;
            })
            ->editColumn('print', function ($finish) {
                if ($finish->print == 0) {
                    return 'Belum Print';
                } else {
                    return 'Sudah Print';
                }
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function sndata(Request $request)
    {
        $sn = Greige::find($request->grade);
        // return $sn;
        return $sn->sn;
    }

    public function operator2getdata(Request $request)
    {
        // $finish = Finish::with('greige')->with('sacon')->where('koreksi', '>', 1)->get();

        $finish = Finish::with(['sacon', 'user', 'greige'])
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->kp <> '') $query = $query->where('sacon.kp', $request->kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->take)
            ->get();


        if ($request->tgl1 <> '') $finish = $finish->where('created_at', '>=', $request->tgl1 . " 00:00:00");
        if ($request->tgl2 <> '') $finish = $finish->where('created_at', '<=', $request->tgl2 . " 23:59:59");

        // return $finish;

        return Datatables::of($finish)
            ->addColumn('action', function ($finish) {
                return "
             <button data-toggle='modal' class='btn btn-primary btn-sm' id='btnprint'
                data-id='" . $finish->sacon->id . "'
             ><i class='fa fa-print'></i> Print</button>

             <button data-toggle='modal' id='editmodal' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='" . $finish->id . "'
                data-title='" . $finish->title . "'
                data-potong='" . $finish->potong . "'
                data-lot='" . $finish->lot . "'
                data-grade='" . $finish->grade . "'
                data-point='" . $finish->point . "'
                data-yds='" . $finish->yds . "'
                data-kg='" . $finish->kg . "'
                data-lebar='" . $finish->lebar . "'
                data-sn='" . $finish->sn . "'
                data-k3l='" . $finish->k3l . "'
                data-inisial='" . $finish->inisial . "'
                data-susutlusi='" . $finish->susutlusi . "'
                data-k='" . $finish->k . "'
                data-actual='" . $finish->actual . "'
                data-tgl='" . $finish->tgl . "'
                data-print='" . $finish->print . "'
                data-idsacon='" . $finish->sacon->id . "'
                data-idgreige='" . $finish->greige_id . "'
                >
                <i class='fa fa-edit'></i> Edit
             </button>
             
             <button id='delete' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deletemodal'
                data-id='" . $finish->id . "'
                >
                <i class='fa fa-trash-alt'></i> Hapus
             </button>
             ";
            })
            ->addColumn('kp', function ($finish) {
                return $finish->sacon->kp;
            })
            ->addColumn('item', function ($finish) {
                return $finish->sacon->item;
            })
            ->editColumn('created_at', function ($finish) {
                return date_format($finish->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($finish) {
                return $finish->user->name;
                // return $finish->users->name;
            })
            ->editColumn('print', function ($finish) {
                if ($finish->print == 0) {
                    return 'Belum Print';
                } else {
                    return 'Sudah Print';
                }
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function grade(Request $request)
    {
        $greige = Greige::where('sacon_id', $request->sacon)->where('koreksi', '>', 1)->where('status', 1)->get();
        $datas = '';

        foreach ($greige as $value) {
            if ($value->id == $request->greige) {

                $datas = $datas . "<option selected value='" . $value->id . "'> NB:" . $value->weaving->nb . " | Potongan: " . $value->potongan . "</option>";
            } else {
                $datas = $datas . "<option value='" . $value->id . "'> NB: " . $value->weaving->nb . " | Potongan: " . $value->potongan . "</option>";
            }
        }

        return $datas;
    }

    public function export_data(Request $request)
    {
        $datas = Finish::with(['sacon', 'user', 'greige'])
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->kp <> '') $query = $query->where('sacon.kp', $request->kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->export_take)
            ->get();

        // if ($request->export_kp <> '') $datas = $datas->where('sacon.kp', $request->export_kp);
        if ($request->export_tgl1 <> '') $datas = $datas->where('created_at', '>=', $request->export_tgl1 . " 00:00:00");
        if ($request->export_tgl2 <> '') $datas = $datas->where('created_at', '<=', $request->export_tgl2 . " 23:59:59");

        // return $datas;

        // Excel::create('Laporan Excel Finish Tri Putra' . date('d-m-y H:i:s'), function ($excel) use ($datas) {

        //     $excel->sheet('New sheet', function ($sheet) use ($datas) {

        //         $sheet->loadView('operator2.finish.excel', compact('datas'));
        //     });
        // })->export('xlsx');;
    }
}
