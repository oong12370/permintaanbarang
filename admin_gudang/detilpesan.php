<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
    
    if (isset($_GET['tgl']) && isset($_GET['id_user'])) {
        $tgl = $_GET['tgl'];
        $id_user = $_GET['id_user'];
        $query = mysqli_query($koneksi, "SELECT  permintaan.id_permintaan, permintaan.kode_brg, nama_brg, jumlah, satuan, status FROM permintaan INNER JOIN 
        stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE status='1'  ");
               
    }

    
?>

<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Permintaan Barang </h3>
                </div>                
                <div class="box-body">                   
                    <a href="index.php?p=datapesanan" style="margin:10px;" class="btn btn-success"><i class='fa fa-backward'>  Kembali</i></a>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead  > 
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>                                                                                              
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Status</th>
                                    <th>Aktion</th>                                                                       
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
                                        <td> <?= $row['kode_brg']; ?> </td>    
                                        <td> <?= $row['nama_brg']; ?> </td>    
                                        <td> <?= $row['jumlah']; ?> </td>    
                                        <td> <?= $row['satuan']; ?> </td>                                           
                                                                                                                    
                                        <td > <?php
                                                if ($row['status'] == 0){
                                                    echo '<span class=text-warning>Menunggu Persetujuan</span>';
                                                } elseif ($row['status'] == 1) {
                                                    echo '<span class=text-primary>Telah Disetujui</span>';
                                                } else {
                                                    echo '<span class=text-danger>Tidak Disetujui</span>';
                                                }
                                               ?> 
                                         </td>
                                         <td > 
                                          <a  href="?p=pic&id_user=<?php echo $id_user; ?>&id_permintaan=<?= $row['id_permintaan']; ?>&kode_brg=<?= $row['kode_brg']; ?>&jumlah=<?= $row['jumlah']; ?>"><span data-placement='top' data-toggle='tooltip' title='Setujui'><button   class="btn btn-success">Picking</button></span></a> 
                                         </td>    
                                        <!-- <td>                                            
                                                
                                                    <a  href="hapuspesan.php?tgl=<?= $tgl; ?>&unit=<?= $unit; ?>&aksi=hapus&id=<?=$row['id']; ?>"><span data-placement='top' data-toggle='tooltip' title='Hapus'><button   class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">Hapus</button></span></a>            
                                                                                                                                                                                                                                                                             
                                        </td> -->
                            
                            
                            </tr>
                            
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Tidak ada permintaan material teknik.</td></tr>";} ?>

                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</section>

