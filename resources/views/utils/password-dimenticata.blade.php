@php
        @endphp

        <!DOCTYPE html>
<html>
<head>
    <x-head title="Password reset" />
    <style type="text/css">
        button {
            background-color: #007BFF;
            color: #FFFFFF;
            padding: 7px;
            border: solid 1px #000000;
        }
    </style>
</head>

<body>
    <h1>Ecco la tua nuova Password: {{ $password }}
        per l'account {{ $email }}
    </h1>
    <a href="{{ route('login') }}">
        <button>
            <b>Vai al Login</b>
        </button>
    </a>
</body>
</html>