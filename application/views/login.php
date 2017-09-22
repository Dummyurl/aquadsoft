<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Admin<b>Panel</b></a>
        <small>Login to Review to your Business</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" action="<?php echo base_url('Login/index') ?>" method="POST">
                <div class="msg">Sign in to start your session</div>
                <div class="text-danger"><?php echo validation_errors(); ?></div>
                <div class="text-danger"><?php echo $this->session->flashdata('msg'); ?></div>
                <div class="input-group">
                  <span class="input-group-addon bg-pink"><i class="material-icons">person</i></span>
                  <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                </div>
                <div class="input-group">
                  <span class="input-group-addon bg-pink"><i class="material-icons">lock</i></span>
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <!--<a href="<?php //echo base_url('Signup'); ?>">Register Now!</a>-->
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="<?php echo base_url('forgotpassword'); ?>">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
