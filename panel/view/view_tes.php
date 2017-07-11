<link rel="stylesheet" type="text/css" href="../assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<script type="text/javascript" src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="script/script_tes.js"> </script>

<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="admin"){
   header('location: ../login.php');
}

include "../../library/config.php";
include "../../library/function_view.php";
include "../../library/function_form.php";

create_title("edit", "Manajemen Tes");
create_button("success", "plus-sign", "Tambah", "btn-add", "form_add()");

create_table(array("Judul Tes (Edisi)", "Tanggal", "Waktu", "Jml. Soal", "Aksi"));

open_form("modal_tes", "return save_data()");
   create_textbox("Judul Tes (Edisi)", "judul", "text", 4, "", "required");
   create_textbox("Tanggal", "tanggal", "text", 4, "datepicker", "required");
   create_textbox("Waktu (menit)", "waktu", "number", 2, "", "required");
   create_textbox("Jml. Soal", "jml_soal", "number", 2, "", "required");
close_form();
?>
