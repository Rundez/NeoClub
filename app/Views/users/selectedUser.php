<?php if(!session()->get('isLoggedIn')) {
    header('location:/');
    exit();
} ?>
<div class="container">
  <div class="container">
    <div class="card" style="width: 18rem;">
      <img src="../images/Persona.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">
          <p><?= ($user['firstName']) . " " . ($user['lastName']); ?></p>
        </h5>
        <p class="card-text">Lorem ipsum dolor sit amet, consectet</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <p><?= ($user['email']); ?></p>
        </li>
        <li class="list-group-item">
          <p><?= ($user['created']); ?></p>
        </li>
      </ul>
    </div>
  </div>