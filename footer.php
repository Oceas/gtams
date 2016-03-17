<?php
    function footer_text(){
        //TODO: Implement Copyright Footer Text
        echo "&copy; " . date("Y") . " " . "Insert Copyright Text Here";
    }
?>

<footer class="teal left white-text">
    <div class="row center margin-bottom-0">
        <div class="col s12">
            <p><?php footer_text(); ?></p>
        </div>
    </div>
</footer>
</body>
</html>