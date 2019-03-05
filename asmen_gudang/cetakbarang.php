<?php ob_start();
	include "../fungsi/fungsi.php";

 ?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #3C8DBC; color: #fff; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #3C8DBC; border-top: solid 1mm #AAAADD; padding: 2mm}
  h1 {color: #000033}
  h2 {color: #000055}
  h3 {color: #000077}
</style>
<!-- Setting Margin header/ kop -->
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 20px;    
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #959595;
  }

   div.kanan {
     width:300px;
	 float:right;
     margin-left:250px;
     margin-top:-140px;
  }

  div.kiri {
	  width:300px;
	  float:left;
	  margin-left:20px;
	  display:inline;
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
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN PENGELUARAN BARANG</u></p>
  <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>
		<td style="text-align: center; "><b>Tanggal </b></td>
        <td style="text-align: center; "><b>Mekanik</b></td>
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
		<td style="text-align: center; "><b>Satuan</b></td>
        <td style="text-align: center; "><b>Jumlah</b></td>
      </tr>
    </thead>
    <tbody>
      <?php

       include "../fungsi/koneksi.php";
       $query = mysqli_query($koneksi, "SELECT permintaan.nik, permintaan.kode_brg, id_user, nama_brg,nama, jumlah, satuan, tgl_permintaan FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg INNER JOIN teknisi ON permintaan.nik = teknisi.nik WHERE status='1'  "); 
      $i   = 1;
      while($data=mysqli_fetch_array($query))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
		<td style="text-align: center; width=70px;"><?php echo tanggal_indo($data['tgl_permintaan']); ?></td>
        <td style="text-align: center; width=70px;"><?php echo $data['nama']; ?></td>        
        <td style="text-align: center; width=120px;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data['nama_brg']; ?></td>
		<td style="text-align: center; width=70px;"><?php echo $data['satuan']; ?></td> 
        <td style="text-align: center; width=50px;"><?php echo $data['jumlah']; ?></td>                   
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  
  <div class="kiri">
      <p>Mengetahui :<br>Manajer </p>
      <br>
      <br>
      <br>
      <p><b><u></u><br>NIK : </b></p>
  </div>

  <div class="kanan">
      <p>Mengetahui :<br>Asisten Manajer Gudang </p>
      <br>
      <br>
      <br>
      <p><b><u></u><br>NIK : </b></p>
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
    $html2pdf->Output('laporan_pengeluaran_barang.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>