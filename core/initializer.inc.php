<?php
    if(file_exists("./core/configuration.inc.php"))
    {
        require_once("./core/configuration.inc.php");
    }
    else exit("<b>Configuration file not found</b>");

    if(file_exists("./core/func/system.class.php"))
    {
        require_once("./core/func/system.class.php");
    }
    else exit("<b>System Class not found");

    if(file_exists("./core/func/gui.class.php"))
    {
        require_once("./core/func/gui.class.php");
    }
    else exit("<b>GUI Class not found");

    $sql    = new sql();
    $page   = new gui();

    $page->buildPage();
    

?>