<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sacon;
use App\Log;
use App\Warping;
use App\Indigo;
use App\Weaving;
use App\Greige;
use App\Finish;
use Illuminate\Support\Facades\Auth;
use DNS2D;

class BarcodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function barcode_sacon(Request $request)
    {
        $sacon = Sacon::where('id', $request->idbarcode)->get();

        $create_logs                = new Log;
        $create_logs->no_bukti      = $request->idbarcode;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Print Baroce Sacon';
        $create_logs->save();

        $update_sacon           = Sacon::find($sacon->first()->id);
        $update_sacon->print    = 1;
        $update_sacon->save();

        return view('barcode.index', compact('sacon'));
    }

    public function barcode_sacon_operator2(Request $request)
    {
        $sacon = Sacon::where('id', $request->idbarcode)->where('koreksi', '>', 1)->get();

        $create_logs                = new Log;
        $create_logs->no_bukti      = $sacon->first()->item;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Print Barcode Sacon';
        $create_logs->save();

        $update_sacon           = Sacon::find($sacon->first()->id);
        $update_sacon->print    = 1;
        $update_sacon->save();

        return view('barcode.sacon', compact('sacon'));
    }

    public function barcode_warping_operator2(Request $request)
    {
        $warping = Warping::with('sacon')->with('user')->where('sacon_id', $request->idbarcode)->where('koreksi', 2)->get();

        $create_logs                = new Log;
        $create_logs->no_bukti      = $warping->first()->sacon->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Print Barcode Warping';
        $create_logs->save();

        $update_warping = Warping::where('sacon_id', $warping->first()->sacon->id);
        $update_warping->update(['print' => 1]);

        return view('barcode.warping', compact('warping'));
    }

    public function barcode_indigo_operator2(Request $request)
    {
        // $sacon = Sacon::where('id',$request->idbarcode)->get()->first();
        $indigo = Indigo::with('sacon')->where('sacon_id', $request->idbarcode)->where('koreksi', '>', 1)->get();

        $create_logs                = new Log;
        $create_logs->no_bukti      = $indigo->first()->sacon->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Print Barcode Indigo';
        $create_logs->save();

        $update_indigo = Indigo::where('sacon_id', $indigo->first()->sacon->id);
        $update_indigo->update(['print' => 1]);

        return view('barcode.indigo', compact('indigo'));
    }

    public function barcode_weaving_operator2(Request $request)
    {
        $weaving = weaving::with('sacon')->where('sacon_id', $request->idbarcode)->where('koreksi', '>', 1)->get();

        $create_logs                = new Log;
        $create_logs->no_bukti      = $weaving->first()->sacon->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Print Barcode Weaving';
        $create_logs->save();

        $update_weaving = weaving::where('sacon_id', $weaving->first()->sacon->id);
        $update_weaving->update(['print' => 1]);

        return view('barcode.weaving', compact('weaving'));
    }

    public function barcode_greige_operator2(Request $request)
    {
        $greige = Greige::with('operator')->with('sacon')->where('sacon_id', $request->idbarcode)->where('koreksi', '>', 1)->get();

        $create_logs                = new Log;
        $create_logs->no_bukti      = $greige->first()->sacon->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Print Barcode Greige';
        $create_logs->save();

        $update_greige = Greige::where('sacon_id', $greige->first()->sacon->id);
        $update_greige->update(['print' => 1]);

        return view('barcode.greige', compact('greige'));
    }

    public function barcode_finish_operator2(Request $request)
    {
        // return 'asd';

        $finish = Finish::with('operator')->with('sacon')->where('sacon_id', $request->idbarcode)->where('koreksi', '>', 1)->get();

        $create_logs                = new Log;
        $create_logs->no_bukti      = $finish->first()->sacon->kp;
        $create_logs->user_id       = Auth::user()->id;
        $create_logs->keterangan    = 'Print Barcode Finish';
        $create_logs->save();

        $update_finish = Finish::where('sacon_id', $finish->first()->sacon->id);
        $update_finish->update(['print' => 1]);

        return view('barcode.finish', compact('finish'));
    }

    public function cekbarcodeop1(Request $request)
    {
        return view('operator1.barcode.index', compact('datas'));
    }

    public function cekbarcodeop1data(Request $request)
    {
        if ($request->status == 'SACON') {
            $ceksacon = Sacon::where('kp', $request->kp)
                ->where('koreksi', '>', 1)
                ->get();

            if ($ceksacon->count() != 0) {
                return 'warping?kp=' . $request->kp;
            } else {
                return 'null';
            }
        } elseif ($request->status == 'WARPING') {
            $ceksacon = Sacon::where('kp', $request->kp)
                ->where('koreksi', '>', 2)
                ->get();

            if ($ceksacon->count() != 0) {
                return 'indigo?kp=' . $request->kp;
            } else {
                return 'null';
            }
        } elseif ($request->status == 'INDIGO') {
            $ceksacon = Sacon::where('kp', $request->kp)
                ->where('koreksi', '>', 2)
                ->get();

            if ($ceksacon->count() != 0) {
                return 'weaving?kp=' . $request->kp;
            } else {
                return 'null';
            }
        } elseif ($request->status == 'WEAVING') {
            $ceksacon = Sacon::where('kp', $request->kp)
                ->where('koreksi', '>', 2)
                ->get();

            if ($ceksacon->count() != 0) {
                return 'greige?kp=' . $request->kp;
            } else {
                return 'null';
            }
        } elseif ($request->status == 'GREIGE') {
            $ceksacon = Sacon::where('kp', $request->kp)
                ->where('koreksi', '>', 2)
                ->get();

            if ($ceksacon->count() != 0) {
                return 'finish?kp=' . $request->kp;
            } else {
                return 'null';
            }
        }else{
            return 'null';
        }

        // $ceksacon = Sacon::where('kp', $request->barcodeid)
        //             ->where('koreksi', 2)
        //             ->get();

        // if ($ceksacon->count() != 0) {
        //     return 'warping';
        // }

        // $cekwarping = Sacon::where('kp', $request->barcodeid)
        //             ->where('koreksi', 3)
        //             ->get();

        // if($cekwarping->count() != 0){
        //     return 'indigo';
        // }

        // $weaving = Sacon::where('kp', $request->barcodeid)
        //             ->where('koreksi', 4)
        //             ->get();

        // if ($weaving->count() !=0) {
        //     return 'weaving';
        // }

        // $greige = Sacon::where('kp', $request->barcodeid)
        //             ->where('koreksi', '>', 4)
        //             ->get();

        // if ($greige->count() !=0) {
        //     return 'greige';
        // }

        // $finish = Sacon::where('kp', $request->barcodeid)
        //             ->where('koreksi', '>', 5)
        //             ->get();

        // if ($finish->count() !=0) {
        //     return 'finish';
        // }

        // if ($cekindigo->count() !=0) {
        //     return 'done';
        // }

        return 'blank';
    }

    public function cekbarcode_warping(Request $request)
    {
        $sacon = Sacon::where('kp', $request->kp)->where('koreksi', '>', 1)->first();

        if ($sacon == '' or $sacon == null) {
            return 'fail';
        }

        $validate = Warping::where('id', $request->id)->where('koreksi', 2)->get();

        if ($validate->count() == 0) {
            return 'fail';
        }

        $update = Warping::find($request->id);
        if ($update->status == 0) {
            $update->status = 1;
            $update->save();

            return 'ok|0';
        }

        $cekall = Warping::where('sacon_id', $request->sacon_id)
            ->where('koreksi', 2)
            ->where('status', 0)
            ->get();

        if ($cekall->count() > 0) {
            return 'ok|0';
        }else{
            return 'move|indigo/create?kp='.$request->kp.'&warping_id='.$request->id;
        }

    }

    public function cekbarcode_indigo(Request $request)
    {
        $sacon = Sacon::where('kp', $request->kp)->where('koreksi', '>', 1)->first();

        if ($sacon == '' or $sacon == null) {
            return 'fail';
        }

        $validate = Indigo::where('id', $request->id)->where('koreksi', 2)->get();

        if ($validate->count() == 0) {
            return 'fail';
        }

        $update = Indigo::find($request->id);
        $update->status = 1;
        $update->save();

        return 'ok|weaving/create?kp='.$request->kp.'&nb='.$update->nb;
    }

    public function cekbarcode_weaving(Request $request)
    {
        $sacon = Sacon::where('kp', $request->kp)->where('koreksi', '>', 1)->first();

        if ($sacon == '' or $sacon == null) {
            return 'fail';
        }

        $validate = Weaving::where('id', $request->id)->where('koreksi', 2)->get();

        if ($validate->count() == 0) {
            return 'fail';
        }

        $update = Weaving::find($request->id);
        $update->status = 1;
        $update->save();

        return 'ok|greige/create?kp='.$request->kp.'&weaving_id='.$update->id;
    }

    public function cekbarcode_greige(Request $request)
    {
        $sacon = Sacon::where('kp', $request->kp)->where('koreksi', '>', 1)->first();

        if ($sacon == '' or $sacon == null) {
            return 'fail';
        }

        $validate = Greige::where('id', $request->id)->where('koreksi', 2)->get();

        if ($validate->count() == 0) {
            return 'fail';
        }

        $update = Greige::find($request->id);
        $update->status = 1;
        $update->save();

        return 'ok|finish/create?kp='.$request->kp.'&greige_id='.$update->id;
    }
}
