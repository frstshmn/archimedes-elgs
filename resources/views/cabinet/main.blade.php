@include('layouts.header')
        <meta name="csrf-token" content="{{ csrf_token() }}" >
        <title>Кабінет | Archimedes ELGS</title>
    </head>
    <body class="font-second background-primary">
        
        @include('layouts.navbar')

        @if (Auth::user()->type === "student")
          @include('cabinet.student')
        @elseif (Auth::user()->type === "teacher")
          @include('cabinet.teacher')
        @else
          @include('errors.401')
        @endif

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </body>
</html>
