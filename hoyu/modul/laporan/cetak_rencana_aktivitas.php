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
$pdf->SetTitle('Laporan Aktivitas Mingguan');
$pdf->SetSubject('Laporan Aktivitas Mingguan');
$pdf->SetKeywords('Report, Activity, Weekly');

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

$sales = $_GET['sales'];
$from = $_GET['from'];
$to = $_GET['to'];

$en=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","January","February","March",
                    "April","May","June","July","August","September","October","November","December");
 
$idn=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Januari","Pebruari","Maret","April","Mei",
                    "Juni","Juli","Agustus","September","Oktober","Nopember","Desember");

$date = mysql_query("SELECT DATE_FORMAT(CURDATE(), '%d %M %Y') AS today");
$r_date = mysql_fetch_array($date);

$today = $r_date['today'];


$tbl_header = '<table border="1" cellspacing="2" cellpadding="3">';
$tbl_footer = '</table>';
$tbl_o = '<table border="o" cellspacing="2" cellpadding="3">';
$tbl_c= '</table>';
$tr_o = '<tr>';
$tr_c = '</tr>';
$th_o = '<th>';
$th_c = '</th>';

$spasi= '<br><br><br><br>';


//aktivitas

$header = '     <table border="0" cellspacing="2" cellpadding="3">    
                    <tr>
                        <th rowspan="2" colspan="3" align="left" valign="top"><img src="images/logo_kop_hino.png" style="width:200px;height:60px;"></th>
                        <th align="center" colspan="5"><h2>FORM RENCANA AKTIVITAS HARIAN</h2></th>
                        <th colspan="3" align="right"><img src="images/form_sales.png" style="width:153px;height:20px;"></th>
                    </tr>
                    <tr>
                        <th colspan="5" align="center"></th>
                        <th colspan="3" align="right">Salesman : '.$sales.'</th>
                    </tr>
                </table>';


$h_tabel='          <th bgcolor="#cccccc" colspan="2"><h4>Tgl Kunjungan</h4></th>
                    <th bgcolor="#cccccc" colspan="3"><h4>Nama Perusahaan</h4></th>
                    <th bgcolor="#cccccc" colspan="3"><h4>Unit Prospek</h4></th>
                    <th bgcolor="#cccccc" colspan="1"><h4>Aktivitas</h4></th>
                    <th bgcolor="#cccccc" colspan="3"><h4>Keterangan</h4></th>
                    <th bgcolor="#cccccc" colspan="1"><h4>Knjgn Brkt</h4></th>';



$qAct = mysql_query("SELECT a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.tgl_aktivitas,
                                            c.day_name, b.tgl_kunjungan_berikut,f.tipe
                      FROM tb_pelanggan a
                      LEFT JOIN tb_aktivitas_harian_unit b ON b.id_pelanggan = a.id_pelanggan
                      JOIN time_dimension c ON c.db_date = b.tgl_kunjungan_berikut
                      LEFT JOIN v_unit_latest_prospek_id d ON d.id_pelanggan = a.id_pelanggan
                      LEFT JOIN tb_prospek e ON e.id_prospek = d.max_prospek
                      LEFT JOIN ms_tipe_kendaraan f ON f.id_tipe_kendaraan = e.id_tipe_kendaraan
                      WHERE a.salesman = '$_GET[sales]' 
                      AND b.tgl_kunjungan_berikut BETWEEN CURDATE() AND (NOW() + INTERVAL 2 DAY)
                      GROUP BY a.nama_perush, b.tgl_kunjungan_berikut
                      ORDER BY b.tgl_kunjungan_berikut ASC");

        while ($rAct = mysql_fetch_assoc($qAct)){
        $dataQact .= "  <tr>
                            <td colspan=\"2\">$rAct[day_name]- $rAct[tgl_kunjungan_berikut]</td>
                            <td colspan=\"3\">$rAct[nama_perush]</td>
                            <td colspan=\"3\">$rAct[tipe]</td>
                            <td colspan=\"1\"></td>
                            <td colspan=\"3\"></td>
                            <td colspan=\"1\"></td>
                        </tr>";  
        } 
                      
$legend='           <th colspan="12" align="left"><h4>DK = Dalam Kota, LK = Luar Kota</h4></th>';
$tgl_cetak='        <th colspan="12" align="right"><h4>Semarang, '.str_replace($en, $idn, $today).'</h4></th>';
$h_ttd='            <th colspan="4" align="left"><h4>disetujui oleh,</h4></th>
                    <th colspan="4" align="center"><h4>disetujui oleh,</h4></th>
                    <th colspan="4" align="right"><h4>dibuat oleh,</h4></th>';

$ttd='              <th colspan="4" align="left"><h4>HRD</h4></th>
                    <th colspan="4" align="center"><h4>Atasan</h4></th>
                    <th colspan="4" align="right"><h4>'.$sales.'</h4></th>';

$output =   $header.
            $tbl_header.$tr_o.$h_tabel.$tr_c.$tbl_footer.
            $tbl_o.$dataQact.$tbl_c.$spasi.

            $tbl_c;
// output the HTML content
$pdf->writeHTML($output, true, false, true, false, '');
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->lastPage();

ob_clean();
//Close and output PDF document
$pdf->Output('Lap_Aktivitas_Periode '.$from.' s/d '.$to.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
