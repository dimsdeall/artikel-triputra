<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sacon;
use App\Warping;
use App\Indigo;
use App\Weaving;
use App\Log;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class IndigoController extends Controller
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
        if (Auth::user()->roles->first()->name == 'Warping & Indigo') {
            $sacon = Sacon::where('kp', $_GET['kp'])
                ->where('koreksi', '>', 1)
                ->get()
                ->first();

            $datas = Indigo::where('sacon_id', $sacon->id)->get();

            return view('operator1.indigo.index', compact('datas', 'sacon'));
        } else if (Auth::user()->roles->first()->name == 'Admin Warping & Indigo') {
            $number = 100;
            $kp     = '';
            $tgl1   = date('Y-m-') . '01';
            $tgl2   = date('Y-m-d');
            $sacon = Sacon::where('koreksi', '>', 1)->orderby('created_at')->get();
            return view('operator2.indigo.index', compact('sacon', 'number', 'kp', 'tgl1', 'tgl2'));
        } else {
            return redirect('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $sacon = Sacon::where('item', $request->barcodeitemindigo)
        //           ->where('koreksi' ,'>' , 2)
        //           ->get()
        //           ->first();

        // $datas = Warping::where('sacon_id', $sacon->id)
        //           ->where('koreksi', 2)
        //           ->get();

        // return view('operator1.indigo.create', compact('datas', 'sacon'));

        $sacon = Sacon::where('kp', $request->kp)
            ->where('koreksi', '>', 1)
            ->get()
            ->first();

        $datas = Indigo::where('sacon_id', $sacon->id)->where('koreksi', 2)->get();
        $nb = Warping::where('sacon_id', $sacon->id)
            ->where('koreksi', 2)
            ->get();

        return view('operator1.indigo.create', compact('datas', 'sacon', 'nb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Indigo::where('nb', $request->nb)
            ->where('sacon_id', $request->id)
            ->get();

        if ($validate->count() > 0) {
            throw ValidationException::withMessages(['nb' => 'Nomor Beam Sudah ada']);
        }

        $newindigo              = new Indigo;
        $newindigo->lot         = strtoupper($request->lot);
        $newindigo->mc_idg      = strtoupper($request->mc_idg);
        $newindigo->nb          = strtoupper($request->nb);
        $newindigo->te           = strtoupper($request->te);
        $newindigo->w           = strtoupper($request->w);
        $newindigo->p           = strtoupper($request->p);
        $newindigo->b           = strtoupper($request->b);
        $newindigo->warping_id  = $request->warping_id;
        $newindigo->user_id     = Auth::user()->id;
        $newindigo->sacon_id    = strtoupper($request->id);
        $newindigo->koreksi     = 2;
        $newindigo->save();

        $update_sacon           = Sacon::find($request->id);
        if ($update_sacon->koreksi < '4') {
            $update_sacon->koreksi  = 4;
            $update_sacon->save();
        }

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Membuat Indigo';
        $create_logs->save();

        if ($request->btnstatus == 'next') {
            return back();
        } else {
            $sacon = Sacon::find($request->id);
            return redirect('/indigo?kp=' . $sacon->kp);
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
        // $validate = Indigo::where('nb', $request->nb)
        //             ->where('sacon_id', $request->id)
        //             ->where('koreksi', '>', 1)
        //             ->get();

        // if ($validate->count() > 0) {
        //     throw ValidationException::withMessages(['nb' => 'Nomor Beam Sudah ada']);
        // }

        $indigo_delete           = Indigo::find($id);
        $indigo_delete->koreksi  = 1;
        $indigo_delete->save();

        $create_indigo              = new indigo;
        $create_indigo->lot         = strtoupper($request->lot);
        $create_indigo->mc_idg      = strtoupper($request->mc_idg);
        $create_indigo->nb          = strtoupper($request->nb);
        $create_indigo->te          = strtoupper($request->te);
        $create_indigo->w           = strtoupper($request->w);
        $create_indigo->p           = strtoupper($request->p);
        $create_indigo->b           = strtoupper($request->b);
        $create_indigo->user_id     = Auth::user()->id;
        $create_indigo->koreksi     = 2;
        $create_indigo->print       = $request->print;
        $create_indigo->sacon_id    = $request->sacon_id;
        $create_indigo->warping_id  = $request->warping_id;
        $create_indigo->created_at  = $indigo_delete->created_at;
        $create_indigo->save();

        $sacon_item = Sacon::find($request->sacon_id);
        $update_weaving = Weaving::where('indigo_id', $id)->where('koreksi', '>', 1)
            ->update(['indigo_id' => $create_indigo->id]);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $sacon_item->item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Edit Indigo (' . $request->keterangan . ')';
        $create_logs->save();

        return redirect('/indigo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $validate = Weaving::where('indigo_id', $id)->where('koreksi', '>', 1)->get();

        if ($validate->count() > 0) {
            throw ValidationException::withMessages(['id' => 'Data Item ini sedang di pakai mohon di cek pada proses selanjutnya']);
        } else {
            $indigo = Indigo::find($id);
            $sacon = Sacon::find($indigo->sacon_id);

            $create_logs                = new Log;
            $create_logs->no_bukti      = $sacon->kp;
            $create_logs->user_id       = Auth::user()->id;
            $create_logs->keterangan    = 'Hapus Indigo (' . $request->keterangan . ')';
            $create_logs->save();

            $indigo->koreksi = '1';
            $indigo->save();

            return redirect('/indigo');
        }

        return $id;
    }

    public function operator1getdata($sacon_id)
    {
        $indigo = Indigo::with('sacon')->where('koreksi', '>', 1)->where('sacon_id', $sacon_id)->get();


        return Datatables::of($indigo)
            ->addColumn('action', function ($indigo) {
                // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
                return "
             <button data-toggle='modal' class='btn btn-success btn-sm' id='btnprint'
                data-id='" . $indigo->id . "'
                data-sacon='" . $indigo->sacon->id . "'
             >Print</button>

             <button data-toggle='modal' id='editmodal' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='" . $indigo->id . "'
                data-mc_idg='" . $indigo->mc_idg . "'
                data-nb='" . $indigo->nb . "'
                data-w='" . $indigo->w . "'
                data-p='" . $indigo->p . "'
                data-b='" . $indigo->b . "'
                data-print='" . $indigo->print . "'
                data-idwarping='" . $indigo->warping_id . "'
                data-idsacon='" . $indigo->sacon_id . "'
                >
                Edit
             </button>";
            })
            ->addColumn('kp', function ($indigo) {
                return $indigo->sacon->kp;
            })
            ->addColumn('item', function ($indigo) {
                return $indigo->sacon->item;
            })
            ->editColumn('created_at', function ($indigo) {
                return date_format($indigo->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($indigo) {
                return $indigo->user->name;
                // return $indigo->users->name;
            })
            ->editColumn('print', function ($indigo) {
                if ($indigo->print == 0) {
                    return 'Belum Print';
                } else {
                    return 'Sudah Print';
                }
            })
            ->editColumn('status', function ($indigo) {
                if ($indigo->status == 0) {
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
        // $indigo = Indigo::with('warping')->where('koreksi', '>', 1)->get();
        $indigo = Indigo::with(['sacon', 'warping'])
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->kp <> '') $query = $query->where('sacon.kp', $request->kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->take)
            ->get();

        if ($request->kp <> '') $indigo = $indigo->where('sacon.kp', $request->kp);
        if ($request->tgl1 <> '') $indigo = $indigo->where('created_at', '>=', $request->tgl1 . " 00:00:00");
        if ($request->tgl2 <> '') $indigo = $indigo->where('created_at', '<=', $request->tgl2 . " 23:59:59");

        return Datatables::of($indigo)
            ->addColumn('action', function ($indigo) {
                // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
                return "
             <button data-toggle='modal' class='btn btn-primary btn-sm' id='btnprint'
                data-id='" . $indigo->id . "'
                data-sacon='" . $indigo->sacon->id . "'
             ><i class='fa fa-print'></i> Print</button>

             <button data-toggle='modal' id='editmodal' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modaledit'
                data-lot='" . $indigo->lot . "'
                data-id='" . $indigo->id . "'
                data-mc_idg='" . $indigo->mc_idg . "'
                data-nb='" . $indigo->nb . "'
                data-te='" . $indigo->te . "'
                data-w='" . $indigo->w . "'
                data-p='" . $indigo->p . "'
                data-b='" . $indigo->b . "'
                data-print='" . $indigo->print . "'
                data-idwarping='" . $indigo->warping_id . "'
                data-idsacon='" . $indigo->sacon_id . "'
                >
                <i class='fa fa-edit'></i> Edit
             </button>
             
             <button id='delete' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deletemodal'
                data-id='" . $indigo->id . "'
                >
                <i class='fa fa-trash-alt'></i> Hapus
             </button>
             ";
            })
            ->addColumn('kp', function ($indigo) {
                return $indigo->sacon->kp;
            })
            ->addColumn('item', function ($indigo) {
                return $indigo->sacon->item;
            })
            ->editColumn('created_at', function ($indigo) {
                return date_format($indigo->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($indigo) {
                return $indigo->user->name;
                // return $indigo->users->name;
            })
            ->editColumn('print', function ($indigo) {
                if ($indigo->print == 0) {
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
        $data = Warping::where('sacon_id', $request->sacon)->where('koreksi', '>', 1)->where('status', 1)->get();
        $datas = '';

        foreach ($data as $value) {
            if ($request->warping == $value->id) {
                $datas = $datas . "<option selected value='" . $value->id . "' >LOT :" . $value->lot . "| NB :" . $value->nb . "| P :" . $value->p . "| B :" . $value->b . "</option>";
            } else {
                $datas = $datas . "<option value='" . $value->id . "' >LOT :" . $value->lot . "| NB :" . $value->nb . "| P :" . $value->p . "| B :" . $value->b . "</option>";
            }
        }

        return $datas;
    }

    public function cek_status(Request $request)
    {
        $validate = Indigo::where('sacon_id', $request->sacon)->where('koreksi', '>', 1)->where('status', 1)->get();

        if ($validate->count() == 0) {
            return 'fail';
        } else {
            return 'ok';
        }
    }

    public function export_data(Request $request)
    {
        $datas = Indigo::with(['sacon', 'user'])
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->export_kp <> '') $query = $query->where('sacon.kp', $request->export_kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->export_take)
            ->get();

        // if ($request->export_kp <> '') $datas = $datas->where('sacon.kp', $request->export_kp);
        if ($request->export_tgl1 <> '') $datas = $datas->where('created_at', '>=', $request->export_tgl1 . " 00:00:00");
        if ($request->export_tgl2 <> '') $datas = $datas->where('created_at', '<=', $request->export_tgl2 . " 23:59:59");

        // return $request;

        Excel::create('Laporan Excel Indigo Tri Putra' . date('d-m-y H:i:s'), function ($excel) use ($datas) {

            $excel->sheet('New sheet', function ($sheet) use ($datas) {

                $sheet->loadView('operator2.indigo.excel', compact('datas'));
            });
        })->export('xlsx');;
    }
}
