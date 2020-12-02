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
                <label for="firstName">First name</label>
                <input type="text" name="firstname" id="firstname" value="<?= set_value('firstname') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="lastName">Last name</label>
                <input type="text" name="lastname" id="lastname" value="<?= set_value('lastname') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-5">
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address"
                       value="<?= set_value('address') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <div class="form-group">
              <label for="postalcode">Postal code</label>
              <input type="number" class="form-control" name="postalcode" id="postalcode"
                     value="<?= set_value('postalcode') ?>">
            </div>
          </div>
            <div class="col-12 col-sm-4">
              <div class="form-group">
                <label for="posttown">Post Town</label>
                <input type="text" class="form-control" name="posttown" id="posttown"
                       value="<?= set_value('posttown') ?>">
              </div>
            </div>
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password"
                     value="<?= set_value('password') ?>">
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="confirmPassword">Confirm password</label>
              <input type="password" class="form-control" name="password_confirm" id="password_confirm"
                     value="<?= set_value('password_confirm') ?>">
            </div>
          </div>
            <?php if (isset($validation)): ?>
              <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors() ?>
                </div>
              </div>
            <?php endif; ?>
      </div>

      <div class="row">
        <div class="col-12 col-sm-4">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
        <div class="col-12 col-sm-8 text-right">
          <a href="/login">Already have an account?</a>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
</div>
</div>
</div>