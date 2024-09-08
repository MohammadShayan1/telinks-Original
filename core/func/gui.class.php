<?php
    class gui
    {
        private $page;
        private $useApi;

        public function __construct()
        {
            $this->page = !empty($_GET['p']) ? ($_GET['p']) : ("home");
        }

        public function title()
        {
            switch($this->page)
            {
                case "home":
                    return "TE-Links || Home";
                                
                default:
                    return "unknown";
            }
        }
        public function buildPage()
        {
            if(file_exists("./core/pages/{$this->page}.inc.php"))
            {
                include "./core/pages/__header.php";
    
                include "./core/pages/{$this->page}.inc.php";
                
                include "./core/pages/__footer.php";
            }
            else exit("<b>Page not found</b>");
        }
    }
