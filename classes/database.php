
<?php

class Database {
    private $_connection;
    private static $_instance;
    private $_host = "localhost";
    private $_username = "root";
    private $_database = "wnet";
    private $_password = "";

    public static function getInstance() {
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    private function __construct() {
        $this->_connection = new mysqli($this->_host, $this->_username,
            $this->_password, $this->_database);


        if(mysqli_connect_error()) {
            trigger_error("Ошибка MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }

    private function __clone() { }

    // чтобы получить ассоциативный массив:
    public function runQuery($query) {
        $result = mysqli_query($this->_connection, $query);
        $resultset = [];
        while($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
            return $resultset;
    }
}
?>