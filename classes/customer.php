<?php
class Customer
{
    private $name_customer;
    private $id_customer;
    private $company;


    public static function getCustomerOrFail($customer_name)
    {
        $customer_name = self::validateCustomerName($customer_name);
        $db = Database::getInstance();
        $sql_query = "SELECT * FROM obj_customers WHERE name_customer = '" . $customer_name . "'";
        $result = $db->runQuery($sql_query);
        if (empty($result)) {
            echo json_encode(array('result' => 'fail' , 'text_error' => 'There is no such customer!!'));
            exit;
        }
        return $result;
    }

    private static function validateCustomerName($customer_name)
    {
        return trim(stripslashes(strip_tags(htmlspecialchars($customer_name))));
    }
    public static function getCustomerDataOrFail($customer_id, $selected_statuses)
    {
        $db = Database::getInstance();
        $sql_query = "SELECT * FROM obj_customers
                      RIGHT JOIN obj_contracts 
                      ON obj_customers.id_customer = obj_contracts.id_customer
                      RIGHT JOIN obj_services
                      ON obj_contracts.id_contract = obj_services.id_contract
                      WHERE  obj_services.status IN(". $selected_statuses .") 
                      AND obj_customers.id_customer = ".$customer_id;
        $result = $db->runQuery($sql_query);

        if (empty($result)) {
            echo json_encode(array('result' => 'fail' , 'text_error' => 'No data for this customer!'));
            exit;
        }
        return $result;
    }
}

