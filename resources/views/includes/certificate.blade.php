<html>

<head>
    <style type='text/css'>
        * {
            box-sizing: border-box;
        }

        .bt {
            border-left: 2px solid #000;
        }

        .br {
            border-right: 2px solid #000;
        }

        .bu {
            border-top: 2px solid #000;
        }

        .bb {
            border-bottom: 2px solid #000;
            border-r
        }
    </style>
</head>

<body class='bg-grid-line'>
    <div class='card'>
        <table border="0" cellpadding="0" cellspacing="0" style="width:340px">
            <tbody>
                <tr>
                    <td style="width:25px">&nbsp;</td>
                    <td style="width:25px">&nbsp;</td>
                    <td style="width:25px">&nbsp;</td>
                    <td style="width:25px">&nbsp;</td>
                    <td style="background-color:#cc9900; text-align:center; vertical-align:middle; width:160px">&nbsp;
                    </td>
                    <td style="width:25px">&nbsp;</td>
                    <td style="width:25px">&nbsp;</td>
                    <td style="width:25px">&nbsp;</td>
                    <td style="width:25px">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="1" style="width:25px">&nbsp;</td>
                    <td style="width:25px">&nbsp;</td>
                    <td style="background-color:#cc9900; text-align:center; vertical-align:middle; width:100px"><img
                            alt="" src="{{ asset('images/logo.png') }}" style="height:65px; width:65px" /></td>
                    <td style="width:25px">&nbsp;</td>
                    <td colspan="3" rowspan="1" style="text-align:center; width:25px"><img alt=""
                            src="{{ asset('images/squars.png') }}" style="height:83px; width:90px" /></td>
                </tr>
                <tr>
                    <td rowspan="2" style="width:25px">&nbsp;</td>
                    <td colspan="3" rowspan="3" style="width:25px">&nbsp;</td>
                    <td style="background-color:#cc9900; text-align:center; vertical-align:middle; width:100px">
                        <h3><strong><span style="font-size:18px">BEST SCHOOL</span></strong></h3>
                    </td>
                    <td class="bu br" colspan="3" rowspan="3" style="width:25px">&nbsp;</td>
                    <td rowspan="2" style="width:25px">&nbsp;</td>
                </tr>
                <tr style="font-size:5px">
                    <td style="text-align:center; vertical-align:middle; width:100px">&nbsp;</td>
                </tr>
                <tr style="font-size:5px">
                    <td style="width:25px">&nbsp;</td>
                    <td style="text-align:center; vertical-align:middle; width:100px">&nbsp;</td>
                    <td style="width:25px">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3" style="text-align:center; vertical-align:bottom; width:25px"><img
                            alt="" src="{{ asset('images/vtriangles.png') }}"
                            style="height:110px; width:80px" /></td>
                    <td style="width:25px">&nbsp;</td>
                    <td colspan="3" rowspan="3" style="text-align:center; vertical-align:middle;"><img
                            alt="" src="{{ asset('images/students/' . $eleve->avatar) }}"
                            style="border:3px solid #cc9900; height:160px; border-radius: 50px;" />
    </div>
    </td>
    <td style="width:25px">&nbsp;</td>
    <td class="br" style="width:25px">&nbsp;</td>
    <td colspan="1" style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2" rowspan="9" style="text-align:center; vertical-align:bottom; width:25px"><img
                alt="" src="{{ asset('images/vbars.png') }}" style="height:200px;" /></td>
        <td style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td style="text-align:center; vertical-align:middle; width:100px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" rowspan="1" style="text-align:center; width:25px"><span
                style="font-size:18px"><strong>{{ strtoupper($eleve->nom_fr . ' ' . $eleve->prenom_fr) }}</strong></span>
        </td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td style="text-align:center; width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td style="text-align:center; vertical-align:middle; width:100px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" rowspan="1" style="text-align:center; width:25px"><span
                style="font-size:18px">{{ $eleve->date_nais }}</span></td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td style="text-align:center; width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td style="text-align:center; vertical-align:middle; width:100px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" rowspan="1" style="text-align:center; width:25px"><span
                style="font-size:22px">{{ $eleve->niveau->nom }}</span></td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" rowspan="1" style="text-align:center; width:25px"><span style="font-size:10px">Code
                Massar : </span></td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" rowspan="1" style="text-align:center; width:25px"><span
                style="font-size:16px">{{ strtoupper($eleve->massar) }}</span></td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" rowspan="1" style="text-align:center; width:25px">
            <span style="font-size:14px">{{ $eleve->date_inscription }}</span>
        </td>
        <td class="br" style="width:25px">&nbsp;</td>
        <td style="width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td class="br" style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; text-align:center; vertical-align:middle; width:100px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td class="bb br" colspan="2" rowspan="2" style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td class="br" style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td class="bb" style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td class="bb" style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td class="bb" style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td class="bb" style="background-color:#cc9900; text-align:center; vertical-align:middle; width:100px">
            &nbsp;</td>
        <td class="bb" style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
    </tr>
    <tr>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; text-align:center; vertical-align:middle; width:100px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
        <td style="background-color:#cc9900; width:25px">&nbsp;</td>
    </tr>
    </tbody>
    </table>

    <p>&nbsp;</p>

    </div>
</body>

</html>
