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
                P Item
            </th>
            <th>
                LOT
            </th>
            <th>
                MC
            </th>
            <th>
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
            <th>
                Potongan
            </th>
            <th>
                Panjang
            </th>
            <th>
                Berat
            </th>
            <th>
                Shift
            </th>
            <th>
                SN
            </th>
            <th>
                OPR
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
                    {{ $item->pitem }}
                </td>
                <td>
                    {{ $item->lot }}
                </td>
                <td>
                    {{ $item->mc }}
                </td>
                <td>
                    {{ $item->nb }}
                </td>
                <td>
                    {{ $item->pakan }}
                </td>
                <td>
                    {{ $item->pick }}
                </td>
                <td>
                    {{ $item->sisir }}
                </td>
                <td>
                    {{ $item->anyaman }}
                </td>
                <td>
                    {{ $item->potongan }}
                </td>
                <td>
                    {{ $item->p }}
                </td>
                <td>
                    {{ $item->b }}
                </td>
                <td>
                    {{ $item->shift }}
                </td>
                <td>
                    {{ $item->sn }}
                </td>
                <td>
                    {{ $item->operator }}
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