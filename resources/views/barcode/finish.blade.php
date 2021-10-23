<style>
    @media print {
        .pagebreak {
            page-break-after: always;
        }

        /* page-break-after works, as well */
    }

    .padbtm {
        padding-bottom: 0.55cm;
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
@foreach ($finish as $data)
    @if ($i != 0)
        <h1 style="text-align: center; margin-top: 0.2cm">{{ $data->title }}</h1>
    @else
        <h1 style="text-align: center;">{{ $data->title }}</h1>
    @endif
    <table style="width: 10cm;margin-top: -0.6cm">
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
                CODE
            </td>
            <td class="padbtm">
                {{ ': ' . $data->sacon->item }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                GRADE
            </td>
            <td class="padbtm">
                {{ ': ' . $data->grade }}
            </td>
            <td class="padbtm">
                {{ $data->lot }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                QTY (YDS)
            </td>
            <td class="padbtm">
                {{ ': ' . $data->yds }}
            </td>
            <td class="padbtm">
                {{ $data->point }}
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                WEIGHT (KG)
            </td>
            <td class="padbtm">
                {{ ': ' . $data->kg }}
            </td>
            <td rowspan="2" style="text-align: center">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->sacon->kp . '|FINISH|' . $data->id, 'QRCODE') }}"
                    height="80" width="80">
                <br>
                <p style="font-size: 12">{{ $data->lebar }}</p>
                <p style="font-size: 12">{{ $data->inisial }}</p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->sacon->kp . '|FINISH|' . $data->id, 'QRCODE') }}"
                    height="80" width="80">
                <p style="font-size: 12">{{ $data->sn }}</p>
            </td>
        </tr>
        <tr>
            <td class="padbtm" colspan="2">
                Registrasi Barang K3L
            </td>
            <td class="padbtm">
                {{ ': ' . $data->k3l }}
            </td>
    </table>
    <table style="width: 100%;padding-top: 0.5cm">
        <tr>
            <td class="padbtm">
                KP
            </td>
            <td class="padbtm">
                {{ ': ' . $data->sacon->kp }}
            </td>
            <td rowspan="3" style="text-align: center">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->sacon->kp . '|FINISH|' . $data->id, 'QRCODE') }}"
                    height="80" width="80">
                <p style="font-size: 12">{{ $data->sacon->kp }}</p>
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                ITEM
            </td>
            <td class="padbtm">
                {{ ': ' . $data->sacon->kp }}
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
    </table>
    <table style="width: 100%;padding-top: 0.5cm">
        <tr>
            <td rowspan="3" style="text-align: center">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->sacon->kp . '|FINISH|' . $data->id, 'QRCODE') }}"
                    height="80" width="80">
                <p style="font-size: 12">{{ $data->sacon->kp }}</p>
            </td>
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
                {{ ': ' . $data->sacon->kp }}
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
    </table>
    @if ($finish->count() - 1 != $i)
        <div class="pagebreak"></div>
    @endif
    @php
        $i++;
    @endphp
@endforeach

<script type="text/javascript">
    print();

</script>
