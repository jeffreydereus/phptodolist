<!----------- Container ------------>
<div class="container" style="height: 80vh;">
    <!----------- Context ------------>
    <div class="col-md-12">
        <form action="<?= URL ?>Login/LoginSession" method="POST" class="form">
            <div class="imgcontainer">
            </div>
            <div class="container">
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="UsrName" class="form input" required>
                <br>
                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="UsrPass" class="form input" required>
                <br>
                <button type="submit" class="form input button" >Login</button> <br>
            </div>
        </form>
    </div>
</div>
