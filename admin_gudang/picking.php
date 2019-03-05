<?php  

	include "../fungsi/koneksi.php";

	if(isset($_GET['id_user'])) {
		$id_user = $_GET['id_user'];
		$id_permintaan = $_GET['id_permintaan'];
		$kode_brg = $_GET['kode_brg'];
		$jumlah = $_GET['jumlah'];
		$tanggal = date('Y-m-d');
		
		
		$query2 = mysqli_query($koneksi, "UPDATE stokbarang SET stok=stok-'$jumlah' WHERE kode_brg='$kode_brg' ");
		
				
		if($query2) {
			header("location:index.php?p=datapesanan");
		} else {
			echo "ada yang salah" . mysqli_error($koneksi);
		}
	}


?>