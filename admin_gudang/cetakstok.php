<?php ob_start(); ?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  h1 {color: #000033}
  h2 {color: #000055}
  h3 {color: #000077}
</style>
<!-- Setting Margin header/ kop -->
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 35px;
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #000;
  }

    div.kanan {
     width:300px;
	 float:right;
     margin-left:210px;
     margin-top:-140px;
  }

  div.kiri {
	  width:300px;
	  float:left;
	  margin-left:30px;
	  display:inline;
  }
  
  </style>
  <table>
  <?php 
      include "../fungsi/koneksi.php";
      $id = isset($_GET['idjenis']) ? $_GET['idjenis'] : "";
      switch($id) {
        case 1 :
            $material = "PIPA";
            break;
        case 2 :
            $material = "METER AIR";
            break;
        case 3 :
            $material = "ASESSORIS";
             break;
        default:
            $material = "";
      }

   ?>

    <tr>
      <th rowspan="3"><img src="../gambar/logopdam.png" style="width:100px;height:100px" /></th>
      <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>TELKOM AKSES <br> TELKOM INDONESIA GROUP</b></font>
      <br><br>Jl. Hos.Cokroaminoto No.26 kelurahan Sudimara Timur Kec. Ciledug-Tangerang<br> Telp : (021) 7315000 </td>
	  
    </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>Laporan Stock Barang Telkom Akses</u></p>
  <table class="tabel2" align="center">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
		<td style="text-align: center; "><b>Satuan</b></td>
        <td style="text-align: center; "><b>Stok</b></td>
              
      </tr>
    </thead>
    <tbody>
      <?php
           
      $sql = mysqli_query($koneksi, "SELECT * FROM stokbarang WHERE id_jenis = '$id' ");  
      $i   = 1;
      while($data=mysqli_fetch_array($sql))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
        <td style="text-align: center; width=80px;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data['nama_brg']; ?></td>
		<td style="text-align: center; width=70px;"><?php echo $data['satuan']; ?></td> 
        <td style="text-align: center; width=70px;"><?php echo $data['stok']; ?></td>
              
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  
<p></p>

  <div class="kiri">
      <p>Mengetahui :<br> Manajer Gudang </p>
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
    $html2pdf->Output('laporan_stok_material_teknik.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>