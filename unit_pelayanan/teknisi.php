<?php  
      include "../fungsi/koneksi.php";
      if (isset($_GET['aksi']) && isset($_GET['nik'])) {
        //die($id = $_GET['id']);
        $id = $_GET['nik'];        

        if ($_GET['aksi'] == 'editteknisi') {
            header("location:?p=editteknisi&nik=$nik");
        } else if ($_GET['aksi'] == 'hapus') {
            header("location:?p=hapusteknisi&nik=$nik");
        } 
    }
	
	$query = mysqli_query($koneksi, "SELECT * FROM teknisi");	

?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-sm-12">
			 <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Olah Data Teknisi</h3>
                </div>                
                <div class="box-body">
               <div class="row">
                    <div class="col-md-2">
                        <a href="index.php?p=tambahteknisi" class=" btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> 
                    </div>
                    <br><br>
                </div>                  
                	<div class="table-responsive">
                		<table class="table text-center" id="user">
                			<thead  > 
	                			<tr>
	                				<th>No</th>
	                				<th>NIK</th>	                					                				
                                    <th>Nama</th>
                                    <th>Mitra</th>
	                				<th>Team</th>	                				
	                			</tr>
                			</thead>
                			<tbody>
                				<tr>
                					<?php 
                						$no =1 ;
                						if (mysqli_num_rows($query)) {
                							while($row=mysqli_fetch_assoc($query)):

                					 ?>
                						<td> <?= $no; ?> </td>
                						<td> <?= $row['nik']; ?> </td>                                        
                						<td> <?= $row['nama']; ?> </td>
                                        <td> <?= $row['mitra']; ?> </td>
                						<td> <?= $row['tim']; ?> </td>
                                         <td>
                                            <a href="?p=editteknisi&aksi=editteknisi&nik=<?= $row['nik']; ?>"><span data-placement='top' data-toggle='tooltip' title='Edit'><button  class="btn btn-info">Edit</button></span></a>                     

                                            <a href="?p=hapusteknisi&aksi=hapus&nik=<?= $row['nik']; ?>"><span data-placement='top' data-toggle='tooltip' title='Hapus'><button  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button></span></a>                    
                                        </td>              					
                				</tr>
                			<?php $no++; endwhile; } ?>
                			</tbody>
                		</table>
                	</div>                	
                </div>
            </div>
		</div>
	</div>

</section>

<script>
    $(function(){
        $("#user").DataTable({
             "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            "sEmptyTable": "Tidak ada data di database"
            }
        });
    });
</script> 
