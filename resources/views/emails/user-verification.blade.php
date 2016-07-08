@extends('layouts.mail')

@section('htmlheader_title')
   Verify your account
@endsection

@section('contentheader_title')
   Verify your account
@endsection


@section('main-content')

   <p>Click here to verify your account: <a href="{{ $link = url('verification', $user->verification_token) . '?email=' . urlencode($user->email) }}"> {{ $link }}</a></p>

   <div style="Margin-left: 20px;Margin-right: 20px;">
      <div class="btn btn--flat btn--large" style="Margin-bottom: 20px;text-align: center;">
         <![if !mso]><a style="border-radius: 4px;display: inline-block;font-size: 14px;font-weight: bold;line-height: 24px;padding: 12px 24px;text-align: center;text-decoration: none !important;transition: opacity 0.1s ease-in;color: #fff;background-color: #4eaacc;font-family: 'PT Serif', Georgia, serif;" href="{{ $link = url('verification', $user->verification_token) . '?email=' . urlencode($user->email) }}">Or click here...</a><![endif]>
         <!--[if mso]><p style="line-height:0;margin:0;">&nbsp;</p><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" href="http://test.com" style="width:238px" arcsize="9%" fillcolor="#4EAACC" stroke="f"><v:textbox style="mso-fit-shape-to-text:t" inset="0px,11px,0px,11px"><center style="font-size:14px;line-height:24px;color:#FFFFFF;font-family:Georgia,serif;font-weight:bold;mso-line-height-rule:exactly;mso-text-raise:4px">Or click here..</center></v:textbox></v:roundrect><![endif]--></div>
   </div>
@endsection







