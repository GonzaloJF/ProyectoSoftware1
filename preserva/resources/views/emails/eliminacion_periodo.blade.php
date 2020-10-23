<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <!--[if !mso]--><!-- -->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel="stylesheet">
    <!-- <![endif]-->

    <title>Eliminacion periodo</title>

    <style type="text/css">
        body {
            width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt: 0px;
            mso-margin-bottom-alt: 0px;
            mso-padding-alt: 0px 0px 0px 0px;
        }
        
        p,
        h1,
        h2,
        h3,
        h4 {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
        
        span.preheader {
            display: none;
            font-size: 1px;
        }
        
        html {
            width: 100%;
        }
        
        table {
            font-size: 14px;
            border: 0;
        }
        /* ----------- responsivity ----------- */
        
        @media only screen and (max-width: 640px) {
            /*------ top header ------ */
            .main-header {
                font-size: 20px !important;
            }
            .main-section-header {
                font-size: 28px !important;
            }
            .show {
                display: block !important;
            }
            .hide {
                display: none !important;
            }
            .align-center {
                text-align: center !important;
            }
            .no-bg {
                background: none !important;
            }
            /*----- main image -------*/
            .main-image img {
                width: 440px !important;
                height: auto !important;
            }
            /* ====== divider ====== */
            .divider img {
                width: 440px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 440px !important;
            }
            .container580 {
                width: 400px !important;
            }
            .main-button {
                width: 220px !important;
            }
            /*-------- secions ----------*/
            .section-img img {
                width: 320px !important;
                height: auto !important;
            }
            .team-img img {
                width: 100% !important;
                height: auto !important;
            }
        }
        
        @media only screen and (max-width: 479px) {
            /*------ top header ------ */
            .main-header {
                font-size: 18px !important;
            }
            .main-section-header {
                font-size: 26px !important;
            }
            /* ====== divider ====== */
            .divider img {
                width: 280px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 280px !important;
            }
            .container590 {
                width: 280px !important;
            }
            .container580 {
                width: 260px !important;
            }
            /*-------- secions ----------*/
            .section-img img {
                width: 280px !important;
                height: auto !important;
            }
        }
    </style>
    <!-- [if gte mso 9]><style type=”text/css”>
        body {
        font-family: arial, sans-serif!important;
        }
        </style>
    <![endif]-->
</head>

    <body style="background-color:#5caad2">
        <div class="card row">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
                    <br><br><br><br><br><br>

                    <tr>
                        <td align="center">
                            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
            
                                <tr>
                                    <td align="justify-content" style="color: #343434; font-size: 20px; font-family: arial, sans-serif!important; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">
                                        <!-- ======= section text ====== -->
            
                                        <div style="line-height: 35px">
            
                                            <span style="color: #000f99;">{{ $usuario['name'] }} {{ $usuario['apellido'] }} </span> 
                                            se le informa que a su reserva con id {{ $datos['id'] }} 
                                            en el laboratorio {{ $datos['cod_lab'] }} 
                                            fijada desde {{ $datos['fecha_inicial'] }} 
                                            hasta  {{ $datos['fecha_final'] }} 
                                            se le ha eliminado un periodo que comprende desde {{ $validatedData['inicio_periodo'] }}
                                            hasta {{ $validatedData['fin_periodo'] }} .
            
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
            
                </table>

                <br><br><br><br><br><br>
            <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

                <tr>
                    <td align="center">
                        <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                            <tr>

                                <td align="center" class="section-img">
                                    <a style=" border-style: none !important; display: block; border: 0 !important;"><img src="{{asset('imagenes/logo_vertical4.png')}}" style="display: block;"  border="0" alt="" /></a>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                
                                <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">


                                    <div style="line-height: 35px">

                                        Sistema de <span style="color: #5caad2;">Reservas de laboratorios</span>

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                            </tr>

                        </table>

                    </td>
                </tr>

                <tr class="hide">
                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                </tr>
                <tr>
                    <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
                </tr>

            </table>
        </div>


    </body>
</html>
