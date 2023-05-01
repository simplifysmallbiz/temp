<?php
/* # Purpose of this script:
 *
 * # HUBSPOT
 * - Pipeline: Closing
 * - Stage: Lost
 * - Action: Move entry in WF NLF to Complete
 * - Move entry in workflow Form Id 21 to Step ID 8
 *
 * */

bs('actions-local/hubspot/move_nlf_entry_to_complete.php');

/* Test if request is valid
 * ------------------------------------- */
if (
    ($data['source'] == 'hubspot') &&
    ($data['pipeline'] == 'closing') &&
    ($data['stage'] == 'lost') &&
    ($data['nlf_wf_step'] == 'complete')
) {

    /* Update Workflow Step
 * -------------------------------------------- */

    try {
        $bs_form_id  = 21;
        $bs_entry_id = $data['nlf_entry_id'];
        $bs_step_id  = 8; //  Completed

        $result = update_gravityflow_step($bs_form_id, $bs_entry_id, $bs_step_id);
        bs($result);
    } catch (Exception $err) {
        $errors = array();
        bs('' . $err->getMessage());

        foreach ($err as $error) {
            bs('Content: ' . $error);
        }
    }
}
