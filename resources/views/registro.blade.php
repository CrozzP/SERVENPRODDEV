<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Vue JS - Otro Metodo</title>
    
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    
<link rel="icon" href="{{ asset('assets/img/icon.ico')}}" type="image/x-icon"/>



<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/fonts.min.css') }}">


   <script>
       (function(){
         window.Laravel = {
        csrfToken: '{{ csrf_token()}}'
    };
})();
   

   </script>
   
</head>
<body>
    <div id="app">
        
            <appr-template>


            </appr-template>

        

    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
   
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    
    <script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
</body>
</html>