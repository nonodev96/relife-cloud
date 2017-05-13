

<!-- Body Copy -->
<div class="row clearfix">
    <?php
    if (!empty($total_users_deletes)){
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="info-box-2 bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">check</i>
                </div>
                <div class="content">
                    <div class="text"><?= $total_users_deletes ?> usuarios eliminados</div>
                    <div class="number">Eliminados</div>
                </div>
            </div>
        </div>
        <?php
    } 
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <form action="/users/deleteUsers" method="POST" >
                
                <div class="header bg-cyan">
                    <h2>
                        Editar usuarios
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="/users/new">Nuevo</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <button type="submit" name="deleteByIds" value="delete" class="my-button">
                                            Eliminar usuarios 
                                        </button>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOMBRE</th>
                                <th>APODO</th>
                                <th>EMAIL</th>
                                <th>UBICACIÓN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($all_users as $key => $value) {
                                ?>
                                <tr>
                                    <td class="col-md-1">
                                        <input type="hidden" name="id[]" value="<?=$value->id?>"/>
                                        <input type="checkbox" name="checkbox_users[]" value="<?= $value->id ?>" id="checkbox_user_<?= $value->id ?>" class="chk-col-light-green" >
                                        <label for="checkbox_user_<?=$value->id?>"></label>
                                    </td>
                                    <td class="col-md-2"><?= $value->first_name ?> <?= $value->last_name ?></td>
                                    <td class="col-md-2"><?= $value->nickname ?></td>
                                    <td class="col-md-2"><?= $value->email ?></td>
                                    <td class="col-md-2"><?= $value->location ?></td>
                                    <td class="col-md-2 button-demo">
                                        <a href="javascript:void(0);">
                                            <button type="submit" name="deleteByID" value="<?= $value->id ?>" class="btn bg-red waves-effect">ELIMINAR</button>
                                        </a><br>
                                        <a href="/users/<?=$value->id?>" class="btn bg-purple waves-effect">EDITAR</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            
            </form>
        </div>
    </div>
</div>
<!-- #END# Body Copy -->


