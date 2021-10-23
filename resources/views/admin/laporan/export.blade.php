
<table>
<tr>
    <th colspan="77" align="center">LAPORAN ARTIKEL TRI PUTRA</th>
</tr>
<tr></tr>
</table>
<style>
    table, th, td {
    border: 1px solid #000000;
    }
</style>
<table>
    <thead style="font-weight: bold;">
    <tr>
        <th rowspan="2" style="vertical-align : middle;text-align:center;">
            No
        </th>
        <th colspan="19" align="center">
            <center>Sacon</center>
        </th>
        <th colspan="7" align="center" >
            <center>Warping</center>
        </th>
        <th colspan="9" align="center" >
            <center>Indigo</center>
        </th>
        <th colspan="16" align="center" >
            <center>Weaving</center>
        </th>
        <th colspan="9" align="center" >
            <center>Greige</center>
        </th>
        <th colspan="17" align="center" >
            <center>Finish</center>
        </th>
    </tr>
    <tr>
        <th >

        </th>
        {{-- SACON --}}
        <th >
            KP
        </th>
        <th >
            Item
        </th>
        <th>
            LOT
        </th>
        <th >
            Lusi
        </th>
        <th>
            ball
        </th>
        <th>
            KG
        </th>
        <th>
            cones
        </th>
        <th >
            Pakan
        </th>
        <th>
            ball
        </th>
        <th>
            KG
        </th>
        <th>
            cones
        </th>
        <th >
            Sisir
        </th>
        <th >
            TE
        </th>
        <th >
            Warna
        </th>
        <th >
            Panjang
        </th>
        <th>
            Susut
        </th>
        <th>
            Actual
        </th>
        <th >
            Author
        </th>
        <th >
            Tanggal
        </th>
        {{-- WARPING --}}
        <th>
            LOT
        </th>
        <th >
            No Beam 
        </th>
        <th>
            TE
        </th>
        <th >
            Panjang
        </th>
        <th >
            Berat
        </th>
        <th >
            Author
        </th>
        <th >
            Tanggal
        </th>
        {{-- INDIGO --}}
        <th>
            LOT
        </th>
        <th >
            MC IDG
        </th>
        <th >
            No Beam
        </th>
        <th>
            TE
        </th>
        <th >
            Warna
        </th>
        <th >
            Panjang
        </th>
        <th >
            Berat
        </th>
        <th >
            Author
        </th>
        <th >
            Tanggal
        </th>
        {{-- WEAVING --}}
        <th>
            P Item
        </th>
        <th>
            LOT
        </th>
        <th >
            MC
        </th>
        <th >
            No Beam
        </th>
        <th>
            Pakan
        </th>
        <th>
            Pick
        </th>
        <th>
            Sisir
        </th>
        <th>
            Anyaman
        </th>
        <th >
            Potongan
        </th>
        <th >
            Panjang
        </th>
        <th>
            Berat
        </th>
        <th>
            OPR
        </th>
        <th>
            Shift
        </th>
        <th >
            SN
        </th>
        <th >
            Author
        </th>
        <th >
            Tanggal
        </th>
        {{-- GREIGE --}}
        <th >
            Shift
        </th>
        <th >
            Panjang
        </th>
        <th >
            Berat
        </th>
        <th>
            SN
        </th>
        <th>
            Potongan
        </th>
        <th>
            Grade
        </th>
        <th>
            OPR
        </th>
        <th >
            Author
        </th>
        <th >
            Tanggal
        </th>
        {{-- FINISH --}}
        <th>
            Title
        </th>
        <th>
            Potong
        </th>
        <th>
            LOT
        </th>
        <th>
            Grade
        </th>
        <th>
            Point
        </th>
        <th>
            YDS
        </th>
        <th>
            KG
        </th>
        <th>
            Lebar
        </th>
        <th>
            SN
        </th>
        <th>
            K3l
        </th>
        <th>
            Susut Lusi
        </th>
        <th>
            Inisial
        </th>
        <th>
            K
        </th>
        <th>
            Actual
        </th>
        <th>
            TGL
        </th>
        <th>
            Author
        </th>
        <th>
            Tanggal
        </th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;    
    @endphp
    @foreach($datas as $data)
        <tr>
            <td>
                {{ $i }}
                @php
                    $i++;
                @endphp
            </td>
            {{-- SACON --}}
            </td>
            {{-- SACON --}}
            <td >
                {{ $data->kp }}
            </td>
            <td >
                {{ $data->item }}
            </td>
            <td>
                {{ $data->lot }}
            </td>
            <td >
                {{ $data->lusi }}
            </td>
            <td>
                {{ $data->ball1 }}
            </td>
            <td>
                {{ $data->kg1 }}
            </td>
            <td>
                {{ $data->cones1 }}
            </td>
            <td >
                {{ $data->pakan }}
            </td>
            <td>
                {{ $data->ball2 }}
            </td>
            <td>
                {{ $data->kg2 }}
            </td>
            <td>
                {{ $data->cones2 }}
            </td>
            <td >
                {{ $data->sisir }}
            </td>
            <td >
                {{ $data->te }}
            </td>
            <td >
                {{ $data->w }}
            </td>
            <td >
                {{ $data->p }}
            </td>
            <td>
                {{ $data->susut }}
            </td>
            <td>
                {{ $data->actual }}
            </td>
            <td >
                {{ $data->user_sacon }}
            </td>
            <td >
                {{ $data->created_at_sacon }}
            </td>
            {{-- WARPING --}}
            <td>
                {{ $data->lot_warping }}
            </td>
            <td >
                {{ $data->nb_warping }}
            </td>
            <td>
                {{ $data->te_warping }}
            </td>
            <td >
                {{ $data->p_warping }}
            </td>
            <td >
                {{ $data->b_warping }}
            </td>
            <td >
                {{ $data->user_warping }}
            </td>
            <td >
                {{ $data->created_at_warping }}
            </td>
            {{-- INDIGO --}}
            <td>
                {{ $data->lot_indigo }}
            </td>
            <td >
                {{ $data->mc_idg_indigo }}
            </td>
            <td >
                {{ $data->nb_indigo }}
            </td>
            <td>
                {{ $data->te_indigo }}
            </td>
            <td >
                {{ $data->w_indigo }}
            </td>
            <td >
                {{ $data->p_indigo }}
            </td>
            <td >
                {{ $data->b_indigo }}
            </td>
            <td >
                {{ $data->user_indigo }}
            </td>
            <td >
                {{ $data->created_at_indigo }}
            </td>
            {{-- WEAVING --}}
            <td>
                {{ $data->pitem_weaving }}
            </td>
            <td>
                {{ $data->lot_weaving }}
            </td>
            <td >
                {{ $data->mc_weaving }}
            </td>
            <td >
                {{ $data->nb_weaving }}
            </td>
            <td>
                {{ $data->pakan_weaving }}
            </td>
            <td>
                {{ $data->pick_weaving }}
            </td>
            <td>
                {{ $data->sisir_weaving }}
            </td>
            <td>
                {{ $data->anyaman_weaving }}
            </td>
            <td >
                {{ $data->potongan_weaving }}
            </td>
            <td >
                {{ $data->p_weaving }}
            </td>
            <td>
                {{ $data->b_weaving }}
            </td>
            <td>
                {{ $data->opr_weaving }}
            </td>
            <td>
                {{ $data->shift_weaving }}
            </td>
            <td >
                {{ $data->sn_weaving }}
            </td>
            <td >
                {{ $data->user_weaving }}
            </td>
            <td >
                {{ $data->created_at_weaving }}
            </td>
            {{-- GREIGE --}}
            <td >
                {{ $data->shift_greige }}
            </td>
            <td >
                {{ $data->p_greige }}
            </td>
            <td >
                {{ $data->b_greige }}
            </td>
            <td>
                {{ $data->sn_greige }}
            </td>
            <td>
                {{ $data->potongan_greige }}
            </td>
            <td>
                {{ $data->grade_greige }}
            </td>
            <td>
                {{ $data->opr_greige }}
            </td>
            <td >
                {{ $data->user_greige }}
            </td>
            <td >
                {{ $data->created_at_greige }}
            </td>
            {{-- FINISH --}}
            <td>
                {{ $data->title_finish }}
            </td>
            <td>
                {{ $data->potong_finish }}
            </td>
            <td>
                {{ $data->lot_finish }}
            </td>
            <td>
                {{ $data->grade_finish }}
            </td>
            <td>
                {{ $data->point_finish }}
            </td>
            <td>
                {{ $data->yds_finish }}
            </td>
            <td>
                {{ $data->kg_finish }}
            </td>
            <td>
                {{ $data->lebar_finish }}
            </td>
            <td>
                {{ $data->sn_finish }}
            </td>
            <td>
                {{ $data->k3l_finish }}
            </td>
            <td>
                {{ $data->susutlusi_finish }}
            </td>
            <td>
                {{ $data->inisial_finish }}
            </td>
            <td>
                {{ $data->k_finish }}
            </td>
            <td>
                {{ $data->actual_finish }}
            </td>
            <td>
                {{ $data->tgl_finish }}
            </td>
            <td>
                {{ $data->user_finish }}
            </td>
            <td>
                {{ $data->created_at_finish }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>