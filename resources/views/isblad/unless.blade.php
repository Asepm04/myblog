<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @unless($isadmin)

        you are note admin

    @endunless

    @env("testing")

    this is test environment
    
    @endenv

    @switch($nilai)
    @case('A')
     Memuaskan
     @break

    @case('B')
     Baik
     @break

    @default

     tidak lulus

    @endswitch

</body>
</html>