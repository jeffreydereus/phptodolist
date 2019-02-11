<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title">Verander opties.</div>
                <p>De veranderde opties werken de volgende keer dat u inlogt.</p>
            </div>
            <div style="padding-top:30px" class="panel-body" >

                <form id="configform" class="form-horizontal" role="form" method="post" action="<?= URL ?>Home/SaveConfig/<?=$_SESSION['UUID']?>">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <select form="configform" name="UserColor" class="form-control">
                            <?php

                                foreach ($colors as $item => $value){
                                    echo '<option value="' . $value["Id"] . '">' . $value["dutchColorName"] . '</option>';
                                }

                            ?>
                        </select>
                    </div>

                    <div style="margin-top:10px; margin-right:5px;" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <button id="btn-login" type="submit" class="btn btn-primary">Sla op</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>