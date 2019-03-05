<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
       
    $query = mysqli_query($koneksi, "SELECT  permintaan.id_permintaan, permintaan.id_user,username,tgl_permintaan,manajer FROM permintaan INNER JOIN 
        user ON permintaan.id_user = user.id_user   ");  
    
?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Permintaan Barang</h3>
                </div>                
                
                    <div class="table-responsive">
                        <table id="datapesanan" class="table text-center">
                            <thead  > 
                                <tr>
                                    <th>No</th> 
                                    <th>Leader </th>
                                    <th>Manager </th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Aksi</th>                                    
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
                                        <td> <?= $row['username']; ?> </td>
                                        <td> <?= $row['manajer']; ?> </td>
                                        <td> <?= tanggal_indo($row['tgl_permintaan']); ?> </td>                                        
                                        <td>                                                                                                                                                                                                          
											<a href="?p=detil&id_user=<?= $row['id_user'];?>&tgl=<?= $row['tgl_permintaan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button class="btn btn-info">Detail</button></span></a>                  
                                        </td>                                                                                            
                            </tr>
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Belum ada permintaan material teknik hari ini</td></tr>";} ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>


</section>

    
