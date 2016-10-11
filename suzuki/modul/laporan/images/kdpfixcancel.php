<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf_include.php');
require_once ('koneksi.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Santomi Fitrada');
$pdf->SetTitle('Kartu Data Prospek');
$pdf->SetSubject('Kartu Data Prospek');
$pdf->SetKeywords('KDP, ITS, SUZUKI');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '', '', '');
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 8, '', true);

$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

/* NOTE:
* *********************************************************
* You can load external XHTML using :
*
* $html = file_get_contents('/path/to/your/file.html');
*
* External CSS files will be automatically loaded.
* Sometimes you need to fix the path of the external CSS.
* *********************************************************
*/

$id_prospek = $_GET['id_prospek'];
$id_pelanggan = $_GET['id_pelanggan'];

$r_prospek = mysql_query("SELECT   a.id_prospek, a.no_prospek, 
                                   DATE_FORMAT(a.tgl_prospek, '%d %M %Y') AS tgl_prospek, 
                                   a.id_pelanggan, b.tipe, b.model, b.transmisi, c.warna, a.jml_kendaraan,a.id_status_prospek,
                                   d.status_prospek,
                                 (
                                    CASE a.test_drive
                                    WHEN 'Y' THEN
                                         'Ya'
                                    WHEN 'N' THEN
                                        'Tidak'
                                    ELSE
                                         '-'
                                    END
                                ) AS test_drive,

                                (
                                    CASE a.id_pembayaran
                                    WHEN '1' THEN
                                        'Cash/Tunai'
                                    WHEN '2' THEN
                                        'Kredit'
                                    ELSE
                                        '-'
                                    END
                                ) AS pembayaran, a.id_pembayaran, a.created_by, a.created_date, e.nama_lengkap

                        FROM
                            tb_prospek a
                        LEFT JOIN ms_tipe_kendaraan b ON b.id_tipe_kendaraan = a.id_tipe_kendaraan
                        LEFT JOIN ms_warna c ON c.id_warna = a.id_warna
                        LEFT JOIN ms_status_prospek_suzuki d ON d.id_status_prospek = a.id_status_prospek
                        LEFT JOIN ms_users e ON e.username = a.created_by
                        WHERE a.id_prospek = '$id_prospek'") 
                        or die (mysql_error());

$prospek = mysql_fetch_array($r_prospek);

$r_customer = mysql_query("SELECT   a.id_pelanggan, a.nama_perush, a.alamat_kantor, a.telp_kantor, a.fax_kantor, a.email_kantor, 
                                    a.jabatan, a.nama_pengurus, a.no_hp, a.email, a.alamat_rumah, a.telp_rumah, a.kodepos, 
                                    c.nama_kota, a.id_asal_prospek

                        FROM
                            tb_pelanggan a
                        LEFT JOIN ms_asal_prospek b ON b.id_asal_prospek = a.id_asal_prospek
                        LEFT JOIN ms_kota c ON c.id_kota = a.id_kota
                        WHERE a.id_pelanggan = '$id_pelanggan'") 
                        or die (mysql_error());
                        
$customer = mysql_fetch_array($r_customer);

$r_kredit = mysql_query("SELECT a.id_prospek, a.id_perusahaan, b.perusahaan, a.id_dp, a.tenor
                         FROM
                            tb_kredit a
                        LEFT JOIN ms_leasing_nama b ON b.id_perusahaan = a.id_perusahaan
                        WHERE a.id_prospek = '$id_prospek'") 
                        or die (mysql_error());
                        
$kredit = mysql_fetch_array($r_kredit);

$r_lost = mysql_query("SELECT   a.id_pelanggan, a.id_prospek, (
                                CASE a.id_p_analisa_lost
                                WHEN '1' THEN
                                    'Beli Merk Lain'
                                WHEN '2' THEN
                                    'Beli Dealer Lain'
                                WHEN '3' THEN
                                    'Beli Bekas'
                                WHEN '4' THEN
                                    'Batal Beli'
                                ELSE
                                    '-'
                                END
                                ) AS lost_case,
                                
                                b.analisa_lost, a.catatan
                         FROM
                            tb_lost a
                        LEFT JOIN ms_analisa_lost b ON b.id_analisa_lost = a.id_analisa_lost
                        WHERE a.id_prospek = '$id_prospek'") 
                        or die (mysql_error());
                        
$lost = mysql_fetch_array($r_lost);

$en=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","January","February","March",
                    "April","May","June","July","August","September","October","November","December");
 
$idn=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Januari","Pebruari","Maret","April","Mei",
                    "Juni","Juli","Agustus","September","Oktober","Nopember","Desember");

$tbl_header = '<table border="1" cellspacing="2" cellpadding="3">';
$tbl_footer = '</table>';
$tr_o = '<tr>';
$tr_c = '</tr>';
$th_o = '<th>';
$th_c = '</th>';


//aktivitas
$logo = '<img src="images/logo_kdp_dcm.png" style="width:343px;height:40px;"> <br>';
$abjad = '<h2>A  B  C  D  E  F  G  H  I  J  K  L  M  N  O  P  Q  R  S  T  U  V  W  X  Y  Z</h2>';

$data_prospek='    <tr>
                        <th>Wiraniaga : '.$prospek['nama_lengkap'].'</th>
                        <th align="center" rowspan="2"><h3>KARTU DATA PROSPEK</h3></th>
                        <th>Tgl. Inq : '.str_replace($en, $idn, $array['tgl_prospek']).'</th>
                    </tr>
                    <tr>
                        <th>Outlet : Duta Cemerlang Motor (DCM)</th>
                        <th>Inq. No. : '.$prospek['no_prospek'].'</th>
                    </tr>
                    <tr>     
                        <th bgcolor="#cccccc" align="center" colspan="3"><h4>Data Pelanggan</h4></th>
                    </tr> ' ;

$data_customer='     <tr>
                        
                        <td>
                            <table border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>Nama Pelanggan</td>
                                    <td>: '.$customer['nama_pengurus'].'</td>
                                </tr>
                                <tr>
                                    <td>Status Pelanggan</td>
                                    <td>: Baru / Repeat Order</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: '.$customer['alamat_rumah'].'</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Kodepos</td>
                                    <td>: '.$customer['kodepos'].'</td>
                                </tr>
                                <tr>
                                    <td>Telp Rumah</td>
                                    <td>: '.$customer['telp_rumah'].'</td>
                                </tr>
                                <tr>
                                    <td>Kota</td>
                                    <td>: '.$customer['kodepos'].'</td>
                                </tr>
                            </table>
                        </td>
                        

                        <td>
                            <table border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>Perusahaan</td>
                                    <td>: '.$customer['nama_perush'].'</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: '.$customer['alamat_kantor'].'</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>: '.$customer['jabatan'].'</td>
                                </tr>
                                <tr>
                                    <td>Telp Kantor</td>
                                    <td>: '.$customer['telp_kantor'].'</td>
                                </tr>
                                <tr>
                                    <td>Handphone</td>
                                    <td>: '.$customer['no_hp'].'</td>
                                </tr>
                                <tr>
                                    <td>Faximile</td>
                                    <td>: '.$customer['fax_kantor'].'</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: '.$customer['email_kantor'].'</td>
                                </tr>
                            </table>
                        </td>
                    </tr>';

$h_data ='          <th bgcolor="#cccccc" align="center"><h4>P. Data</h4></th>';

if ($customer['id_asal_prospek'] == '1'){ 
    $asal_prospek = '
                        <th bgcolor="#cccccc"align="center">Database</th>
                        <th align="center">Referensi</th>
                        <th align="center">S.Traffic</th>
                        <th align="center">Exhibition</th>
                        <th align="center">Call</th>
                        <th align="center">Visit</th>
                        <th align="center">Others</th>';
                        
} elseif ($customer['id_asal_prospek'] == '2'){ 
    $asal_prospek = '
                        <th align="center">Database</th>
                        <th bgcolor="#cccccc" align="center">Referensi</th>
                        <th align="center">S.Traffic</th>
                        <th align="center">Exhibition</th>
                        <th align="center">Call</th>
                        <thalign="center">Visit</th>
                            <th align="center">Others</th>';
                        
} elseif ($customer['id_asal_prospek'] == '3'){ 
    $asal_prospek = '
                        <th align="center">Database</th>
                        <th align="center">Referensi</th>
                        <th bgcolor="#cccccc" align="center">S.Traffic</th>
                        <th align="center">Exhibition</th>
                        <th align="center">Call</th>
                        <th align="center">Visit</th>
                        <th align="center">Others</th>';
                        
} elseif ($customer['id_asal_prospek'] == '4'){ 
    $asal_prospek = '
                        <th align="center">Database</th>
                        <th align="center">Referensi</th>
                        <th align="center">S.Traffic</th>
                        <th bgcolor="#cccccc" align="center">Exhibition</th>
                        <th align="center">Call</th>
                        <th align="center">Visit</th>
                        <th align="center">Others</th>';
                        
} elseif ($customer['id_asal_prospek'] == '5'){ 
    $asal_prospek = '
                        <th align="center">Database</th>
                        <th align="center">Referensi</th>
                        <th align="center">S.Traffic</th>
                        <th align="center">Exhibition</th>
                        <th bgcolor="#cccccc" align="center">Call</th>
                        <th align="center">Visit</th>
                        <th align="center">Others</th>';
                        
} elseif ($customer['id_asal_prospek'] == '6') { 
    $asal_prospek = '
                        <th align="center">Database</th>
                        <th align="center">Referensi</th>
                        <th align="center">S.Traffic</th>
                        <th align="center">Exhibition</th>
                        <th align="center">Call</th>
                        <th bgcolor="#cccccc" align="center">Visit</th>
                        <th align="center">Others</th>';

} elseif ($customer['id_asal_prospek'] == '7'){ 
    $asal_prospek = '
                        <th align="center">Database</th>
                        <th align="center">Referensi</th>
                        <th align="center">S.Traffic</th>
                        <th align="center">Exhibition</th>
                        <th align="center">Call</th>
                        <th align="center">Visit</th>
                        <th bgcolor="#cccccc" align="center">Others</th>';
                        
} else { 
    $asal_prospek = '
                        <th align="center">Database</th>
                        <th align="center">Referensi</th>
                        <th align="center">S.Traffic</th>
                        <th align="center">Exhibition</th>
                        <th align="center">Call</th>
                        <th align="center">Visit</th>
                        <th bgcolor="#cccccc" align="center">Others</th>';
                        }

$h_jumlah='             <th bgcolor="#cccccc" align="center"><h4>Jumlah</h4></th>';
$jumlah='               <th align="center">'.$prospek['jml_kendaraan'].'</th>';
$h_test_drive='         <th bgcolor="#cccccc" align="center"><h4>Tes Drive</h4></th>';
$test_drive='           <th align="center">'.$prospek['test_drive'].'</th>';

$h_model='              <th bgcolor="#cccccc" align="center" colspan="4"><h4>Tipe Kendaraan</h4></th>';
$model='                <th align="center" colspan="8">'.$prospek['model'].'</th> '; 
                        
$h_pembayaran='         <th bgcolor="#cccccc" align="center" colspan="2" ><h4>Pembayaran</h4></th>';
$h_warna='              <th bgcolor="#cccccc" align="center" colspan="2" ><h4>Warna</h4></th>';
$h_tipe='               <th bgcolor="#cccccc" align="center" colspan="2" ><h4>Variant</h4></th>'; 
$h_transmisi='          <th bgcolor="#cccccc" align="center" colspan="1" ><h4>Transmisi</h4></th>'; 
$h_status_prospek='     <th bgcolor="#cccccc" align="center" colspan="5" ><h4>Last Progress</h4></th>'; 

$pembayaran='           <th align="center" colspan="2">'.$prospek['pembayaran'].'</th>';
$warna='                <th align="center" colspan="2">'.$prospek['warna'].'</th>';
$tipe='                 <th align="center" colspan="2">'.$prospek['tipe'].'</th>';
$transmisi='            <th align="center" colspan="1">'.$prospek['transmisi'].'</th>';

if ($prospek['id_status_prospek'] == '1'){ 
    $status_prospek = '                        
                        <th bgcolor="#cccccc" align="center" colspan="1">P</th>
                        <th align="center" colspan="1">HP</th>
                        <th align="center" colspan="1">SPK</th>
                        <th align="center" colspan="1">DO</th>
                        <th align="center" colspan="1">Lost</th>';

} elseif ($prospek['id_status_prospek'] == '2'){ 
    $status_prospek = '                        
                        <th align="center" colspan="1">P</th>
                        <th bgcolor="#cccccc" align="center" colspan="1">HP</th>
                        <th align="center" colspan="1">SPK</th>
                        <th align="center" colspan="1">DO</th>
                        <th align="center" colspan="1">Lost</th>';

} elseif ($prospek['id_status_prospek'] == '3'){ 
    $status_prospek = '                        
                        <th align="center" colspan="1">P</th>
                        <th align="center" colspan="1">HP</th>
                        <th bgcolor="#cccccc" align="center" colspan="1">SPK</th>
                        <th align="center" colspan="1">DO</th>
                        <th align="center" colspan="1">Lost</th>';

} elseif ($prospek['id_status_prospek'] == '4'){ 
    $status_prospek = '                        
                        <th align="center" colspan="1">P</th>
                        <th align="center" colspan="1">HP</th>
                        <th align="center" colspan="1">SPK</th>
                        <th bgcolor="#cccccc" align="center" colspan="1">DO</th>
                        <th align="center" colspan="1">Lost</th>';
} elseif ($prospek['id_status_prospek'] == '5'){ 
    $status_prospek = '                        
                        <th align="center" colspan="1">P</th>
                        <th align="center" colspan="1">HP</th>
                        <th align="center" colspan="1">SPK</th>
                        <th align="center" colspan="1">DO</th>
                        <th bgcolor="#cccccc" align="center" colspan="1">Lost</th>'; 
}

else { 
    $status_prospek = '                        
                        <th align="center" colspan="1">P</th>
                        <th align="center" colspan="1">HP</th>
                        <th align="center" colspan="1">SPK</th>
                        <th align="center" colspan="1">DO</th>
                        <th align="center" colspan="1">Lost</th>'; 
}

$h_follow='             <th bgcolor="#cccccc" align="center" colspan="12"><h4>Detail Follow Up</h4></th>';

$h_tanggal='            <th>Tanggal</th>';
$h_aktivitas='          <th>Aktivitas</th>';
$h_keterangan='         <th>Keterangan</th>';
$h_next='               <th>Next Follow Up</th>';
$h_sh='                 <th>TTD SH</th>';
$h_adm='                <th>TTD ADM</th>';


$qAct = mysql_query("SELECT DATE_FORMAT(tgl_aktivitas, '%d %M %Y') AS tgl_aktivitas, 
                                    (
                                    CASE aktivitas
                                    WHEN 'telp' THEN
                                         'Telepon'
                                    WHEN 'visit' THEN
                                        'Visit'
                                    WHEN 'survey' THEN
                                        'Survey'
                                    ELSE
                                         '-'
                                    END
                                ) AS aktivitas,keterangan,
                            DATE_FORMAT(tgl_kunjungan_berikut, '%d %M %Y') AS tgl_kunjungan_berikut 
                    FROM tb_aktivitas_harian_unit 
                    WHERE id_pelanggan = '51513' AND deleted_flag = 0");
        while ($rAct = mysql_fetch_assoc($qAct)){
        $dataQact .= "  <tr>
                            <td>$rAct[tgl_aktivitas]</td>
                            <td>$rAct[aktivitas]</td>
                            <td>$rAct[keterangan]</td>
                            <td>$rAct[tgl_kunjungan_berikut]</td>
                            <td></td>
                            <td></td>
                        </tr>";  
        } 
                      
$case='                 <th bgcolor="#cccccc" align="center" colspan="3"><h4>Lost Case</h4></th>';  
$analisa='              <th bgcolor="#cccccc" align="center" colspan="3"><h4>Analisa Lost</h4></th>';  
$catatan='              <th bgcolor="#cccccc" align="center" colspan="5"><h4>Catatan</h4></th> '; 

$case_isi='             <th align="center" colspan="3"><h4>'.$lost['lost_case'].'</h4></th>';  
$analisa_isi='          <th align="center" colspan="3"><h4>'.$lost['analisa_lost'].'</h4></th>';  
$catatan_isi='          <th align="center" colspan="5"><h4>'.$lost['catatan_isi'].'</h4></th> '; 

$h_kredit='             <th bgcolor="#cccccc" align="center" colspan="9"><h4>Jika Metode Pembelian Kredit</h4></th>';  
$h_paraf='              <th align="center" rowspan="3" colspan="3"><h4>Paraf Sales Co</h4></th>';  
$h_lembaga='            <th align="center" colspan="4"><h4>Lembaga Pembiayaan</h4></th>';
$h_dp='                 <th align="center" colspan="4"><h4>Down Payment</h4></th>';
$h_tenor='              <th align="center" colspan="1"><h4>Tenor</h4></th>';

$lembaga='              <td align="center" colspan="4">'.$kredit['perusahaan'].'</td>';

if ($kredit['id_dp'] == '1'){ 
$dp='                   <td bgcolor="#cccccc" align="center" colspan="1">0 - 14,9%</td>
                        <td align="center" colspan="1">15 - 19,9%</td>
                        <td align="center" colspan="1">20 - 29,9%</td>
                        <td align="center" colspan="1">>30%</td>';
} elseif ($kredit['id_dp'] == '2'){ 
$dp='                   <td align="center" colspan="1">0 - 14,9%</td>
                        <td bgcolor="#cccccc" align="center" colspan="1">15 - 19,9%</td>
                        <td align="center" colspan="1">20 - 29,9%</td>
                        <td align="center" colspan="1">>30%</td>';
} elseif ($kredit['id_dp'] == '3'){ 
$dp='                   <td align="center" colspan="1">0 - 14,9%</td>
                        <td align="center" colspan="1">15 - 19,9%</td>
                        <td bgcolor="#cccccc" align="center" colspan="1">20 - 29,9%</td>
                        <td align="center" colspan="1">>30%</td>';
}elseif ($kredit['id_dp'] == '4'){ 
$dp='                   <td align="center" colspan="1">0 - 14,9%</td>
                        <td align="center" colspan="1">15 - 19,9%</td>
                        <td align="center" colspan="1">20 - 29,9%</td>
                        <td bgcolor="#cccccc" align="center" colspan="1">>30%</td>';
}else{ 
$dp='                   <td align="center" colspan="1">0 - 14,9%</td>
                        <td align="center" colspan="1">15 - 19,9%</td>
                        <td align="center" colspan="1">20 - 29,9%</td>
                        <td align="center" colspan="1">>30%</td>';
}


$tenor='                <td align="center" colspan="1">'.$kredit['tenor'].' Tahun</td>';



$output =   $logo.$abjad.
            $tbl_header.$data_prospek.$tbl_footer.
            $tbl_header.$data_customer.$tbl_footer.
            $tbl_header.$tr_o.$h_data.$asal_prospek.$h_jumlah.$jumlah.$h_test_drive.$test_drive.$tr_c.
                        $tr_o.$h_model.$model.$tr_c.
                        $tr_o.$h_pembayaran.$h_warna.$h_tipe.$h_transmisi.$h_status_prospek.$tr_c.
                        $tr_o.$pembayaran.$warna.$tipe.$transmisi.$status_prospek.$tr_c.
                        $tr_o.$h_follow.$tr_c.
            $tbl_footer.
            $tbl_header.$tr_o.$h_tanggal.$h_aktivitas.$h_keterangan.$h_next.$h_sh.$h_adm.$tr_c.
                        $dataQact.
            $tbl_footer.
            $tbl_header.$tr_o.$case.$analisa.$catatan.$tr_c.$tbl_footer.
            $tbl_header.$tr_o.$case_isi.$analisa_isi.$catatan_isi.$tr_c.$tbl_footer.
            $tbl_header.$tr_o.$h_kredit.$h_paraf.$tr_c.
                        $tr_o.$h_lembaga.$h_dp.$h_tenor.$tr_c.
                        $tr_o.$lembaga.$dp.$tenor.$tr_c.
            $tbl_footer ;
// output the HTML content
$pdf->writeHTML($output, true, false, true, false, '');
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->lastPage();

ob_clean();
//Close and output PDF document
$pdf->Output('KDP '.$prospek['no_prospek'].'_'.$customer['nama_perush'].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
