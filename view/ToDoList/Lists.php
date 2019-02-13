<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Uw Lijstjes</th>
            <th scope="col">Edit</th>
            <th scope="col">Verwijder</th>
            <th scope="col">Andere bevoegden</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $lists = getLists($_SESSION["UUID"]);

        foreach ($lists as $Items => $values){
            echo '<tr>';
            echo '<th scope="row"><a href=' .URL . 'ToDoList/ShowList/' . $values["ListID"] . '>' . $values["ListName"]  . ' </a><span class="badge">' . $values["ListItemsCount"] . '</span></th>';
            echo '<th scope="row"><a href=' .URL . 'ToDoList/EditList/' . $values["ListID"] . '>' . 'Edit</a></th>';
            echo '<th scope="row"><a href=' .URL . 'ToDoList/DeleteList/' . $values["ListID"] . '>' . 'Verwijder</a></th>';
            echo '<th scope="row"><a href=' .URL . 'ToDoList/SeeVisitors/' . $values["ListID"] . '>' . 'Bevoegden</a></th>';
            echo '</tr>';
        }


        ?>
        </tbody>
    </table>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Lijstjes die met u gedeeld worden</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $lists2 = GetSharedLists($_SESSION["UUID"]);

        foreach ($lists2 as $Items => $values){
            echo '<tr>';
            echo '<th scope="row"><a href=' .URL . 'ToDoList/ShowList/' . $values["SharedListID"] . '>' . $values["ListName"]  . ' </a><span class="badge">' . $values["ListItemsCount"] . '</span></th>';
            echo '</tr>';
        }


        ?>
        </tbody>
    </table>
</div>
