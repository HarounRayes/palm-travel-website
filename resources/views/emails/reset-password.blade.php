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
                <div class="col num3"
                     style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 150px; background-color: #ffffff; width: 150px;">
                    <div class="col_cont" style="width:100% !important;">
                        <!--[if (!mso)&(!IE)]><!-->
                        <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                            <!--<![endif]-->
                            <div align="center" class="img-container center fixedwidth"
                                 style="padding-right: 0px;padding-left: 0px;">
                                <!--[if mso]>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr style="line-height:0px">
                                        <td style="padding-right: 0px;padding-left: 0px;" align="center">
                                <![endif]-->
                                <h2> Reset Password Email From Palmoasisholidays Website </h2>
                                <h3>Dear {{$user->name}} please follow the reset password link </h3>
                                <div style="margin-top: 40px">
                                    <a href="{{route('member.password.reset', ['token' => $token])}}" style="background-color: #104277;color: #fff;padding: 10px;text-decoration: none;border-radius: 3px;">
                                        Reset password </a>
                                </div>
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
@endsection
