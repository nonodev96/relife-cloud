
<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
    <div class="panel-group full-body" id="accordion" role="tablist" aria-multiselectable="true">
        <?php 
        $debug_array = array(
            array(
                'title'=>'Debug cookies',
                'key'=>'cookie',
                'data'=> $_COOKIE
            ),
            array(
                'title'=>'Debug sesión',
                'key'=>'session',
                'data'=> $_SESSION
            ),
            array(
                'title'=>'Debug usuarios',
                'key'=>'users',
                'data'=> $this->db->get('users')->result()
            ),
            array(
                'title'=>'Debug productos',
                'key'=>'products',
                'data'=> $this->db->get('products')->result()
            ) 
        );
        foreach ($debug_array as $key => $value) {
            ?>
            <div class="panel panel-col-pink">
                <div class="panel-heading" role="tab" id="heading_<?=$value['key']?>">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$value['key']?>" aria-expanded="false" aria-controls="collapse_<?=$value['key']?>" class="collapsed">
                           <?=$value['title']?>
                        </a>
                    </h4>
                </div>
                <div id="collapse_<?=$value['key']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?=$value['key']?>" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        <pre><?php var_dump($value['data']) ?></pre>   
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>