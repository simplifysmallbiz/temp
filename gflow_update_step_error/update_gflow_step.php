<?php
/* # Purpose of this script:
 *
 * * Update GravityFlow Step
 *
 *
 *
 * */

/*

try {
$bs_form_id = x;
$bs_entry_id = x;
$bs_step_id = x;

$result = update_gravityflow_step($bs_form_id, $bs_entry_id, $bs_step_id);

} catch (Exception $err) {
$errors = array();
bs('' . $err->getMessage());

foreach ($err as $error) {
bs('Content: ' . $error);
}
}

 */

function update_gravityflow_step($bs_form_id, $bs_entry_id, $bs_step_id)
{
    bs('actions-local/update_gravityflow_step.php');

    /**
     * Testing purposes
     */
    bs('FORM ID: ' . $bs_form_id);
    bs('Entry ID: ' . $bs_entry_id);
    bs('STEP ID: ' . $bs_step_id);

    /**
     * Update
     */

    try {
        $api = new Gravity_Flow_API($bs_form_id);

        $result = $api->send_to_step($bs_entry_id, $bs_step_id);
        return $result;
    } catch (Exception $err) {
        $errors = array();
        bs('' . $err->getMessage());

        foreach ($err as $error) {
            bs('Content: ' . $error);
        }
    }
}
