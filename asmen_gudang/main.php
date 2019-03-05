<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";

    $query = mysqli_query($koneksi, "SELECT count(*) from stokbarang ");   
    $query1 = mysqli_query($koneksi, "SELECT count(*) from permintaan "); 
    $query2 = mysqli_query($koneksi, "SELECT count(*) from user "); 
    if (mysqli_num_rows($query2)) {
                                            while($rowss=mysqli_fetch_assoc($query2)):   
?>

 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
    
    <div class="col-lg-4 col-xs-12">
        <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <p><font size="5px"><b>Data User</b></font></p>
              <p><font size="5px"><?= $rowss['count(*)']; ?></font></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="index.php?p=user" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    <?php 
                                        
                                        if (mysqli_num_rows($query1)) {
                                            while($rows=mysqli_fetch_assoc($query1)):

                                     ?>
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <p><font size="5px"><b>Data Permintaan</b></font></p>
              <p><font size="5px"><?= $rows['count(*)']; ?></font></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="index.php?p=datapesanan" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    <?php 
                                        $no =1 ;
                                        if (mysqli_num_rows($query)) {
                                            while($row=mysqli_fetch_assoc($query)):

                                     ?>
     <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <p><font size="5px"><b>Data Stok</b></font></p>
              <p><font size="5px"><?= $row['count(*)']; ?></font></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="index.php?p=material" class="small-box-footer">Info Lebih Lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    <?php $no++; endwhile; }else  ?>
    <?php $no++; endwhile; }else  ?>
  </section>
  <?php $no++; endwhile; }else  ?>
  