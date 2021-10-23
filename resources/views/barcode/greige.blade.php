<style>
    @media print {
        .pagebreak {
            page-break-after: always;
        }

        /* page-break-after works, as well */
    }

    .padbtm {
        padding-bottom: 0.17cm;
    }

    table {
        font-weight: bold;
        padding: 0;
        white-space: nowrap;
        font-size: 18px;
    }

    /* table, th, td {
        border: 1px solid black;
    } */

</style>
@php
$i = 0;
@endphp
@foreach ($greige as $data)
    @if ($i != 0)
        <h3 style="text-align: center; margin-top: 0.2cm">&nbsp;</h3>
    @else
        <h3 style="text-align: center;">&nbsp;</h3>
    @endif
    <table style="width: 10cm">
        <tr>
            <td class="padbtm">
                KP
            </td>
            <td class="padbtm">
                {{ ': ' . $data->sacon->kp }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                ITEM
            </td>
            <td class="padbtm">
                {{ ': ' . $data->sacon->item }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                LOT
            </td>
            <td class="padbtm">
                {{ ': ' . $data->sacon->lot }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                POT
            </td>
            <td class="padbtm">
                {{ ': ' . $data->potongan }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                P
            </td>
            <td class="padbtm">
                {{ ': ' . $data->p . ' Mtr' }}
            </td>
            <td rowspan="3" style="text-align: center">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->sacon->kp . '|GREIGE|' . $data->id, 'QRCODE') }}"
                    height="80" width="80">
                <br>
                <p style="font-size: 12">{{ $data->sacon->kp }}</p>
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                B
            </td>
            <td class="padbtm">
                {{ ': ' . $data->b . ' Kg' }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                OPR
            </td>
            <td class="padbtm">
                {{ ': ' . $data->opr }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                SHIFT
            </td>
            <td class="padbtm">
                {{ ': ' . $data->shift }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                SN
            </td>
            <td class="padbtm">
                {{ ': ' . $data->sn }}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: center">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->sacon->kp . '|GREIGE|' . $data->id, 'QRCODE') }}"
                    height="80" width="80">
                <br>
                <p style="font-size: 12">{{ $data->sacon->kp }}</p>
            </td>
        </tr>
    </table>
    @if ($greige->count() - 1 != $i)
        <div class="pagebreak"></div>
    @endif
    @php
        $i++;
    @endphp
@endforeach

<script type="text/javascript">
    print();

</script>
