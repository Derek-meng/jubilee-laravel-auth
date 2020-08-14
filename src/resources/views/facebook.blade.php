@extends('base')
@section('script')
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '{{config('services.facebook.client_id')}}',
                cookie: true,
                xfbml: true,
                version: '{{config('services.facebook.version')}}'
            });

            FB.AppEvents.logPageView();

        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    </script>
@endsection
