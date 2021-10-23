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
                Shift
            </th>
            <th>
                No Beam
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
                SN
            </th>
            <th>
                Grade
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
                    {{ $item->shift }}
                </td>
                <td>
                    {{ $item->weaving->nb }}
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
                    {{ $item->sn }}
                </td>
                <td>
                    {{ $item->grade }}
                </td>
                <td>
                    {{ $item->opr }}
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