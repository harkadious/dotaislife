<?php
session_start();
include "../../library/config.php";
include "../../library/function_view.php";

if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_tes='$_GET[tes]' ORDER BY id_soal");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $soal = $r['soal'];
      $soal .= '<ol type="A">';		
      for($i=1; $i<=5; $i++){	
         $kolom = "pilihan_$i";
         if($r['kunci']==$i) $soal .= '<li class="text-primary" style="font-weight: bold">'.$r[$kolom].'</li>';
         else $soal .= '<li>'.$r[$kolom].'</li>';
      }
      $soal .= '</ol>';
		
      $row = array();
      $row[] = $no;
      $row[] = $soal;
      $row[] = create_action($r['id_soal']);
      $data[] = $row;
      $no++;
   }	
   $output = array("data" => $data);
   echo json_encode($output);
}

elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_soal='$_GET[id]'");
   $data = mysqli_fetch_array($query);
   echo json_encode($data);
}

elseif($_GET['action'] == "insert"){
   $soal = addslashes($_POST['soal']);
   $pil_1 = addslashes($_POST['pil_1']);
   $pil_2 = addslashes($_POST['pil_2']);
   $pil_3 = addslashes($_POST['pil_3']);
   $pil_4 = addslashes($_POST['pil_4']);
   $pil_5 = addslashes($_POST['pil_5']);
   mysqli_query($mysqli, "INSERT INTO soal SET 
      id_tes = '$_GET[tes]',
      soal = '$soal',
      pilihan_1 = '$pil_1',
      pilihan_2 = '$pil_2',
      pilihan_3 = '$pil_3',
      pilihan_4 = '$pil_4',
      pilihan_5 = '$pil_5',
      kunci = '$_POST[kunci]'");	
   echo "ok";
}

elseif($_GET['action'] == "update"){
   $soal = addslashes($_POST['soal']);
   $pil_1 = addslashes($_POST['pil_1']);
   $pil_2 = addslashes($_POST['pil_2']);
   $pil_3 = addslashes($_POST['pil_3']);
   $pil_4 = addslashes($_POST['pil_4']);
   $pil_5 = addslashes($_POST['pil_5']);
   mysqli_query($mysqli, "UPDATE soal SET 
      soal = '$soal',
      pilihan_1 = '$pil_1',
      pilihan_2 = '$pil_2',
      pilihan_3 = '$pil_3',
      pilihan_4 = '$pil_4',
      pilihan_5 = '$pil_5',
      kunci = '$_POST[kunci]' WHERE id_soal='$_POST[id]'");
   echo "ok";
}

elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM soal WHERE id_soal='$_GET[id]'");	
}

?>
