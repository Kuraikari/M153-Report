<div id="modal" class="modalDialog">
    <div id="modal" class="login-wrap">
        <a href="/bossBay/homepage" class="close"><i class="fa fa-close"></i></a>
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign
                In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
                <!--======================================================================
                Sign In
                ======================================================================-->
                <div class="sign-in-htm">
                    <?php echo $this->formHelper->createForm(
                        "submitForm1",
                        "signIn",
                        "./",
                        "POST",
                        ""
                    ); ?>



<!--                    inputGroup(string $name, string $classes, array $options = [], string $value, $type, $divClass, $labelClass )-->

                    <?php echo $this->formHelper->inputGroup('user', 'input', ['label' => 'Username'], isset($_COOKIE["member_login"]) ? $_COOKIE["member_login"] : '' , 'text', 'group','label' ); ?>
                    <?php echo $this->formHelper->inputGroup('pass', 'input',['label' => 'Password'], isset($_COOKIE["member_password"]) ? $_COOKIE["member_password"] : '', 'password', 'group', 'label'); ?>

                    <input type="hidden" name="action" value="login">
                    <div class="group">
                        <a href="#" id="submitButton1" class="btn btn-sm animated-button thar-three">Sign In</a>
                    </div>
                    <div class="hr"></div>
                    <div class="group">
                        <input type="checkbox" name="remember" id="remember" <?php echo isset($_COOKIE["member_login"]) ?  'checked' : '' ; ?>/>
                        <label for="remember">Remember me</label>
                    </div>

                    <?php echo $this->formHelper->endForm(); ?>

                </div>
                <!--======================================================================
                Sign Up
                ======================================================================-->
                <div class="sign-up-htm">
                    <?php echo $this->formHelper->createForm(
                        "submitForm2",
                        "signUp",
                        "./",
                        "POST"
                    ); ?>

                    <?php echo $this->formHelper->inputGroup('Firstname', 'input', ['label' => 'Firstname'],'', 'text', 'group','label'); ?>
                    <?php echo $this->formHelper->inputGroup('Lastname', 'input', ['label' => 'Lastname'],'', 'text', 'group','label'); ?>
                    <?php echo $this->formHelper->inputGroup('Username', 'input', ['label' => 'Username'],'', 'text', 'group','label'); ?>
                    <?php echo $this->formHelper->inputGroup('Password1', 'input', ['label' => 'Password'],'', 'password', 'group','label'); ?>
                    <?php echo $this->formHelper->inputGroup('Password2', 'input', ['label' => 'Repeat Password'],'', 'password', 'group','label'); ?>
                    <?php echo $this->formHelper->inputGroup('Email', 'input', ['label' => 'Email Address'],'', 'text', 'group','label'); ?>

                    <div class="hr"></div>
                    <input type="hidden" name="action" value="register">
                    <div class="group">
                        <a href="#" id="submitButton2" class="btn btn-sm animated-button thar-three">Sign Up</a>
                    </div>

                    <?php echo $this->formHelper->endForm(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function ()
    {
        $("#submitButton1").click(function ()
        {
            username = $("#user").val();
            password = $("#pass").val();
            remember = $("#remember")[0].checked ? "on" : "off";
            $.ajax({
                type: "POST",
                url: "/user/login",
                data: "name=" + username + "&pass=" + password + "&remember=" + remember ,
                success: function (isValid) {
                    if (JSON.parse(isValid)['isValid'] == true)
                    {
                        //window.location = "/bossBay/homepage";
                        // swal('Login Successful','You are now Loged In on BossBay','success');
                   swal({title: 'Login Successful',
                        text: "Click on Confirm to get back on the Boss page",
                        type: 'success',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Confirm'}).then(function () {
                        window.location.href = "homepage"; });
                    }
                    else
                    {
                        swal('Ups...','Wrong Username or Password','error');
                    }
                },
            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function ()
    {
        $("#submitButton2").click(function ()
        {
            username = $("#Username").val();
            email = $("#Email").val();
            firstname = $("#Firstname").val();
            lastname = $("#Lastname").val();
            password1 = $("#Password1").val();
            password2 = $("#Password2").val();
            $.ajax({
                type: "POST",
                url: "/user/register",
                data: "Username=" + username + "&Password1=" + password1 + "&Password2=" + password2
                + "&Firstname=" + firstname + "&Lastname=" + lastname + "&Email=" + email,
                success: function (isValid) {
                    if (JSON.parse(isValid)['isValid'] == true)
                    {
                        swal({title: 'Register Successful',
                            text: "Click on Confirm to get back on the Boss page",
                            type: 'success',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Confirm'}).then(function () {
                            window.location.href = "homepage"; });
                    }
                    else
                    {
                        temp1 = JSON.parse(isValid);
                        if(temp1.errors.isMatch == null){ temp1.errors.isMatch = ""}
                        if(temp1.errors.userExists  == null){ temp1.errors.userExists  = ""}
                        if(temp1.errors.isEmail == null){ temp1.errors.isEmail = ""}
                        if(temp1.errors.isValidePassword == null){ temp1.errors.isValidePassword = ""}
                        if(temp1.errors.minLength == null){ temp1.errors.minLength  = ""}
                        if(temp1.errors.required == null){ temp1.errors.required = ""}
                        swal('Ups...',temp1.errors.required + ' , '
                            + temp1.errors.minLength + ' , '
                            + temp1.errors.isValidePassword + ' , '
                            + temp1.errors.isEmail + ' , '
                            + temp1.errors.userExists + ' , '
                            + temp1.errors.isMatch
                            ,'error');
                    }
                },
            });
            return false;
        });
    });
</script>
