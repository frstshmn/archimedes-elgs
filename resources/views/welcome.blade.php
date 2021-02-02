@include('layouts.header')
        <title>Головна | Archimedes ELGS</title>
        
        <script>
            // $(document).ready(function() {  
            //     $('#main_brand').hide();
            //     $('#second_brand').hide();
            //     $('#main_brand').fadeIn(1000);
            //     $('#second_brand').fadeIn(1000);
            // });
        </script>
    </head>
    <body class="font-second background-primary">
        
        @include('layouts.navbar')

        <div class="container">
            <div class="row mt-5">
                <div class="col-12 text-center text-white">
                    <div class="jumbotron bg-transparent">
                        <h1 class="font-main">Archimedes</h1>
                        <p class="font-second">Електронна система ведення лекцій та оцінювання студентів<br><a href="http://kpeklntu.com.ua" class="text-white">КПЕК Луцького НТУ</a></p>
                    </div>
                </div>      
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <a href="{{ url('/login') }}" class="btn btn-outline-light p-4 btn-lg">Увійти в кабінет</a>
                    <a href="{{ url('/register') }}" class="btn btn-outline-light p-4 btn-lg">Створити нового користувача</a>
                </div>     
            </div>        
            <div class="row">
                <div class="col-md-6 col-xs-12 text-center">

                </div>
                <div class="col-md-6 col-xs-12 text-center">
                    
                </div>      
            </div>        
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </body>
</html>