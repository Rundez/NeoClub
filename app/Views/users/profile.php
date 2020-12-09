<div class="row py-5 px-4">
    <div class="col-md-5 mx-auto">
        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden" id="demo">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">

                    <div class="profile mr-3"><img src="uploads/<?= session()->get('id') ?>" alt="..." width="130" class="rounded mb-2 img-thumbnail"><a href="#" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-outline-dark btn-sm btn-block">Add profile picture <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-image" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9c0 .013 0 .027.002.04V12l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15 9.499V3.5a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm4.502 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg></a></div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><?= $firstname ?> <?= $lastname ?></h4>
                        <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i></p>
                    </div>
                    <div class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#editProfile">Edit profile</div>
                </div>

            </div>
            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"></h5><small class="text-muted"> <i class="fas fa-image mr-1"></i></small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"></h5><small class="text-muted"> <i class="fas fa-user mr-1"></i></small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block"></h5><small class="text-muted"> <i class="fas fa-user mr-1"></i></small>
                    </li>
                </ul>
            </div>

            <?php if (session()->get('error')) : ?>
                <div class="alert alert-danger" width="75%" role="alert">
                    <?= session()->get('error') ?>
                </div>

            <?php elseif (session()->get('success')) : ?>
                <div class="alert alert-success" width="75%" role="alert">
                    <?= session()->get('success') ?>
                </div>

            <?php endif ?>


            <?php if (!empty($hobbies) && is_array($hobbies)) : ?>
                <div class="px-4 py-3">
                    <h5 class="mb-0">Hobbies</h5>
                    <div class="p-4 rounded shadow-sm bg-light">
                        <?php foreach ($hobbies as $hobby) : ?>
                            <p class='font-italic mb-0'><?= $hobby ?></p>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>

            <div class="px-4 py-3">
                <h5 class="mb-0">Personal</h5>
                <div class="p-4 rounded shadow-sm bg-light">
                    <p class="font-italic mb-0">Firstname: <?= session()->get('firstname') ?></p>
                    <p class="font-italic mb-0">Lastname: <?= session()->get('lastname') ?></p>
                    <p class="font-italic mb-0">Email: <?= session()->get('email') ?></p>
                    <p class="font-italic mb-0">Role: <?= session()->get('role') ?></p>

                </div>
            </div>


            <div class="py-4 px-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Additional information</h5><a href="#" class="btn btn-link text-muted"></a>
                </div>
                <div class="p-4 rounded shadow-sm bg-light">
                        <p>Additional profile information here</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!--Upload Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/users/addProfilePic" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Choose image</label>
                        <input name="image" type="file" class="form-control" id="image">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!--Edit profile modal -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit profile information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/users/edit" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input name="firstname" type="text" class="form-control" value="<?= $firstname ?>" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <input name="lastname" type="text" class="form-control" value="<?= $lastname ?>" placeholder="Last name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" value="<?= $email ?>" placeholder="Email">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>


<style>
    .profile-head {
        transform: translateY(5rem)
    }

    .cover {
        background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
        background-size: cover;
        background-repeat: no-repeat
    }

    #demo {
        -webkit-box-shadow: -5px 3px 9px -1px rgba(0, 0, 0, 0.59);
        box-shadow: -5px 3px 9px -1px rgba(0, 0, 0, 0.59);
    }
</style>