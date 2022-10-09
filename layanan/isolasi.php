<?php
require_once '../conn.php';

// global $conn;
$sql = " SELECT d.fs_nm_pasien, d.fs_mr, g.fs_nm_layanan, f.fs_nm_bed, e.fs_nm_kelas, b.fd_tgl_in , sum(a.fn_total) fn_count_all 
from TA_TRS_BILLING a
left join ta_trs_bed b on a.fs_kd_reg = b.fs_kd_reg
left join ta_registrasi c on a.fs_kd_reg = c.fs_kd_reg
left join tc_mr d on c.fs_mr = d.fs_mr
left join ta_kelas e on b.fs_kd_kelas = e.fs_kd_kelas
left join ta_bed f on b.fs_kd_bed = f.fs_kd_bed
left join ta_layanan g on b.fs_kd_layanan = g.fs_kd_layanan
where b.fd_tgl_out='3000-01-01' and b.fd_tgl_void='3000-01-01' and g.fs_kd_layanan='RI010' group by d.fs_nm_pasien, d.fs_mr, g.fs_nm_layanan,
f.fs_nm_bed, e.fs_nm_kelas, b.fd_tgl_in   ";

$result = array();
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
