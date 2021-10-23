<style>
    @media all {
        .page-break {
            display: none;
        }
    }

    @media print {
        .page-break {
            display: block;
            page-break-after: always;
        }
    }

    .padbtm {
        padding-bottom: 0.1cm;
        width: 2cm;
    }

    table{
        font-weight: bold;
        padding: 0;
        white-space: nowrap;
        font-size: 18px;
    }
    /* table, th, td {
        border: 1px solid black;
        } */

</style>
@foreach ($sacon as $data)
    <h3 style="text-align: center">&nbsp;</h3>
    <table style="width: 10cm;">
        <tr>
            <td class="padbtm">
                KP
            </td>
            <td colspan="2">
                {{ ': ' . $data->kp }}
            </td>
            
        </tr>
        <tr>
            <td class="padbtm">
                ITEM
            </td>
            <td colspan="2">
                {{ ': ' . $data->item }}
            </td>
            
        </tr>
        <tr>
            <td class="padbtm">
                LOT
            </td>
            <td colspan="2">
                {{ ': ' . $data->lot }}
            </td>
            
        </tr>
        <tr>
            <td class="padbtm">
                NE
            </td>
            <td colspan="2">
                {{ ': L : ' . $data->lusi }}
            </td>
            
        </tr>
        <tr>
            <td class="padbtm">
                &nbsp;
            </td>
            <td colspan="2">
                {{ ': P : ' . $data->pakan }}
            </td>
            
        </tr>
        <tr>
            <td class="padbtm">
                SISIR
            </td>
            <td colspan="2">
                {{ ': ' . $data->sisir }}
            </td>
            
        </tr>
        <tr>
            <td class="padbtm">
                TE
            </td>
            <td>
                {{ ': ' . $data->te }}
            </td>
            <td rowspan="3" style="vertical-align: top; text-align: center">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->kp . '|SACON|' . $data->id, 'QRCODE') }}"
                    height="80" width="80">
                <br>
                <p style="font-size: 12">{{ $data->item }}</p>
            </td>
        </tr>
        <tr>
            <td class="padbtm">
                WARNA
            </td>
            <td>
                {{ ': ' . $data->w }}
            </td>
        </tr>
        <tr>
            <td class="padbtm" align="left" valign='top'>
                PANJANG
            </td>
            <td align="left" valign='top'>
                {{ ': ' . $data->p }}
            </td>
        </tr>
        <tr>
            <td style="padding-top: 1cm" colspan="2">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($data->kp . '|SACON|' . $data->id, 'QRCODE') }}"
                    height="80" width="80">
                <br>
                <p style="font-size: 12">{{ $data->item }}</p>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
@endforeach

<script type="text/javascript">
    print();

</script>
