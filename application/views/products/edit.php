<!-- Basic Validation -->
<div class="row clearfix">
    <?php
    if (!empty($product_update) and $product_update == TRUE){
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="info-box-2 bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">check</i>
                </div>
                <div class="content">
                    <div class="text">Producto <?= $get_product->title ?></div>
                    <div class="number">Actualizado</div>
                </div>
            </div>
        </div>
        <?php
    } elseif(!empty($product_update) and $product_update == FALSE)  {
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
                <h2><?= $get_product->title ?></h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <form id="form_validation" method="POST" action="/products/<?= $get_product->id ?>" autocomplete="off">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="title" value="<?= $get_product->title ?>" autofocus >
                                    <label class="form-label">Título</label>
                                </div>
                            </div>
                             <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="description" cols="30" rows="5" class="form-control no-resize" required><?= $get_product->description ?></textarea>
                                    <label class="form-label">Descripción</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="starting_price" value="<?= $get_product->starting_price ?>" required min="0" step="0.01" >
                                    <label class="form-label">Precio de lanzamiento </label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Fecha de lanzamiento</label>
                                    <input type="text" class="user_datetimepicker form-control" name="datetime_product" 
                                           data-value="<?= $get_product->datetime_product ?>" placeholder="Fecha de lanzamiento">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="location" value="<?= $get_product->location ?>">
                                    <label class="form-label">Ubicación</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label for="category">Categorias</label>
                                <select class="form-control show-tick" id="category" name="category">
                                    <option value="0" <?= ($get_product->category == 0 ) ? "selected" : "" ?>>Otras Categorías</option>
                                    <option value="1" <?= ($get_product->category == 1 ) ? "selected" : "" ?>>Motor y Accesorios</option>
                                    <option value="2" <?= ($get_product->category == 2 ) ? "selected" : "" ?>>Electrónica</option>
                                    <option value="3" <?= ($get_product->category == 3 ) ? "selected" : "" ?>>Deporte y Ocio</option>
                                    <option value="4" <?= ($get_product->category == 4 ) ? "selected" : "" ?>>Muebles, Deco y Jardín</option>
                                    <option value="5" <?= ($get_product->category == 5 ) ? "selected" : "" ?>>Consolas y Videojuegos</option>
                                    <option value="6" <?= ($get_product->category == 6 ) ? "selected" : "" ?>>Libros, Películas y Música</option>
                                    <option value="7" <?= ($get_product->category == 7 ) ? "selected" : "" ?>>Moda y Accesorios</option>
                                    <option value="8" <?= ($get_product->category == 8 ) ? "selected" : "" ?>>Niños y Bebés</option>
                                    <option value="9" <?= ($get_product->category == 9 ) ? "selected" : "" ?>>Inmobiliaria</option>
                                    <option value="10" <?= ($get_product->category == 10 ) ? "selected" : "" ?>>Electrodomésticos</option>
                                    <option value="11" <?= ($get_product->category == 11 ) ? "selected" : "" ?>>Servicios</option>
                                    <option value="12" <?= ($get_product->category == 12 ) ? "selected" : "" ?>>Otros</option>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?= $get_product->id ?>">
                            <input type="hidden" name="submit" value="submit">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Actualizar</button><br>
                            
                        </div>
                            
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div id="user-thumbnials">
                                <a href="/assets/images/products/<?=$get_product->image ? $get_product->image : "default.png" ?>" data-sub-html="<?= $get_product->title ?>">
                                    <img class="img-responsive thumbnail" src="/assets/images/products/<?= $get_product->image ? $get_product->image : "default.png" ?>">
                                </a>
                            </div>
                            
                             <div class="form-group form-float">
                                <div class="form-line">
                                    <p><b>Usuario que publica</b></p>
                                    <?php
                                        $get_all_users = $this->Users_model->getAllUsers();
                                    ?>
                                    <select class="form-control show-tick" name="id_user" data-live-search="true">
                                        <?php
                                        foreach ($get_all_users as $key => $user) {
                                            ?>
                                            <option value="<?= $user->id ?>" <?= ($get_product->id_user == $user->id ) ? "selected" : "" ?> ><?= $user->id ?>:  <?= $user->nickname ?> <?= !empty($user->first_name) ? "(" . $user->first_name . " " . $user->last_name . ")" : "" ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
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
                    <small><?= $get_product->title ?> </small>
                </h2>
            </div>
            <div class="body">
                <form action="/products/uploadImage/<?= $get_product->id ?>" class="dropzone" id="my-awesome-dropzone" method="post" enctype="multipart/form-data">
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
<?php var_dump($get_product);  ?>
