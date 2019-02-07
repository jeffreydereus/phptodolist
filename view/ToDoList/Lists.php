<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Uw Lijstjes</th>
            <th scope="col">Edit</th>
            <th scope="col">Verwijder</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $lists = getLists($_SESSION["UUID"]);

        foreach ($lists as $Items => $values){
            echo '<tr>';
            echo '<th scope="row"><a href=' .URL . 'ToDoList/ShowList/' . $values["ListID"] . '>' . $values["ListName"]  . '</a></th>';
            echo '<th scope="row"><a href='  . '>' . 'Edit</a></th>';
            echo '<th scope="row"><a href='  . '>' . 'Verwijder</a></th>';
            echo '</tr>';
        }


        ?>
        </tbody>
    </table>
</div>
