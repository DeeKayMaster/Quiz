<?php
    session_start();

    require "dbconnect.php"; //wymagamy pliku z danymi logowania do bazy w przeciwnym razie przerywamy skrypt

    try {
        $conn = new PDO("mysql:host=localhost;dbname=$databasename;charset=utf8", $username, $password);
      // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
    } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>QUIZ</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/quiz.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>    <link rel="stylesheet" href="css/style.css" />
    <style>
    .carousel-item {
        height: 32rem;
        position: relative;
        color: white;
        background: #777;
    }

    .container {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding-bottom: 50px;
    }

    .overlay-image {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        background-position: center;
        background-size: cover;
        opacity: 0.5;
    }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="images/quiz.png" height="48"
                        class="d-inline-block align-text-top" alt="logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php
                        
                    ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Start</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tests.php">Test</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="top10.php">TOP 10</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">Tapety</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">Rejestracja</a>
                        </li>
                    </ul>
                    <?php 
                        if(isset($_SESSION['login'])){
                            echo '<div class="h-100" style="padding-right:5px; color:#664B39;">Jeste?? zalogowany jako <b><span style="color:#E5A097;">'.$_SESSION['login'].'</span></b></div>';
                            echo'<form class="d-flex" action="logout.php" method="POST">
                                    <button id="buttonLog" class="btn btn-outline-success" type="submit">Wyloguj</button>
                                </form>';

                        }else{
                            echo'<form class="d-flex" action="login.php" method="POST">
                                    <input class="form-control me-2 logInput" type="text" name="login" placeholder="Login" required>
                                    <input class="form-control me-2 logInput" type="password" name="password" placeholder="Has??o" required>
                                    <button id="buttonLog" class="btn btn-outline-success" type="submit">Zaloguj</button>
                                </form>';
                        }
	                ?>
                </div>
            </div>
        </nav>
    </header>

    <main class="min-vh-100">
        
        <!-- KARUZELA-SLIDER -->

        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="overlay-image" style="background-image:url(images/slider1.jpg);"></div>
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Przetestuj si??!</h1>
                            <p>Skorzystaj z naszego serwisu, aby sprawdzi?? swoj??
                                wiedz?? z IT.
                            </p>
                            <p><a href="tests.php" class="btn btn-lg btn-primary">Zobacz nasze testy</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="overlay-image" style="background-image:url(images/slider2.jpg);"></div>
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Do????cz do nas za darmo!</h1>
                            <p>Za?????? konto w naszym serwisie, aby m??c korzysta?? z naszych us??ug.</p>
                            <p><a class="btn btn-lg btn-primary" href="registration.php">Zarejestruj si??</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="overlay-image" style="background-image:url(images/slider3.jpg);"></div>
                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>Zmierz si?? z innymi!</h1>
                            <p>Rozwi??zuj testy i zosta?? liderem rankingu.</p>
                            <p><a class="btn btn-lg btn-primary" href="top10.php">Zobacz ranking graczy</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- 3 KOLUMNY -->
        <div class="container-fluid" style="padding:3rem;">
            <div class="row justify-content-center">
                <div class="col-12 col-md-3" style="text-align:justify;">
                    <img class="rounded-circle mx-auto d-block" width="140" height="140" src="images/bulb.svg"
                        alt="??ar??wka">
                    <h2 style="text-align:center;">Kreatywno????</h2>
                    <p>Rozwi??zuj??c testy rozwi?? swoj?? kreatywno????. Szukanie nowych, niestandardowych rozwi??za??, pomys????w
                        usprawniaj??cych ??ycie,
                        ucieczka od sztampy - bez tego ci????ko my??le?? o rozwoju biznesu, gospodarki, sztuki... Tw??rcze
                        my??lenie jest ko??em zamachowym wprawiaj??cym ??wiat w ruch.</p>
                </div>
                <div class="col-12 col-md-3" style="text-align:justify;">
                    <img class="rounded-circle mx-auto d-block" width="140" height="140" src="images/win.svg"
                        alt="przyjaciele">
                    <h2 style="text-align:center;">Zwyci????aj</h2>
                    <p>Poznaj nowych ludzi. Sprawd?? swoj?? wiedz?? z r????nych kategorii na tle innych. Zobacz ile os??b jest
                        od Ciebie lepszych. D???? do zwyci??stwa w rankingu.</p>
                </div>
                <div class="col-12 col-md-3" style="text-align:justify;">
                    <img class="rounded-circle mx-auto d-block" width="140" height="140" src="images/present.svg"
                        alt="wygrana">
                    <h2 style="text-align:center;">Wygrywaj nagrody</h2>
                    <p>Co miesi??c dla graczy z TOP 10 naszego rankingu b??dziemy przyznawa?? ciekawe nagrody rzeczowe. Na
                        koniec roku gracz znajduj??cy si?? najwy??ej w rankingu zgarnie laptopa.</p>
                </div>
            </div>
        </div>



        <!-- FOOTER -->
        <footer class="py-5">
            <p class="m-0 text-center">Copyright &copy; Dawid Kogut 2021</p>
        </footer>
    </main>
</body>

</html>