<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>{{ config('app.name') }}</title>
    <style type='text/css'>
        body, html {
            height: 90%;
            background: #111;
            font: 12px 'Verdana';
        }

        #container {
            height: 100%;
            text-align: center;
        }

        #logo {
            width: 500px;
            height: 140px;
            position: relative;
            top: 50%;
            margin-top: -77px;
            margin-left: auto;
            margin-right: auto;
            background: #111;
            color: #2D2D2D;
        }

        a:link {
            text-decoration: none;
            color: grey;
        }

        a:visited {
            text-decoration: none;
            color: grey;
        }

        a:hover {
            text-decoration: none;
            color: grey;
        }

        a:active {
            text-decoration: none;
            color: grey;
        }
    </style>
</head>
<body>
<div id="container">
    <div id="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}"
                                                            title="{{ config('app.name') }}" alt="{{ config('app.name') }}"/></a>

        <a href="{{ route('home') }}" class="linky">Home</a>&nbsp;&nbsp;&nbsp;<a href="{{ route('login') }}" class="linky">Login</a>&nbsp;&nbsp;&nbsp;<a
                    href="{{ route('register') }}" class="linky">Register</a>&nbsp;&nbsp;&nbsp;<a href="{{ route('password.request') }}"
                                                                                   class="linky">Recover</a>
        <br/><br/>
    </div>
</div>

</body>
</html>


