<div class="container">
    <h1><?= ($title) ?></h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-right" style="margin-bottom: 20px; margin-right: 45%" data-toggle="modal" data-target="#exampleModalCenter">
        Say something!
    </button>

    <?php if (session()->get('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->get('error') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($posts) && is_array($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
            <div class="card mb-3 bg-light shadow-sm" style="width: 55%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                    <img src="https://randomuser.me/api/portraits/men/<?= rand(0,90) ?>.jpg"class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= ($post['title']) ?></h5>
                            <p class="card-text"><?= ($post['body']) ?></p>
                            <p class="card-text"><small class="text-muted"><a href="/users/<?= ($post['slug']) ?>"><?= ($post['firstName']) . " " . ($post['lastName']) ?></a></small></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>    


    <?php else : ?>

        <h3>No News</h3>

        <p>Unable to find any posts for you.</p>

    <?php endif ?>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/posts/newPost" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="The post title">
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" rows="3" type="text" class="form-control" id="body" placeholder="What is on your mind?"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


</div>