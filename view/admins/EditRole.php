<div class="container">
    <h1>Verander de rol van: <?= $Values[0]["UsrName"]?>
        <small>Kies uit: Gebruiker of Admin</small>
    <form id="loginform" class="form-horizontal" role="form" method="post" action="<?= URL ?>admin/SaveChangedRole/<?=$Values[0]["UUID"]?>">
        <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
            <input id="login-password" type="text" class="form-control" name="Role" placeholder="Rol" value="<?=$Values[0]["UsrRole"]?>">
        </div>

        <div style="margin-top:10px; margin-right:5px;" class="form-group" id="replacethis">
            <!-- Button -->

            <div class="col-sm-12 controls">
                <button id="btn-login" type="submit" class="btn btn-primary">Sla op</button>
            </div>
        </div>
    </form>
</div>