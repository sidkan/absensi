<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/logo_kemenag.png"/>

        <!-- Custom CSS-->
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/css/font_style.css" rel="stylesheet">

    <title>Rekap Kinerja</title>
  </head>
  <body>

<div class="container"> 
    <div class="row mt-3 justify-content-center">
        <div class="col-md-12">
            <b><h2 class="text-center">LAPORAN KINERJA HARIAN</h2></b>
        </div>
    </div>
    <hr>
    <div class="row mt-3"> Saya yang bertanda tangan di bawah ini : </div>
    <div class="row mt-3">
        <div class="col-md-12">
        <table class="table table-borderless table-sm">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td><?php echo ": " .  $pegawai['nama_pegawai']?></td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td><?= ": " .  $pegawai['nip']?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td><?= ": " .  $pegawai['jabatan']?></td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td><?= ": " .  $satker['nama_satker']?></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div class="row mt-3"> Sesuai uraian tugas dan fungsi saya telah melaksanakan tugas sebagai berikut:</div>
    <div class="row mt-3">
        <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-hover table-sm table-striped table-bordered" id="mytable">
            <thead class="thead-light">
              <tr>
                <th scope="col" width="3%">No</th>
                <th scope="col" width="12%">Tanggal</th>
                <th scope="col" width="85%">Kinerja Harian</th>
              </tr>
            </thead>
            <tbody>
            <?php 

            switch($bulan){
                case date('m'):
                    $tgl = date('d');
                break;
                case '01':
                    $tgl = 31;
                break;
                case '02':
                    $tgl = 29;
                break;
                case '03':
                    $tgl = 31;
                break;
                case '04':
                    $tgl = 30;
                break;
                case '05':
                    $tgl = 31;
                break;
                case '06':
                    $tgl = 30;
                break;
                case '07':
                    $tgl = 31;
                break;
                case '08':
                    $tgl = 31;
                break;
                case '09':
                    $tgl = 30;
                break;
                case '10':
                    $tgl = 31;
                break;
                case '11':
                    $tgl = 30;
                break;
                case '12':
                    $tgl = 31;
                break;
                default:
                    $tgl = date('d');
            break;
            }  
              $no = 1;
              //$tgl = date('d');
              $thn_bln = $tahun ."-". $bulan;
              for ($i = 1; $i <= $tgl; $i++):
                //echo '<td>';
                if ($i<=9){
                    $tgl_select = '0'.$i;
                }else {
                    $tgl_select = $i;
                }

                $tgl_now = $tahun ."-". $bulan . "-". $tgl_select;
            ?>
              <tr>
                <th scope="row"><?= $no."."?></th>
                <td>
                    <?= $tgl_select ."-".$bulan."-". $tahun?>   
                </td>
                <?php
                    //echo '<td> aktivitas </td>';
                    
                      
                        // //$sql = "SELECT  `waktu_masuk`, `waktu_keluar`  FROM `tbl_absensi` WHERE `nip` = '". $peg['nip'] ."' && tgl_absen = '2020-04-". $tgl_select ."'";
                        $sql = "SELECT  * FROM `tbl_aktivitas` WHERE `nip` = '". $pegawai['nip'] ."' && tgl_aktivitas = '".$thn_bln."-". $tgl_select ."' ORDER BY `jam_mulai` ASC";
                        $result = $this->db->query($sql)->result_array();
                        if ($result){
                            echo '<td>';
                            $urutan = 1;
                            foreach($result as $res){
                                
                                echo substr($res['jam_mulai'],0,5)."-". substr($res['jam_selesai'],0,5). " ";
                                echo "<i>". $res['isi_aktivitas'] . "</i> </br>";

                                $urutan++;
                                
                            }

                            echo "</td>";
                            
                        }else {
                          echo "<td class='table-danger'>-</td>";
                          
                        }
                        // //echo '</td>';
                        
                ?>
              </tr>

            <?php $no++; endfor; ?>
            </tbody>
          </table>
        </div>
        </div>
    </div>
    <div class="row mt-3" >
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
            <table class="table table-borderless table-sm">
                <thead>
                    <tr>
                        <th scope="col" width="60%"></th>
                        <th scope="col" width="40%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>Kupang, <?= date('d-m-Y')?></td>
                    </tr>
                    <tr>
                        <td>Mengetahui</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><?= $pimpinan['jabatan'] ?></td>
                        <td>Yang Membuat Pernyataan</td>
                    </tr>
                    <tr>
                        <td height="60px"></td>
                        <td height="60px"></td>
                    </tr>
                    <tr>
                        <td>
                            <?= $pimpinan['nama_pegawai']; ?></br>
                            NIP. <?= $pimpinan['nip']; ?>
                        </td>
                        <td>
                            <?= $pegawai['nama_pegawai']; ?></br>
                            NIP. <?= $pegawai['nip']; ?> 
                        </td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>
    <!--
    <div class="row mt-3">
        <a href="<?= site_url('laporanpdf'); ?>">Download Rekap Kinerja Bulan Lalu</a>
    </div>
    -->

</div>

<script>
    window.print();
</script>
