<?php
require ("../connect.php");

session_start();
if (isset($_SESSION['user'])) 
{	
}
?>
<style>
.p1 {
  font-family:  Times;
}

.p2 {
  font-family: Algerian;
}

.p3 {
  font-family:  monospace;
}
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>


    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/23412c6a8d.js"></script>

    <!-- Custom Style-->
    <link rel="stylesheet" href="./css/Style.css">
</head>

<body>

    <div class="container">
        <div class="panel">
            <div class="row">
                <div class="col liquid">
                    <!-- <h1 style="color: #f8c401;
                        font-family: fangsong;
                        margin-top: 350px;
                        margin-left: 80px;
                        font-size: 70px;">Q Vision</h1> -->
                </div>
                <div class="col login" style="margin-top: 50px;
                margin-left: -100px;">
                   <form method="POST" action="validation.php">
                        <div class="titles">
                            <img src="..\dist\img\Quadsel.jpg" alt="" class="login_img" style="max-width: 273px;
    max-height: 52px;
    margin-top: 38px;
    margin-left: 101px;" >
                        </div>
						
                        <div class="form-group" style=" margin-top: 70px;">
						
						 <div class="input-icon" style=" margin-left: 20px;">
                                <i class="fas fa-user"></i>
                            </div>
						 <input type="text" placeholder="User Name" name="Inputusername" class="form-input" Autocomplete="off" autofocus>
                           
                           
                        </div>
                        <div class="form-group">
                                 <div class="input-icon" style=" margin-left: 20px;">
                                <i class="fas fa-user-lock"></i>
                            </div>     
<input type="password" name="InputPassword" placeholder="Password" class="form-input" Autocomplete="off">
                           
                        </div>

                       <input type="submit" class="btn btn-primary btn-block" style="margin-top: 71px;margin-left: 206px;width:100px;font-size:20px !important;" value="Login"/>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {

            $('.owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                items: 1
            });
        });
    </script>
</body>

</html>

