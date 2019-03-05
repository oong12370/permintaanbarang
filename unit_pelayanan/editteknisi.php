<?php  
	include "../fungsi/koneksi.php";
    //mengambil id untuk edit user
	if (isset($_GET['nik'])) {
		$nik = $_GET['nik'];
		$query = mysqli_query($koneksi, "SELECT * FROM teknisi WHERE nik = $nik ");
		if (mysqli_num_rows($query)) {
			while($row2 = mysqli_fetch_assoc($query)):
?>
<?php
 if(isset($_POST['simpan'])) {
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $mitra = $_POST['mitra'];
        $tim = $_POST['tim'];
        $query = mysqli_query($koneksi, "UPDATE teknisi SET nik='$nik', nama='$nama', mitra='$mitra', tim='$tim' WHERE nik ='$nik' ");
              
        if ($query) {
            header("location:index.php?p=teknisi");
        } else {
            echo 'gagal : ' . mysqli_error($koneksi);
        }
    }
?>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Tambah Data Teknisi</h3>
                </div>
                <form method="post"  action="" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="username" class="col-sm-offset-1 col-sm-3 control-label">NIK</label>
                            <div class="col-sm-4">
                                <input  required type="text" value="<?= $row2['nik']; ?>" class="form-control" name="nik">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="paswword"class="col-sm-offset-1 col-sm-3 control-label">Nama</label>
                            <div class="col-sm-4">
                                <input required type="text" value="<?= $row2['nama']; ?>" class="form-control" name="nama">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="manajer" class="col-sm-offset-1 col-sm-3 control-label">Mitra</label>
                            <div class="col-sm-4">
                                <input  required type="text" value="<?= $row2['mitra']; ?>" class="form-control" name="mitra">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="asmen" class="col-sm-offset-1 col-sm-3 control-label">Team</label>
                            <div class="col-sm-4">
                                <input  required type="text" value="<?= $row2['tim']; ?>"  class="form-control" name="tim">
                            </div>
                        </div>                        
                                
                        <div class="form-group">
                            <input type="submit" name="simpan" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php endwhile; } }  ?>