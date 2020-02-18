<div class="wrap-content-login">
        <?php
            if(isset($variables["isRest"]) && $variables["isRest"]){
                ?>
                <form id="formRest" class="form-login">
                    <div class="logo">
                        <a href="?p=index"><img src="<?= $theme . $logoPage ?>"></a>
                    </div>
                    <div id="loadMessage" class="form-group msg">
                        <span class="form-control"></span>
                    </div>
                    <div class="form-group">
                        <label class="pin" for="passID">
                            <i class="icofont-key"></i>
                        </label>
                        <input class="form-control" type="password" placeholder="New Password" id="passID" name="pass_system">
                    </div>
                    <div class="form-group">
                        <label class="pin" for="cpassID">
                            <i class="icofont-key"></i>
                        </label>
                        <input class="form-control" type="password" placeholder="Repeat Password" id="cpassID" name="cpass_system">
                    </div>
                    <div class="form-group-btn">
                        <input id="btnRest" class="btn btn-info active-btn" type="button" value="Rest Password">
                        <input type="hidden" name="ajax_action" value="login.system.rest">
                    </div>
                </form>
                <?php
            }else{
            ?>
                <form id="formLogin" class="form-login">
                    <div class="logo">
                        <a href="?p=index"><img src="<?= $theme . $logoPage ?>"></a>
                    </div>
                    <div id="loadMessage" class="form-group msg">
                        <span class="form-control"></span>
                    </div>
                    <div class="form-group">
                        <label class="pin" for="userID">
                            <i class="icofont-user-suited"></i>
                        </label>
                        <input class="form-control" type="text" placeholder="Username" id="userID" name="user_system">
                    </div>
                    <div class="form-group">
                        <label class="pin" for="passID">
                            <i class="icofont-key"></i>
                        </label>
                        <input class="form-control" type="password" placeholder="Password" id="passID" name="pass_system">
                    </div>
                    <div class="from-group">
                        <span>
                            <input id="remSystem" type="checkbox" name="rem_system">
                            <label for="remSystem">Remember</label>
                        </span>
                                <span>
                            <a class="forgot-password">Forgot password</a>
                        </span>
                    </div>
                    <div class="form-group-btn">
                        <input id="btnLogin" class="btn btn-info active-btn" type="button" value="Login">
                        <a href="<?= $variables["url_sign_up"] ?>" id="btnSignUp" class="btn btn-info" type="button" target="_blank">Sign up</a>
                        <input type="hidden" name="ajax_action" value="login.system.login">
                    </div>
                </form>
                    <?php
                }
            ?>
</div>
<script>
    $(function () {
        $(".forgot-password").on("click", function(){
            $.confirm({
                title: 'Forgot password',
                content: '' +
                    '<form class="formName">' +
                    '<div class="form-group">' +
                    '<label>Enter Email</label>' +
                    '<input type="email" placeholder="Your email" class="name form-control" name="email_system" required />' +
                    '<input type="hidden" name="ajax_action" value="login.system.forgot">' +
                    '</div>' +
                    '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var mail = this.$content.find('.name').val();
                            if(!mail){
                                $.alert('provide a valid email');
                                return false;
                            }
                            $.post("index.php", {"ajax_action": "login.system.forgot", "email_system": mail}, function (data) {
                                xData = JSON.parse(data);
                                if (xData["status"]) {
                                    $.alert(xData["subject"]);
                                }
                            });
                        }
                    },
                    cancel: function () {
                    },
                },
                onContentReady: function () {
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click');
                    });
                }
            });
        });
    });
</script>
