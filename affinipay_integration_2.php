<?php
/*
 * Send cURL to Lawpay
 *  Instructions:
 * * https://developers.affinipay.com/connect/connect-merchant.html
 * * This application makes use of Affinipay Wordpress Plugin
 * * https://wordpress.org/plugins/affinipay-payment-gateway/*
 * */

function send_to_lawpay($payment_token_id, $bs_form_id, $amount, $pnc_name_full)
{
    bs('---------------------------------------------------------------------------------- ');
    bs('/actions-outgoing/submit_charge.php');

    switch ($bs_form_id) {
            // case 21: // New Lead Form
            //     $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRANSACTION_ACCOUNT
            //     break;
            // case 43: // Payment Consult Family Law Form
            //     $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRANSACTION_ACCOUNT
            //     break;
            // case 46: // Payment Consult SPED Form
            //     $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRANSACTION_ACCOUNT
            //     break;
            // case 48: // Payment Consult Retainer Form
            //     $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRUST_ACCOUNT
            //     break;
            // case 78: // Payment SPED SET CONSULT Form
            //     $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRUST_ACCOUNT
            //     break;
        default:
            $lawpay_account = LAWPAY_TEST_ACCOUNT;
    }

    /**
     * Send cURL
     */

    bs('Lawpay Account: ' . $lawpay_account);


    $lawpay_charges_endpoint = 'https://api.affinipay.com/v1/charges';
    $method = 'POST';
    $charge_data = '{
        "amount":"' . $amount . '",
        "method":"' . $payment_token_id . '",
        "account_id":"' . $lawpay_account . '",
        "reference": "' . $pnc_name_full . '"
    }';




    try {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $lawpay_charges_endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $charge_data);
        curl_setopt($ch, CURLOPT_USERPWD, LAWPAY_TEST_SECRET_KEY . ':' . '');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    } catch (Exception $err) {
        $errors = array();
        // bs('' . $err->getMessage());

        foreach ($err as $error) {
            // bs('Content: ' . $error . content);
        }
    }
}
