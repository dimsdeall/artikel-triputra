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
                LOT
            </th>
            <th>
                MC IDG
            </th>
            <th>
                No Beam
            </th>
            <th>
                TE
            </th>
            <th>
                Warna
            </th>
            <th>
                Panjang
            </th>
            <th>
                Berat
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
                    {{ $item->lot }}
                </td>
                <td>
                    {{ $item->mc_idg }}
                </td>
                <td>
                    {{ $item->nb }}
                </td>
                <td>
                    {{ $item->te }}
                </td>
                <td>
                    {{ $item->w }}
                </td>
                <td>
                    {{ $item->p }}
                </td>
                <td>
                    {{ $item->b }}
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