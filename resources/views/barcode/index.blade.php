<style>
@media all {
    .page-break { display: none; }
}

@media print {
    .page-break { display: block; page-break-before: always; }
}

.padbtm{ padding-bottom: 0.3cm;}
</style>
@foreach ($sacon as $data)
<center>
    <h1>SINARAN</h1>
</center>
<table>
    <tr>
        <td class="padbtm">
            KP
        </td>
        <td class="padbtm">
            {{ ': '.$data->kp }}
        </td>
    </tr>
    <tr>
        <td class="padbtm">
            Code
        </td>
        <td class="padbtm">
            {{ ': '.$data->sisir }}
        </td>
        <td class="padbtm">
            SC M1
        </td>
    </tr>
    <tr>
        <td>
            Grade
        </td>
        <td>
            {{ ': '.$data->w }}
        </td>
        <td>
            LOT P049
        </td>
    </tr>
    <tr>
        <td>
            QTY(YD)
        </td>
        <td>
            {{ ': '.$data->te }}
        </td>
        <td rowspan="2" align="right" style="width: 2.5cm">
            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->item, 'QRCODE')}}" height="60" width="60">
        </td>
    </tr>
    <tr>
        <td>
            WEIGHT(KG)
        </td>
        <td>
            {{ ': '.$data->j }}
        </td>
    </tr>
    <tr>
        <td align="center">
            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->item, 'QRCODE')}}" height="60" width="60">
            <br>
            asd
        </td>
    </tr>
    <tr>
        <td>
            AR:EL
        </td>
        <td></td>
        <td>
            1.212DS3/343
        </td>
    </tr>
</table>
<div class="page-break"></div>
@endforeach

@foreach ($sacon as $data)
<center>
    <h1>SINARAN</h1>
</center>
<table>
    <tr>
        <td class="padbtm">
            KP
        </td>
        <td class="padbtm">
            {{ ': '.$data->kp }}
        </td>
    </tr>
    <tr>
        <td class="padbtm">
            Code
        </td>
        <td class="padbtm">
            {{ ': '.$data->sisir }}
        </td>
        <td class="padbtm">
            SC M1
        </td>
    </tr>
    <tr>
        <td>
            Grade
        </td>
        <td>
            {{ ': '.$data->w }}
        </td>
        <td>
            LOT P049
        </td>
    </tr>
    <tr>
        <td>
            QTY(YD)
        </td>
        <td>
            {{ ': '.$data->te }}
        </td>
        <td rowspan="2" align="right" style="width: 2.5cm">
            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->item, 'QRCODE')}}" height="60" width="60">
        </td>
    </tr>
    <tr>
        <td>
            WEIGHT(KG)
        </td>
        <td>
            {{ ': '.$data->j }}
        </td>
    </tr>
    <tr>
        <td align="center">
            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->item, 'QRCODE')}}" height="60" width="60">
            <br>
            asd
        </td>
    </tr>
    <tr>
        <td>
            AR:EL
        </td>
        <td></td>
        <td>
            1.212DS3/343
        </td>
    </tr>
</table>
@endforeach

<script type="text/javascript">
    print();
</script>