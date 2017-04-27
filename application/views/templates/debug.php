
<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
    <div class="panel-group full-body" id="accordion_13" role="tablist" aria-multiselectable="true">
        
        <div class="panel panel-col-pink">
            <div class="panel-heading" role="tab" id="headingOne_13">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_13" href="#collapseOne_13" aria-expanded="false" aria-controls="collapseOne_13" class="collapsed">
                       Debug usuarios 
                    </a>
                </h4>
            </div>
            <div id="collapseOne_13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_13" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                    <?php
                    $query = $this->db->get('products');
                    $all_products = $query->result();
                    ?>
                    <pre><?php var_dump($all_products) ?></pre>   
                </div>
            </div>
        </div>
        
        <div class="panel panel-col-pink">
            <div class="panel-heading" role="tab" id="headingTwo_13">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_13" href="#collapseTwo_13" aria-expanded="false" aria-controls="collapseTwo_13">
                        Debug productos
                    </a>
                </h4>
            </div>
            <div id="collapseTwo_13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_13" aria-expanded="false">
                <div class="panel-body">
                    <?php
                    $query = $this->db->get('products');
                    $all_products = $query->result();
                    ?>
                    <pre><?php var_dump($all_products) ?></pre>
                </div>
            </div>
        </div>
        
    </div>
</div>