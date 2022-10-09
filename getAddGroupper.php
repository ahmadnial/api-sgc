<?php
require_once 'conn2.php';

// global $conn;
$sql = " SELECT * from econtrol where mr='340302100140917' ";

// $result = array();
$query = sqlsrv_query($conn, $sql) or die(sqlsrv_errors());;
while ($data = sqlsrv_fetch_array($query)) {
    $result[] = $data;
}
$response = array(
    'status' => 200,
    'message' => 'Success',
    'data' => $result
);
header('Content-Type: application/json');
echo json_encode($response);
