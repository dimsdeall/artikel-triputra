<table>
    <thead>
        <tr>
            <th>
                no
            </th>
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
            <th>
                Author
            </th>
            <th>
                Print
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
        @foreach ($datas as $item)
            <tr>
                <td>
                    {{ $i }}
                </td>
                <td>
                    {{ $item->sacon->kp }}
                </td>
                <td>
                    {{ $item->sacon->item }}
                </td>
                <td>
                    {{ $item->title }}
                </td>
                <td>
                    {{ $item->potong }}
                </td>
                <td>
                    {{ $item->lot }}
                </td>
                <td>
                    {{ $item->grade }}
                </td>
                <td>
                    {{ $item->point }}
                </td>
                <td>
                    {{ $item->yds }}
                </td>
                <td>
                    {{ $item->kg }}
                </td>
                <td>
                    {{ $item->lebar }}
                </td>
                <td>
                    {{ $item->sn }}
                </td>
                <td>
                    {{ $item->k3l }}
                </td>
                <td>
                    {{ $item->inisial }}
                </td>
                <td>
                    {{ $item->susutlusi }}
                </td>
                <td>
                    {{ $item->k }}
                </td>
                <td>
                    {{ $item->actual }}
                </td>
                <td>
                    {{ $item->tgl }}
                </td>
                <td>
                    {{ $item->user->name }}
                </td>
                <td>
                    @if ($item->print == 0)
                        Belum Print
                    @else
                        Sudah Print
                    @endif
                </td>
                <td>
                    {{ date_format($item->created_at,'d-M-Y h:i:s') }}
                </td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
    </tbody>
</table>