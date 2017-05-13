    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-purple">
                    <h2>
                        Productos
                    </h2>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover dataTable datatable_relife_products">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Descripción</th>
                                <th>Precio de lanzacimiento</th>
                                <th>Fecha de publicación</th>
                                <th>Ubicación</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($get_all_products as $value) {
                                ?>
                                <tr>
                                    <td class="col-md-1"><?= $value->id ?></td>
                                    <td class="col-md-2"><?= $value->title ?></td>
                                    <td class="col-md-6"><?= $value->description ?></td>
                                    <td class="col-md-1"><?= $value->starting_price?$value->starting_price."€":"" ?></td>
                                    <td class="col-md-1 date_time"><?= $value->datetime_product ?></td>
                                    <td class="col-md-1"><?= $value->location ?></td>
                                    <td class="col-md-1"><?= $this->Users_model->getUserById($value->id_user)[0]->nickname ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>