<div class="container">
    <table class="table table-striped" id="table">
        <thead>
        <tr>
            <th scope="col">Log Entry ID</th>
            <th scope="col">Exception</th>
            <th scope="col">Exception Thrown</th>
            <th scope="col">Action Type</th>
            <th scope="col">Log Date</th>
            <th scope="col">Controller Action</th>
            <th scope="col">Target ID</th>
            <th scope="col">UUID</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($logs as $Items => $values){
            echo '<tr>';
            echo '<td scope="row">' . $values["LogEntryID"]  . '</a></td>';
            echo '<td scope="row">' . $values["Exception"]  . '</a></td>';
            if ($values["ExceptionThrown"] == 0) {
                echo '<td scope="row">Nee</a></td>';
            } else {
                echo '<td scope="row">Ja</a></td>';

            }
            echo '<td scope="row">' . $values["ActionType"]  . '</a></td>';
            echo '<td scope="row">' . $values["LogDate"]  . '</a></td>';
            echo '<td scope="row">' . $values["ControllerAction"] . '</td>';
            echo '<td scope="row">' . $values["TargetID"] . '</td>';
            echo '<td scope="row">' . $values["UUID"] . '</td>';
            echo '</tr>';
        }


        ?>
        </tbody>
    </table>
</div>

