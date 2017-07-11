<?php
session_start();
include "../../library/config.php";
include "../../library/function_date.php";
include "../../library/function_view.php";

//Menampilkan data ke tabel
if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM tes ORDER BY id_tes DESC");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $row = array();
      $row[] = $no;
      $row[] = $r['judul'];
      $row[] = tgl_indonesia($r['tanggal']);
      $row[] = $r['waktu'].' menit';
      $row[] = $r['jml_soal'];
      $row[] = create_action($r['id_tes']);
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}

//Menampilkan data ke form
elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM tes WHERE id_tes='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

//Menambah data
elseif($_GET['action'] == "insert"){
   mysqli_query($mysqli, "INSERT INTO tes SET
      judul = '$_POST[judul]',
      tanggal = '$_POST[tanggal]',
      waktu = '$_POST[waktu]',
      jml_soal = '$_POST[jml_soal]'");	
}

//Mengedit data
elseif($_GET['action'] == "update"){
   mysqli_query($mysqli, "UPDATE tes SET
      judul = '$_POST[judul]',
      tanggal = '$_POST[tanggal]',
      waktu = '$_POST[waktu]',
      jml_soal = '$_POST[jml_soal]'
      WHERE id_tes='$_POST[id]'");	
}

//Menghapus data
elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM tes WHERE id_tes='$_GET[id]'");	
}
?>
