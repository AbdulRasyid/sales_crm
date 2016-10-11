<?php 
                //ekspor xls
                function xlsBOF() {
                        echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
                        return;
                        }
 
                function xlsEOF() {
                    echo pack("ss", 0x0A, 0x00);
                    return;
                    }
 
                function xlsWriteNumber($Row, $Col, $Value) {
                    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
                    echo pack("d", $Value);
                    return;
                }
 
                function xlsWriteLabel($Row, $Col, $Value ) {
                    $L = strlen($Value);
                    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
                    echo $Value;
                    return;
                }
            
                //koneksi ke database dan jalankan query
                include "koneksi.php";

                $from =  $_GET['from'];
                $to =  $_GET['to'];
                $lv = $_GET['lv'];
                $sv = $_GET['sv'];

                if($lv == 'supervisor'){ 
                $result = mysql_query("SELECT a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.nama AS asal_prospek,
                                          d.no_prospek AS no_inq, 

                                          d.tgl_prospek AS tgl_create_prospek,
                                          RIGHT (d.tgl_prospek, 2) AS tgl_prospek,
                                          SUBSTRING(d.tgl_prospek, 6, 2) AS bln_prospek,
                                          LEFT (d.tgl_prospek, 4) AS thn_prospek,

                                          d.id_kendaraan, e.merk, d.id_tipe_kendaraan, f.model, f.tipe, d.id_warna,
                                          g.warna,

                                          (
                                            CASE d.test_drive
                                            WHEN 'Y' THEN
                                                'YES'
                                            WHEN 'N' THEN
                                                'NO'
                                            ELSE
                                                '-'
                                            END
                                          ) AS test_drive,

                                          d.jml_kendaraan, z.salesman AS wiraniaga, z.supervisor AS koordinator,
                                          y.nama_lengkap AS supervisor,
                                          (SELECT nama_lengkap FROM ms_users WHERE username = 'teguh.iman') AS head_sales,
                                          h.max_aktivitas,

                                          i.tgl_aktivitas AS tgl_aktivitas_create,
                                          RIGHT (i.tgl_aktivitas, 2) AS tgl_aktivitas,
                                          SUBSTRING(i.tgl_aktivitas, 6, 2) AS bln_aktivitas,
                                          LEFT (i.tgl_aktivitas, 4) AS thn_aktivitas,

                                          i.tgl_kunjungan_berikut AS tgl_knjngn_brkt_create,
                                          RIGHT (i.tgl_kunjungan_berikut, 2) AS tgl_knjngan,
                                          SUBSTRING(i.tgl_kunjungan_berikut, 6, 2) AS bln_knjngan,
                                          LEFT (i.tgl_kunjungan_berikut, 4) AS thn_knjngan,

                                          q.status_prospek,

                                            k.no_spk,
                                            k.tgl_spk AS tgl_spk_create,
                                            RIGHT (k.tgl_spk, 2) AS tgl_spk,
                                            SUBSTRING(k.tgl_spk, 6, 2) AS bln_spk,
                                            LEFT (k.tgl_spk, 4) AS thn_spk,

                                            (
                                                CASE l.id_p_analisa_lost
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
                                            m.analisa_lost,

                                            i.keterangan,

                                            (
                                                CASE d.id_pembayaran
                                                WHEN '1' THEN
                                                'Cash/Tunai'
                                                WHEN '2' THEN
                                                'Kredit'
                                                ELSE
                                                    '-'
                                                END
                                            ) AS pembayaran,
                                            
                                            o.perusahaan, p.dp, n.tenor

                                  FROM  tb_pelanggan a
                                  LEFT JOIN v_data_users z ON z.salesman = a.salesman
                                  LEFT JOIN ms_users y ON y.username = z.supervisor
                                  LEFT JOIN ms_asal_prospek b ON b.id_asal_prospek = a.id_asal_prospek
                                  LEFT JOIN v_unit_latest_prospek_id c ON c.id_pelanggan = a.id_pelanggan
                                  LEFT JOIN tb_prospek d ON d.id_prospek = c.max_prospek
                                  LEFT JOIN ms_kendaraan e ON e.id_kendaraan = d.id_kendaraan
                                  LEFT JOIN ms_tipe_kendaraan f ON f.id_tipe_kendaraan = d.id_tipe_kendaraan
                                  LEFT JOIN ms_warna g ON g.id_warna = d.id_warna
                                  LEFT JOIN v_unit_latest_activity_id h ON h.id_pelanggan = a.id_pelanggan
                                  LEFT JOIN tb_aktivitas_harian_unit i ON i.id_aktivitas_harian = h.max_aktivitas
                                  LEFT JOIN v_unit_latest_spk_id j ON j.id_pelanggan = a.id_pelanggan
                                  LEFT JOIN tb_spk k ON k.id_spk = j.max_spk
                                  LEFT JOIN tb_lost l ON l.id_prospek = d.id_prospek 
                                  LEFT JOIN ms_analisa_lost m ON m.id_analisa_lost = l.id_analisa_lost
                                  LEFT JOIN tb_kredit n ON n.id_prospek = d.id_prospek
                                  LEFT JOIN ms_leasing_nama o ON o.id_perusahaan = n.id_perusahaan
                                  LEFT JOIN ms_dp p ON p.id_dp = n.id_dp
                                  LEFT JOIN ms_status_prospek_suzuki q ON q.id_status_prospek = d.id_status_prospek

                                  WHERE d.tgl_prospek BETWEEN '$from' AND '$to'
                                  AND z.supervisor = '$sv'");
                
                } elseif ($lv == 'admin'){ 
                $result = mysql_query("SELECT a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.nama AS asal_prospek,
                                          d.no_prospek AS no_inq, 

                                          d.tgl_prospek AS tgl_create_prospek,
                                          RIGHT (d.tgl_prospek, 2) AS tgl_prospek,
                                          SUBSTRING(d.tgl_prospek, 6, 2) AS bln_prospek,
                                          LEFT (d.tgl_prospek, 4) AS thn_prospek,

                                          d.id_kendaraan, e.merk, d.id_tipe_kendaraan, f.model, f.tipe, d.id_warna,
                                          g.warna,

                                          (
                                            CASE d.test_drive
                                            WHEN 'Y' THEN
                                                'YES'
                                            WHEN 'N' THEN
                                                'NO'
                                            ELSE
                                                '-'
                                            END
                                          ) AS test_drive,

                                          d.jml_kendaraan, z.salesman AS wiraniaga, z.supervisor AS koordinator,
                                          y.nama_lengkap AS supervisor,
                                          (SELECT nama_lengkap FROM ms_users WHERE username = 'teguh.iman') AS head_sales,
                                          h.max_aktivitas,

                                          i.tgl_aktivitas AS tgl_aktivitas_create,
                                          RIGHT (i.tgl_aktivitas, 2) AS tgl_aktivitas,
                                          SUBSTRING(i.tgl_aktivitas, 6, 2) AS bln_aktivitas,
                                          LEFT (i.tgl_aktivitas, 4) AS thn_aktivitas,

                                          i.tgl_kunjungan_berikut AS tgl_knjngn_brkt_create,
                                          RIGHT (i.tgl_kunjungan_berikut, 2) AS tgl_knjngan,
                                          SUBSTRING(i.tgl_kunjungan_berikut, 6, 2) AS bln_knjngan,
                                          LEFT (i.tgl_kunjungan_berikut, 4) AS thn_knjngan,

                                          q.status_prospek,

                                            k.no_spk,
                                            k.tgl_spk AS tgl_spk_create,
                                            RIGHT (k.tgl_spk, 2) AS tgl_spk,
                                            SUBSTRING(k.tgl_spk, 6, 2) AS bln_spk,
                                            LEFT (k.tgl_spk, 4) AS thn_spk,

                                            (
                                                CASE l.id_p_analisa_lost
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
                                            m.analisa_lost,

                                            i.keterangan,

                                            (
                                                CASE d.id_pembayaran
                                                WHEN '1' THEN
                                                'Cash'
                                                WHEN '2' THEN
                                                'Credit'
                                                ELSE
                                                    '-'
                                                END
                                            ) AS pembayaran,
                                            
                                            o.perusahaan, p.dp, n.tenor

                                  FROM  tb_pelanggan a
                                  LEFT JOIN v_data_users z ON z.salesman = a.salesman
                                  LEFT JOIN ms_users y ON y.username = z.supervisor
                                  LEFT JOIN ms_asal_prospek b ON b.id_asal_prospek = a.id_asal_prospek
                                  LEFT JOIN v_unit_latest_prospek_id c ON c.id_pelanggan = a.id_pelanggan
                                  LEFT JOIN tb_prospek d ON d.id_prospek = c.max_prospek
                                  LEFT JOIN ms_kendaraan e ON e.id_kendaraan = d.id_kendaraan
                                  LEFT JOIN ms_tipe_kendaraan f ON f.id_tipe_kendaraan = d.id_tipe_kendaraan
                                  LEFT JOIN ms_warna g ON g.id_warna = d.id_warna
                                  LEFT JOIN v_unit_latest_activity_id h ON h.id_pelanggan = a.id_pelanggan
                                  LEFT JOIN tb_aktivitas_harian_unit i ON i.id_aktivitas_harian = h.max_aktivitas
                                  LEFT JOIN v_unit_latest_spk_id j ON j.id_pelanggan = a.id_pelanggan
                                  LEFT JOIN tb_spk k ON k.id_spk = j.max_spk
                                  LEFT JOIN tb_lost l ON l.id_prospek = d.id_prospek 
                                  LEFT JOIN ms_analisa_lost m ON m.id_analisa_lost = l.id_analisa_lost
                                  LEFT JOIN tb_kredit n ON n.id_prospek = d.id_prospek
                                  LEFT JOIN ms_leasing_nama o ON o.id_perusahaan = n.id_perusahaan
                                  LEFT JOIN ms_dp p ON p.id_dp = n.id_dp
                                  LEFT JOIN ms_status_prospek_suzuki q ON q.id_status_prospek = d.id_status_prospek

                                 WHERE d.tgl_prospek BETWEEN '$from' AND '$to'
                                  AND z.supervisor = '$sv'");
                }
                !$result?die(mysql_error()):'';
 
                //pengaturan nama file
                $namaFile = "ReportITS-$from-$to.xls";
                //pengaturan judul data
                $judul = "Report ITS Suzuki";
                //baris berapa header tabel di tulis
                $tablehead = 2;
                //baris berapa data mulai di tulis
                $tablebody = 3;
                //no urut data
                $nourut = 1;
                 
                //penulisan header
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment;filename=".$namaFile."");
                header("Content-Transfer-Encoding: binary ");
                 
                 
                xlsBOF();
                 
                xlsWriteLabel(0,0,$judul);  
                 
                $kolomhead = 0;
                xlsWriteLabel($tablehead,$kolomhead++,"No.Inq");              
                xlsWriteLabel($tablehead,$kolomhead++,"Pelanggan");             
                xlsWriteLabel($tablehead,$kolomhead++,"Tgl");
                xlsWriteLabel($tablehead,$kolomhead++,"Bln");              
                xlsWriteLabel($tablehead,$kolomhead++,"Thn");             
                xlsWriteLabel($tablehead,$kolomhead++,"Model");
                xlsWriteLabel($tablehead,$kolomhead++,"Tipe");              
                xlsWriteLabel($tablehead,$kolomhead++,"Warna");             
                xlsWriteLabel($tablehead,$kolomhead++,"Asal Prospek");
                xlsWriteLabel($tablehead,$kolomhead++,"Test Drive");              
                xlsWriteLabel($tablehead,$kolomhead++,"Jml Rencana Pembelian");    
                xlsWriteLabel($tablehead,$kolomhead++,"Wiraniaga");   
                xlsWriteLabel($tablehead,$kolomhead++,"Grade");         
                xlsWriteLabel($tablehead,$kolomhead++,"koordinator");  
                xlsWriteLabel($tablehead,$kolomhead++,"Head Sales");  
                xlsWriteLabel($tablehead,$kolomhead++,"Tgl");
                xlsWriteLabel($tablehead,$kolomhead++,"Bln");              
                xlsWriteLabel($tablehead,$kolomhead++,"Thn"); 
                xlsWriteLabel($tablehead,$kolomhead++,"Last Progress");  
                xlsWriteLabel($tablehead,$kolomhead++,"No. SPK"); 
                xlsWriteLabel($tablehead,$kolomhead++,"Tgl");
                xlsWriteLabel($tablehead,$kolomhead++,"Bln");              
                xlsWriteLabel($tablehead,$kolomhead++,"Thn");
                xlsWriteLabel($tablehead,$kolomhead++,"Analisa Lost"); 
                xlsWriteLabel($tablehead,$kolomhead++,"Jml Actual Pembelian");  
                xlsWriteLabel($tablehead,$kolomhead++,"Voice Of Customer");  
                xlsWriteLabel($tablehead,$kolomhead++,"Pembiayaan");
                xlsWriteLabel($tablehead,$kolomhead++,"Lembaga Pembiayaan");   
                xlsWriteLabel($tablehead,$kolomhead++,"Down Payment");  
                xlsWriteLabel($tablehead,$kolomhead++,"Tenor");   


                while ($data = mysql_fetch_array($result))
                {
                $kolombody = 0;
                 
                //gunakan xlsWriteNumber untuk penulisan nomor dan xlsWriteLabel untuk penulisan string
                xlsWriteNumber($tablebody,$kolombody++,$data['no_inq']);
                xlsWritelabel($tablebody,$kolombody++,$data['nama_perush']);
                xlsWriteLabel($tablebody,$kolombody++,$data['tgl_prospek']);
                xlsWritelabel($tablebody,$kolombody++,$data['bln_prospek']);
                xlsWriteLabel($tablebody,$kolombody++,$data['thn_prospek']);
                xlsWritelabel($tablebody,$kolombody++,$data['model']);
                xlsWriteLabel($tablebody,$kolombody++,$data['tipe']);
                xlsWritelabel($tablebody,$kolombody++,$data['warna']);
                xlsWriteLabel($tablebody,$kolombody++,$data['asal_prospek']);
                xlsWritelabel($tablebody,$kolombody++,$data['test_drive']);
                xlsWriteLabel($tablebody,$kolombody++,$data['jml_kendaraan']);
                
                $salesman = explode(".",$data['wiraniaga']);
                $capital = ucwords($salesman[0]);
                xlsWriteLabel($tablebody,$kolombody++,$capital);
                xlsWriteLabel($tablebody,$kolombody++,'');
                xlsWriteLabel($tablebody,$kolombody++,$data['supervisor']);
                xlsWriteLabel($tablebody,$kolombody++,$data['head_sales']);
                xlsWriteLabel($tablebody,$kolombody++,$data['tgl_knjngan']);
                xlsWritelabel($tablebody,$kolombody++,$data['bln_knjngan']);
                xlsWriteLabel($tablebody,$kolombody++,$data['thn_knjngan']);
                xlsWriteLabel($tablebody,$kolombody++,$data['status_prospek']);
                xlsWriteLabel($tablebody,$kolombody++,$data['no_spk']);
                xlsWriteLabel($tablebody,$kolombody++,$data['tgl_spk']);
                xlsWritelabel($tablebody,$kolombody++,$data['bln_spk']);
                xlsWriteLabel($tablebody,$kolombody++,$data['thn_spk']);
                xlsWriteLabel($tablebody,$kolombody++,$data['analisa_lost']);
                xlsWriteLabel($tablebody,$kolombody++,$data['jml_kendaraan']);
                xlsWriteLabel($tablebody,$kolombody++,$data['keterangan']);
                xlsWriteLabel($tablebody,$kolombody++,$data['pembayaran']);
                xlsWriteLabel($tablebody,$kolombody++,$data['perusahaan']);
                xlsWriteLabel($tablebody,$kolombody++,$data['dp']);
                xlsWriteLabel($tablebody,$kolombody++,$data['tenor']);



                $tablebody++;
                $nourut++;
                }
                 
                xlsEOF();
                exit();

?>