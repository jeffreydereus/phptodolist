<div class="container">
    <form id="loginform" class="form-horizontal" role="form" method="post" action="<?= URL ?>ToDoList/SaveEditedList/<?=$ListValues[0]["ListID"]?>">
        <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
            <input id="login-password" type="text" class="form-control" name="ListName" placeholder="Lijst Naam" value="<?=$ListValues[0]["ListName"]?>">
        </div>

        <div style="margin-top:10px; margin-right:5px;" class="form-group" id="replacethis">
            <!-- Button -->

            <div class="col-sm-12 controls">
                <button id="btn-login" type="submit" class="btn btn-primary">Sla op</button>
            </div>
        </div>
    </form>
</div>