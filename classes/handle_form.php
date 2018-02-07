<?php

require_once 'database.php';

Class HandleForm
{
    public static function autocomplete_handler($keyword)
    {
        $db = Database::getInstance();
        // $mysqli = $db->getConnection();
        $sql_query = "SELECT name_customer FROM obj_customer WHERE name_customer LIKE '%" . $keyword . "%' LIMIT 0,6";
        $result = $db->runQuery($sql_query);
        if (!empty($result)) {
            foreach ($result as $customer) { ?>
                <option value="<?php echo $customer['name_customer']; ?>"></option>
                <?php
            }
        }
    }
    public static function submit_handler($data) {
        print_r($data);

    }
}

?>

