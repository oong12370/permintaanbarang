<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$id_user = $_POST['id_user'];
		$kode_brg = $_POST['kode_brg'];
		$qty = $_POST['qty'];		
		$tgl_pakai = date('Y-m-d');
		$projek = $_POST['projek'];
		$nik = $_POST['nik'];
		
		$query2 = mysqli_query($koneksi, "UPDATE pengeluaran_barang SET jumlah=jumlah-'$qty' WHERE kode_brg='$kode_brg' ");
		$query = "INSERT into pemakaian (id_user, kode_brg, projek,  nik, qty,tgl_pakai ) VALUES 
										('$id_user', '$kode_brg', '$projek', '$nik', '$qty','$tgl_pakai')

			";
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=pemakaian");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}
	}