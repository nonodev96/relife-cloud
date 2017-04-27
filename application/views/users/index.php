

<!-- Body Copy -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <form action="">
                
                <div class="header">
                    <h2>
                        Editar usuarios
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/users/new" class=" waves-effect waves-block"><i class="material-icons">person_add</i>Nuevo </a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">delete</i>Eliminar </a></li>
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($all_users as $key => $value) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="id[]" value="<?=$value->id?>"/>
                                        <input type="checkbox" id="checkbox_user_<?=$value->id?>" class="chk-col-light-green" >
                                        <label for="checkbox_user_<?=$value->id?>"></label>
                                    </td>
                                    <td>
                                        <?= $value->first_name ? $value->first_name . ". " : "" ?>
                                        <?= $value->last_name ?>
                                        
                                    </td>
                                    <td><?= $value->nickname ?></td>
                                    <td><?= $value->email ?></td>
                                    <td>
                                        <a href="/users/<?=$value->id?>" class=" bd-pink">
                                            <i class="material-icons">mode_edit</i>    
                                        </a>
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


