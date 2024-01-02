<?php
require_once __DIR__ . '/../Config/Query.php';

class HomeModel {
    private $query;

    public function __construct(Query $query) {
        $this->query = $query;
    }

    public function getTopProductos() {
        $sql = "SELECT * FROM producto ORDER BY stock DESC LIMIT 4";
        return $this->query->selectAll($sql);
    }
}

?>
