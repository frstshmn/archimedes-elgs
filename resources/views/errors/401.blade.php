@include('layouts.header')
        <title>401 Unautorized</title>
        
        <script>
            $(document).ready(function() {  
                $('#main').hide();
                $('#second').hide();
                $('#main').fadeIn(1000);
                setTimeout(function() {
                    $('#second').fadeIn(1000);
                }, 500);
                
            });
        </script>
    </head>
    <body class="font-second background-primary">

        <div class="container">
            <div class="row mt-5">
                <div class="col-md-6 col-xs-12" id="main">
                    <img class="logoscreen float-md-right mx-auto d-block" style="filter: brightness(100);" src="{{ asset('images/archimedes_logo.svg') }}" width="40%" />
                </div>
                <div class="col-md-6 col-xs-12 text-center text-md-left text-white" id="second">
                    <div class="jumbotron bg-transparent text-white">
                        <p class="font-second">Whoops, looks like something went wrong...</p>
                        <h1 class="font-main display-2">401</h1>
                        <p class="font-second">Unautorized</p>
                    </div>
                </div>
            </div>      
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </body>
</html>