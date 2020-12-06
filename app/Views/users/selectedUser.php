<?php if (session()->get('role') != 'admin') {
  header('location:/');
  exit();
} ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
      <h2 class="mb-4 mt-4 page-title">Edit member profile</h2>
      <div class="my-4">

        <?php if (session()->get('error')) : ?>
          <div class="col-12">
            <div class="alert alert-danger" role="alert">
              <?= session()->get('error') ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (session()->get('success')) : ?>
          <div class="col-12">
            <div class="alert alert-success" role="alert">
              <?= session()->get('success') ?>
            </div>
          </div>
        <?php endif; ?>


        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
          <li class="nav-item">
          </li>
        </ul>
        <form action="/admin/edituser" method="post">
          <div class="row mt-5 align-items-center">
            <div class="col-md-3 text-center mb-5">
              <div class="avatar avatar-xl">
                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="..." class="avatar-img rounded-circle" />
              </div>
            </div>
            <div class="col">
              <div class="row align-items-center">
                <div class="col-md-7">
                  <h4 class="mb-1"><?= $user['firstName'] ?> <?= $user['lastName'] ?></h4>
                  <p class="small mb-3"><span class="badge badge-dark"><?= $user['posttown'] ?></span></p>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-md-7">
                  <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus. In hac habitasse platea dictumst. Cras urna quam, malesuada vitae risus at,
                    pretium blandit sapien.
                  </p>
                </div>
                <div class="col">
                  <p class="small mb-0 text-muted"><?= $user['address'] . ", " . $user['postalcode'] ?></p>
                  <p class="small mb-0 text-muted"><?= $user['posttown'] ?></p>
                  <p class="small mb-0 text-muted"><?= $user['phone'] ?></p>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4" />
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="firstname">Firstname</label>
              <input type="text" name="firstname" id="firstname" value="<?= $user['firstName'] ?>" class="form-control"  />
            </div>
            <div class="form-group col-md-6">
              <label for="lastname">Lastname</label>
              <input type="text" name="lastname" id="lastname" value="<?= $user['lastName'] ?>" class="form-control"  />
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail4">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" id="inputEmail4" />
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="address">Address</label>
              <input type="text" name="address" class="form-control" value="<?= $user['address'] ?>" id="addres"  />
            </div>
            <div class="form-group col-md-4">
              <label for="posttown">Post town</label>
              <input type="text" name="posttown" class="form-control" value="<?= $user['posttown'] ?>" id="posttown"  />
            </div>
            <div class="form-group col-md-2">
              <label for="postalcode">Postal code</label>
              <input type="text" name="postalcode" value="<?= $user['postalcode'] ?>" class="form-control" id="postalcode" />
            </div>
          </div>
      </div>
      <input type="hidden" name="id" value="<?= $user['id'] ?>">
      <input type="hidden" name="slug" value="<?= $user['slug'] ?>">

      <button type="submit" class="btn btn-primary confirm">Save Changes</button>
      </form>
    </div>
  </div>
</div>
</div>

<style>
  body {
    color: #8e9194;
    background-color: #f4f6f9;
  }

  .avatar-xl img {
    width: 110px;
  }

  .rounded-circle {
    border-radius: 50% !important;
  }

  img {
    vertical-align: middle;
    border-style: none;
  }

  .text-muted {
    color: #aeb0b4 !important;
  }

  .text-muted {
    font-weight: 300;
  }

  .form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #4d5154;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid #eef0f3;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }

  .confirm {
    margin-bottom: 20px;
  }
</style>