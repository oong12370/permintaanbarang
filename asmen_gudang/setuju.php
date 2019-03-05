<?php  
error_reporting(0);
	include "../fungsi/koneksi.php";

	if(isset($_GET['id_user'])) {
		$id_user = $_GET['id_user'];
		$id_permintaan = $_GET['id_permintaan'];
		$kode_brg = $_GET['kode_brg'];
		$jumlah = $_GET['jumlah'];
		$tgl_keluar = date('Y-m-d');
		
		$query1 = mysqli_query($koneksi, "UPDATE permintaan SET status=1 WHERE id_permintaan='$id_permintaan' ");		

		$query2 = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_permintaan='$id_permintaan'");
		
		$row = mysqli_fetch_assoc($query2);

		$query3 = mysqli_query($koneksi, "INSERT INTO pengeluaran_barang VALUES('','$id_permintaan','$id_user', '$kode_brg', '$jumlah', '$tgl_keluar') ");

		if($query1) {
			
			echo '<script>window.location = "index.php?p=datapesanan"</script>';
		} else {
			echo "ada yang salah" . mysqli_error($koneksi);
		}
	}


?>