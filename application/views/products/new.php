<div class="row clearfix">
    <?php
    if (!empty($product_create) and $product_create == TRUE) {
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="info-box-2 bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">check</i>
                </div>
                <div class="content">
                    <div class="text"><?= $get_product->title ?></div>
                    <div class="number">Producto creado</div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-light-blue">
                <h2>Nuevo producto</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <form id="form_validation" method="POST" action="/products/new" autocomplete="off" enctype="multipart/form-data">
                
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="title" value="" required>
                                    <label class="form-label">Título</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="description" cols="30" rows="5" class="form-control no-resize" required></textarea>
                                    <label class="form-label">Descripción</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="starting_price" value="" required>
                                    <label class="form-label">Precio</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="location" value=""  required>
                                    <label class="form-label">Ubicación</label>
                                </div>
                            </div>
                            
                            
                            <div class="form-group form-float">
                                <label for="category_id">Categoría</label>
                                <select class="form-control show-tick" id="category_id" name="category" required>
                                    <option value="0">Otras Categorías</option>
                                    <option value="1">Motor y Accesorios</option>
                                    <option value="2">Electrónica</option>
                                    <option value="3">Deporte y Ocio</option>
                                    <option value="4">Muebles, Deco y Jardín</option>
                                    <option value="5">Consolas y Videojuegos</option>
                                    <option value="6">Libros, Películas y Música</option>
                                    <option value="7">Moda y Accesorios</option>
                                    <option value="8">Niños y Bebés</option>
                                    <option value="9">Inmobiliaria</option>
                                    <option value="10">Electrodomésticos</option>
                                    <option value="11">Servicios</option>
                                    <option value="12">Otros</option>
                                </select>
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
                                            <option value="<?= $user->id ?>"><?= $user->id ?>:  <?= $user->nickname ?> <?= !empty($user->first_name) ? "(" . $user->first_name . " " . $user->last_name . ")" : "" ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <p><b>Imagen</b></p>
                                    <input type="file" class="form-control" name="file" required>
                                </div>
                            </div>
                            <input type="hidden" name="submit" value="submit">
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Crear producto</button><br>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
