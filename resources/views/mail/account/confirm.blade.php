@extends('mail.layouts.default')
@section('main')
    <table cellpadding="0" cellspacing="0" class="es-content" align="center"
        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
        <tr>
            <td align="center" style="padding:0;Margin:0">
                <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                    <tr>
                        <td align="left"
                            style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
                            <table cellpadding="0" cellspacing="0" width="100%"
                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                <tr>
                                    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                        <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr>
                                                <td align="center"
                                                    style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:0px">
                                                    <img src="https://mafycx.stripocdn.email/content/guids/CABINET_67e080d830d87c17802bd9b4fe1c0912/images/55191618237638326.png"
                                                        alt
                                                        style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                        width="100">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="es-m-txt-c"
                                                    style="padding:0;Margin:0;padding-bottom:10px">
                                                    <h1
                                                        style="Margin:0;line-height:46px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:46px;font-style:normal;font-weight:bold;color:#333333">
                                                        Confirm Your Email</h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="es-m-p0r es-m-p0l"
                                                    style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px">
                                                    <p
                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                        You’ve received this message because your email
                                                        address has been registered with our site.
                                                        Please click the button below to verify your
                                                        email address and confirm that you are the owner
                                                        of this account.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center"
                                                    style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px">
                                                    <p
                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                        If you did not register with us, please
                                                        disregard this email.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center"
                                                    style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px">
                                                    <!--[if mso]><a href="" target="_blank" hidden>
        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href=""
        style="height:44px; v-text-anchor:middle; width:282px" arcsize="14%" stroke="f"  fillcolor="#5c68e2">
        <w:anchorlock></w:anchorlock>
        <center style='color:#ffffff; font-family:arial, "helvetica neue", helvetica, sans-serif; font-size:18px; font-weight:400; line-height:18px;  mso-text-raise:1px'>CONFIRM YOUR EMAIL</center>
        </v:roundrect></a>
        <![endif]-->
                                                    <!--[if !mso]><!-- --><span class="es-button-border msohide"
                                                        style="border-style:solid;border-color:#2CB543;background:#5C68E2;border-width:0px;display:inline-block;border-radius:6px;width:auto;mso-border-alt:10px;mso-hide:all"><a
                                                            href="{{ $url }}" class="es-button" target="_blank"
                                                            style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;padding:10px 30px 10px 30px;display:inline-block;background:#5C68E2;border-radius:6px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center;padding-left:30px;padding-right:30px">CONFIRM
                                                            YOUR EMAIL</a></span>
                                                    <!--<![endif]-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="es-m-p0r es-m-p0l"
                                                    style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px">
                                                    <p
                                                        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                        Once confirmed, this email will be uniquely
                                                        associated with your account.</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
