<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Lijst punt</th>
            <th scope="col">Beschrijving</th>
            <th scope="col">Duur</th>
            <th scope="col">Klaar</th>
            <th scope="col">Edit</th>
            <th scope="col">Verwijder</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($VisibleList as $Items => $values){
            echo '<tr>';
            echo '<th scope="row">' . $values["ItemName"]  . '</a></th>';
            echo '<th scope="row">' . $values["ItemDescription"]  . '</a></th>';
            echo '<th scope="row">' . $values["Duration"]  . ' Min</a></th>';
            echo '<th scope="row">' . $values["ItemFinished"]  . '</a></th>';
            echo '<th scope="row"><a href=' .URL . 'ToDoList/EditListItem/' . $values["ListItemID"].  '>'  . 'Edit</a></th>';
            echo '<th scope="row"><a href=' .URL . 'ToDoList/deleteListItem/'. $values["ListItemID"] . '>'  . 'Verwijder</a></th>';
            echo '</tr>';
        }


        ?>
        </tbody>
    </table>
    <form id="loginform" class="form-horizontal" role="form" method="post" action="<?= URL ?>ToDoList/SaveItemToList/<?=$ListID?>">
        <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
            <input id="login-password" type="text" class="form-control" name="ListItemName1" placeholder="Lijst Punt">
            <input id="login-password" type="text" class="form-control" name="ListItemDescription1" placeholder="Beschrijving">
            <input id="Duration" type="number" class="form-control" name="ListItemDuration1" placeholder="Hoe lang duurt het? (In minuten)">
        </div>

        <div style="margin-top:10px; margin-right:5px;" class="form-group" id="replacethis">
            <!-- Button -->

            <div class="col-sm-12 controls">
                <button id="btn-login" type="submit" class="btn btn-primary">Voeg toe</button>
            </div>
        </div>
    </form>
</div>
