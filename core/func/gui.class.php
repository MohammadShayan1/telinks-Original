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
            return "TE-Links || " . ucwords($this->page);
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
