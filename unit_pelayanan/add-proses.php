<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$id_user = $_POST['id_user'];
		$kode_brg = $_POST['kode_brg'];
		$jumlah = $_POST['jumlah'];		
		$tgl_pemesanan = date('Y-m-d');
		$id_jenis = $_POST['id_jenis'];
		$nik = $_POST['nik'];
		$sqlcek = mysqli_query($koneksi, "SELECT * from sementara where id_user='$_POST[id_user]'");   
		$rscek=mysqli_num_rows($sqlcek);
		if($rscek  >= 9){
			echo "<script>window.alert('Maksimal Permintaan Barang 9 Jenis!!! Thanks')
    window.location='index.php?p=formpesan'</script>";
    }else{$query = "INSERT into sementara (id_user, kode_brg, id_jenis,  jumlah, tgl_permintaan, nik ) VALUES 
										('$id_user', '$kode_brg', '$id_jenis', '$jumlah', '$tgl_pemesanan', '$nik')

			";
		}
		
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=formpesan");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}
	}
?>