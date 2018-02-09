<?php
include 'customer.php';
include 'database.php';
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

        $customer = Customer::getCustomerOrFail($data['search-client']);

        if (empty($data['checkboxvar'])) {
            echo json_encode(array('result' => 'fail' , 'text_error' => 'Please, select statuses!'));
            exit;
        }
        $selected_statuses  = "'" . implode("','", $data['checkboxvar']) . "'";

        $our_customer_data = Customer::getCustomerDataOrFail($customer[0]['id_customer'], $selected_statuses);

        header('Content-Type: application/json');
        echo json_encode(array('result' => 'success', 'cards' => $our_customer_data));
        exit;

    }
}

?>

