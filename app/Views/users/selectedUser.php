<?php if (session()->get('role') != 'admin') {
  header('location:/');
  exit();
} ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
      <h2 class="mb-4 mt-4 page-title">Edit member profile</h2>
      <div class="my-4">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
          <li class="nav-item">
          </li>
        </ul>
        <form>
          <div class="row mt-5 align-items-center">
            <div class="col-md-3 text-center mb-5">
              <div class="avatar avatar-xl">
                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="..." class="avatar-img rounded-circle" />
              </div>
            </div>
            <div class="col">
              <div class="row align-items-center">
                <div class="col-md-7">
                  <h4 class="mb-1"><?= $user['firstName']?> <?= $user['lastName']?></h4>
                  <p class="small mb-3"><span class="badge badge-dark">New York, USA</span></p>
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
                  <p class="small mb-0 text-muted">Nec Urna Suscipit Ltd</p>
                  <p class="small mb-0 text-muted">P.O. Box 464, 5975 Eget Avenue</p>
                  <p class="small mb-0 text-muted">(537) 315-1481</p>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4" />
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="firstname">Firstname</label>
              <input type="text" id="firstname" class="form-control" placeholder="Brown" />
            </div>
            <div class="form-group col-md-6">
              <label for="lastname">Lastname</label>
              <input type="text" id="lastname" class="form-control" placeholder="Asher" />
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="inputEmail4" placeholder="brown@asher.me" />
          </div>
          <div class="form-group">
            <label for="inputAddress5">Address</label>
            <input type="text" class="form-control" id="inputAddress5" placeholder="P.O. Box 464, 5975 Eget Avenue" />
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCompany5">Company</label>
              <input type="text" class="form-control" id="inputCompany5" placeholder="Nec Urna Suscipit Ltd" />
            </div>
            <div class="form-group col-md-4">
              <label for="inputState5">State</label>
              <select id="inputState5" class="form-control">
                <option selected="">Choose...</option>
                <option>...</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip5">Zip</label>
              <input type="text" class="form-control" id="inputZip5" placeholder="98232" />
            </div>
          </div>
          <hr class="my-4" />
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputPassword4">Old Password</label>
                <input type="password" class="form-control" id="inputPassword5" />
              </div>
              <div class="form-group">
                <label for="inputPassword5">New Password</label>
                <input type="password" class="form-control" id="inputPassword5" />
              </div>
              <div class="form-group">
                <label for="inputPassword6">Confirm Password</label>
                <input type="password" class="form-control" id="inputPassword6" />
              </div>
            </div>
            <div class="col-md-6">
              <p class="mb-2">Password requirements</p>
              <p class="small text-muted mb-2">To create a new password, you have to meet all of the following requirements:</p>
              <ul class="small text-muted pl-4 mb-0">
                <li>Minimum 8 character</li>
                <li>At least one special character</li>
                <li>At least one number</li>
                <li>Can’t be the same as a previous password</li>
              </ul>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Save Change</button>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  body{
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
</style>