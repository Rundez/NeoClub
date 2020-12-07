<?php
$start = date('d F, Y H:i:s', strtotime($activity['start']));
$end = date('d F, Y H:i:s', strtotime($activity['end']));

?>

<div class="container-sm">
    <div class="jumbotron mt-5">
        <div class="row">
            <div class="col-md-7">
                <h1 class="my-4"><?= $activity['name'] ?></h1>
            </div>
            <div class="col-md-4">
                <p style="float:right">From: <?= $start ?></p>
                <p style="float:right">To: <?= $end ?></p>
            </div>
        </div>

        <hr class="mb-4">

        <!-- Portfolio Item Row -->
        <div class="row">
            <div class="col-md-7">
                <img class="img-flud" src="../uploads/<?= $activity['image'] ?>" alt="">
            </div>

            <div class="col-md-3">
                <h3 class="my-3">Description</h3>

                <p><?= $activity['body'] ?></p>
                <h3 class="my-3">Attending</h3>

                <?php if(!empty($attending) && is_array($attending)) : ?>

                <ul class="list-group">
                    <?php for ($i = 0; $i < count($attending); $i++) : ?>
                        <li class="list-group-item"><?= $attending[$i]['firstName'] . " " . $attending[$i]['lastName'] ?></li>
                        <?php if($i > 3){break;} ?>
                    <?php endfor ?>
                </ul>
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#attendingModal">See more</button>
                    <?php else: ?>
                    <p>Click attend to be the first to join this activity!</p>
                    <?php endif?>
            </div>
            <div class="col-md-2">
                <form action="attendActivity/<?= $activity['id'] ?>" method="post">
                    <button class="btn btn-primary mt-2">Attend</button>
                </form>
            </div>
        </div>

        <hr>
        <div class="row">


        </div>
        <!-- /.row -->

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="attendingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Who is coming?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php foreach ($attending as $attending) : ?>
                        <li class="list-group-item"><?= $attending['firstName'] . " " . $attending['lastName'] ?></li>
                    <?php endforeach ?>
                </ul>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>



<style>
    .img-flud {
        width: 550px;
        height: 480px;
    }

    .jumbotron {
        background-color: white;
    }
</style>