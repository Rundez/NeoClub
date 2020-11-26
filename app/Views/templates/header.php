<!doctype html>
<html>

<head>
    <title>Neo ungdomsklubb</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/home.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
    <?php if ($_SERVER['REQUEST_URI'] == "/chat") {
        echo "<link rel='stylesheet' href='/assets/css/chat.css'>";
    } ?>

<body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo session()->get('isLoggedIn') ? "/posts" : "/"; ?>">Neo Club</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?php if (session()->get('isLoggedIn')) : ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/posts">The wall <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/users">All users</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin">Admin</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/chat">Chat</a>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aktiviteter
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/upcoming">Kommende aktiviteter</a>
                            <a class="dropdown-item" href="/activities">Alle aktiviteter</a>
                        </div>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/profile">My profile</a>
                            <a class="dropdown-item" href="/edit">Edit profile</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <p style="margin: 0" class="nav-link"><?= session()->get('firstname') ?></p>
                    </li>
                    <li class="nav-item active float-sm-right">
                        <a class="nav-link" href="/logout">Log out</a>
                    </li>

                </ul>
            <?php else : ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/posts">The wall <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/login">Log in</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>