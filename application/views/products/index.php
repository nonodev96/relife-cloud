

<!-- Body Copy -->
<div class="row clearfix">
    <?php
    if (!empty($total_products_deletes)){
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="info-box-2 bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">check</i>
                </div>
                <div class="content">
                    <div class="text"><?= $total_products_deletes ?> Productos eliminados</div>
                    <div class="number">Eliminados</div>
                </div>
            </div>
        </div>
        <?php
    } 
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <form action="/products/deleteProducts" method="POST" >
                
                <div class="header bg-cyan">
                    <h2>
                        <?= !empty($templates["products"]["keyword"]) ? "<strong>" . $templates["products"]["keyword"] . "</strong>" : "Editar productos" ?>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="/products/new">Nuevo </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <button type="submit" name="deleteByIds" value="delete" class="my-button">
                                            Eliminar productos 
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
                                <th>TITULO</th>
                                <th>DESCRIPCIÓN</th>
                                <th>FECHA DE PUBLICACIÓN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($get_all_products as $key => $value) {
                                ?>
                                <tr>
                                    <td class="col-md-1">
                                        <input type="hidden" name="id[]" value="<?= $value->id ?>"/>
                                        <input type="checkbox" name="checkbox_products[]" value="<?= $value->id ?>" id="checkbox_product_<?= $value->id ?>" class="chk-col-light-green" >
                                        <label for="checkbox_product_<?=$value->id?>"></label>
                                    </td>
                                    <td class="col-md-1"><?= $value->title ?></td>
                                    <td class="col-md-5"><?= $value->description ?></td>
                                    <td class="col-md-3 date_time"><?= $value->datetime_product ?></td>
                                    <td class="col-md-2 button-demo">
                                        <a href="javascript:void(0);">
                                            <button type="submit" name="deleteByID" value="<?= $value->id ?>" class="btn bg-red waves-effect">ELIMINAR</button>
                                        </a><br>
                                        <a href="/products/<?=$value->id?>" class="btn bg-purple waves-effect">EDITAR</a>
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


