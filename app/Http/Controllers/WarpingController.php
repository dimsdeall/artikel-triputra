<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Warping;
use App\Sacon;
use App\Indigo;
use App\Log;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class WarpingController extends Controller
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

            $datas = Warping::where('sacon_id', $sacon->id)->get();

            return view('operator1.warping.index', compact('datas', 'sacon'));
        } else if (Auth::user()->roles->first()->name == 'Admin Warping & Indigo') {
            $number = 100;
            $kp     = '';
            $tgl1   = date('Y-m-') . '01';
            $tgl2   = date('Y-m-d');
            $sacon = Sacon::where('koreksi', '>', 1)->orderby('created_at')->get();
            return view('operator2.warping.index', compact('sacon', 'number', 'kp', 'tgl1', 'tgl2'));
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
        $sacon = Sacon::where('kp', $request->kp)
            ->where('koreksi', '>', 1)
            ->get()
            ->first();

        $datas = Warping::where('sacon_id', $sacon->id)->where('koreksi', 2)->get();
        $warping_id = $request->warping_id;

        return view('operator1.warping.create', compact('datas', 'sacon', 'warping_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Warping::where('nb', $request->nb)
            ->where('sacon_id', $request->id)
            ->get();
        if ($validate->count() > 0) {
            throw ValidationException::withMessages(['nb' => 'Nomor Beam Sudah ada']);
        }

        $newwarping             = new Warping;
        $newwarping->lot        = strtoupper($request->lot);
        $newwarping->nb         = strtoupper($request->nb);
        $newwarping->te         = strtoupper($request->te);
        $newwarping->p          = strtoupper($request->p);
        $newwarping->b          = strtoupper($request->b);
        $newwarping->koreksi    = 2;
        $newwarping->user_id    = Auth::user()->id;
        $newwarping->sacon_id   = strtoupper($request->id);
        $newwarping->save();

        $update_sacon           = Sacon::find($request->id);
        if ($update_sacon->koreksi < '3') {
            $update_sacon->koreksi  = 3;
            $update_sacon->save();
        }

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Membuat Warping ( Data Potong ' . $request->potong . ' )';
        $create_logs->save();

        if ($request->btnstatus == 'next') {
            return back();
        } else {
            $sacon = Sacon::find($request->id);
            return redirect('/warping?kp=' . $sacon->kp);
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
        $warping_delete           = Warping::find($id);
        $warping_delete->koreksi  = 1;
        $warping_delete->save();

        $create_warping           = new warping;
        $create_warping->lot      = strtoupper($request->lot);
        $create_warping->nb       = strtoupper($request->nb);
        $create_warping->te       = strtoupper($request->te);
        $create_warping->p        = strtoupper($request->p);
        $create_warping->b        = strtoupper($request->b);
        $create_warping->user_id  = Auth::user()->id;
        $create_warping->koreksi  = 2;
        $create_warping->print    = strtoupper($request->print);
        $create_warping->sacon_id = strtoupper($request->sacon_id);
        $create_warping->created_at = $warping_delete->created_at;
        $create_warping->save();

        $update_indigo = Indigo::where('warping_id', $id)->where('koreksi', '>', 1)
            ->update(['warping_id' => $create_warping->id]);

        $sacon_item = Sacon::find($request->sacon_id);

        $create_logs                = new Log;
        $create_logs->no_bukti      = $sacon_item->item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Edit Warping (' . $request->warping_keterangan . ')';
        $create_logs->save();

        return redirect('/warping');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $validate = Indigo::where('warping_id', $id)->where('koreksi', '>', 1)->get();

        if ($validate->count() > 0) {
            throw ValidationException::withMessages(['id' => 'Data Item ini sedang di pakai mohon di cek pada proses selanjutnya']);
        } else {
            $warping = Warping::find($id);
            $sacon = Sacon::find($warping->sacon_id);

            $create_logs                = new Log;
            $create_logs->no_bukti      = $sacon->kp;
            $create_logs->user_id       = Auth::user()->id;
            $create_logs->keterangan    = 'Hapus Warping (' . $request->keterangan . ')';
            $create_logs->save();

            $warping->koreksi = '1';
            $warping->save();

            return redirect('/warping');
        }

        return $id;
    }

    public function operator1getdata($sacon_id)
    {
        $warping = Warping::with('sacon')->where('koreksi', '>', 1)->where('sacon_id', $sacon_id)->get();

        return Datatables::of($warping)
            ->addColumn('action', function ($warping) {
                // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
                return "
             <button data-toggle='modal' class='btn btn-success btn-sm' id='btnprint'
                data-id='" . $warping->sacon->id . "'
             >Print</button>

             <button data-toggle='modal' id='editmodal' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='" . $warping->id . "'
                data-nb='" . $warping->nb . "'
                data-p='" . $warping->p . "'
                data-b='" . $warping->b . "'
                data-print='" . $warping->print . "'
                data-idsacon='" . $warping->sacon->id . "'
                >
                Edit
             </button>";
            })
            ->addColumn('kp', function ($warping) {
                return $warping->sacon->kp;
            })
            ->addColumn('item', function ($warping) {
                return $warping->sacon->item;
            })
            ->editColumn('created_at', function ($warping) {
                return date_format($warping->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($warping) {
                return $warping->user->name;
                // return $warping->users->name;
            })
            ->editColumn('print', function ($warping) {
                if ($warping->print == 0) {
                    return 'Belum Print';
                } else {
                    return 'Sudah Print';
                }
            })
            ->editColumn('status', function ($warping) {
                if ($warping->status == 0) {
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
        // $warping = Warping::where('koreksi', '>', 1)->get();
        $warping = Warping::with('sacon')
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->kp <> '') $query = $query->where('sacon.kp', $request->kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->take)
            ->get();

        if ($request->tgl1 <> '') $warping = $warping->where('created_at', '>=', $request->tgl1 . " 00:00:00");
        if ($request->tgl2 <> '') $warping = $warping->where('created_at', '<=', $request->tgl2 . " 23:59:59");

        return Datatables::of($warping)
            ->addColumn('action', function ($warping) {
                // $route = "{{ route(lokasi.update, ".$lokasi->id.") }}";
                return "
             <button data-toggle='modal' class='btn btn-primary btn-sm' id='btnprint'
                data-id='" . $warping->sacon->id . "'
             ><i class='fa fa-print'></i> Print</button>

             <button id='editmodal' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modaledit'
                data-id='" . $warping->id . "'
                data-lot='" . $warping->lot . "'
                data-nb='" . $warping->nb . "'
                data-te='" . $warping->te . "'
                data-p='" . $warping->p . "'
                data-b='" . $warping->b . "'
                data-print='" . $warping->print . "'
                data-idsacon='" . $warping->sacon->id . "'
                >
                <i class='fa fa-edit'></i> Edit
             </button>
             
             <button id='delete' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deletemodal'
                data-id='" . $warping->id . "'
                >
                <i class='fa fa-trash-alt'></i> Hapus
             </button>
             ";
            })
            ->addColumn('kp', function ($warping) {
                return $warping->sacon->kp;
            })
            ->addColumn('item', function ($warping) {
                return $warping->sacon->item;
            })
            ->editColumn('created_at', function ($warping) {
                return date_format($warping->created_at, 'd-M-Y h:i:s');
            })
            ->editColumn('user_id', function ($warping) {
                return $warping->user->name;
                // return $warping->users->name;
            })
            ->editColumn('print', function ($warping) {
                if ($warping->print == 0) {
                    return 'Belum Print';
                } else {
                    return 'Sudah Print';
                }
            })
            ->rawColumns(['id', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function cek_status(Request $request)
    {
        $validate = Warping::where('sacon_id', $request->sacon)->where('koreksi', '>', 1)->where('status', 0)->get();

        if ($validate->count() == 0) {
            return 'ok';
        } else {
            return 'fail';
        }
    }

    public function export_data(Request $request)
    {
        $datas = Warping::with(['sacon', 'user'])
            ->whereHas('sacon', function ($query) use ($request) {
                if ($request->export_kp <> '') $query = $query->where('sacon.kp', $request->export_kp);
            })
            ->where('koreksi', '>', 1)
            ->take($request->export_take)
            ->get();


        if ($request->export_tgl1 <> '') $datas = $datas->where('created_at', '>=', $request->export_tgl1 . " 00:00:00");
        if ($request->export_tgl2 <> '') $datas = $datas->where('created_at', '<=', $request->export_tgl2 . " 23:59:59");

        // return $request;

        Excel::create('Laporan Excel Warping Tri Putra' . date('d-m-y H:i:s'), function ($excel) use ($datas) {

            $excel->sheet('New sheet', function ($sheet) use ($datas) {

                $sheet->loadView('operator2.warping.excel', compact('datas'));
            });
        })->export('xlsx');;
    }
}
