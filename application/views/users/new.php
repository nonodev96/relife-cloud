<div class="row clearfix">
    <?php
    if (!empty($user_create) and $user_create == TRUE){
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="info-box-2 bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">check</i>
                </div>
                <div class="content">
                    <div class="text"><?= $get_user->email ?></div>
                    <div class="number">Usuario creado</div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-light-blue">
                <h2>Nuevo usuario</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <form id="form_validation" method="POST" action="/users/new" autocomplete="off">
                
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nickname" value="" required>
                                    <label class="form-label">Apodo</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" value="" required>
                                    <label class="form-label">Email</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" autocomplete="new-password" required>
                                    <label class="form-label">Contraseña</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label for="role">Papel</label>
                                <select class="form-control show-tick" id="role" name="role" required>
                                    <option value="0">Normal</option>
                                    <option value="1">Moderador</option>
                                    <option value="2">Administrador</option>
                                </select>
                            </div>

                            <input type="hidden" name="submit" value="submit">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Crear usuario</button><br>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- #END# Basic Validation -->