<?php
require_once 'conn.php';

// global $conn;
$sql = " SELECT a.fs_keterangan from ta_trs_billing a 
left join ta_trs_bed b on a.fs_kd_reg = b.fs_kd_reg
where b.fd_tgl_out='3000-01-01' and b.fd_tgl_void='3000-01-01' ";

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
