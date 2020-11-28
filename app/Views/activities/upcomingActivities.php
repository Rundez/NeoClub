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
            <th class="th-sm" scope="col">Navn</th>
            <th class="th-sm" scope="col">Aktivitet</th>
            <th class="th-sm" scope="col">Start (YYYY-MM-DD)</th>
            <th class="th-sm" scope="col">Slutt (YYYY-MM-DD)</th>
            <th class="th-sm" scope="col">Mer info</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($activities as $activity) : ?>
            <tr>
                <td><?= $activity['name'] ?></td>
                <td><?= $activity['aktivitet'] ?></td>
                <td><?= $activity['start'] ?></td>
                <td><?= $activity['end'] ?></td>
                <td><a class="btn btn-info" role="button" href="/activities/<?= esc($activity['slug'], 'url'); ?>">Got to
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
                            <label for="aktivitet">Aktivitet (Feks. Golf)</label>
                            <input name="aktivitet" type="text" class="form-control" id="aktivitet"
                                   placeholder="Hva slags aktivitet?">
                        </div>
                        <div class="form-group">
                            <label for="start">Start</label>
                            <input name="start" type="datetime-local" class="form-control" id="start"
                                   placeholder="Når starter aktiviteten??">
                        </div>
                        <div class="form-group">
                            <label for="slutt">Slutt</label>
                            <input name="end" type="datetime-local" class="form-control" id="slutt"
                                   placeholder="Når slutter aktiviteten?">
                        </div>
                        <div class="form-group">
                            <label for="body">Beskrivelse</label>
                            <textarea name="body" rows="3" type="text" class="form-control" id="body"
                                   placeholder="Beskrivelse"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Velg bilde</label>
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