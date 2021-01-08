<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laravel PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }
        @page {
            size: A4;
            padding: 15px;
        }
        @media print {
            html, body {
            width: 210mm;
            height: 297mm;
            /*font-size : 16px;*/
            }
        }
    </style>
    
    
</head>
<body>
    {{-- <td align="center">
        <img src="{{ public_path('images/water.png') }}" alt="Logo" width="64" class="logo"/>
    </td> --}}
<h1>ใบแจ้งหนี้สำหรับ</h1>
ขอขอบคุณในการสั่งซื้อ

<div class="alert alert-primary" role="alert">
    A simple primary alert—check it out!
</div>

</body>
</html>