<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @form

    <input type="checked" @checked($user['premium'])>
    @csrf
    <input type="text" value="{{$user['name']}}" @readonly(!$user['admin'])>

    @endform
</body>
</html>