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
        return "TE Links || " . ucwords($this->page);
    }
    public function buildPage()
    {
        if (file_exists("./core/pages/{$this->page}.inc.php")) {

            if (!isset($_GET["download"])) {
                if (helper::searchMultipleWords($this->page, ["admin-dashboard", "admin-logout", "edit_member", "newsletter", "regmember", "admin-image-form", "admin-add-event", "admin-edit-event", "admin-event", "regteamtech", "edit-teamtech", "admin-olympiad"])) {
                    include "./core/pages/__admin-header.php";
                } else {
                    if (!helper::searchMultipleWords($this->page, ["admin-home"]))
                        include "./core/pages/__header.php";
                }
            }


            include "./core/pages/{$this->page}.inc.php";

            if (!isset($_GET["download"])) {
                if (helper::searchMultipleWords($this->page, ["admin-dashboard", "admin-logout",  "edit_member", "newsletter", "regmember", "admin-image-form", "admin-add-event", "admin-edit-event", "admin-event", "regteamtech", "edit-teamtech", "admin-olympiad"])) {
                    include "./core/pages/__admin-footer.php";
                } else {
                    if (!helper::searchMultipleWords($this->page, ["admin-home"]))
                        include "./core/pages/__footer.php";
                }
            }

        } else
            exit("<b>Page not found</b>");
    }
}
