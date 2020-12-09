<div class="container">
    <h1 style="margin-top:20px"><?= ($title) ?></h1>

    <?php if (session()->get('isLoggedIn')) : ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-right" style="margin-bottom: 20px; margin-right: 30%" data-toggle="modal" data-target="#exampleModalCenter">
            Say something!
        </button>
    <?php endif; ?>

    <?php if (session()->get('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->get('error') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($posts) && is_array($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
            <div class="card bg-light shadow-sm mb-0" style="width: 70%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="../uploads/<?= $post['id'] ?>" class="card-img" alt="profile picture">
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
            <?php if (!empty($post['comments'] && is_array($post['comments']))) : ?>
                <?php foreach ($post['comments'] as $comment) : ?>
                    <div class="box-footer box-comments" style="width: 70%">
                        <div class="box-comment"> <img class="img-circle img-sm" src="../uploads/<?= $comment['senderID'] ?>" onerror="this.onerror=null;this.src='https://img.icons8.com/office/36/000000/person-female.png';">
                            <div class="comment-text"> <span class="username"> <?= $comment['firstName'] . " " . $comment['lastName'] ?> <span class="text-muted pull-right">8:03 PM Today</span> </span> <?= $comment['message'] ?> </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (session()->get('isLoggedIn')) : ?>
                <!--Input box for commenting -->
                <div class="box-footer mb-2" style="width: 70%">
                    <form action="posts/addComment" method="post"> <img class="img-responsive img-circle img-sm" src="../uploads/<?= session()->get('id') ?>" onerror="this.onerror=null;this.src='https://img.icons8.com/office/36/000000/person-female.png';">
                        <div class="img-push"> <input type="text" name="message" class="form-control input-sm" placeholder="Press enter to post comment"> </div>
                        <?php if ($post['postID']) : ?>
                            <input type="hidden" name="postid" value="<?= $post['postID'] ?>" ?>
                        <?php endif; ?>
                    </form>
                </div>
            <?php else : ?>
                <div class="mt-3"></div>
            <?php endif ?>
        <?php endforeach; ?>


    <?php else : ?>

        <h3>No Posts</h3>

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


<style>
    .container {
        margin-bottom: 500px
    }

    .stretch-card>.card {
        width: 100%;
        min-width: 100%
    }

    .flex {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto
    }

    @media (max-width:991.98px) {
        .padding {
            padding: 1.5rem
        }
    }

    @media (max-width:767.98px) {
        .padding {
            padding: 1rem
        }
    }

    .padding {
        padding: 3rem
    }

    .box-widget {
        border: none;
        position: relative
    }

    .box {
        position: relative;
        border-radius: 3px;
        background: #ffffff;
        border-top: 3px solid #d2d6de;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1)
    }

    .box-header.with-border {
        border-bottom: 1px solid #f4f4f4
    }

    .box-header {
        color: #444;
        display: block;
        padding: 10px;
        position: relative
    }

    .user-block img {
        width: 40px;
        height: 40px;
        float: left
    }

    .img-circle {
        border-radius: 50%
    }

    .user-block .username {
        font-size: 16px;
        font-weight: 600
    }

    .username a {
        text-decoration: none
    }

    .user-block .username,
    .user-block .description,
    .user-block .comment {
        display: block;
        margin-left: 50px
    }

    .user-block .description {
        color: #999;
        font-size: 13px
    }

    .user-block .username,
    .user-block .description,
    .user-block .comment {
        display: block;
        margin-left: 50px
    }

    .user-block:after {
        clear: both
    }

    .user-block:before,
    .user-block:after {
        content: "";
        display: table
    }

    .box-header>.box-tools {
        position: absolute;
        right: 10px;
        top: 5px
    }

    .box-header>.box-tools [data-toggle="tooltip"] {
        position: relative
    }

    .btn {
        border-radius: 3px;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid transparent
    }

    .btn-box-tool {
        padding: 5px;
        font-size: 12px;
        background: transparent;
        color: #97a0b3
    }

    .box-header:after,
    .box-body:after,
    .box-footer:after {
        clear: both
    }

    .box-body {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        padding: 10px
    }

    .pad {
        padding: 10px
    }

    .img-responsive,
    .thumbnail a>img,
    .thumbnail>img {
        display: block;
        max-width: 100%;
        height: auto
    }

    p {
        margin: 0 0 10px
    }

    .btn-default {
        background-color: #f4f4f4;
        color: #444;
        border-color: #ddd
    }

    .btn {
        border-radius: 3px;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid transparent
    }

    .btn-group-xs>.btn,
    .btn-xs {
        padding: 1px 5px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px
    }

    .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc
    }

    .pull-right {
        float: right !important
    }

    .text-muted {
        color: #777;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        background-color: #fff
    }

    .box-comments {
        background: #f7f7f7
    }

    .box-footer {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        border-top: 1px solid #f4f4f4;
        padding: 10px
    }

    .box-comments .box-comment:first-of-type {
        padding-top: 0
    }

    .box-comments .box-comment {
        padding: 8px 0;
        border-bottom: 1px solid #eee
    }

    .box-comments .box-comment:before,
    .box-comments .box-comment:after {
        content: "";
        display: table
    }

    .img-sm,
    .box-comments .box-comment img,
    .user-block.user-block-sm img {
        width: 30px !important;
        height: 30px !important
    }

    .img-sm,
    .img-md,
    .img-lg,
    .box-comments .box-comment img,
    .user-block.user-block-sm img {
        float: left
    }

    .box-comments .comment-text {
        margin-left: 40px;
        color: #555
    }

    .box-comments .username {
        color: #444;
        display: block;
        font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        overflow-x: hidden;
        overflow-y: auto
    }

    .box-comments .text-muted {
        font-weight: 400;
        font-size: 12px;
        background-color: #f7f7f7
    }

    .box-footer {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        border-top: 1px solid #f4f4f4;
        padding: 10px
    }

    .box-header:before,
    .box-body:before,
    .box-footer:before,
    .box-header:after,
    .box-body:after,
    .box-footer:after {
        content: "";
        display: table
    }

    .img-sm,
    .box-comments .box-comment img,
    .user-block.user-block-sm img {
        width: 30px !important;
        height: 30px !important
    }

    .img-sm {
        float: left
    }

    .img-sm+.img-push {
        margin-left: 40px
    }
</style>