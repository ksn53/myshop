<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Internet shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="Keywords" content="">
    <meta http-equiv="Cache-Control" content="public">
    <meta http-equiv="Cache-Control" content="no-store">
    <meta http-equiv="Cache-Control" content="max-age=34700">
    <meta http-equiv="content-language" content="ru">

    <meta name="author" content="">
    <meta name="copyright" content="">
    <meta name="Publisher-Email" Content="">
    <meta name="Publisher-URL" Content="">
    <meta name="description" content="Fashion - my cool e-shop">
    <meta name="keywords" content="Fashion, e-shop, casual, cloth">
    <meta name="theme-color" content="#393939">

    <link rel="icon" href="img/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/scripts.js" defer=""></script>
    <script src="js/scriptsnew.js"></script>
</head>
<body>
    <div id="grayMenu" class="container-fluid gray-menu text-dark pt-2 pb-2">
        <div class="container d-flex justify-content-end">
            <strong><?=$currentLogin ? $currentLogin : 'Guest'?></strong>
            <?php
            if ($currentLogin) {
                ?>
                <a href="/user">User panel</a>&nbsp;<b>|</b><br>
                <a href="/login?logout=1">Logout</a>
                <?php
            } else {
                ?>
                <strong><a class="gray-menu-link" href="/login">Login</a></strong>
                <?php
            }
            ?>
        </div>
    </div>
    <div id="whiteMenu" class="container-fluid bg-white">
        <div class="container">
            <div class="row pt-3 pb-3">
                <div class="col col-lg-2">
                    <a class="page-header__logo" href="/"><img src="../img/logo.svg" alt="Fashion"></a>
                </div>
                <div class="col-lg-5">
                    <form id="editDataForm" method="post" action="/" class="gx-2 row">
                        <div class="col-sm-8">
                            <input name="slug" type="text" class="form-control" id="slugInput" placeholder='Enter code or item name'>
                        </div>
                        <div class="col-auto d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary" id="searchButton">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-auto"></div>
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <a href="/addorder">in cart&nbsp;</a>
                        <div id="basketCount">
                            <?php
                            if (isset($_SESSION['basket'])) {
                                echo count($_SESSION['basket']);
                            } else {
                                echo "0";
                            }
                            ?>
                        </div>
                        &nbsp;items<b>&nbsp;|&nbsp;</b>
                        <a href="javascript://" onclick="emptyBasket()" id="mainPageEmptyBasket">Empty cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="blackMenu" class="container-fluid white-menu-text bg-black text-white d-flex justify-content-start">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a class="black-menu-link" href="/">Homepage</a>
                </div>
                <div class="col">
                    <a href="/new">new items</a>
                </div>
                <div class="col">
                    <a href="/sale">Sale</a>
                </div>
                <div class="col">
                    <a href="/delivery">Delivery</a>
                </div>
            </div>
        </div>
    </div>

    <main class="shop-page">

    <?php include 'application/views/'.$content_view; ?>

    <footer class="page-footer">
      <div class="container">
        <a class="page-footer__logo" href="/">
          <img src="../img/logo--footer.svg" alt="Fashion">
        </a>

        <nav class="page-footer__menu">
          <ul class="main-menu main-menu--footer">
            <li>
              <a class="main-menu__item" href="/index.php">Главная</a>
            </li>
            <li>
              <a class="main-menu__item" href="/new">Новинки</a>
            </li>
            <li>
              <a class="main-menu__item" href="/sale">Sale</a>
            </li>
            <li>
              <a class="main-menu__item" href="/delivery">Доставка</a>
            </li>
          </ul>
        </nav>
        <address class="page-footer__copyright">
          © Все права защищены
        </address>
      </div>
    </footer>

</body>
</html>
