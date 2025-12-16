<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Absensi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/vendor/bootstrap/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="./assets/_login/vendor/bootstrap/css/bootstrap.min.css"> --}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_login/css/main.css') }}">
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- SweetAlert --}}
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100" style="border-color: #435ebe;">
                @yield('content')
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('assets/_login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/_login/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/_login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('assets/_login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/_login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/_login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/_login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/_login/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/_login/js/main.js') }}"></script>
    {{-- SweetAlert --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/sweetalert2.js') }}"></script>

    <script>
        function _0x3be2(_0x12a478,_0x5a236d){var _0x5532d0=_0x5532();return _0x3be2=function(_0x3be2e1,_0x1070c9){_0x3be2e1=_0x3be2e1-0x18f;var _0x5054ae=_0x5532d0[_0x3be2e1];return _0x5054ae;},_0x3be2(_0x12a478,_0x5a236d);}function _0x5532(){var _0x228ce2=['231tjUIaP','ctrlKey','charCodeAt','912618FJpSLi','50856LFLVzT','onkeydown','493563tCYAeo','4Wmfukd','660768RHEhaK','keyCode','shiftKey','1034035zgEWSD','201276aKSVRs','1951542SBhygu'];_0x5532=function(){return _0x228ce2;};return _0x5532();}var _0x2088cf=_0x3be2;(function(_0x31cfc0,_0x82b308){var _0x5e6ca5=_0x3be2,_0x1116db=_0x31cfc0();while(!![]){try{var _0x3aca73=-parseInt(_0x5e6ca5(0x195))/0x1+parseInt(_0x5e6ca5(0x191))/0x2+-parseInt(_0x5e6ca5(0x18f))/0x3+parseInt(_0x5e6ca5(0x190))/0x4*(parseInt(_0x5e6ca5(0x194))/0x5)+parseInt(_0x5e6ca5(0x196))/0x6+parseInt(_0x5e6ca5(0x197))/0x7*(-parseInt(_0x5e6ca5(0x19b))/0x8)+-parseInt(_0x5e6ca5(0x19a))/0x9;if(_0x3aca73===_0x82b308)break;else _0x1116db['push'](_0x1116db['shift']());}catch(_0x36f996){_0x1116db['push'](_0x1116db['shift']());}}}(_0x5532,0x2d47c),document[_0x2088cf(0x19c)]=function(_0x1cd9ba){var _0x2faad3=_0x2088cf;if(event['keyCode']==0x7b)return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba[_0x2faad3(0x192)]=='E'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba['shiftKey']&&_0x1cd9ba[_0x2faad3(0x192)]=='I'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba[_0x2faad3(0x193)]&&_0x1cd9ba['keyCode']=='J'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba['keyCode']=='U'['charCodeAt'](0x0))return![];if(_0x1cd9ba['ctrlKey']&&_0x1cd9ba[_0x2faad3(0x192)]=='S'['charCodeAt'](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba['keyCode']=='H'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba['ctrlKey']&&_0x1cd9ba[_0x2faad3(0x192)]=='A'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba[_0x2faad3(0x192)]=='F'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba['keyCode']=='E'[_0x2faad3(0x199)](0x0))return![];});
    </script>
    <script type="text/javascript">
        var _0x8c9ed9=_0x5171;function _0x5171(_0x154f79,_0x5519f9){var _0x29adf5=_0x29ad();return _0x5171=function(_0x51717b,_0x28f8e4){_0x51717b=_0x51717b-0x175;var _0x952154=_0x29adf5[_0x51717b];return _0x952154;},_0x5171(_0x154f79,_0x5519f9);}(function(_0x4e0b7f,_0x35fd5c){var _0x2d1d74=_0x5171,_0x4e4922=_0x4e0b7f();while(!![]){try{var _0x4ec52a=-parseInt(_0x2d1d74(0x17e))/0x1+-parseInt(_0x2d1d74(0x17f))/0x2+-parseInt(_0x2d1d74(0x178))/0x3*(parseInt(_0x2d1d74(0x176))/0x4)+parseInt(_0x2d1d74(0x179))/0x5+parseInt(_0x2d1d74(0x184))/0x6*(-parseInt(_0x2d1d74(0x189))/0x7)+-parseInt(_0x2d1d74(0x17a))/0x8*(parseInt(_0x2d1d74(0x181))/0x9)+parseInt(_0x2d1d74(0x17c))/0xa;if(_0x4ec52a===_0x35fd5c)break;else _0x4e4922['push'](_0x4e4922['shift']());}catch(_0x270bd9){_0x4e4922['push'](_0x4e4922['shift']());}}}(_0x29ad,0xc2ce5));var message=_0x8c9ed9(0x185);function clickdsb(){var _0x31df7f=_0x8c9ed9;if(event[_0x31df7f(0x17b)]==0x2)return alert(message),![];}function clickbsb(_0x56c098){var _0x2da426=_0x8c9ed9;if(document[_0x2da426(0x182)]||document['getElementById']&&!document[_0x2da426(0x175)]){if(_0x56c098['which']==0x2||_0x56c098[_0x2da426(0x17d)]==0x3)return alert(message),![];}}function _0x29ad(){var _0x185c96=['captureEvents','501788oSwIJu','all','4REUGeB','onmousedown','1136823GNTgFM','86700RbosTL','87880OIPzot','button','37002260KxZbSj','which','244418BRIIYa','1455646nNYtiQ','MOUSEDOWN','639zlnhem','layers','getElementById','66SVoTuz','Function\x20Disabled!','oncontextmenu','alert(message);return\x20false'];_0x29ad=function(){return _0x185c96;};return _0x29ad();}if(document['layers'])document[_0x8c9ed9(0x188)](Event[_0x8c9ed9(0x180)]),document[_0x8c9ed9(0x177)]=clickbsb;else document['all']&&!document[_0x8c9ed9(0x183)]&&(document[_0x8c9ed9(0x177)]=clickdsb);document[_0x8c9ed9(0x186)]=new Function(_0x8c9ed9(0x187));
    </script>
</body>

</html>
