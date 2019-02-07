<div class="container">
    <form id="loginform" class="form-horizontal" role="form" method="post" action="<?= URL ?>ToDoList/SaveEditedItem/<?=$ItemValues[0]["ListItemID"]?>">
        <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
            <input id="login-password" type="text" class="form-control" name="ListItemName" placeholder="Lijst Punt" value="<?=$ItemValues[0]["ItemName"]?>">
            <input id="login-password" type="text" class="form-control" name="ListItemDescription" placeholder="Beschrijving" value="<?=$ItemValues[0]["ItemDescription"]?>">
            <input id="Duration" type="number" class="form-control" name="ListItemDuration" placeholder="Hoe lang duurt het? (In minuten)" value="<?=$ItemValues[0]["Duration"]?>">
            <input id="Duration" type="text" class="form-control" name="ListItemFinished" placeholder="Klaar? Gebruik voor uw eigen duidelijkheid (Ja) of (nee)" value="<?=$ItemValues[0]["ItemFinished"]?>">
        </div>

        <div style="margin-top:10px; margin-right:5px;" class="form-group" id="replacethis">
            <!-- Button -->

            <div class="col-sm-12 controls">
                <button id="btn-login" type="submit" class="btn btn-primary">Sla op</button>
            </div>
        </div>
    </form>
</div>