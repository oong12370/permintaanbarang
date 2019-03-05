<?php  

	include "../fungsi/koneksi.php";

	$kode_brg = $_GET['kode_brg'];
	$jumlah = $_GET['jumlah'];
	
	$query = mysqli_query($koneksi,"select * from pengeluaran_barang WHERE kode_brg='$kode_brg' ");
     
	 
    	$row = mysqli_fetch_assoc($query);
    	if ($row['jumlah'] > 9 ){
    	$data = array(
	            'hasil'      =>  1,
	            'pesan' => 'Tidak dapat request jika stok pemakaian lebih dari 10 '
	             );
	 			echo json_encode($data);
		}
    

  
?>