<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title">Maak To Do List</div>
                <a href="#" id="filldetails" onclick="addFields()">Voeg veld toe</a>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="loginform" class="form-horizontal" role="form" method="post" action="<?= URL ?>Login/LoginSession">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                        <input id="login-username" type="text" class="form-control" name="ListName" value="" placeholder="Lijst Naam">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                        <input id="login-password" type="text" class="form-control" name="ListItemName" placeholder="Lijst Punt">
                    </div>

                    <div style="margin-top:10px; margin-right:5px;" class="form-group" id="replacethis">
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
    <script type='text/javascript'>
        i = 0;
        function addFields(){
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("loginform");
            // Create an <input> element, set its type and name attributes
            var div = document.createElement("div");
            div.classList.add("input-group");
            div.style = "margin-bottom: 25px";
            // div.id = "div" + i;
            container.appendChild(div);

            var span = document.createElement("span");
            span.classList.add("input-group-addon");
            span.id = "span" + i;
            div.appendChild(span);

            var ii = document.createElement("i");
            ii.classList.add("glypicon");
            ii.classList.add("glyphicon-tag");
            span.appendChild(ii);

            var input = document.createElement("input");
            input.name = "ListItemName" + i;
            input.type = "text";
            input.classList.add("form-control");
            input.placeholder = "Lijst Punt";
            input.id = "login-password";
            div.appendChild(input);

            //replace the save button
            container.removeChild(document.getElementById("replacethis"));

            var div2 = document.createElement("div");
            div2.classList.add("form-group");
            div2.style = "margin-top: 10px";
            div2.style = "margin-right:5px";
            div2.id = "replacethis";
            container.appendChild(div2);

            var div3 = document.createElement("div");
            div3.classList.add("col-sm-12");
            div3.classList.add("controls");
            div2.appendChild(div3);

            var button = document.createElement("button");
            button.classList.add("btn");
            button.classList.add("btn-primary");
            button.type = "submit";
            button.id = "btn-login";
            button.innerHTML = "Sla op";
            div3.appendChild(button);


            //add line break
            container.appendChild(document.createElement("br"));
            i++
        }
    </script>
<!--<div style="margin-bottom: 25px" class="input-group">-->
<!--    <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>-->
<!--    <input id="login-password" type="password" class="form-control" name="ListItemName" placeholder="Lijst Punt">-->
<!--</div>-->