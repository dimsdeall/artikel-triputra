<table>
    <tr>
        <th colspan="17" align="center">LAPORAN ARTIKEL TRI PUTRA</th>
    </tr>
    <tr></tr>
</table>

<style>
    table, th, td {
    border: 1px solid #000000;
    }
</style>

<table>
    <thead>
        <tr>
            <th>
                KP
            </th>
            <th>
                Item
            </th>
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
                Inisial
            </th>
            <th>
                Susut Lusi
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
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>
                {{ $data->sacon->kp }}
            </td>
            <td>
                {{ $data->sacon->item }}
            </td>
            <td>
                {{ $data->title }}
            </td>
            <td>
                {{ $data->greige->potongan }}
            </td>
            <td>
                {{ $data->lot }}
            </td>
            <td>
                {{ $data->grade }}
            </td>
            <td>
                {{ $data->point }}
            </td>
            <td>
                {{ $data->yds }}
            </td>
            <td>
                {{ $data->kg }}
            </td>
            <td>
                {{ $data->lebar }}
            </td>
            <td>
                {{ $data->sn }}
            </td>
            <td>
                {{ $data->k3l }}
            </td>
            <td>
                {{ $data->inisial }}
            </td>
            <td>
                {{ $data->susutlusi }}
            </td>
            <td>
                {{ $data->k }}
            </td>
            <td>
                {{ $data->actual }}
            </td>
            <td>
                {{ $data->tgl }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

