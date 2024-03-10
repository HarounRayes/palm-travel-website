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
                                <h4>Dear {{$order->card[0]->people[0]->first_name}}</h4>
                                <p>Thank you for your Enquiry</p>
                                <p>We currently working on your request and we will get back to you within 24 hrs</p>
                                <b>Your request as per below: </b><br>
                                @php $i=1; @endphp
                                @foreach($order->card as $card)
                                    <table style="border: solid 1px #7E7E7E;width: 90%;margin:20px auto;">
                                        <tr style="border-bottom: solid 1px #7E7E7E;">
                                            <td style="background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px;width: 30%">
                                                Tour {{$i}}
                                            </td>
                                            <td style="background-color: #0070c0;padding: 10px"></td>
                                        </tr>
                                        <tr style="border-bottom: solid 1px #7E7E7E">
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                                Activity Name:
                                            </td>
                                            <td style="padding: 10px">{{$card->activity->name_en}}</td>
                                        </tr>
                                        <tr style="border-bottom: solid 1px #7E7E7E">
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                                Activity Type:
                                            </td>
                                            <td style="padding: 10px">{{$card->category->name_en}}</td>
                                        </tr>
                                        <tr style="border-bottom: solid 1px #7E7E7E">
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                                Pick up Point:
                                            </td>
                                            <td style="padding: 10px"> {{$card->pick_up}}</td>
                                        </tr>
                                        <tr style="border-bottom: solid 1px #7E7E7E">
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                                Drop off Point:
                                            </td>
                                            <td style="padding: 10px"> {{$card->drop_off}}</td>
                                        </tr>
                                        <tr style="border-bottom: solid 1px #7E7E7E">
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                               Name:
                                            </td>
                                            <td style="padding: 10px"> {{$card->people[0]->first_name.' '.$card->people[0]->last_name}}</td>
                                        </tr>
                                        <tr style="border-bottom: solid 1px #7E7E7E">
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                                Number of Persons:
                                            </td>
                                            <td style="padding: 10px">{{$card->number_of_person()}}</td>
                                        </tr>
                                        <tr style="border-bottom: solid 1px #7E7E7E">
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                                Mobil Number:
                                            </td>
                                            <td style="padding: 10px">{{$card->mobile}}</td>
                                        </tr>
                                        <tr style="border-bottom: solid 1px #7E7E7E">
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                                Email:
                                            </td>
                                            <td style="padding: 10px">{{$card->email}}</td>
                                        </tr>
                                        <tr>
                                            <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px">
                                                Price:
                                            </td>
                                            <td style="padding: 10px">{{$card->price}}</td>
                                        </tr>
                                    </table>
                                    @php $i++; @endphp
                                @endforeach
                                <table style="border: solid 1px #7E7E7E;width: 90%;margin:20px auto;">
                                    <tr style="border-bottom: solid 1px #7E7E7E">
                                        <td style="border-right: solid 1px #7E7E7E;background-color: #0070c0;color: #ffffff;font-weight: bold;padding: 10px;width: 30%">
                                           Total Price:
                                        </td>
                                        <td style="padding: 10px"> {{$order->total_price()}}</td>
                                    </tr>
                                </table>
                                <p>We pride in providing you the best service on your next dream destination</p>
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
