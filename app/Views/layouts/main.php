<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link href="<?= base_url('\assets\css\style.css?v=' . time()) ?>" rel="stylesheet" type="text/css">

    <?= $this->renderSection('custom_css') ?>
    <title><?= isset($meta_title) ? $meta_title : 'Image Editor'  ?></title>
</head>

<body">
    <?php
    $uri = service('uri');
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><?= isset($meta_title) ? $meta_title : 'Image Editor'  ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $uri->getSegment(1) == '' ? 'active' : null ?>" aria-current="page" href="/">Home</a>
                    </li>
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $uri->getSegment(1) == 'dashboard' ? 'active' : null ?>" aria-current="page" href="/dashboard">Dashboard</a>
                        </li>
                    <?php else : ?>

                    <?php endif; ?>

                </ul>
                <div class="d-flex">
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= session()->get('first_name') . ' ' . session()->get('last_name') ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <!-- <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li> -->
                                    <li><a class="dropdown-item" href="/user/logout">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php else : ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?= ($uri->getSegment(1) == 'user' && $uri->getSegment(2) == 'login') ? 'active' : null ?>" aria-current="page" href="/user/login">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($uri->getSegment(1) == 'user' && $uri->getSegment(2) == 'register') ? 'active' : null ?>" href="/user/register">Register</a>
                            </li>
                        </ul>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>
    <?= $this->renderSection('header') ?>
    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>
    <?= $this->renderSection('footer') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>

</html>