<!-- Basic Validation -->
<div class="row clearfix">
    <?php
    if (!empty($user_update) and $user_update == TRUE){
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="info-box-2 bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">check</i>
                </div>
                <div class="content">
                    <div class="text">Usuario <?= $get_user->email ?></div>
                    <div class="number">Actualizado</div>
                </div>
            </div>
        </div>
        <?php
    } elseif(!empty($user_update) and $user_update == FALSE)  {
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="info-box-2 bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">sentiment_neutral</i>
                </div>
                <div class="content">
                    <div class="text">Error</div>
                    <div class="number">Algo salio mal </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2><?= $get_user->email ?></h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <form id="form_validation" method="POST" action="/users/<?= $get_user->id ?>" autocomplete="off">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                           
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="first_name" value="<?= $get_user->first_name ?>" >
                                    <label class="form-label">Nombre</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="last_name" value="<?= $get_user->last_name ?>" >
                                    <label class="form-label">Apellidos</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nickname" value="<?= $get_user->nickname ?>" >
                                    <label class="form-label">Apodo</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" value="<?= $get_user->email ?>" required>
                                    <label class="form-label">Email</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="user_datetimepicker form-control" name="birth_date" 
                                           data-value="<?= $get_user->birth_date ?>" placeholder="Cumpleaños">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="location" value="<?= $get_user->location ?>">
                                    <label class="form-label">Localidad</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" value="" autocomplete="new-password" >
                                    <label class="form-label">Contraseña</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label for="role">Papel</label>
                                <select class="form-control show-tick" id="role" name="role">
                                    <option value="0" <?= $get_user->role==0?'selected':''; ?>>Normal</option>
                                    <option value="1" <?= $get_user->role==1?'selected':''; ?>>Moderador</option>
                                    <option value="2" <?= $get_user->role==2?'selected':''; ?>>Administrador</option>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?= $get_user->id ?>">
                            <input type="hidden" name="submit" value="submit">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Actualizar</button><br>
                            
                        </div>
                            
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div id="user-thumbnials">
                                <a href="/assets/images/users/<?= $get_user->profile_avatar?$get_user->profile_avatar:"default.jpg" ?>" data-sub-html="<?= $get_user->email ?>">
                                    <img class="img-responsive thumbnail" src="/assets/images/users/<?= $get_user->profile_avatar?$get_user->profile_avatar:"default.jpg" ?>">
                                </a>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                    Actualizar imagen
                    <small><?= $get_user->email ?> </small>
                </h2>
            </div>
            <div class="body">
                <form action="/users/uploadImage/<?= $get_user->id ?>" class="dropzone" id="my-awesome-dropzone" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="dz-message">                        
                            <div class="drag-icon-cph">
                                <i class="material-icons">touch_app</i>
                            </div>
                            <h3>Suelta los archivos aquí o haga clic para cargar.</h3>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </div>
                </form>
                <button type="submit" id="submit-all" 
                class="btn btn-primary m-t-15 waves-effect" >Actualizar imagen</button><br>
            </div>
        </div>
    </div>

</div>
<!-- #END# Basic Validation -->
<?php var_dump($get_user);  ?>
