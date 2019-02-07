<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Alle Gebruikers</th>
            <th scope="col">Rol</th>
            <th scope="col">Verander rol</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $lists = getAllUsers();

        foreach ($lists as $Items => $values){
            $roles = GetUserRole($values["UUID"]);
            echo '<tr>';
            echo '<th scope="row"><a href=' .URL . 'Admin/AdminView/' . $values["UUID"] . '>' . $values["UsrName"]  . '</a></th>';
            echo '<th scope="row">'.$roles[0]["RoleName"].'</th>';
            echo '<th scope="row"><a href=' .URL . 'Admin/EditRole/' . $values["UUID"] . '>' . 'Verander</a></th>';
            echo '</tr>';
        }


        ?>
        </tbody>
    </table>
</div>
