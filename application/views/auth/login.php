
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Admin<b>ReLife</b></a>
        <small>Iniciar sesión</small>
    </div>
    <div class="card">
        <div class="body">
            <form action="<?= base_url() ?>index/login" id="sign_in" method="POST">
                <div class="msg">Inicia sesión con la cuenta de administrador</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Recordar mis datos</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">Entrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>