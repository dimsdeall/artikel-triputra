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
                Lusi
            </th>
            <th>
                Ball
            </th>
            <th>
                KG
            </th>
            <th>
                Cones
            </th>
            <th>
                Pakan
            </th>
            <th>
                Ball
            </th>
            <th>
                KG
            </th>
            <th>
                Cones
            </th>
            <th>
                Sisir
            </th>
            <th>
                Te
            </th>
            <th>
                Warna
            </th>
            <th>
                Panjang
            </th>
            <th>
                Susut
            </th>
            <th>
                Actual
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
                    {{ $item->kp }}
                </td>
                <td>
                    {{ $item->item }}
                </td>
                <td>
                    {{ $item->lot }}
                </td>
                <td>
                    {{ $item->lusi }}
                </td>
                <td>
                    {{ $item->ball1 }}
                </td>
                <td>
                    {{ $item->kg1 }}
                </td>
                <td>
                    {{ $item->cones1 }}
                </td>
                <td>
                    {{ $item->pakan }}
                </td>
                <td>
                    {{ $item->ball2 }}
                </td>
                <td>
                    {{ $item->kg2 }}
                </td>
                <td>
                    {{ $item->cones2 }}
                </td>
                <td>
                    {{ $item->sisir }}
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
                    {{ $item->susut }}
                </td>
                <td>
                    {{ $item->actual }}
                </td>
                <td>
                    {{ $item->users->name }}
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
