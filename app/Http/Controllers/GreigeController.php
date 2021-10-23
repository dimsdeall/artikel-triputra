<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warping;
use App\Models\Sacon;
use App\Models\Indigo;
use App\Models\Log;
use App\Models\Weaving;
use App\Models\Greige;
use App\Models\User;
use App\Models\Finish;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class GreigeController extends Controller
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
        if (Auth::user()->roles->first()->name == 'Greige') {
            $sacon = Sacon::where('kp', $_GET['kp'])
                ->where('koreksi', '>', 1)
                ->get()
                ->first();

            $datas = Weaving::where('sacon_id', $sacon->id)->get();

            return view('operator1.greige.index', compact('datas', 'sacon'));
        } elseif (Auth::user()->roles->first()->name == 'Admin Greige') {
            $number = 100;
            $kp     = '';
            $tgl1   = date('Y-m-') . '01';
            $tgl2   = date('Y-m-d');
            $sacon = Sacon::where('koreksi', '>', 1)->orderby('created_at')->get();
            return view('operator2.greige.index', compact('sacon', 'number', 'kp', 'tgl1', 'tgl2'));
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
        $sacon = Sacon::where('kp', $request->kp)
            ->where('koreksi', '>', 1)
            ->get()
            ->first();

        $datas = Greige::where('sacon_id', $sacon->id)->where('koreksi', 2)->get();
        $indigo = Indigo::where('sacon_id', $sacon->id)->where('koreksi', 2)->get();
        // $weaving = Weaving::select('pitem')
        //             ->where('sacon_id', $sacon->id)
        //             ->where('koreksi', 2)
        //             ->groupby('pitem')
        //             ->get();
        $weaving = Weaving::find($request->weaving_id);
        $user = User::all();

        return view('operator1.greige.create', compact('datas', 'sacon', 'indigo', 'weaving', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $new_greige              = new Greige;
        $new_greige->b           = strtoupper($request->b);
        $new_greige->potongan    = strtoupper($request->potongan);
        $new_greige->p           = strtoupper($request->p);
        $new_greige->opr         = strtoupper($request->opr);
        $new_greige->grade       = strtoupper($request->grade);
        $new_greige->shift       = strtoupper($request->shift);
        $new_greige->koreksi     = 2;
        $new_greige->user_id     = Auth::user()->id;
        $new_greige->sn          = strtoupper($request->sn);
        $new_greige->weaving_id  = strtoupper($request->weaving_id);
        $new_greige->sacon_id    = strtoupper($request->id);
        $new_greige->save();

        $update_sacon           = Sacon::find($request->id);
        if ($update_sacon->koreksi < '6') {
            $update_sacon->koreksi  = 6;
            $update_sacon->save();
        }

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Membuat Greige ( Data Potong ' . $request->potong . ' )';
        $create_logs->save();

        if ($request->btnstatus == 'next') {
            return back();
        } else {
            $sacon = Sacon::find($request->id);
            return redirect('/greige?kp=' . $sacon->kp);
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
        $delete_greige          = Greige::find($id);
        $delete_greige->koreksi = 1;
        $delete_greige->save();

        $potong = Weaving::find($request->potong);

        $new_greige              = new Greige;
        $new_greige->b           = strtoupper($request->b);
        $new_greige->potongan    = strtoupper($potong->potongan);
        $new_greige->p           = strtoupper($request->p);
        $new_greige->opr         = strtoupper($request->opr);
        $new_greige->grade       = strtoupper($request->grade);
        $new_greige->shift       = strtoupper($request->shift);
        $new_greige->koreksi     = 2;
        $new_greige->user_id     = Auth::user()->id;
        $new_greige->sn          = strtoupper($request->sn);
        $new_greige->weaving_id  = strtoupper($potong->id);
        $new_greige->sacon_id    = strtoupper($request->sacon_id);
        $new_greige->created_at  = $delete_greige->created_at;
        $new_greige->save();

        $update_finish = Finish::where('sacon_id', $request->sacon_id)
            ->where('greige_id', $delete_greige->id)
            ->update(['grade' => $request->grade, 'greige_id' => $new_greige->id]);

        $sacon = Sacon::find($request->sacon_id);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $sacon->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Edit Greige ( Data Potong ' . $request->potong . ' )';
        $create_logs->save();


        return redirect('/greige');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $validate = Finish::where('greige_id', $id)->where('koreksi', '>', 1)->get();

        if ($validate->count() > 0) {
            throw ValidationException::withMessages(['id' => 'Data Item ini sedang di pakai mohon di cek pada proses selanjutnya']);
        } else {
            $greige = Greige::find($id);
            $sacon = Sacon::find($greige->sacon_id);

            $create_logs                = new Log;
            $create_logs->no_bukti      = $sacon->kp;
            $create_logs->user_id       = Auth::user()->id;
            $create_logs->keterangan    = 'Hapus Greige (' . $request->keterangan . ')';
            $create_logs->save();

            $greige->koreksi = '1';
            $greige->save();

            return redirect('/greige');
        }

        return $id;
    }

    public function operator1getdata($sacon_id)
    {
        $greige = Greige::with('weaving')->with('sacon')->where('koreksi', '>', 1)->where('sacon_id', $sacon_id)->get();

        return Datatables::of($greige)
            ->addColumn('action', function ($greige) {
                // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
                return "
             <button data-toggle='modal' class='btn btn-success btn-sm' id='btnprint'
                data-id='" . $greige->sacon->id . "'
             >Print</button>

             <button data-toggle='modal' id='editmodal' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='" . $greige->id . "'
                data-nb='" . $greige->nb . "'
                data-p='" . $greige->p . "'
                data-print='" . $greige->print . "'
                data-idsacon='" . $greige->sacon->id . "'
                >
                Edit
             </button>";
            })
            ->addColumn('kp', function ($greige) {
                return $greige->sacon->kp;
            })
            ->addColumn('item', function ($greige) {
                return $greige->sacon->item;
            })
            ->editColumn('created_at', function ($greige) {
                return date_format($greige->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($greige) {
                return $greige->user->name;
                // return $greige->users->name;
            })
            ->editColumn('print', function ($greige) {
                if ($greige->print == 0) {
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

    public function operator1potong(Request $request)
    {
        $datas = Weaving::where('koreksi', 2)
            ->where('sacon_id', $request->sacon)
            ->where('pitem', $request->pitem)
            ->get();
        $data = '';
        foreach ($datas as $value) {
            $data = $data . "<option value='" . $value->id . "'>" . $value->potongan . "</option>";
        }

        $data = $data . '|' . $datas->first()->sn;

        return $data;
    }

    public function operator1sn(Request $request)
    {
        $sn = Weaving::find($request->potongan);

        return $sn->sn;
    }

    public function operator2getdata(Request $request)
    {
        // $greige = greige::with('weaving')->with('sacon')->where('koreksi', '>', 1)->get();

        $greige = Greige::with(['sacon', 'user', 'weaving'])
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->kp <> '') $query = $query->where('sacon.kp', $request->kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->take)
            ->get();


        if ($request->tgl1 <> '') $greige = $greige->where('created_at', '>=', $request->tgl1 . " 00:00:00");
        if ($request->tgl2 <> '') $greige = $greige->where('created_at', '<=', $request->tgl2 . " 23:59:59");

        return Datatables::of($greige)
            ->addColumn('action', function ($greige) {
                return "
             <button data-toggle='modal' class='btn btn-primary btn-sm' id='btnprint'
                data-id='" . $greige->sacon->id . "'
             ><i class='fa fa-print'></i> Print</button>

             <button data-toggle='modal' id='editmodal' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='" . $greige->id . "'
                data-no_mc='" . $greige->no_mc . "'
                data-b='" . $greige->b . "'
                data-p='" . $greige->p . "'
                data-sn='" . $greige->sn . "'
                data-potongan='" . $greige->potongan . "'
                data-grade='" . $greige->grade . "'
                data-shift='" . $greige->shift . "'
                data-opr='" . $greige->opr . "'
                data-print='" . $greige->print . "'
                data-idsacon='" . $greige->sacon->id . "'
                data-idweaving='" . $greige->weaving_id . "'
                >
                <i class='fa fa-edit'></i> Edit
             </button>
             
             <button id='delete' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deletemodal'
                data-id='" . $greige->id . "'
                >
                <i class='fa fa-trash-alt'></i> Hapus
             </button>
             ";
            })
            ->addColumn('kp', function ($greige) {
                return $greige->sacon->kp;
            })
            ->addColumn('item', function ($greige) {
                return $greige->sacon->item;
            })
            ->editColumn('created_at', function ($greige) {
                return date_format($greige->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($greige) {
                return $greige->user->name;
                // return $greige->users->name;
            })
            ->editColumn('print', function ($greige) {
                if ($greige->print == 0) {
                    return 'Belum Print';
                } else {
                    return 'Sudah Print';
                }
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function operator2pitem(Request $request)
    {
        $datas = Weaving::select('pitem')
            ->where('koreksi', 2)
            ->where('sacon_id', $request->sacon)
            ->groupby('pitem')
            ->get();

        $pitem = Weaving::find($request->weaving);
        $data = '';

        foreach ($datas as $value) {
            if ($value->pitem == $pitem->pitem) {
                $data = $data . "<option selected value='" . $value->pitem . "'>" . $value->pitem . "</option>";
            } else {
                $data = $data . "<option value='" . $value->pitem . "'>" . $value->pitem . "</option>";
            }
        }

        $data = $data . '|';

        $datas = Weaving::where('koreksi', 2)
            ->where('sacon_id', $request->sacon)
            ->where('pitem', $pitem->pitem)
            ->get();

        $sn = '';
        foreach ($datas as $value) {
            if ($value->potongan == $request->potongan) {
                $data = $data . "<option selected value='" . $value->id . "'>" . $value->potongan . "</option>";
                $sn = $value->sn;
            } else {
                $data = $data . "<option value='" . $value->id . "'>" . $value->potongan . "</option>";
            }
        }

        $data = $data . '|' . $sn;

        return $data;
    }

    public function cek_status(Request $request)
    {
        $validate = Greige::where('sacon_id', $request->sacon)->where('koreksi', '>', 1)->where('status', 1)->get();

        if ($validate->count() == 0) {
            return 'fail';
        } else {
            return 'ok';
        }
    }

    public function export_data(Request $request)
    {
        $datas = Greige::with(['sacon', 'user', 'weaving'])
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

        // Excel::create('Laporan Excel Greige Tri Putra' . date('d-m-y H:i:s'), function ($excel) use ($datas) {

        //     $excel->sheet('New sheet', function ($sheet) use ($datas) {

        //         $sheet->loadView('operator2.greige.excel', compact('datas'));
        //     });
        // })->export('xlsx');;
    }
}
