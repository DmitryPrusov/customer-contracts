<?php

require_once 'database.php';

Class HandleForm
{
    public static function autocomplete_handler($keyword)
    {
        $db = Database::getInstance();
        $sql_query = "SELECT name_customer FROM obj_customers WHERE name_customer LIKE '%" . $keyword . "%' LIMIT 0,6";
        $result = $db->runQuery($sql_query);
        if (!empty($result)) {
            foreach ($result as $customer) { ?>
                <option value="<?php echo $customer['name_customer']; ?>"></option>
                <?php
            }
        }
    }
    public static function submit_handler($data) {
        header('Content-Type: application/json');

        $db = Database::getInstance();
        $sql_query = "SELECT * FROM obj_customers WHERE name_customer = '".$data['search-client']."'";
        $result = $db->runQuery($sql_query);
                if (empty($result)) {
                    echo json_encode(array('result' => 'fail'));
                    exit;
                }

//        SELECT * FROM obj_customers
//RIGHT JOIN obj_contracts ON obj_customers.id_customer = obj_contracts.id_customer
//RIGHT JOIN obj_services ON obj_contracts.id_contract = obj_services.id_contract
//WHERE  obj_services.status IN('disconnected', 'connecting')
//        AND obj_customers.id_customer = 1
        print_r($result[0]['id_customer']);

        echo json_encode(array('result' => 'success'));
        exit;

    }

    public function my_contact_form_generate_response($type)
    {

        if ($type == 'success') {
            echo json_encode(array('result' => 'success'));
            exit;
        } else {
            echo json_encode(array('result' => 'error'));
            exit;
        }
    }


}

?>

