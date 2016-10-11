<?php
//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2014-01-25
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
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
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
require_once ('tcpdf/examples/tcpdf_include.php');
require_once ('config/koneksi.php');
require_once ('config/library.php');
require_once ('config/fungsi_indotgl.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


//query

$history = mysql_query("SELECT tb_pelanggan.kode_pelanggan,
                                    tb_pelanggan.alamat_1,
                                    tb_pelanggan.alamat_2,
                                    tb_pelanggan.kodepos,
                                    tb_pelanggan.nama_perush,
                                    tb_pelanggan.id_pelanggan,
                                    tb_pelanggan.status_pelanggan,
                                    tb_pelanggan.nama_pengurus,
                                    tb_pelanggan.jabatan,
                                    tb_pelanggan.faximile,
                                    tb_pelanggan.no_ktp,
                                    tb_pelanggan.tmpt_lahir,
                                    tb_pelanggan.tgl_lahir,
                                    tb_pelanggan.tmpt_lahir,
                                    tb_pelanggan.jns_kelamin,
                                    tb_pelanggan.id_pekerjaan,
                                    tb_pelanggan.gol_darah,
                                    tb_pelanggan.agama,
                                    tb_pelanggan.status_perkawinan,
                                    tb_pelanggan.kewarganegaraan,
                                    tb_pelanggan.email,
                                    tb_pelanggan.telp_hp,
                                    tb_pelanggan.telp_kantor,
                                    tb_pelanggan.telp_rumah,
                                    tb_pelanggan.kode_database,
                                    tb_pelanggan.sesuai_ktp,
                                    tb_pelanggan.ksystem_kode,
                                    tb_pelanggan.rt,
                                    tb_pelanggan.rw,
                                    tb_database.id_database,
                                    tb_database.kode_database,
                                    tb_database.nama_database,
                                    ms_asal_prospek.nama AS nama_asal_prospek,
                                    ms_asal_prospek.id_asal_prospek,
                                    ms_bidang_usaha.nama AS nama_bidang_usaha,
                                    ms_bidang_usaha.id_bidang_usaha,
                                    ms_segmen.id_segmen,
                                    ms_users.divisi,
									ms_users.nama_lengkap,
                                    ms_kelurahan.id_kelurahan,
                                    ms_kelurahan.nama_kelurahan,
                                    ms_kecamatan.id_kecamatan,
                                    ms_kecamatan.nama_kecamatan,
                                    ms_kota.id_kota,
                                    ms_kota.nama_kota,
                                    ms_prov.id_prov,
                                    ms_prov.nama_prov
                        FROM tb_pelanggan
                                LEFT JOIN ms_bidang_usaha ON ms_bidang_usaha.id_bidang_usaha = tb_pelanggan.id_bidang_usaha
                                LEFT JOIN ms_segmen ON ms_segmen.id_segmen = tb_pelanggan.id_segmen
                                LEFT JOIN ms_kelurahan ON ms_kelurahan.id_kelurahan = tb_pelanggan.id_kelurahan
                                LEFT JOIN ms_kecamatan ON ms_kecamatan.id_kecamatan = tb_pelanggan.id_kecamatan
								LEFT JOIN ms_kota ON ms_kota.id_kota = tb_pelanggan.id_kota
                                LEFT JOIN ms_prov ON ms_prov.id_prov = tb_pelanggan.id_prov
                                LEFT JOIN ms_asal_prospek ON ms_asal_prospek.id_asal_prospek = tb_pelanggan.id_asal_prospek
                                LEFT JOIN tb_database ON tb_database.id_database = tb_pelanggan.kode_database
                                JOIN ms_users ON ms_users.username = tb_pelanggan.salesman
                        WHERE tb_pelanggan.id_pelanggan = '$_GET[id]'
                        ORDER BY tb_pelanggan.id_pelanggan DESC");
  $r = mysql_fetch_array($history);



// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Affandi Noor Rizka');
$pdf->SetTitle('HISTORY PELANGGAN');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('', '', 'LAPORAN HISTORY CUSTOMER', $r[nama_perush]);

// set header and footer fonts
$pdf->setHeaderFont(array(
    PDF_FONT_NAME_MAIN,
    '',
    PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(
    PDF_FONT_NAME_DATA,
    '',
    PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__file__) . '/lang/eng.php')) {
    require_once (dirname(__file__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
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

$tanggal = DATE("D-m-Y"); 

// define some HTML content with style
$style = '<!-- EXAMPLE OF CSS STYLE -->
<style>
    table.list {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #BFBFBF;
	border-left: 1px solid #BFBFBF;
	margin-bottom: 20px;
	font-family: Tahoma; 
	font-size: 8pt;
	padding-top:5px;
}
.list td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.list  td.head {
	background-color: #ADADAD; 
	padding: 5px; 
    text-transform: capitalize;
    	text-align: center;
        	color: #FFFFFF;
	font-weight: bold;
    }

.list tbody a {
	text-decoration: none;
}
.list tbody td {
	vertical-align: middle;
	padding: 0px 5px;
}
.list tbody tr:odd {
	background: #FFFFFF;
}
.list tbody tr:even {
	background: #E4EEF7;
}
.list .left {
	text-align: left;
	padding: 7px;
}
.list .right {
	text-align: right;
	padding: 7px;
}
.list .center {
	text-align: center;
	padding: 7px;
}
</style>';

$body = <<< EOF
Tanggal Cetak : $tanggal
<br><br>
 <table class="list">
            <tr><td class="head" colspan="2" bgcolor="#ADADAD">DATA PELANGGAN</td></tr>
            <tr><td class="right">Nama Pelanggan</td><td class="left">: $r[nama_perush]</td></tr>
			<tr><td class="right">Status Pelanggan</td><td class="left">: $r[status_pelanggan]</td></tr>
			<tr><td class="right">Nama Pengurus</td><td class="left">: $r[nama_pengurus]</td></tr>
			<tr><td class="right">Asal Prospek</td><td class="left">: $r[nama_asal_prospek]</td></tr>
			<tr><td class="right">Segmen</td><td class="left">: $r[id_segmen]</td></tr>
			<tr><td class="right">Kode Database</td><td class="left">: $r[kode_database]</td></tr>
			<tr><td class="right">Jabatan</td><td class="left">: $r[jabatan]</td></tr>
			<tr><td class="right">No. HP</td><td class="left">: $r[telp_hp]</td></tr>
			<tr><td class="right">Telp. Kantor</td><td class="left">: $r[telp_kantor]</td></tr>
			<tr><td class="right">Telp. Rumah</td><td class="left">: $r[telp_rumah]</td></tr>
			<tr><td class="right">Fax</td><td class="left">: $r[faximile]</td></tr>
			<tr><td class="right">Email</td><td class="left">: $r[email]</td></tr>
			<tr><td class="right">No. KTP</td><td class="left">: $r[no_ktp]</td></tr>
			<tr><td class="right">Tempat, Tanggal Lahir</td><td class="left">: $r[tmpt_lahir], $r[tgl_lahir] </td></tr>
			<tr><td class="right">Jenis Kelamin</td><td class="left">: $r[jns_kelamin]</td></tr>
			<tr><td class="right">Agama</td><td class="left">: $r[agama]</td></tr>
			<tr><td class="right">Status Perkawinan</td><td class="left">: $r[status_perkawinan]</td></tr>
			<tr><td class="right">Pekerjaan</td><td class="left">: $r[pekerjaan]</td></tr>
			<tr><td class="right">Kewarganegaraan</td><td class="left">: $r[kewarganegaraan]</td></tr>
			<tr><td class="right">Kota/Kabupaten</td><td class="left">: $r[nama_kota]</td></tr>
			<tr><td class="right">Kecamatan</td><td class="left">: $r[nama_kecamatan]</td></tr>
			<tr><td class="right">Kelurahan</td><td class="left">: $r[nama_kelurahan]</td></tr>
			<tr><td class="right">RT</td><td class="left">: $r[rt]</td></tr>
			<tr><td class="right">RW</td><td class="left">: $r[rw]</td></tr>
			<tr><td class="right">Alamat</td><td class="left">: $r[alamat_1]</td></tr>
			<tr><td class="right">Kodepos</td><td class="left">: $r[kodepos]</td></tr>
       </table>
EOF;

$html = $style . $body;
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
$pdf->AddPage();
$style = '<!-- EXAMPLE OF CSS STYLE -->
<style>
    .list {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #BFBFBF;
	border-left: 1px solid #BFBFBF;
	margin-bottom: 20px;
	font-family: Tahoma; 
	font-size: 8pt;
	padding-top:5px;
}
.list td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.list  td.head {
	background-color: #ADADAD; 
	padding: 5px; 
    text-transform: capitalize;
    	text-align: center;
        	color: #FFFFFF;
	font-weight: bold;
    }

.list tbody a {
	text-decoration: none;
}
.list tbody td {
	vertical-align: middle;
	padding: 0px 5px;
}
.list tbody tr:odd {
	background: #FFFFFF;
}
.list tbody tr:even {
	background: #E4EEF7;
}
.list .left {
	text-align: left;
	padding: 7px;
}
.list .right {
	text-align: right;
	padding: 7px;
}
.list .center {
	text-align: center;
	padding: 7px;
}
</style>';

$history_activity = mysql_query("SELECT tb_aktivitas_harian.tgl_aktivitas AS 'tgl_aktivitas',
                                        tb_aktivitas_harian.aktivitas AS 'aktivitas',
                                        tb_aktivitas_harian.keterangan AS 'keterangan',
                                        tb_aktivitas_harian.tgl_kunjungan_berikut AS 'tgl_kunjungan_berikut',
                                        tb_aktivitas_harian.catatan AS 'catatan',
                                        tb_survey.hasil_survey AS 'hasil_survey',
                                        tb_survey.keterangan AS 'ket_survey',
                                        tb_survey.hasil_survey AS 'hasil_survey',
                                        ms_perusahaan.perusahaan AS 'perusahaan',
                                        ms_surveyor.surveyor AS 'surveyor',
                                        ms_surveyor.no_hp AS 'no_hp',
                                        ms_cabang.alamat AS 'alamat_cabang',
                                        ms_cabang.telp AS 'telp_cabang'
                                    FROM tb_aktivitas_harian 
                                    LEFT JOIN tb_survey ON tb_survey.id_aktivitas_harian = tb_aktivitas_harian.id_aktivitas_harian
                                    LEFT JOIN ms_cabang ON ms_cabang.`id_cabang` = tb_survey.`id_cabang`
                                    LEFT JOIN ms_perusahaan ON ms_perusahaan.`id_perusahaan` = tb_survey.`id_perusahaan`
                                    LEFT JOIN `ms_surveyor` ON ms_surveyor.`id_surveyor` = `ms_cabang`.`id_cabang`
                                    WHERE tb_aktivitas_harian.id_pelanggan = $_GET[id]
										 ORDER BY `tgl_aktivitas`");

$head = <<< EOF
<table class="list"><tr><td class="head" bgcolor="#ADADAD">Tanggal</td>
                        <td class="head" bgcolor="#ADADAD">Aktivitas</td>
                        <td class="head" bgcolor="#ADADAD">Keterangan</td>
                        <td class="head" bgcolor="#ADADAD">Kunjungan Berikut</td>
                        <td class="head" bgcolor="#ADADAD">Catatan</td>
                        <td class="head" bgcolor="#ADADAD">Leasing</td>
                  </tr>
EOF;

while ($rda = mysql_fetch_assoc($history_activity)){
    $data .= "<tr><td>". tgl_indo($rda[tgl_aktivitas]) . "</td>
                     <td>$rda[aktivitas]</td>
                     <td>$rda[keterangan]</td>
                     <td>". tgl_indo($rda[tgl_kunjungan_berikut]) ."</td>
                     <td>Catatan : $rda[catatan]
                         <br>Keterangan Aktivitas : $rda[keterangan]</td>
                         <td>$rda[perusahaan]
                         <br>Hasil  : $rda[hasil_survey] 
                         <br>Keterangan  : $rda[ket_survey]</td></tr>";
     
}
$footer = '</table>';

$html = $style . $head . $data . $footer;
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
$pdf->AddPage();

       $history_prospect = mysql_query("SELECT tb_prospek.*, ms_status_prospek.status_prospek,
                                                    ms_kendaraan.merk, ms_tipe_kendaraan.tipe,ms_tipe_kendaraan.keterangan,
                                                    ms_warna.warna, ms_pembayaran.pembayaran, 
                                                    ms_perusahaan.perusahaan, ms_kota_perusahaan.kota_perusahaan,
                                                    tb_kredit.tenor, ms_dp.dp, tb_spk.*, tb_do.*
                                                    FROM tb_prospek
                                                    LEFT JOIN ms_status_prospek   ON ms_status_prospek.id_status_prospek = tb_prospek.id_status_prospek
                                                    LEFT JOIN ms_kendaraan        ON ms_kendaraan.id_kendaraan = tb_prospek.id_kendaraan
                                                    LEFT JOIN ms_tipe_kendaraan   ON ms_tipe_kendaraan.id_tipe_kendaraan = tb_prospek.id_tipe_kendaraan
                                                    LEFT JOIN ms_warna            ON ms_warna.id_warna = tb_prospek.id_warna
                                                    LEFT JOIN ms_pembayaran       ON ms_pembayaran.id_pembayaran = tb_prospek.id_pembayaran
                                                    LEFT JOIN tb_kredit           ON tb_kredit.id_prospek = tb_prospek.id_prospek
                                                    LEFT JOIN tb_spk              ON tb_spk.id_prospek = tb_prospek.id_prospek
                                                    LEFT JOIN tb_do               ON tb_do.id_prospek = tb_prospek.id_prospek
                                                    LEFT JOIN ms_perusahaan       ON ms_perusahaan.id_perusahaan = tb_kredit.id_perusahaan
                                                    LEFT JOIN ms_kota_perusahaan  ON ms_kota_perusahaan.id_kota_perusahaan = tb_kredit.id_kota_perusahaan
                                                    LEFT JOIN ms_dp               ON ms_dp.id_dp = tb_kredit.id_dp
                                                    WHERE tb_prospek.id_pelanggan='$_GET[id]' AND tb_prospek.deleted_flag = 0
                                                     GROUP BY tb_prospek.id_prospek
				                           ORDER BY tb_prospek.id_prospek DESC");

$headProspek = <<< EOF
  			 <table class="list"><tr>
                    <td class="head" bgcolor="#ADADAD">Tanggal Prospek</td>                
                    <td class="head" bgcolor="#ADADAD">Kendaraan</td>
                    <td class="head" bgcolor="#ADADAD">Jumlah</td>
                   
                </tr>
EOF;

while ($rdp = mysql_fetch_assoc($history_prospect)){
    $dataProspek .= "<tr><td>". tgl_indo($rdp[tgl_prospek]) ."</td>
                         <td>$rdp[merk] $rdp[keterangan] $rdp[warna]</td>
                         <td>$rdp[jml_kendaraan]</td></tr>
                    <tr><td >Touch</td><td colspan=\"2\">". tgl_indo($rdp[tgl_touch]) ."</td></tr>
                    <tr><td >Nego</td><td colspan=\"2\">". tgl_indo($rdp[tgl_nego]) ."</td></tr>
                    <tr><td >Hot</td>   <td colspan=\"2\">". tgl_indo($rdp[tgl_hot]) ."</td></tr>
                    <tr><td >SPK</td> <td colspan=\"2\">". tgl_indo($rdp[tgl_spk]) ." <br>No : $rdp[no_spk]</td></tr>
                    <tr><td >DO</td> <td colspan=\"2\">". tgl_indo($rdp[tgl_do]) ." <br>No Rangka : $rdp[no_rangka] <br> No Mesin : $rdp[no_mesin] <br> No Nota : $rdp[no_nota]</td></tr>
                    <tr><td >PO</td><td colspan=\"2\">". tgl_indo($rdp[tgl_po]) ." <br>No PO : $rdp[no_purchase_order] </td></tr>
                    <tr><td >Lost</td><td colspan=\"2\">". tgl_indo($rdp[tgl_lost]) ."</td></tr>";    
}

$footerProspek = '</table>';

$html = $style . $headProspek . $dataProspek . $footerProspek;
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();


//Close and output PDF document
$pdf->Output($r[nama_perush] . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
