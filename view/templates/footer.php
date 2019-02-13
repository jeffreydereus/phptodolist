<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
<div class="container">
    <?php

    if($_SESSION["msg"] != ""){
        echo '<div class="alert alert-success alert-dismissable" id="flash-msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>'. $_SESSION["msg"] .'</h4>
                </div>';

        echo '<script>$(document).ready(function () {
        $("#flash-msg").delay(2000).fadeOut("slow");
        });</script>';

        $_SESSION["msg"] = "";
    }

    ?>
</div>
</body>
</html>