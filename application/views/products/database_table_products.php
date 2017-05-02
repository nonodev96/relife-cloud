    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Productos
                    </h2>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover dataTable datatable_products">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Descripción</th>
                                <th>Precio de lanzacimiento</th>
                                <th>Fecha de publicación</th>
                                <th>Ubicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($get_all_products as $value) {
                                ?>
                                <tr>
                                    <td><?= $value->id ?></td>
                                    <td><?= $value->title ?></td>
                                    <td><?= $value->description ?></td>
                                    <td><?= $value->starting_price?$value->starting_price."€":"" ?></td>
                                    <td class="date_time"><?= $value->datetime_product ?></td>
                                    <td><?= $value->location ?></td>
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
            