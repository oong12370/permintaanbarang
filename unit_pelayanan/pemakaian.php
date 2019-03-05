<?php  
    include "../fungsi/koneksi.php";
    $error = "";


?>

<section class="content">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Form Pemakaian Barang</h3>
                </div>
                <form method="post" id="tes"  action="add_pakai.php" class="form-horizontal">
             
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="nama_brg" class="a col-sm-3 control-label">Leader</label>
                            <div class="col-sm-3">
                                <input type="hidden" readonly value="<?= $_SESSION['id_user']; ?>" class="form-control" name="id_user">
                                <input type="text" readonly value="<?= $_SESSION['username']; ?>" class="form-control" name="unit">
                            </div>
                        </div>
                         
                        <div class="form-group">
                            <label  for="nama_brg" class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-5">
                                <select id="nama_brg" required="isikan dulu" class="form-control" name="kode_brg">
                                <option value="">--Pilih Nama Barang--</option>  
                                 <?php  
                                    include "../fungsi/koneksi.php";
                                    $queryJenis = mysqli_query($koneksi, "select pengeluaran_barang.*, stokbarang.* from pengeluaran_barang,stokbarang where pengeluaran_barang.kode_brg=stokbarang.kode_brg ");
                                    if (mysqli_num_rows($queryJenis)) {
                                        while($row=mysqli_fetch_assoc($queryJenis)):
                                    ?>                                        
                                        <option value="<?= $row['kode_brg']; ?>"><?= $row['nama_brg']; ?></option>
                                    <?php endwhile; } ?>                                                                   
                                </select>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label for="jumlah" class=" col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-2">
                                <input id="qty" type="number" onkeyup="sendAjax()" class="form-control" name="qty" required>                                
                            </div>
                            <span class="col-sm-7"> <?php echo $error; ?></span>
                        </div>
						 <div class="form-group">
                            <label for="teknisi" class=" col-sm-3 control-label">Teknisi</label>
                            <div class="col-sm-5">
                                <select id="nik" required="isikan dulu" class="form-control" name="nik">
                                <option value="">--Pilih  Teknisi--</option>
                                <?php  
                                    include "../fungsi/koneksi.php";
                                    $queryJenis = mysqli_query($koneksi, "select * from teknisi");
                                    if (mysqli_num_rows($queryJenis)) {
                                        while($row=mysqli_fetch_assoc($queryJenis)):
                                    ?>                                        
                                        <option value="<?= $row['nik']; ?>"><?= $row['nama']; ?></option>
                                    <?php endwhile; } ?>                                      
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stok" class=" col-sm-3 control-label">Projek</label>
                            <div class="col-sm-6">
                                <input id="projek" type="text" class="form-control" name="projek" required>                                
                            </div>
                            </div>
                        <div class="form-group">
                            <input type="submit" id="simpan" name="simpan" class="btn btn-primary col-sm-offset-3 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Pemakaian Barang</h3>
                </div>
                
                    <table class="table table-responsive" id="tbpakai">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Pakai</th>
                            <th>Sisa</th>
                            <th>Satuan</th>
                            <th>Nama Teknisi</th>
                            <th>Projek</th>
                        </tr>
                        <tr>
                        <?php 
                            $sekarang  = date("Y-m-d");
                            $queryTampil = mysqli_query($koneksi, "select pemakaian.*, stokbarang.*,pengeluaran_barang.*,teknisi.* from pemakaian,stokbarang,pengeluaran_barang,teknisi where pemakaian.kode_brg=stokbarang.kode_brg && pemakaian.kode_brg=pengeluaran_barang.kode_brg && pemakaian.nik=teknisi.nik  "  );
                            $no = 1;
                            if(mysqli_num_rows($queryTampil) > 0) {
                                while($row = mysqli_fetch_assoc($queryTampil)):
                            

                         ?>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['nama_brg']; ?></td>
                            <td><?php echo $row['qty']; ?> </td>
                            <td><?php echo $row['jumlah']; ?></td>
                            <td><?php echo $row['satuan'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            
                            <td><?php echo $row['projek'] ?></td>
                        </tr>
                    <?php $no++; endwhile; } else { echo "<tr><td>Tidak ada permintaan barang hari ini</td></tr>"; } ?>
                    </table>    
                <div class="box-body">
                    <a class="btn btn-success" target="blank" href="cetak__pemakaian.php" ><i class="fa fa-print"></i> Print out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $("#tbpakai").DataTable({
             "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            "sEmptyTable": "Tidak ada data di database"
            }
        });
    });
</script> 
<script>
    $(document).ready(function(){
        $("#jenis_brg").change(function(){
            var jenis = $(this).val();
            var dataString = 'jenis='+jenis;
            $.ajax({
                type:"POST",
                url:"getdata.php",
                data:dataString,
                success:function(html){
                    $("#nama_brg").html(html);                    
                }
            });
        });

        $("#nama_brg").change(function(){
            var kode = $(this).val();
            var dataString = 'kode='+kode;
            $.ajax({
                type:"POST",
                url:"get_pengeluaran.php",
                data:dataString,
                success:function(html){
                    $("#stok").val(html);        
                }
            });
        });
				       
    });


	
	 function cek_stok(){
                var jumlah = $("#jumlah").val();                
                var kode_brg = $("#nama_brg").val();   
                $.ajax({
                    url: 'cekstok.php',
                    data:"jumlah="+jumlah+"&kode_brg="+kode_brg,
                    dataType:'json',
                }).success(function (data) {                                      
                                      
                   
                        if(data.hasil == 1){                            
                            $("#tes").submit(function(e){
                                e.preventDefault();
                                alert(data.pesan);
                            });
                        }
                        
                   

                });
            }

   function sendAjax() {
    setTimeout(
        function() {
            var jumlah = $("#jumlah").val();                
                var kode_brg = $("#nama_brg").val();   
                $.ajax({
                    url: 'cekstok.php',
                    data:"jumlah="+jumlah+"&kode_brg="+kode_brg,
                    dataType:'json',
                }).success(function (data) {                                      
                                      
                   
                        if(data.hasil == 1){                            
                            
                                alert(data.pesan);
                                $("#jumlah").val("");
                            
                        }
                        
                   

                });
        }, 1000);
}
</script>