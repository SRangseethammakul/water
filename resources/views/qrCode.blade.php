<!DOCTYPE html>
<html>
<head>
    <title>How to Generate QR Code in Laravel 6? - ItSolutionStuff.com</title>
</head>
<body>
    
<div class="visible-print text-center">
    <h1>Laravel 6 - QR Code Generator Example</h1>
     
    {!! QrCode::size(250)->generate('ItSolutionStuff.com'); !!}
     
    <p>example by ItSolutionStuf.com.</p>
</div>
    
</body>
</html>