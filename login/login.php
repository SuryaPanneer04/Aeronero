<?php
require("../connect.php");

session_start();
if (isset($_SESSION['user'])) {
    // var_dump($_SESSION);
}
?>
<style>
    .p1 {
        font-family: Times;
    }

    .p2 {
        font-family: Algerian;
    }

    .p3 {
        font-family: monospace;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QVision ERP LOGIN</title>


    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
                            <img src="..\qvision\images\logo123.jpg" alt="" class="login_img" style="max-width: 573px;
    max-height: 260px;
    margin-top: 40px;
    margin-left: 60px;">
                        </div>

                        <div class="form-group" style=" margin-top: 70px;">

                            <div class="input-icon" style=" margin-left: 20px;">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" placeholder="User Name" name="Inputusername" class="form-input" Autocomplete="off" autofocus>


                        </div>
                       <div class="form-group" style="position: relative;">
                            <div class="input-icon" style="margin-left: 20px;">
                                <i class="fas fa-user-lock"></i>
                            </div>

                            <input type="password" id="password" name="InputPassword" placeholder="Password" class="form-input" autocomplete="off" style="padding-right: 45px;">

                            <span onclick="togglePassword()" style="
                                position: absolute;
                                right: 15px;
                                top: 50%;
                                transform: translateY(-50%);
                                cursor: pointer;
                                color: #666;
                                font-size: 18px;
                                z-index: 10;
                                ">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </span>
                        </div>

                        <input type="submit" class="btn btn-primary btn-block" style="margin-top: 71px;margin-left: 206px;width:100px;font-size:20px;" value="Login" />
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $('.owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                items: 1
            });
        });
    </script>
    <script>
        function togglePassword() {
            var password = document.getElementById("password");
            var icon = document.getElementById("toggleIcon");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>