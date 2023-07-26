
<!DOCTYPE html>
<html >

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">


</style>


</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <div class="es-wrapper-color">
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="background-position: center top;">
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">
                        <table cellpadding="0" cellspacing="0" class="esd-header-popover es-header" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-header-body" align="center" cellpadding="0" cellspacing="0" width="560" style="border-radius: 10px 10px 0px 0px;">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20" align="left">
                                                        <!--[if mso]><table width="520" cellpadding="0" cellspacing="0"><tr><td width="250" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="left" class="es-left">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="250" class="es-m-p0r esd-container-frame es-m-p20b" valign="top" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-image es-m-txt-c" style="font-size: 0px;">
                                                                                        <img src="{{ $message->embed(public_path() . '../assets/img/electropuno.png') }}" alt="Logo" style="display: block;" title="Logo" width="260">
                                                                                        
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="20"></td><td width="250" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="250" align="left" class="esd-container-frame">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="right" class="esd-block-text es-m-txt-c">
                                                                                        <p>{{$date}}</p>
                                                                                        @if($datosR['estado_trc'] == '1')
                                                                                           
                                                                                        <h3>Notificacion</h3>
                                                                                       @elseif($datosR['estado_trc'] == '2')
                                                                                           
                                                                                        <h3>Recordatorio</h3>
                                                                                       @elseif($datosR['estado_trc'] == '3')
                                                                                           
                                                                                        <h3>Felicitaciones</h3>
                                                                                       @endif
                                                                                       
                                                                                      

                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p5t es-p5b" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image" style="font-size: 0px;">
                                                                                        <a target="_blank"><img class="adapt-img" src="{{ $message->embed(public_path() . '../assets/img/linea.png') }}" alt style="display: block;" width="560"></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="560" style="border-radius: 0 0 10px 10px;">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p30b es-p20l" align="left">
                                                        <!--[if mso]><table width="540" cellpadding="0" cellspacing="0"><tr><td width="327" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" align="left" class="es-left">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="327" class="es-m-p0r esd-container-frame es-m-p20b" valign="top" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text es-p20t es-p10b es-m-p20r es-m-txt-l">
                                                                                        <h1>{{$datosR['nombre_t']}}</h1>
                                                                                        

                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                                        <p>{{$datosR['descripcion_t']}}</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                                        <h3 style="color: #f76b0a;"><span style="background-color:#FFFFFF; border-radius: 10px;">{{$datosR['nombre_r']}}</span></h3>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                                        <p>{{$datosR['descripcion_r']}}</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="5"></td><td width="208" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="208" align="left" class="esd-container-frame">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-image" style="font-size: 0px;">
                                                                                        <a target="_blank" href="#"><img class="adapt-img" src="{{ $message->embed(public_path() . '../assets/img/falta.png') }}" alt style="display: block;" width="208"></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="560" style="background-color: transparent;">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p30t es-p20b es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="520" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text">
                                                                                        <h2>Hola,&nbsp;{{$colaborador->colaborador->nombre}}</h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                                        
                                                                                        <h2 align="center" style="color: #f40e0e;"><span style="background-color:#FFFFFF; border-radius: 10px; ">{{$mensajeNotificacion}}</span></h2>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                       
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center" >
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="560" style="background-color: transparent;">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p10b es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="520" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                
                                                                                <tr>
                                                                                    <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                                        <h3 style="color: #f76b0a;"><span style="background-color:#FFFFFF; border-radius: 10px;">&nbsp;Fechas asignadas&nbsp;</span></h3>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="esd-structure es-p20" align="left" bgcolor="#ffffff" style="background-color: #ffffff; border-radius: 10px;">
                                                        <!--[if mso]><table width="520" height="200" cellpadding="0" cellspacing="0" ><tr><td width="130" align="center"  style="margin: 10px"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="130" class="es-m-p0r es-m-p20b esd-container-frame" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text">
                                                                                        <p style="color: #3e7d8e; font-size: 14px;">Asignacion</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text">
                                                                                        
                                                                                        <h2 style="color: #144d62; line-height: 60%;"><strong>{{$datosR['fechacreacion_trc']}}</strong></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p5b">
                                                                                        <p style="color: #144d62;"><strong>{{$datosR['fechacreacionh_trc']}}</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td class="es-hidden" width="10"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="10"></td><td width="130" align="center"   style="margin: 10px"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="130" class="es-m-p0r es-m-p20b esd-container-frame" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text">
                                                                                        <p style="color: #3e7d8e; font-size: 14px;">Limite</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text">
                                                                                        <h2 style="color: #ec2323; line-height: 60%;"><strong>{{$datosR['fechalimite']}}</strong></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text es-p5b">
                                                                                        <p style="color: #ec2323;"><strong>11:59:59 PM</strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td class="es-hidden" width="10"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="10"></td><td width="130" align="right"  style="margin: 10px"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="130" class="es-m-p0r esd-container-frame" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text">
                                                                                        <p style="color: #3e7d8e; font-size: 14px;">Validacion</p>
                                                                                    </td>
                                                                                </tr>
                                                                                   <tr>
                                                                                       <td align="center" class="esd-block-text">
                                                                                           <h2 style="color: #144d62; line-height: 60%;"><strong>{{$datosR['fechavalidacion_trc']}}</strong></h2>
                                                                                       </td>
                                                                                   </tr>
                                                                                   <tr>
                                                                                       <td align="center" class="esd-block-text es-p5b">
                                                                                           <p style="color: #144d62;"><strong>{{$datosR['fechavalidacionh_trc']}}</strong></p>
                                                                                       </td>
                                                                                   </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="10"></td><td width="130" align="right"  style="margin: 10px"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right">
                                                        <table cellpadding="0" cellspacing="0" class="es-right" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="130" class="es-m-p0r esd-container-frame" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center" class="esd-block-text">
                                                                                        <p style="color: #3e7d8e; font-size: 14px;">Atencion</p>
                                                                                    </td>
                                                                                </tr>
                                                                               
                                                                                   <tr>
                                                                                       <td align="center" class="esd-block-text">
                                                                                           <h2 style="color: #144d62; line-height: 60%;"><strong>{{$datosR['fechaatencion_trc']}}</strong></h2>
                                                                                       </td>
                                                                                   </tr>
                                                                                   <tr>
                                                                                       <td align="center" class="esd-block-text es-p5b">
                                                                                           <p style="color: #144d62;"><strong>{{$datosR['fechaatencionh_trc']}}</strong></p>
                                                                                       </td>
                                                                                   </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                      
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="560" style="background-color: transparent;">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p40b es-p20r es-p20l" align="left">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="520" class="esd-container-frame" align="center" valign="top">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody><tr>
                                                                                    <td align="center" class="esd-block-button es-m-txt-c"><span class="es-button-border" style=" border-style: solid;
                                                                                        border-color: #F76B0A;
                                                                                        border-width: 15px 30px 15px 30px;
                                                                                        display: inline-block;
                                                                                        background: #F76B0A;
                                                                                        border-radius: 30px;
                                                                                        font-size: 20px;
                                                                                        font-family: arial, 'helvetica neue', helvetica, sans-serif;
                                                                                        margin: 5px;
                                                                                        text-decoration: none;
                                                                                        width: auto;
                                                                                        text-align: center;
                                                                                        color: #fff;
                                                                                        "><a href="{{$datosR['URL']}}" class="es-button" target="_blank" style="text-decoration:none; color: #fff;"> Realice su seguimiento </a></span>
                                                                                        <h3>{{$datosR['URL']}}</h3>
                                                                                     </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
 
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>