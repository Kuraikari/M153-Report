<?php

use services\DatabaseSeeder;

$databaseSeed = new DatabaseSeeder();

$databaseSeed->run();

use services\QueryBuilder;

    $query = new QueryBuilder();
    $myQuery = $query
                ->select('user')
                ->from('user')
                ->execute();
?>
<html>
<head>
    <link href="../../css/base.css" type="text/css" rel="stylesheet">
    <script src="../../js/customElements.js"></script>
</head>
<body>
    <div id="nav-main">
        <header>
            <img src="../../assets/pictures/report-logo.png" alt="lololol">
        </header>
        <div class="left">
            <div>
                <ul class="menu-main">
                    <li><a href="home">Home</a></li>
                    <li><a href="about-us">About us</a></li>
                    <li>
                        <a href="">Manage</a>
                        <ul>
                            <li><a href="users">Users</a></li>
                            <li><a href="customers">Customers</a></li>
                            <li><a href="reports">Reports</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right">
            <div>
                <a href="#login-popup" class="btn-login">LogIn</a>
                <a href="" class="btn-language">EN</a>
            </div>
        </div>
    </div>
    <div id="login-popup">
        <form method="post">
            <a href="" class="btn-reset">X</a>
            <input type="text" name="username" placeholder="username"><br>
            <input type="password" name="password" placeholder="password"><br>

            <input type="checkbox" name="remember-me" id="remember-me">
            <label for="remember-me">Remember me</label><br>

            <input type="submit" value="Log In">
        </form>
    </div>
    <div class="wrapper-outer">
        <div class="wrapper-inner">