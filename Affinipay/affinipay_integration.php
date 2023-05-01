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
        case 21: // New Lead Form
            $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRANSACTION_ACCOUNT
            break;
        case 43: // Payment Consult Family Law Form
            $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRANSACTION_ACCOUNT
            break;
        case 46: // Payment Consult SPED Form
            $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRANSACTION_ACCOUNT
            break;
        case 48: // Payment Consult Retainer Form
            $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRUST_ACCOUNT
            break;
        case 78: // Payment SPED SET CONSULT Form
            $lawpay_account = LAWPAY_TEST_ACCOUNT; // LAWPAY_TRUST_ACCOUNT
            break;
        default:
            $lawpay_account = LAWPAY_TEST_ACCOUNT;
    }

    try {
        // Set Public Key * Secret Key
        // https://secure.lawpay.com/settings/advanced
        ChargeIO::setCredentials(
            new ChargeIO_Credentials(
                LAWPAY_PUBLIC_KEY,
                //LAWPAY_TEST_SECRET_KEY
                LAWPAY_LIVE_SECRET_KEY
            )
        );
        ChargeIO::setDebug(true); // remove!

    } catch (Exception $err) {
        $errors = array();
        // bs('' . $err->getMessage());

        foreach ($err as $error) {
            // bs('Content: ' . $error . content);
        }
    }

    try {

        // Process the charge create($paymentMethod, $amount, $params = array())
        $result = ChargeIO_Charge::create(new ChargeIO_PaymentMethodReference(array('id' => $payment_token_id)), $amount, array('reference' => $pnc_name_full, $lawpay_account));

        return ($result);
        bs($result);
    } catch (Exception $err) {
        $errors = array();
        // bs('' . $err->getMessage());

        foreach ($err as $error) {
            // bs('Content: ' . $error . content);
        }
    }
}
