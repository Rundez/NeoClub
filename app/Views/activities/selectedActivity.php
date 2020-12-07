<div class="container-sm">
    <div class="jumbotron mt-5">
  <!-- Portfolio Item Heading -->
  <h1 class="my-4"><?= $activity['name'] ?></h1>
  <hr class="my-4">

  <!-- Portfolio Item Row -->
  <div class="row">

    <div class="col-md-8">
      <img class="img-flud" src="../uploads/<?= $activity['image'] ?>" alt="">
    </div>

    <div class="col-md-4">
      <h3 class="my-3">Description</h3>
      <p><?= $activity['body'] ?></p>
      <h3 class="my-3">Details</h3>
      <ul>
        <li><?= $activity['aktivitet'] ?></li>
      </ul>
    </div>

  </div>
  <!-- /.row -->

  <!-- Related Projects Row -->
  <h3 class="my-4">Related Projects</h3>

  <div class="row">


  </div>
  <!-- /.row -->

</div>
    </div>
</div>



<style>
    .img-flud {
        width: 100%;
        height: 100%;
    }

    .jumbotron {
        background-color: white;
    }
</style>