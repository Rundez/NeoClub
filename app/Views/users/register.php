<?php
if (session()->get('isLoggedIn') && session()->get('role') == 'admin') {
  $type = 'admin';
} else {
  $type = 'member';
}
?>

<div class="container">
  <div class="row">
    <div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 gb-white form-wrapper">
      <div class="container">
        <h3>Register</h3>
        <hr>
        <form class="form" action="/register" method="POST">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="phone">Phone number</label>
                <input type="tel" class="form-control" name="phone" id="phone" value="<?= set_value('phone') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-5">
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="<?= set_value('address') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <div class="form-group">
                <label for="postalcode">Postal code</label>
                <input type="number" class="form-control" name="postalcode" id="postalcode" value="<?= set_value('postalcode') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-4">
              <div class="form-group">
                <label for="posttown">Post Town</label>
                <input type="text" class="form-control" name="posttown" id="posttown" value="<?= set_value('posttown') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?= set_value('password') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="confirmPassword">Confirm password</label>
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="<?= set_value('password_confirm') ?>">
              </div>
            </div>
            <?php if (isset($validation)) : ?>
              <div class="col-12">
                <div class="alert alert-danger" role="alert">
                  <?= $validation->listErrors() ?>
                </div>
              </div>
            <?php endif; ?>
          </div>

          <div class="row">
            <div class="col-12 col-sm-4 mb-2">
              <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                  <label class="form-check-label" for="male">
                    Male
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                  <label class="form-check-label" for="female">
                    Female
                  </label>
                </div>
            </div>
          </div>


            <div class="row">
              <div class="col-12 col-sm-4">
                <input type="hidden" name="type" value="<?= $type ?>">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>

              <?php if ($type == 'admin') : ?>
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="rights">Select role</label>
                    <select class="form-select" id="role" aria-label="Default select example">
                      <option value="member">Member</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                </div>
              <?php endif; ?>

              <?php if ($type == 'member') : ?>
                <div class="col-12 col-sm-8 text-right">
                  <a href="/login">Already have an account?</a>
                </div>
              <?php endif; ?>
            </div>
          </div>
      </div>
    </div>
    </form>
  </div>
</div>
</div>