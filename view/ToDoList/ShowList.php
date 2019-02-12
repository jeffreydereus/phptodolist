<div class="container">
    <input type="text" id="SearchInput" onkeyup="FilterTable()" placeholder=" Zoek op Duur of Status">
    <table class="table table-striped" id="table">
        <thead>
        <tr>
            <th scope="col">Lijst punt</th>
            <th scope="col">Beschrijving</th>
            <th scope="col">Duur</th>
            <th scope="col" id="finished">Status</th>
            <th scope="col">Edit</th>
            <th scope="col">Verwijder</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($VisibleList as $Items => $values){
            echo '<tr id="'. $values["ListItemID"] .'">';
            echo '<td scope="row">' . $values["ItemName"]  . '</a></td>';
            echo '<td scope="row">' . $values["ItemDescription"]  . '</a></td>';
            echo '<td scope="row">' . $values["Duration"]  . ' Min</a></td>';
            echo '<td scope="row">' . $values["ItemFinished"]  . '</a></td>';
            echo '<td scope="row"><a href=' .URL . 'ToDoList/EditListItem/' . $values["ListItemID"].  '>'  . 'Edit</a></td>';
            echo '<td scope="row"><a href="?remove" type="submit" class="button" name="remove">Verwijder</td>';
            echo '</tr>';
        }


        ?>
        </tbody>
    </table>
    <form id="loginform" class="form-horizontal" role="form" method="post" action="<?= URL ?>ToDoList/SaveItemToList/<?=$ListID?>">
        <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
            <input id="listitem" type="text" class="form-control" name="ListItemName1" placeholder="Lijst Punt" required>
            <input id="desc" type="text" class="form-control" name="ListItemDescription1" placeholder="Beschrijving" required>
            <input id="Duration" type="number" class="form-control" name="ListItemDuration1" placeholder="Hoe lang duurt het? (In minuten)" required>
        </div>

        <div style="margin-top:10px; margin-right:5px;" class="form-group" id="replacethis">
            <!-- Button -->

            <div class="col-sm-12 controls">
                <button id="btn-login" type="submit" class="btn btn-primary">Voeg toe</button>
            </div>
        </div>
    </form>

    <?php
    if($_GET){
        if(isset($_GET['remove'])){
            deleteitem($values);
        }
    }

    function deleteitem($values)
    {
        header_remove("Location");
        deleteListItem($values["ListItemID"], $values["ListID"]);
    }

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

<script>

    var table = $('table');

    $('#finished')
        .wrapInner('<span title="sort this column"/>')
        .each(function(){

            var th = $(this),
                thIndex = th.index(),
                inverse = false;

            th.click(function(){

                table.find('td').filter(function(){

                    return $(this).index() === thIndex;

                }).sortElements(function(a, b){

                    return $.text([a]) > $.text([b]) ?
                        inverse ? -1 : 1
                        : inverse ? 1 : -1;

                }, function(){

                    // parentNode is the element we want to move
                    return this.parentNode;

                });

                inverse = !inverse;

            });

        });

    function FilterTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("SearchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
