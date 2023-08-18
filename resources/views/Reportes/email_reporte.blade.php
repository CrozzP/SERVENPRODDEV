
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
                                                                                        <img src="{{ $message->embed('../assets/img/electropuno.png') }}" alt="Logo" style="display: block;" title="Logo" width="260">
                                                                                        
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
                                                                                        <a target="_blank"><img class="adapt-img" src="{{ $message->embed('../assets/img/linea.png') }}" alt style="display: block;" width="560"></a>
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
                                                               <tr><h1>Datos del suministro</h1></tr>
                                                                <tr>
                                                                    <td width="327" class="es-m-p0r esd-container-frame es-m-p20b" valign="top" align="center">
                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                 <td>Suministro</td>
                                                                                    <td align="left" class="esd-block-text es-p10t es-p10b es-m-p20r es-m-txt-l">
                                                                                        <h1>{{$extraordinarios->suministro->CodigoSuministro}}</h1>
                                                                                        
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                 <td>Codigo Ruta</td>
                                                                                    <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                                        <p>{{$extraordinarios->suministro->CodigoRutaSuministro}}</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                 <td>Direccion</td>
                                                                                    <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                                        <h3 style="color: #f76b0a;"><span style="background-color:#FFFFFF; border-radius: 10px;">{{$extraordinarios->suministro->DireccionPredio}}</span></h3>
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
                                                                                        <a target="_blank" href="#"><img class="adapt-img" src="{{ $message->embed('../assets/img/alto.png') }}" alt style="display: block;" width="208"></a>
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

                                <tr>
                                    <td class="esd-stripe" align="center">
                                       <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="560" style="border-radius: 0 0 10px 10px;">
                                            <tbody>
                                             <tr>
                                                <!--[if mso]><table width="540" cellpadding="0" cellspacing="0"><tr><td width="560" valign="top"><![endif]-->
                                               <table cellpadding="0" cellspacing="0" align="left" class="es-left">
                                                   <tbody>
                                                      <tr><h1>Datos del Registro</h1></tr>
                                                      <tr>
                                                         <td width="560" class="es-m-p0r esd-container-frame es-m-p20b" valign="top" align="center">
                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                               <tbody>
                                                                    <tr>
                                                                     <td>Codigo registro</td>
                                                                     <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                         <p>{{$extraordinarios->id}}</p>
                                                                     </td>
                                                                     <td>Fecha de registro</td>
                                                                        <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                            <h3 style="color: #f76b0a;"><span style="background-color:#FFFFFF; border-radius: 10px;">{{$extraordinarios->estadoExtraordinario->created_at}}</span></h3>
                                                                        </td>
                                                                    </tr>
                                                                     <tr>
                                                                        <td>Tipo Registro</td>
                                                                        <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                            <h3 style="color: #f76b0a;"><span style="background-color:#FFFFFF; border-radius: 10px;">{{$extraordinarios->obsTipoExtraordinario->tipoExtraordinario->nombreTipoExt}}</span></h3>
                                                                        </td>
                                                                        <td>Descripcion</td>
                                                                        <td align="left" class="esd-block-text es-p10t es-p10b es-p10r es-m-p20r">
                                                                            <h3 style="color: #f76b0a;"><span style="background-color:#FFFFFF; border-radius: 10px;">{{$extraordinarios->obsTipoExtraordinario->nombreObsTipoExt}}</span></h3>
                                                                        </td>
                                                                     </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>

                                               <!--[if mso]></td></tr></table><![endif]-->
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
                                                                                        "><a href="#" class="es-button" target="_blank" style="text-decoration:none; color: #fff;"> Realice su seguimiento </a></span>
                                                                                        
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
<footer>
  <p>&copy; 2022 Electro Puno S.A.A.</p>
  <ul>
    <li>No responder a este correo</li>
  </ul>
</footer>

</html>