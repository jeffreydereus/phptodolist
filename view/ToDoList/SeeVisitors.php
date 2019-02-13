<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Bevoegden</th>
            <th scope="col">Verwijderen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $Visitors = GetVisitors($ListID);
        foreach ($Visitors as $Items => $values){
            echo '<tr>';
            echo '<th scope="row">' . $values["VisitorEmail"] . '</th>';
            echo '<th scope="row"><a href="' . URL . 'ToDoList/RemoveVisitor/ ' . $values["VisitorID"] . '/' . $ListID . '/' . $values["VisitorEmail"] . '">Verwijder</th>';
            echo '</tr>';
        }


        ?>
        </tbody>
    </table>
    <form id="VisitorForm" class="form-horizontal" role="form" method="post" action="<?= URL ?>ToDoList/AddVisitors/<?=$ListID?>">
        <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
            <input id="listitem" type="text" class="form-control" name="VisitorUsrName" placeholder="Email van Bevoegde" required>
        </div>

        <div style="margin-top:10px; margin-right:5px;" class="form-group" id="replacethis">
            <!-- Button -->

            <div class="col-sm-12 controls">
                <button id="btn-login" type="submit" class="btn btn-primary">Voeg bevoegde toe</button>
            </div>
        </div>
    </form>
</div>
