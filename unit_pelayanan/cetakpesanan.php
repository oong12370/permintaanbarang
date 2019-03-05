<?php 
  
  include "../fungsi/koneksi.php";
  include "../fungsi/fungsi.php";

  ob_start(); 
  $id  = isset($_GET['id']) ? $_GET['id'] : false;


  $id_user = $_GET['id_user'];
  $tgl= $_GET['tgl'];
    
?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  
 
</style>
<!-- Setting Margin header/ kop -->
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 145px;
    
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #000;

  }

   table.isi {
    margin: 0 170px;

  }

  .isi td {
    padding: 15px 15px;
  }
  div.kanan {
     position: absolute;
     bottom: 100px;
     right: 50px;
     
  }

  div.tengah {
     position: absolute;
     bottom: 100px;
     right: 330px;
     
  }

  div.kiri {
     position: absolute;
     bottom: 100px;
     left: 10px;     
  }

  </style>
  <table>
     <tr>
      <th rowspan="3"><img src="../gambar/logopdam.png" style="width:100px;height:100px" /></th>
      <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>TELKOM AKSES <br> TELKOM INDONESIA GROUP</b></font>
      <br><br>Jl. Hos.Cokroaminoto No.26 kelurahan Sudimara Timur Kec. Ciledug-Tangerang<br> Telp : (021) 7315000 </td>
    
    </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PERMINTAAN BARANG </u></p>
  <br><br>
 
  <div class="isi" style="margin: 0 auto;">
   <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>        
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
        <td style="text-align: center; "><b>Jumlah</b></td> 
		<td style="text-align: center; "><b>Satuan</b></td> 
         <td style="text-align: center; "><b>Teknisi</b></td>                                     
      </tr>
    </thead>
    <tbody>
      <?php

       
       $query = mysqli_query($koneksi, "SELECT permintaan.nik, permintaan.kode_brg, id_user, nama_brg,nama, jumlah, satuan, tgl_permintaan FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg INNER JOIN teknisi ON permintaan.nik = teknisi.nik  WHERE id_user='$id_user' AND  status=1 AND tgl_permintaan='$tgl' "); 
      $i   = 1;
      while($data=mysqli_fetch_array($query))
      {
      ?>
      <tr>
        <td style="text-align: center;"><?php echo $i; ?></td>             
        <td style="text-align: center;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center;"><?php echo $data['nama_brg']; ?></td>
         <td style="text-align: center;"><?php echo $data['jumlah']; ?></td> 
		<td style="text-align: center;"><?php echo $data['satuan']; ?></td>  
       <td style="text-align: center;"><?php echo $data['nama']; ?></td>                             
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  <?php 

  $query2 = mysqli_query($koneksi, "SELECT permintaan.nik, permintaan.kode_brg, id_user, nama_brg,nama, jumlah, satuan, tgl_permintaan FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg INNER JOIN teknisi ON permintaan.nik = teknisi.nik WHERE id_user='$id_user' AND  status=1 AND tgl_permintaan='$tgl' ");  
  $data2 = mysqli_fetch_assoc($query2);

  ?>

  <p>Pada hari ini tanggal : <b> <?=  tanggal_indo($tgl); ?></b> telah dikeluarkan serta serah terima barang berupa seperti yang tersebut di atas.</p>
  <p>Teknisi yang mengambil barang ke Gudang : <?php echo $data2['nama']; ?></p>
  </div>
 
  
<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
 include '../assets/html2pdf/html2pdf.class.php';
 try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('bukti_permintaan_dan_pengeluaran_barang.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>