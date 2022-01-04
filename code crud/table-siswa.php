<?php
include 'config.php';
$columns = [
    'lama',
    'no_id',
    'nama',
    'ba',
    'cdsa',
    'provinsi',
    'kab_kota',
    'tahun_salur',
    'jenis_angsuran',
    'kualitas',
    'angs_akhir',
    'gljr',
    'angsuran',
    'angs_pokok',
    'angs_jasa',
    'adj_pokok',
    'adj_jasa',
    'kelebihan',
    'pengembalian',
    'pendapatan',
    'c_user',
    'c_date',
];

$query = 'SELECT * FROM data_siswa WHERE ';

if (isset($_POST['search']['value'])) {
    $query .=
        '
  (no_id LIKE "%' .
        $_POST['search']['value'] .
        '%"
  OR nama LIKE "%' .
        $_POST['search']['value'] .
        '%"  
  OR provinsi LIKE "%' .
        $_POST['search']['value'] .
        '%"
  OR tahun_salur LIKE "%' .
        $_POST['search']['value'] .
        '%"
  OR angsuran LIKE "%' .
        $_POST['search']['value'] .
        '%"
  OR pendapatan LIKE "%' .
        $_POST['search']['value'] .
        '%")';
}

if (isset($_POST['order'])) {
    $query .=
        'ORDER BY ' .
        $columns[$_POST['order']['0']['column']] .
        ' ' .
        $_POST['order']['0']['dir'] .
        ' 
 ';
} else {
    $query .= 'ORDER BY tahun_salur ASC ';
}

$query1 = '';
$no = 1;
if ($_POST['length'] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

// $number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = [];

while ($row = mysqli_fetch_array($result)) {
    $sub_array = [];
    $sub_array[] = $no++;
    $sub_array[] = $row['lama'];
    $sub_array[] = $row['no_id'];
    $sub_array[] = $row['nama'];
    $sub_array[] = $row['ba'];
    $sub_array[] = $row['cdsa'];
    $sub_array[] = $row['provinsi'];
    $sub_array[] = $row['kab_kota'];
    $sub_array[] = $row['thn_salur'];
    $sub_array[] = $row['jenis_angs'];
    $sub_array[] = $row['kualitas'];
    $sub_array[] = $row['angs_akhir'];
    $sub_array[] = $row['gljr'];
    $sub_array[] = $row['angsuran'];
    $sub_array[] = $row['angs_pokok'];
    $sub_array[] = $row['angs_jasa'];
    $sub_array[] = $row['adj_pokok'];
    $sub_array[] = $row['adj_jasa'];
    $sub_array[] = $row['kelebihan'];
    $sub_array[] = $row['pengembalian'];
    $sub_array[] = $row['pendapatan'];
    $sub_array[] = $row['c_user'];
    $sub_array[] = $row['c_date'];
}

function get_all_data($connect)
{
    $query = 'SELECT * FROM data_siswa';
    $result = mysqli_query($connect, $query);
    return mysqli_num_rows($result);
}

$output = [
    'draw' => intval($_POST['draw']),
    'recordsTotal' => get_all_data($connect),
    // 'recordsFiltered' => $number_filter_row,
    'data' => $data,
];

echo json_encode($output);