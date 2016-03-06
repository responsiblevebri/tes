<?php 
session_start();
include'inc/config.php';
include'function.php';

if(!isset($_SESSION['username'])){
	die('Anda belum login.');
}
$_SESSION['log']='<div class="alert alert-danger">Proses gagal.</div>';
if(isset($_GET['id_proyek'])){
	DB::insert('a_kebutuhan_logistik', array(
  	'id_proyek' 	=> $_GET['id_proyek']
	));	
		$_SESSION['log']='<div class="alert alert-success">Sudah disediakan space data baru. Silahkan dilengkapi</div>';
}
GoBack();
?>