
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-pink">
                <h2>
                    Añadir puja:
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    
                    <form class="form-horizontal" action="/products/addBid" method="post">
                        <input type="hidden" name="id_product" value="<?= $get_product->id ?>" />
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="idUser_Id">Usuario que puja</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" data-live-search="true" id="idUser_Id" name="id_user">
                                            <?php
                                            $get_all_users = $this->Users_model->getAllUsers();
                                            foreach ($get_all_users as $key => $user) {
                                                ?>
                                                    <option value="<?= $user->id ?>" >
                                                        <?= $user->id ?>:  <?= $user->nickname ?> 
                                                        <?= !empty($user->first_name) ? "(" . $user->first_name . " " . $user->last_name . ")" : "" ?>
                                                    </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="bid_Id">Puja</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" class="form-control money-euro" id="bid_Id" name="bid" placeholder="Ex: 5€" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Añadir puja</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

 <?php 
if ($has_bids) { 
    $count = !empty($get_bids["count"])?$get_bids["count"]:0;
    $max = !empty($get_bids["max"]->bid)?$get_bids["max"]->bid:0;
    $min = !empty($get_bids["min"]->bid)?$get_bids["min"]->bid:0;
    $array_count_to = array(
        'count' => array(
            'title' => 'Total de pujas',
            'number' => $count,
            'icon' => 'euro_symbol',
        ),
        'max' => array(
            'title' => 'Puja más alta',
            'number' => $max,
            'icon' => 'euro_symbol',
        ),
        'min' => array(
            'title' => 'Puja más baja',
            'number' => $min,
            'icon' => 'euro_symbol',
        ),
    );
    $colors = array('pink', 'cyan', 'light-green', 'orange');
    ?>
    <div class="row clearfix">
        <?php
        $counter = 0;
        foreach ($array_count_to as $key => $value) {
            $value['color'] = $colors[(int)($counter%count($colors))];
            $counter++;
            ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-<?= $value['color'] ?> hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons"><?= $value['icon'] ?></i>
                    </div>
                    <div class="content">
                        <div class="text"><?= $value['title'] ?></div>
                        <div class="number count-to" 
                             data-from="0" 
                             data-to="<?= $value['number'] ?>" 
                             data-speed="2500" 
                             data-fresh-interval="1"><?= $value['number'] ?></div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-xd-12 col-sm-12">
            <div class="panel-group" id="bids" role="tablist" aria-multiselectable="true">
                <?php
                foreach ($get_bids["all_bids"] as $key => $value) {
                    $colors_key = (int)($key%count($colors));
                    ?>
                    <div class="panel panel-col-<?= $colors[$colors_key] ?>">
                        <div class="panel-heading" role="tab" id="heading_<?= $key ?>">
                            <h4 class="panel-title">
                                <a role="button" 
                                    data-toggle="collapse" 
                                    data-parent="#bids" 
                                    href="#collapse_<?= $key ?>" 
                                    aria-expanded="true" 
                                    aria-controls="collapse_<?= $key ?>">
                                    <i class="material-icons">euro_symbol</i> 
                                    Puja: <?= $key ?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse_<?= $key ?>"
                            class="panel-collapse collapse" 
                            role="tabpanel" 
                            aria-labelledby="heading_<?= $key ?>">
                            <div class="panel-body">
                                <?php
                                $userExist = $this->Users_model->userExist($value->id_user);
                                if ($userExist) {
                                    $user = $this->Users_model->getUserByID($value->id_user)[0];
                                    $value->user = $user;
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <img class="img-responsive" 
                                            src="<?= ASSETS_IMG_USERS ?><?= $user->profile_avatar ?: IMG_USERS_DEFAULT ?>"
                                            alt="<?= $user->email ?>">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                            <h3><?= $user->nickname ?> </h3>
                                            <p><?= $user->first_name ?> <?= $user->last_name ?></p>
                                            <small><?= $user->email ?></small>
                                            <p>
                                                Puja de <strong><?= $value->bid ?>€</strong><br>
                                                <span class="date_time"><?= $value->datetime_sale ?></span>
                                            </p>
                                            <form action="/products/deleteBid" method="post">
                                                <input type="hidden" name="id_product" value="<?= $get_product->id ?>"/>
                                                <input type="hidden" name="id" value="<?= $value->id ?>"/>
                                                <input type="submit" class="btn btn-danger m-t-15 waves-effect" value="Borrar"/>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <!--<?php var_dump($value) ?>-->
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php 
} 
?>
<!--<?php var_dump($get_bids) ?>-->
