<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Here is your password: {{ $password }}</p>
    <p>Use this password to login at <a href="{{env('APP_URL')}}">{{ env('APP_NAME')}}</a> </p>
</body>

</html>