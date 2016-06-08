<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inicio') :: Dona Sangre</title>

    <link rel="stylesheet" href="{{ elixir("css/app.css") }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
@if ( env('FACEBOOK_APP_ID') )
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '{{ env('FACEBOOK_APP_ID') }}',
                xfbml      : true,
                version    : 'v2.3',
                status     : true
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endif
    <div id="app"></div>

    <script>
        window.APIURL = '{{ env('API_URL') }}';
    </script>
    <script src="{{ elixir('js/vendors.js') }}"></script>
    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>