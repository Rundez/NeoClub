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
        <?php if (session()->get('success')) : ?>
            <div class="alert alert-success" role="alert" style="text-align:center">
                <?= session()->get('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->get('error')) : ?>
            <div class="alert alert-danger" role="alert" style="text-align:center">
                <?= session()->get('error') ?>
            </div>
        <?php endif; ?>



        <!-- Portfolio Item Row -->
        <div class="row">
            <div class="col-md-7">
                <img class="img-flud" src="../uploads/<?= $activity['image'] ?>" alt="">
            </div>

            <div class="col-md-3">
                <h3 class="my-3">Description</h3>

                <p><?= $activity['body'] ?></p>
                <h3 class="my-3">Attending</h3>

                <?php if (!empty($attending) && is_array($attending)) : ?>

                    <ul class="list-group">
                        <?php for ($i = 0; $i < count($attending); $i++) : ?>
                            <li class="list-group-item"> <a href="/users/<?=$attending[$i]['slug']?>"><?= $attending[$i]['firstName'] . " " . $attending[$i]['lastName'] ?></a></li>
                            <?php if ($i > 3) {
                                break;
                            } ?>
                        <?php endfor ?>
                    </ul>
                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#attendingModal">See more</button>
                <?php else : ?>
                    <p>Click attend to be the first to join this activity!</p>
                <?php endif ?>
            </div>
            <div class="col-md-1">
                <form action="attendActivity/<?= $activity['id'] ?>" method="post">
                    <button class="btn btn-primary mt-2">Attend</button>
                </form>
            </div>
            <div class="col-md-1">
                <form action="cancelAttendActivity/<?= $activity['id'] ?>" method="post">
                    <button class="btn btn-danger mt-2">Resign</button>
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
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Who is attending?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php foreach ($attending as $attending) : ?>


                        <li class="list-group-item"><a href="/users/<?=$attending['slug'] ?>"><?= $attending['firstName'] . " " . $attending['lastName'] ?> </a></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>



<style>
    .img-flud {
        width: 580px;
        height: 480px;
    }

    .jumbotron {
        background-color: white;
    }
</style>