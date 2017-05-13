<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Debug</h2>
                </div>
                <div class="body">
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
                            <div class="panel panel-col-teal">
                                <div class="panel-heading" role="tab" id="heading_<?=$value['key']?>">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$value['key']?>" aria-expanded="false" aria-controls="collapse_<?=$value['key']?>" class="collapsed">
                                           <?=$value['title']?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_<?=$value['key']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?=$value['key']?>" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <?php var_dump($value['data']) ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
    
    </div>
</div>
