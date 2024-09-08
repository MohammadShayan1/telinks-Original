<?php
    if (file_exists("./core/initializer.inc.php")) {
        require_once("./core/initializer.inc.php");
    } else
        exit("<b>Initializer not found</b>");