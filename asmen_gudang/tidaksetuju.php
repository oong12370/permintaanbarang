<?php  

include "../fungsi/koneksi.php";

if (isset($_GET['id']) && isset($_GET['tgl']) && isset($_GET['id_user'])) {
	$id = $_GET['id'];
	$tgl = $_GET['tgl'];
	$id_user = $_GET['id_user'];

	$query = mysqli_query($koneksi, "UPDATE permintaan SET status=2 WHERE id_permintaan='$id' ");

	if($query) {
		header("location:index.php?p=detil&tgl=$tgl&id_user=$id_user");
	} else {
		echo "error : " . mysqli_error($koneksi);
	}
}


?>