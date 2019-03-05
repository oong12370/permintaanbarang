<?php
	include "../fungsi/koneksi.php";

	if(isset($_GET['nik'])){
		$nik=$_GET['nik'];
		
	    $query = mysqli_query($koneksi,"delete from teknisi where nik='$nik'");
	    if ($query) {
	    	header("location:index.php?p=teknisi");
	    } else {
	    	echo 'gagal';
	    }
	
	}
?>