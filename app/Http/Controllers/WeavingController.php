<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Warping;
use App\Sacon;
use App\Indigo;
use App\Log;
use App\Weaving;
use App\Greige;
use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class WeavingController extends Controller
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
        if (Auth::user()->roles->first()->name == 'Weaving') {
            $sacon = Sacon::where('kp', $_GET['kp'])
                ->where('koreksi', '>', 1)
                ->get()
                ->first();

            $datas = Weaving::where('sacon_id', $sacon->id)->get();

            return view('operator1.weaving.index', compact('datas', 'sacon'));
        } elseif (Auth::user()->roles->first()->name == 'Admin Weaving') {
            $number = 100;
            $kp     = '';
            $tgl1   = date('Y-m-') . '01';
            $tgl2   = date('Y-m-d');
            $sacon = Sacon::where('koreksi', '>', 1)->orderby('created_at')->get();
            return view('operator2.weaving.index', compact('sacon', 'number', 'kp', 'tgl1', 'tgl2'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sacon = Sacon::where('kp', $request->kp)
            ->where('koreksi', '>', 1)
            ->get()
            ->first();

        $datas = Weaving::where('sacon_id', $sacon->id)->where('koreksi', 2)->get();
        $indigo = Indigo::where('sacon_id', $sacon->id)->where('koreksi', 2)->where('status', 1)->get();
        $user = User::all();

        $nb = ($request->nb <> "") ? $request->nb : 0;

        return view('operator1.weaving.create', compact('datas', 'sacon', 'indigo', 'user', 'nb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cekindigo = Indigo::where('sacon_id', $request->id)
            ->where('koreksi', '>', 1)
            ->where('nb', $request->nb)
            ->get()
            ->first();

        if ($request->pitem == "") {
            $sacon_item = Sacon::find($request->id);
            $request->pitem = $sacon_item->item;
        }

        $new_weaving             = new Weaving;
        $new_weaving->pitem      = strtoupper($request->pitem);
        $new_weaving->lot        = strtoupper($request->lot);
        $new_weaving->mc         = strtoupper($request->mc);
        $new_weaving->nb         = strtoupper($request->nb);
        $new_weaving->pakan      = strtoupper($request->pakan);
        $new_weaving->pick       = strtoupper($request->pick);
        $new_weaving->sisir      = strtoupper($request->sisir);
        $new_weaving->anyaman    = strtoupper($request->anyaman);
        $new_weaving->potongan   = strtoupper($request->potongan);
        $new_weaving->p          = strtoupper($request->p);
        $new_weaving->b          = strtoupper($request->b);
        $new_weaving->shift      = strtoupper($request->shift);
        $new_weaving->koreksi    = 2;
        $new_weaving->user_id    = Auth::user()->id;
        $new_weaving->opr        = strtoupper($request->opr);
        $new_weaving->sn         = strtoupper($request->sn);
        $new_weaving->indigo_id  = strtoupper($cekindigo->id);
        $new_weaving->sacon_id   = strtoupper($request->id);
        $new_weaving->save();

        $update_sacon           = Sacon::find($request->id);
        if ($update_sacon->koreksi < '5') {
            $update_sacon->koreksi  = 5;
            $update_sacon->save();
        }

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Membuat Weaving ( Data Potong ' . $request->potong . ' )';
        $create_logs->save();

        if ($request->btnstatus == 'next') {
            return back();
        } else {
            $sacon = Sacon::find($request->id);
            return redirect('/weaving?kp=' . $sacon->kp);
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
        $weaving_delete           = Weaving::find($id);
        $weaving_delete->koreksi  = 1;
        $weaving_delete->save();

        // $nb = Indigo::find($request->nb);

        $cekindigo = Indigo::where('sacon_id', $request->id)
            ->where('koreksi', '>', 1)
            ->where('nb', $request->nb)
            ->get()
            ->first();

        if ($request->pitem == "") {
            $sacon_item = Sacon::find($request->id);
            $request->pitem = $sacon_item->item;
        }

        $new_weaving             = new Weaving;
        $new_weaving->pitem      = strtoupper($request->pitem);
        $new_weaving->lot        = strtoupper($request->lot);
        $new_weaving->mc         = strtoupper($request->mc);
        $new_weaving->nb         = strtoupper($request->nb);
        $new_weaving->pakan      = strtoupper($request->pakan);
        $new_weaving->pick       = strtoupper($request->pick);
        $new_weaving->sisir      = strtoupper($request->sisir);
        $new_weaving->anyaman    = strtoupper($request->anyaman);
        $new_weaving->potongan   = strtoupper($request->potongan);
        $new_weaving->p          = strtoupper($request->p);
        $new_weaving->b          = strtoupper($request->b);
        $new_weaving->shift      = strtoupper($request->shift);
        $new_weaving->koreksi    = 2;
        $new_weaving->user_id    = Auth::user()->id;
        $new_weaving->opr        = strtoupper($request->opr);
        $new_weaving->sn         = strtoupper($request->sn);
        $new_weaving->indigo_id  = strtoupper($cekindigo->id);
        $new_weaving->sacon_id   = strtoupper($request->id);
        $new_weaving->created_at = $weaving_delete->created_at;
        $new_weaving->save();

        $sacon_item = Sacon::find($request->id);
        $update_greige = Greige::where('weaving_id', $id)->where('koreksi', '>', 1)
            ->update(['weaving_id' => $new_weaving->id, 'potongan' => $request->potongan]);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $sacon_item->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Update Weaving (' . $request->keterangan_edit . ')';
        $create_logs->save();

        return redirect('/weaving');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $validate = Greige::where('weaving_id', $id)->where('koreksi', '>', 1)->get();

        if ($validate->count() > 0) {
            throw ValidationException::withMessages(['id' => 'Data Item ini sedang di pakai mohon di cek pada proses selanjutnya']);
        } else {
            $weaving = Weaving::find($id);
            $sacon = Sacon::find($weaving->sacon_id);

            $create_logs                = new Log;
            $create_logs->no_bukti      = $sacon->kp;
            $create_logs->user_id       = Auth::user()->id;
            $create_logs->keterangan    = 'Hapus Weaving (' . $request->keterangan . ')';
            $create_logs->save();

            $weaving->koreksi = '1';
            $weaving->save();

            return redirect('/weaving');
        }

        return $id;
    }

    public function operator1getdata($sacon_id)
    {
        $weaving = Weaving::with('sacon')->with('operator')->where('koreksi', '>', 1)->where('sacon_id', $sacon_id)->get();

        return Datatables::of($weaving)
            ->addColumn('action', function ($weaving) {
                // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
                return "
             <button data-toggle='modal' class='btn btn-success btn-sm' id='btnprint'
                data-id='" . $weaving->sacon->id . "'
             >Print</button>

             <button data-toggle='modal' id='editmodal' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='" . $weaving->id . "'
                data-nb='" . $weaving->nb . "'
                data-p='" . $weaving->p . "'
                data-opr='" . $weaving->opr . "'
                data-print='" . $weaving->print . "'
                data-idsacon='" . $weaving->sacon->id . "'
                >
                Edit
             </button>";
            })
            ->addColumn('kp', function ($weaving) {
                return $weaving->sacon->kp;
            })
            ->addColumn('item', function ($weaving) {
                return $weaving->sacon->item;
            })
            ->editColumn('created_at', function ($weaving) {
                return date_format($weaving->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($weaving) {
                return $weaving->user->name;
            })
            ->editColumn('print', function ($weaving) {
                if ($weaving->print == 0) {
                    return 'Belum Print';
                } else {
                    return 'Sudah Print';
                }
            })
            ->editColumn('status', function ($weaving) {
                if ($weaving->status == 0) {
                    return "<i class='fa fa-times'></i>";
                } else {
                    return "<i class='fa fa-check text-success'></i>";
                }
            })
            ->rawColumns(['id', 'action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }

    public function operator2getdata(Request $request)
    {
        // $weaving = Weaving::with('sacon')->with('operator')->where('koreksi', '>', 1)->get();
        $weaving = Weaving::with(['sacon', 'user'])
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->kp <> '') $query = $query->where('sacon.kp', $request->kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->take)
            ->get();

        if ($request->tgl1 <> '') $weaving = $weaving->where('created_at', '>=', $request->tgl1 . " 00:00:00");
        if ($request->tgl2 <> '') $weaving = $weaving->where('created_at', '<=', $request->tgl2 . " 23:59:59");
        return Datatables::of($weaving)
            ->addColumn('action', function ($weaving) {
                // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
                return "
             <button data-toggle='modal' class='btn btn-primary btn-sm' id='btnprint'
                data-id='" . $weaving->sacon->id . "'
             ><i class='fa fa-print'></i> Print</button>

             <button data-toggle='modal' id='editmodal' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='" . $weaving->id . "'
                data-pitem='" . $weaving->pitem . "'
                data-lot='" . $weaving->lot . "'
                data-mc='" . $weaving->mc . "'
                data-nb='" . $weaving->nb . "'
                data-pakan='" . $weaving->pakan . "'
                data-pick='" . $weaving->pick . "'
                data-sisir='" . $weaving->sisir . "'
                data-anyaman='" . $weaving->anyaman . "'
                data-potongan='" . $weaving->potongan . "'
                data-p='" . $weaving->p . "'
                data-b='" . $weaving->b . "'
                data-shift='" . $weaving->shift . "'
                data-sn='" . $weaving->sn . "'
                data-opr='" . $weaving->opr . "'
                data-print='" . $weaving->print . "'
                data-idsacon='" . $weaving->sacon->id . "'
                data-idindigo='" . $weaving->indigo_id . "'
                >
                <i class='fa fa-edit'></i> Edit
             </button>
             
             <button id='delete' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deletemodal'
                data-id='" . $weaving->id . "'
                >
                <i class='fa fa-trash-alt'></i> Hapus
             </button>
             ";
            })
            ->addColumn('kp', function ($weaving) {
                return $weaving->sacon->kp;
            })
            ->addColumn('item', function ($weaving) {
                return $weaving->sacon->item;
            })
            ->editColumn('created_at', function ($weaving) {
                return date_format($weaving->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($weaving) {
                return $weaving->user->name;
            })
            ->editColumn('print', function ($weaving) {
                if ($weaving->print == 0) {
                    return 'Belum Print';
                } else {
                    return 'Sudah Print';
                }
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function operator2getnb(Request $request)
    {
        $data = Indigo::where('sacon_id', $request->sacon)->where('koreksi', '>', 1)->get();

        $datas = '';

        foreach ($data as $value) {
            if ($request->indigo == $value->id) {
                $datas = $datas . "<option selected value='" . $value->nb . "' >" . $value->nb . "</option>";
            } else {
                $datas = $datas . "<option value='" . $value->nb . "' >" . $value->nb . "</option>";
            }
        }

        return $datas;
    }

    public function cek_status(Request $request)
    {
        $validate = Weaving::where('sacon_id', $request->sacon)->where('koreksi', '>', 1)->where('status', 1)->get();

        if ($validate->count() == 0) {
            return 'fail';
        } else {
            return 'ok';
        }
    }

    public function export_data(Request $request)
    {
        $datas = Weaving::with(['sacon', 'user'])
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->export_kp <> '') $query = $query->where('sacon.kp', $request->export_kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->export_take)
            ->get();

        // if ($request->export_kp <> '') $datas = $datas->where('sacon.kp', $request->export_kp);
        if ($request->export_tgl1 <> '') $datas = $datas->where('created_at', '>=', $request->export_tgl1 . " 00:00:00");
        if ($request->export_tgl2 <> '') $datas = $datas->where('created_at', '<=', $request->export_tgl2 . " 23:59:59");

        // return $datas;

        Excel::create('Laporan Excel Weaving Tri Putra' . date('d-m-y H:i:s'), function ($excel) use ($datas) {

            $excel->sheet('New sheet', function ($sheet) use ($datas) {

                $sheet->loadView('operator2.weaving.excel', compact('datas'));
            });
        })->export('xlsx');;
    }
}
