    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Usuarios
                    </h2>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover dataTable datatable_users">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apodo</th>
                                <th>Email</th>
                                <th>Cumpleaños</th>
                                <th>Fecha de creación</th>
                                <th>Dirección</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($all_users as $value) {
                                ?>
                                <tr>
                                    <td><?= $value->id ?></td>
                                    <td><?= $value->first_name ?> <br><?= $value->last_name ?></td>
                                    <td><?= $value->nickname ?></td>
                                    <td><?= $value->email ?></td>
                                    <td class="date_time"><?= $value->birth_date ?></td>
                                    <td class="date_time"><?= $value->join_date ?></td>
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
            