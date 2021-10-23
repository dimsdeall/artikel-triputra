<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warping;
use App\Models\User;
use App\Models\Sacon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function laporan_admin()
    {
        if (Auth::user()->roles->first()->name != 'Admin') {
            return redirect('/home');
        }

        $number = 100;
        $kp     = '';
        $tgl1   = date('Y-m-').'01';
        $tgl2   = date('Y-m-d');


        $datas = Sacon::select(
            'sacon.kp as kp',
            'sacon.item as item',
            'sacon.lot as lot',
            'sacon.lusi as lusi',
            'sacon.ball1 as ball1',
            'sacon.kg1 as kg1',
            'sacon.cones1 as cones1',
            'sacon.pakan as pakan',
            'sacon.ball2 as ball2',
            'sacon.kg2 as kg2',
            'sacon.cones2 as cones2',
            'sacon.sisir as sisir',
            'sacon.te as te',
            'sacon.w as w',
            'sacon.p as p',
            'sacon.susut as susut',
            'sacon.actual as actual',
            'sacon.koreksi as koreksi',
            DB::raw('(select users.name from users where id = sacon.user_id) as user_sacon'),
            'sacon.created_at as created_at_sacon',
            'warping.lot as lot_warping',
            'warping.nb as nb_warping',
            'warping.te as te_warping',
            'warping.p as p_warping',
            'warping.b as b_warping',
            DB::raw('(select users.name from users where id = warping.user_id) as user_warping'),
            'warping.created_at as created_at_warping',
            'indigo.lot as lot_indigo',
            'indigo.mc_idg as mc_idg_indigo',
            'indigo.nb as nb_indigo',
            'indigo.te as te_indigo',
            'indigo.w as w_indigo',
            'indigo.p as p_indigo',
            'indigo.b as b_indigo',
            DB::raw('(select users.name from users where id = indigo.user_id) as user_indigo'),
            'indigo.created_at as created_at_indigo',
            'weaving.pitem as pitem_weaving',
            'weaving.lot as lot_weaving',
            'weaving.mc as mc_weaving',
            'indigo.nb as nb_weaving',
            'weaving.pakan as pakan_weaving',
            'weaving.pick as pick_weaving',
            'weaving.sisir as sisir_weaving',
            'weaving.anyaman as anyaman_weaving',
            'weaving.potongan as potongan_weaving',
            'weaving.p as p_weaving',
            'weaving.b as b_weaving',
            'weaving.opr as opr_weaving',
            'weaving.shift as shift_weaving',
            'weaving.sn as sn_weaving',
            DB::raw('(select users.name from users where id = weaving.user_id) as user_weaving'),
            'weaving.created_at as created_at_weaving',
            'greige.shift as shift_greige',
            'greige.p as p_greige',
            'greige.b as b_greige',
            'greige.sn as sn_greige',
            'greige.potongan as potongan_greige',
            'greige.grade as grade_greige',
            'greige.opr as opr_greige',
            DB::raw('(select users.name from users where id = greige.user_id) as user_greige'),
            'greige.created_at as created_at_greige',
            'finish.title as title_finish',
            'finish.potong as potong_finish',
            'finish.lot as lot_finish',
            'finish.grade as grade_finish',
            'finish.point as point_finish',
            'finish.yds as yds_finish',
            'finish.kg as kg_finish',
            'finish.lebar as lebar_finish',
            'finish.sn as sn_finish',
            'finish.k3l as k3l_finish',
            'finish.susutlusi as susutlusi_finish',
            'finish.inisial as inisial_finish',
            'finish.k as k_finish',
            'finish.tgl as tgl_finish',
            'finish.actual as actual_finish',
            DB::raw('(select users.name from users where id = finish.user_id) as user_finish'),
            'finish.created_at as created_at_finish'
        )
        ->leftjoin('warping',function($joinwarping){
            $joinwarping->on('warping.sacon_id', 'sacon.id');
            $joinwarping->where('warping.koreksi', '>', 1);
        })                        
        ->leftjoin('indigo',function($joinindigo){
            $joinindigo->on('indigo.sacon_id', 'sacon.id');
            $joinindigo->on('indigo.warping_id', 'warping.id');
            $joinindigo->where('indigo.koreksi', '>', 1);
        })
        ->leftjoin('weaving',function($joinweaving){
            $joinweaving->on('weaving.sacon_id', 'sacon.id');
            $joinweaving->on('weaving.indigo_id', 'indigo.id');
            $joinweaving->where('weaving.koreksi', '>', 1);
        })
        ->leftjoin('greige',function($joingreige){
            $joingreige->on('greige.sacon_id', 'sacon.id');
            $joingreige->on('greige.weaving_id', 'weaving.id');
            $joingreige->where('greige.koreksi', '>', 1);
        })
        ->leftjoin('finish', function($joinfinish){
            $joinfinish->on('finish.sacon_id', 'sacon.id');
            $joinfinish->on('finish.greige_id', 'greige.id');
            $joinfinish->where('finish.koreksi', '>', 1);
        })
        ->where('sacon.koreksi', '>', '1')
        ->take($number);

        if ($kp <> '') {
            $datas= $datas->where('sacon.kp', $kp);
        }

        if($tgl1 <> '' or $tgl2 <> ''){
            $datas= $datas->where('sacon.created_at', '>=', $tgl1.' 00:00:00' )
                          ->where('sacon.created_at', '<=', $tgl2.' 23:59:59' )
                          ->get();
        }else{
            $datas= $datas->get();
        }

        $sacon = Sacon::where('koreksi', '>', 1)->orderby('created_at')->get();
        return view('admin.laporan.laporan', compact('sacon', 'datas', 'number', 'kp', 'tgl1', 'tgl2'));
    }

    public function laporan_admin_sortir(Request $request){
        if (Auth::user()->roles->first()->name != 'Admin') {
            return redirect('/home');
        }


        if($request->btnsbmt == 1){
            $this->export($request);
        }

        if ($request->number == '' or $request->number == 'null') {
            $request->number = 100;
        }

        if ($request->kp <> '') {
            $validate = Sacon::where('kp', $request->kp)->where('koreksi', '>', 1)->get();

            if ($validate->count() == 0) {
                throw ValidationException::withMessages(['kp' => 'KP = '.$request->kp.' tidak di temukan!']);
            }
        }


        $datas = Sacon::select(
            'sacon.kp as kp',
            'sacon.item as item',
            'sacon.lot as lot',
            'sacon.lusi as lusi',
            'sacon.ball1 as ball1',
            'sacon.kg1 as kg1',
            'sacon.cones1 as cones1',
            'sacon.pakan as pakan',
            'sacon.ball2 as ball2',
            'sacon.kg2 as kg2',
            'sacon.cones2 as cones2',
            'sacon.sisir as sisir',
            'sacon.te as te',
            'sacon.w as w',
            'sacon.p as p',
            'sacon.susut as susut',
            'sacon.actual as actual',
            'sacon.koreksi as koreksi',
            DB::raw('(select users.name from users where id = sacon.user_id) as user_sacon'),
            'sacon.created_at as created_at_sacon',
            'warping.lot as lot_warping',
            'warping.nb as nb_warping',
            'warping.te as te_warping',
            'warping.p as p_warping',
            'warping.b as b_warping',
            DB::raw('(select users.name from users where id = warping.user_id) as user_warping'),
            'warping.created_at as created_at_warping',
            'indigo.lot as lot_indigo',
            'indigo.mc_idg as mc_idg_indigo',
            'indigo.nb as nb_indigo',
            'indigo.te as te_indigo',
            'indigo.w as w_indigo',
            'indigo.p as p_indigo',
            'indigo.b as b_indigo',
            DB::raw('(select users.name from users where id = indigo.user_id) as user_indigo'),
            'indigo.created_at as created_at_indigo',
            'weaving.pitem as pitem_weaving',
            'weaving.lot as lot_weaving',
            'weaving.mc as mc_weaving',
            'indigo.nb as nb_weaving',
            'weaving.pakan as pakan_weaving',
            'weaving.pick as pick_weaving',
            'weaving.sisir as sisir_weaving',
            'weaving.anyaman as anyaman_weaving',
            'weaving.potongan as potongan_weaving',
            'weaving.p as p_weaving',
            'weaving.b as b_weaving',
            'weaving.opr as opr_weaving',
            'weaving.shift as shift_weaving',
            'weaving.sn as sn_weaving',
            DB::raw('(select users.name from users where id = weaving.user_id) as user_weaving'),
            'weaving.created_at as created_at_weaving',
            'greige.shift as shift_greige',
            'greige.p as p_greige',
            'greige.b as b_greige',
            'greige.sn as sn_greige',
            'greige.potongan as potongan_greige',
            'greige.grade as grade_greige',
            'greige.opr as opr_greige',
            DB::raw('(select users.name from users where id = greige.user_id) as user_greige'),
            'greige.created_at as created_at_greige',
            'finish.title as title_finish',
            'finish.potong as potong_finish',
            'finish.lot as lot_finish',
            'finish.grade as grade_finish',
            'finish.point as point_finish',
            'finish.yds as yds_finish',
            'finish.kg as kg_finish',
            'finish.lebar as lebar_finish',
            'finish.sn as sn_finish',
            'finish.k3l as k3l_finish',
            'finish.susutlusi as susutlusi_finish',
            'finish.inisial as inisial_finish',
            'finish.k as k_finish',
            'finish.tgl as tgl_finish',
            'finish.actual as actual_finish',
            DB::raw('(select users.name from users where id = finish.user_id) as user_finish'),
            'finish.created_at as created_at_finish'
            )
            ->leftjoin('warping',function($joinwarping){
                $joinwarping->on('warping.sacon_id', 'sacon.id');
                $joinwarping->where('warping.koreksi', '>', 1);
            })  
            ->leftjoin('indigo',function($joinindigo){
                $joinindigo->on('indigo.sacon_id', 'sacon.id');
                $joinindigo->on('indigo.warping_id', 'warping.id');
                $joinindigo->where('indigo.koreksi', '>', 1);
            })
            ->leftjoin('weaving',function($joinweaving){
                $joinweaving->on('weaving.sacon_id', 'sacon.id');
                $joinweaving->on('weaving.indigo_id', 'indigo.id');
                $joinweaving->where('weaving.koreksi', '>', 1);
            })
            ->leftjoin('greige',function($joingreige){
                $joingreige->on('greige.sacon_id', 'sacon.id');
                $joingreige->on('greige.weaving_id', 'weaving.id');
                $joingreige->where('greige.koreksi', '>', 1);
            })
            ->leftjoin('finish', function($joinfinish){
                $joinfinish->on('finish.sacon_id', 'sacon.id');
                $joinfinish->on('finish.greige_id', 'greige.id');
                $joinfinish->where('finish.koreksi', '>', 1);
            })
            ->where('sacon.koreksi', '>', '1')
            ->take($request->number);

            if ($request->kp <> '') {
                $datas= $datas->where('sacon.kp', $request->kp);
            }

            if($request->tgl1 <> '' or $request->tgl2 <> ''){
                $datas= $datas->where('sacon.created_at', '>=', $request->tgl1.' 00:00:00' )
                              ->where('sacon.created_at', '<=', $request->tgl2.' 23:59:59' )
                              ->get();
            }else{
                $datas= $datas->get();
            }

        $number = $request->number;
        $kp     = $request->kp;
        $tgl1   = $request->tgl1;
        $tgl2   = $request->tgl2; 

        $sacon = Sacon::where('koreksi', '>', 1)->orderby('created_at')->get();
        return view('admin.laporan.laporan', compact('sacon', 'datas', 'number', 'kp', 'tgl1', 'tgl2'));

        // return $datas;

        // return Datatables::of($datas)
        // ->rawColumns(['id', 'action'])
        // ->addIndexColumn()
        // ->make(true); 
    }

    public function export($request){
        
        if (Auth::user()->roles->first()->name != 'Admin') {
            return redirect('/home');
        }

        if ($request->number == '' or $request->number == 'null') {
            $request->number = 100;
        }

        if ($request->kp <> '') {
            $validate = Sacon::where('kp', $request->kp)->where('koreksi', '>', 1)->get();

            if ($validate->count() == 0) {
                throw ValidationException::withMessages(['kp' => 'KP = '.$request->kp.' tidak di temukan!']);
            }
        }


        $datas = Sacon::select(
            'sacon.kp as kp',
            'sacon.item as item',
            'sacon.lot as lot',
            'sacon.lusi as lusi',
            'sacon.ball1 as ball1',
            'sacon.kg1 as kg1',
            'sacon.cones1 as cones1',
            'sacon.pakan as pakan',
            'sacon.ball2 as ball2',
            'sacon.kg2 as kg2',
            'sacon.cones2 as cones2',
            'sacon.sisir as sisir',
            'sacon.te as te',
            'sacon.w as w',
            'sacon.p as p',
            'sacon.susut as susut',
            'sacon.actual as actual',
            'sacon.koreksi as koreksi',
            DB::raw('(select users.name from users where id = sacon.user_id) as user_sacon'),
            'sacon.created_at as created_at_sacon',
            'warping.lot as lot_warping',
            'warping.nb as nb_warping',
            'warping.te as te_warping',
            'warping.p as p_warping',
            'warping.b as b_warping',
            DB::raw('(select users.name from users where id = warping.user_id) as user_warping'),
            'warping.created_at as created_at_warping',
            'indigo.lot as lot_indigo',
            'indigo.mc_idg as mc_idg_indigo',
            'indigo.nb as nb_indigo',
            'indigo.te as te_indigo',
            'indigo.w as w_indigo',
            'indigo.p as p_indigo',
            'indigo.b as b_indigo',
            DB::raw('(select users.name from users where id = indigo.user_id) as user_indigo'),
            'indigo.created_at as created_at_indigo',
            'weaving.pitem as pitem_weaving',
            'weaving.lot as lot_weaving',
            'weaving.mc as mc_weaving',
            'indigo.nb as nb_weaving',
            'weaving.pakan as pakan_weaving',
            'weaving.pick as pick_weaving',
            'weaving.sisir as sisir_weaving',
            'weaving.anyaman as anyaman_weaving',
            'weaving.potongan as potongan_weaving',
            'weaving.p as p_weaving',
            'weaving.b as b_weaving',
            'weaving.opr as opr_weaving',
            'weaving.shift as shift_weaving',
            'weaving.sn as sn_weaving',
            DB::raw('(select users.name from users where id = weaving.user_id) as user_weaving'),
            'weaving.created_at as created_at_weaving',
            'greige.shift as shift_greige',
            'greige.p as p_greige',
            'greige.b as b_greige',
            'greige.sn as sn_greige',
            'greige.potongan as potongan_greige',
            'greige.grade as grade_greige',
            'greige.opr as opr_greige',
            DB::raw('(select users.name from users where id = greige.user_id) as user_greige'),
            'greige.created_at as created_at_greige',
            'finish.title as title_finish',
            'finish.potong as potong_finish',
            'finish.lot as lot_finish',
            'finish.grade as grade_finish',
            'finish.point as point_finish',
            'finish.yds as yds_finish',
            'finish.kg as kg_finish',
            'finish.lebar as lebar_finish',
            'finish.sn as sn_finish',
            'finish.k3l as k3l_finish',
            'finish.susutlusi as susutlusi_finish',
            'finish.inisial as inisial_finish',
            'finish.k as k_finish',
            'finish.tgl as tgl_finish',
            'finish.actual as actual_finish',
            DB::raw('(select users.name from users where id = finish.user_id) as user_finish'),
            'finish.created_at as created_at_finish'
            )
            ->leftjoin('warping',function($joinwarping){
                $joinwarping->on('warping.sacon_id', 'sacon.id');
                $joinwarping->where('warping.koreksi', '>', 1);
            })  
            ->leftjoin('indigo',function($joinindigo){
                $joinindigo->on('indigo.sacon_id', 'sacon.id');
                $joinindigo->on('indigo.warping_id', 'warping.id');
                $joinindigo->where('indigo.koreksi', '>', 1);
            })
            ->leftjoin('weaving',function($joinweaving){
                $joinweaving->on('weaving.sacon_id', 'sacon.id');
                $joinweaving->on('weaving.indigo_id', 'indigo.id');
                $joinweaving->where('weaving.koreksi', '>', 1);
            })
            ->leftjoin('greige',function($joingreige){
                $joingreige->on('greige.sacon_id', 'sacon.id');
                $joingreige->on('greige.weaving_id', 'weaving.id');
                $joingreige->where('greige.koreksi', '>', 1);
            })
            ->leftjoin('finish', function($joinfinish){
                $joinfinish->on('finish.sacon_id', 'sacon.id');
                $joinfinish->on('finish.greige_id', 'greige.id');
                $joinfinish->where('finish.koreksi', '>', 1);
            })
            ->where('sacon.koreksi', '>', '1')
            ->take($request->number);

            if ($request->kp <> '') {
                $datas= $datas->where('sacon.kp', $request->kp);
            }

            if($request->tgl1 <> '' or $request->tgl2 <> ''){
                $datas= $datas->where('sacon.created_at', '>=', $request->tgl1.' 00:00:00' )
                              ->where('sacon.created_at', '<=', $request->tgl2.' 23:59:59' )
                              ->get();
            }else{
                $datas= $datas->get();
            }

        // return view('admin.laporan.export', compact('datas'));

        // Excel::create('Laporan Excel Tri Putra'.date('d-m-y H:i:s'), function($excel) use($datas){

        //     $excel->sheet('New sheet', function($sheet) use($datas){
        
        //         $sheet->loadView('admin.laporan.export', compact('datas'));
        
        //     });
        
        // })->export('xls');;
    }
}
