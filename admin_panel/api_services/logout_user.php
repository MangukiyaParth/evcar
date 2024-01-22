<?php
function logout_user()
{
    global $outputjson, $gh, $db, $at, $ur, $ud;

    $data = array();
    $data['user_id'] = $user_id = $gh->read('original_user_id', 0);
    $data['action'] = "Logout";
    $data['date_added'] = date("Y-m-d H:i:s");
    $data['date_modified'] = date("Y-m-d H:i:s");
    $data['status'] = 1;
    $data['record_id'] = 0;
    $data['module_id'] = 0;
    $data['operation'] = 'logout_user';
    $data['from'] = $gh->read("from", PANEL_CONSTANT);
    $token_id = $gh->read('token_id', 0);
    $force_login = $gh->read('force_login', 0);

    if ($force_login == 0) {
        $log_id = $db->insert("tbl_audit_logs", $data);
    }

    $at->setToken("");
    $ur->setRights("");
    $ud->setUser("");
    $outputjson['success'] = 1;
}
