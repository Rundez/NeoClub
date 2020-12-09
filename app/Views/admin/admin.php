<?php if (session()->get('role') != 'admin') {
    header('location:/posts');
    exit();
} ?>
<div class="container" style="margin-top: 1em">
    <div class="jumbotron" style="background-color:white;">
        <h1><?= $title ?></h1>
        <ul class="list-group" style="width: 50%;">
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>

            <li class="list-group-item"><a role="button" href="/users">Member overview</a></li>
            <li class="list-group-item"><a role="button" href="/register">Add member</a></li>
        </ul>
    </div>
</div>