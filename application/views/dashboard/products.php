
    <div class="row clearfix">
        
        <!-- Line Chart de productos-->
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">shopping_cart</i>
                </div>
                <div class="content">
                    <div class="text">Total de productos</div>
                    <div class="number count-to" data-from="0" data-to="<?= $dashboard["total_products"] ?>" 
                         data-speed="1000" data-fresh-interval="1">
                        <?= $dashboard["total_products"] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-pink">
                    <h2>Gráfico historico de productos</h2>
                </div>
                <div class="body">
                    <canvas id="line_chart_products" height="150"></canvas>
                </div>
            </div>
        </div>
        <!-- #END# Line Chart -->
                
    </div>
    