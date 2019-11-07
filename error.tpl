<div class="exception" style="text-align: center;">

    <div class="info"><h1><?php echo htmlentities($message); ?></h1></div>
    <div>
        <?php
            for($i=0;$i<27;$i++){
                for($j=0;$j<=$i;$j++){
                    echo "*&nbsp;";
                }
                echo '<br/>';
            }
        ?>
    </div>
</div>