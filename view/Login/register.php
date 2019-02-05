<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">Sign Up</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="<?=URL?>Login/index">Sign In</a></div>
        </div>
        <div class="panel-body" >
            <form id="signupform" class="form-horizontal" role="form" method="post" action="<?=URL?>Login/RegisterToDB">

                <div id="signupalert" style="display:none" class="alert alert-danger">
                    <p>Error:</p>
                    <span></span>
                </div>

                <div class="form-group">
                    <label for="UsrName" class="col-md-3 control-label">Gebruikersnaam</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="UsrName" placeholder="Gebruikersnaam">
                    </div>
                </div>
                <div class="form-group">
                    <label for="UsrPass" class="col-md-3 control-label">Wachtwoord</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="UsrPass" placeholder="Wachtwoord">
                    </div>
                </div>

                <div class="form-group">
                    <!-- Button -->
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
