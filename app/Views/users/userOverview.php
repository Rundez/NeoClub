<div class="container">

<h1><?= ($title); ?></h1>
<?php if (! empty($users) && is_array($users)) : ?>

    <?php foreach ($users as $user): ?>

        <h3><?= ($user['firstName']); ?></h3>
        <p> <?= $user['lastName'];?> </p>
        
        <p><a href="/users/<?= esc($user['slug'], 'url'); ?>">Got to user</a></p>

    <?php endforeach; ?>

<?php else : ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>

</div>