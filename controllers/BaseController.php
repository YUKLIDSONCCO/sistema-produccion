<?php
class BaseController {
    protected function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../views/$view.php";
    }

    protected function redirect($url) {
        header("Location: $url");
        exit;
    }
}
?>
