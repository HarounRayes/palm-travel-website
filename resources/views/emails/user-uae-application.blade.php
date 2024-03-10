@extends('emails.main')
@section('content')
    <div style="background-color:transparent;">
        <div class="block-grid mixed-two-up"
             style="direction:ltr; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: transparent;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                <!--[if (mso)|(IE)]>
                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="background-color:transparent;">
                    <tr>
                        <td align="center">
                            <table cellpadding="0" cellspacing="0" border="0" style="width:600px">
                                <tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                <!--[if (mso)|(IE)]>
                <td align="center" width="100%"
                    style="background-color:transparent;width:150px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                    valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;background-color:#ffffff;">
                <![endif]-->
                <div class="col num12"
                     style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 150px; background-color: #ffffff; width: 150px;">
                    <div class="col_cont" style="width:100% !important;">
                        <!--[if (!mso)&(!IE)]><!-->
                        <div
                            style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                            <!--<![endif]-->
                            <div align="left" class="img-container center fixedwidth"
                                 style="padding-right: 15px;padding-left: 15px;">
                                <!--[if mso]>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr style="line-height:0px">
                                        <td style="padding-right: 0px;padding-left: 0px;" align="left">
                                <![endif]-->
                                <h4>Dear {{$application->people[0]->firstName()->value}}</h4>
                                <p>Thank you for your Enquiry</p>
                                <p>We currently working on your request and we will get back to you within 24 hrs</p>
                                <b>Your request as per below: </b><br>


                                <!--[if mso]></td></tr></table><![endif]-->
                            </div>
                            <!--[if (!mso)&(!IE)]><!-->
                        </div>
                        <!--<![endif]-->
                    </div>

                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
            </div>
        </div>
    </div>

    <div style="background-color:transparent;">
        <div class="block-grid"
             style="min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #ffffff;">
            <div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">
                <!--[if (mso)|(IE)]>
                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="background-color:transparent;">
                    <tr>
                        <td align="center">
                            <table cellpadding="0" cellspacing="0" border="0" style="width:600px">
                                <tr class="layout-full-width" style="background-color:#ffffff"><![endif]-->
                <!--[if (mso)|(IE)]>
                <td align="center" width="600"
                    style="background-color:#ffffff;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;"
                    valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;">
                <![endif]-->
                <div class="col num12"
                     style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
                    <div class="col_cont" style="width:100% !important;">
                        <!--[if (!mso)&(!IE)]><!-->
                        <div
                            style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 10px; padding-left: 10px;">
                            <!--<![endif]-->
                            <table border="0" cellpadding="0" cellspacing="0" class="divider"
                                   role="presentation"
                                   style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                   valign="top" width="100%">
                                <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                               class="divider_content" height="40" role="presentation"
                                               style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 40px; width: 100%;"
                                               valign="top" width="100%">
                                            <tbody>
                                            <tr style="vertical-align: top;" valign="top">
                                                <td height="40"
                                                    style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                                    valign="top"><span></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div align="center" class="button-container"
                                 style="">


                                <table border="0" dir="{{ trans('all.dir') }}" cellpadding="0" cellspacing="0"
                                       class="divider"
                                       role="presentation"
                                       style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #585858;"
                                       valign="top" width="100%">

                                    <tbody>
                                    <tr style="border-bottom: solid 1px #7E7E7E">
                                        <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                            Reference ID:
                                        </td>
                                        <td style="padding: 10px">{{$application->reference_id}}</td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #7E7E7E">
                                        <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                            Visa Type:
                                        </td>
                                        <td style="padding: 10px">{{$application->type->name_en}}</td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #7E7E7E;">
                                        <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                            Total Price
                                        </td>
                                        <td style="padding: 10px">{{$application->price}}</td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #7E7E7E;padding: 10px">
                                        <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                            Lead Name
                                        </td>
                                        <td style="padding: 10px">{{$application->people[0]->firstName()->value.' '.$application->people[0]->lastName()->value}}</td>
                                    </tr>
                                    <tr style="padding: 10px">
                                        <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                            Number of Person
                                        </td>
                                        <td style="padding: 10px">{{$application->person_number}}</td>
                                    </tr>


                                    </tbody>
                                </table>

                            </div>

                            <table border="0" cellpadding="0" cellspacing="0" class="divider"
                                   role="presentation"
                                   style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                   valign="top" width="100%">
                                <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                               class="divider_content" height="40" role="presentation"
                                               style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 40px; width: 100%;"
                                               valign="top" width="100%">
                                            <tbody>
                                            <tr style="vertical-align: top;" valign="top">
                                                <td height="40"
                                                    style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                                    valign="top"><span></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table border="0" cellpadding="0" cellspacing="0" class="divider"
                                   role="presentation"
                                   style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
                                   valign="top" width="100%">
                                <tbody>
                                <tr style="vertical-align: top;" valign="top">
                                    <td class="divider_inner"
                                        style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;"
                                        valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                               class="divider_content" height="40" role="presentation"
                                               style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 40px; width: 100%;"
                                               valign="top" width="100%">
                                            <tbody>
                                            <tr style="vertical-align: top;" valign="top">
                                                <td height="40"
                                                    style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;text-align: center"
                                                    valign="top"><p>We pride in providing you the best service on your next dream destination</p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!--[if (!mso)&(!IE)]><!-->
                        </div>
                        <!--<![endif]-->
                    </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
            </div>
        </div>
    </div>
@endsection
