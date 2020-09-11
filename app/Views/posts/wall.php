<div class="container">
    <h1><?= ($title) ?></h1>

    <?php if (!empty($posts) && is_array($posts)) : ?>
        
            <?php foreach ($posts as $post) : ?>
                <div class="card mb-3 bg-light" style="width: 55%;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="./images/Persona.png" class="card-img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= ($post['title']) ?></h5>
                                <p class="card-text"><?= ($post['body']) ?></p>
                                <p class="card-text"><small class="text-muted"><a href="/users/<?=($post['slug']) ?>"><?= ($post['firstName']) . " " . ($post['lastName']) ?></a></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        <?php else : ?>

            <h3>No News</h3>

            <p>Unable to find any posts for you.</p>

        <?php endif ?>

        </div>