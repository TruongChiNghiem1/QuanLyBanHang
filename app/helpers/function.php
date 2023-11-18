<?php
function json_message($message, $status = 'success') {
    header('Content-Type: application/json');
    echo json_encode(['status' => $status, 'message' => $message]);
    exit();
}

function json_result($result_data, $decode = false) {
    header('Content-Type: application/json');
    if($decode) echo htmlspecialchars_decode(json_encode($result_data));
    else echo json_encode($result_data);
    exit();
}