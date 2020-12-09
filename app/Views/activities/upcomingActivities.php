<?php if(!session()->get('isLoggedIn')) {
    header('location:/');
    exit();
} ?>

<div class="container">
    <h1 style="margin:auto; width:50%; margin-top: 0.5em" ><?= $title ?> </h1>
    <hr>
    <?php if (!empty($activities) && is_array($activities)) : ?>
    <!-- Activities table -->
    <table class="table table-active" id="selectedColumn">
        <thead>
        <tr>
            <th class="th-sm" scope="col">Name</th>
            <th class="th-sm" scope="col">Kind of activity</th>
            <th class="th-sm" scope="col">Start </th>
            <th class="th-sm" scope="col">End </th>
            <th class="th-sm" scope="col">More info</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($activities as $activity) : ?>
            <?php
             $start = date('d F, Y H:i:s', strtotime($activity['start']));
             $end = date('d F, Y H:i:s', strtotime($activity['end']));
            ?>

            <tr>
                <td><?= $activity['name'] ?></td>
                <td><?= $activity['aktivitet'] ?></td>
                <td><?= $start ?></td>
                <td><?= $end ?></td>
                <td><a class="btn btn-info" role="button" href="/activities/<?= esc($activity['slug'], 'url'); ?>">Go to
                        activity</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <h4 style="color: #85271f">No upcoming activities</h4>
    <hr>
<?php endif ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Add new activity
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/activities/add" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" id="name"
                                   aria-describedby="emailHelp" placeholder="Name of activity">
                        </div>
                        <div class="form-group">
                            <label for="aktivitet">Activity (e.g., Golf)</label>
                            <input name="aktivitet" type="text" class="form-control" id="aktivitet"
                                   placeholder="What kind of activity?">
                        </div>
                        <div class="form-group">
                            <label for="start">Start</label>
                            <input name="start" type="datetime-local" class="form-control" id="start"
                                   placeholder="When does the activity start?">
                        </div>
                        <div class="form-group">
                            <label for="slutt">End</label>
                            <input name="end" type="datetime-local" class="form-control" id="slutt"
                                   placeholder="When does the activity end?">
                        </div>
                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" rows="3" type="text" class="form-control" id="body"
                                   placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload image</label>
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
</div>

<script>
    $(document).ready(function() {
        $('#selectedColumn').DataTable();
    } );
</script>