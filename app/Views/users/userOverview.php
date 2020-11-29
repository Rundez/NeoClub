<?php if(!session()->get('role') != 'admin')
{
    header('location:/posts');
    exit();
} ?>
<div class="container mb-5 mt-3">
    <h1 style="margin-top: 0.5em;"><?= ($title); ?></h1>
    <hr>
    <table class="table table-active" id="selectedColumn">
        <thead>
            <tr>
                <th class="th-sm" scope="col">Fornavn</th>
                <th class="th-sm" scope="col">Etternavn</th>
                <th class="th-sm" scope="col">Epost</th>
                <th class="th-sm" scope="col">Medlem siden</th>
                <th class="th-sm" scope="col">Kontigentstatus</th>
                <th class="th-sm" scope="col">Aktiviteter</th>
                <th class="th-sm" scope="col">Gå til medlem</th>
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
                        } else {echo "Ingen data";}
                        ?>
                        </td>
                        <td><a class="btn btn-info" role="button" href="/users/<?= esc($user['slug'], 'url'); ?>">Go to user</a></td>
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
    $(document).ready(function() {
        $('#selectedColumn').DataTable();
    });
</script>