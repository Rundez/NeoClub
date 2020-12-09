<?php if (session()->get('role') != 'admin') {
    header('location:/posts');
    exit();
} ?>
<div class="container mb-5 mt-3">
  <h1 style="margin-top: 0.5em;">Neo Club Members</h1>
  <hr>
    <?php if(session()->get('success')): ?>
      <div class="alert alert-success" role="alert">
          <?= session()->get('success') ?>
      </div>
    <?php endif; ?>
  <table class="table table-active" id="selectedColumn">
    <thead>
    <tr>
      <th class="th-sm" scope="col">Firstname</th>
      <th class="th-sm" scope="col">Lastname</th>
      <th class="th-sm" scope="col">Email</th>
      <th class="th-sm" scope="col">Member since</th>
      <th class="th-sm" scope="col">Subscription status</th>
      <th class="th-sm" scope="col">Activities</th>
      <th class="th-sm" scope="col">User profiles</th>
      <th class="th-sm" scope="col">Send Invoice</th>
    </tr>
    </thead>

    <tbody>
    <?php if (!empty($users) && is_array($users)) : ?>
    <?php foreach ($users as $user) : ?>
      <tr>
        <td><?= $user['firstName'] ?></td>
        <td><?= $user['lastName'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= substr($user['created'], 0, -10) ?></td>
        <td><?= $user['kontigentstatus'] ?></td>
        <td>
            <?php
            if ($user['hobbies'] != "Ingen data") {
                foreach ($user['hobbies'] as $hobbies) {
                    echo $hobbies['hobby'] . "\n";
                }
            } else {
                echo "No hobbies";
            }
            ?>
        </td>
        <td><a class="btn btn-info" role="button" href="/users/<?= esc($user['slug'], 'url'); ?>">Go to user profile</a></td>
        <td><a class="btn btn-info" role="button" href="/admin/sendemail/<?=$user['email']?>">Send Invoice</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

    <?php else : ?>
      <h3>No user found</h3>
      <p>Unable to find any users for you.</p>
    <?php endif ?>
</div>


<script>
  $(document).ready(function () {
    $('#selectedColumn').DataTable();
  });
</script>