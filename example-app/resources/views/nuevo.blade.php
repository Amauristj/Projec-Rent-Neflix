<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">




    </head>
    <body class="antialiased">
        
    <table class="table table-striped">
        <tr>
            <td>{{ $email_account }}</td>
            <td>{{ $password_account }}</td>
            <td>{{ $user_netflix }}</td>
            <td>{{ $pin_user_netflix }}</td>
        </tr>
    </table>
    </body>
</html>