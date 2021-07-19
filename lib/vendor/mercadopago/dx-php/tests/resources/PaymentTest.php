<?php 

use PHPUnit\Framework\TestCase;

/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class PaymentTest extends TestCase
{


    public static function setUpBeforeClass()
    {
        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = new Dotenv\Dotenv(__DIR__, '../../.env');
            $dotenv->load();
        }
        
        MercadoPago\SDK::setAccessToken($_ENV['ACCESS_TOKEN']);
    }

    

    public function testCreatePendingPayment()
    {

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = 141;
        $payment->token = $this->SingleUseCardToken('in_process');
        $payment->description = "Ergonomic Silk Shirt";
        $payment->installments = 1;
        $payment->payment_method_id = "visa";
        $payment->payer = array(
            "email" => "larue.nienow@hotmail.com"
        );
        $payment->external_reference = "reftest";
        $payment->save();

        $this->assertEquals($payment->status, 'in_process'); 
 
        return $payment;

    }

    /**
     * @depends testCreatePendingPayment
     */
    public function testFindPaymentById(object $payment_created_previously) {
        $payment = MercadoPago\Payment::find_by_id($payment_created_previously->id); 
        $this->assertEquals($payment->id, $payment_created_previously->id);
    }

    /**
     * @depends testCreatePendingPayment
     */
    public function testPaymentsSearch(object $payment_created_previously) {
 
        $filters = array(
            "external_reference" => $payment_created_previously->external_reference
        );

        $payments = MercadoPago\Payment::search($filters); 

        $payment = end($payments);

        $this->assertTrue(count($payments) > 0);
        $this->assertEquals($payment->external_reference, $payment_created_previously->external_reference);

    }
    
    /**
     * @depends testCreatePendingPayment 
     */
    public function testCancelPayment(object $payment_created_previously) {
        $payment_created_previously->status = "cancelled";
        $payment_created_previously->update();
        
        $payment = MercadoPago\Payment::find_by_id($payment_created_previously->id);
        $this->assertEquals("cancelled", $payment->status);
        
    }


    private function SingleUseCardToken($status){

        $cards_name_for_status = array(
            "approved" => "APRO",
            "in_process" => "CONT",
            "call_for_auth" => "CALL",
            "not_founds" => "FUND",
            "expirated" => "EXPI",
            "form_error" => "FORM",
            "general_error" => "OTHE",
        );

        $i_current_month = intval(date('m'));
        $i_current_year = intval(date('Y'));
        
        $security_code = rand(111, 999);
        $expiration_month = rand($i_current_month, 12);
        $expiration_year = rand($i_current_year + 2, 2999);
        $dni = rand(11111111, 99999999);

        $payload = array(
            "json_data" => array(
                "card_number" => "4509953566233704",
                "security_code" => (string)$security_code,
                "expiration_month" => str_pad($expiration_month, 2, '0', STR_PAD_LEFT),
                "expiration_year" => str_pad($expiration_year, 4, '0', STR_PAD_LEFT),
                "cardholder" => array(
                    "name" => $cards_name_for_status[$status],
                    "identification" => array(
                        "type" => "DNI",
                        "number" => (string)$dni
                    )
                )
            )
        );

        $response = MercadoPago\SDK::post('/v1/card_tokens', $payload);

        return $response['body']['id'];

    }


}

?>