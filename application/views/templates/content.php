<section class="content">
    <div class="container-fluid">
        
        <?php 
        foreach ($templates as $key => $template) {
            if (!empty($template["title"] )) {
                ?>
                <div class="block-header">
                    <h2><?= $template["title"] ?></h2>
                </div>
                <?php
            }
            echo $template["content"];
        }
        ?>
        
    </div>
</section>