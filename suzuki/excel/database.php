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

                $id_database =  $_GET['id_database'];
                $sv = $_GET['sv'];
        
                $r_database = mysql_query("SELECT * FROM tb_database WHERE id_database=$id_database");
                $a_database = mysql_fetch_array($r_database);
                $nama = $a_database['kode_database'];

                $result = mysql_query("SELECT d.nama_database, d.tgl_mulai, d.tgl_selesai, a.salesman, u.supervisor, 
                                              a.id_pelanggan, a.nama_perush, a.nama_pengurus, a.alamat_rumah, c.id_prospek,
                                              IFNULL(e.status_prospek,'Belum Prospek') AS status_prospek, f.tipe, f.model, 
                                              f.transmisi, g.warna, i.tgl_aktivitas, 
                                              (
                                              CASE i.aktivitas
                                              WHEN 'telp' THEN
                                                'Telepon'
                                              WHEN 'visit' THEN
                                                'Visit'
                                              WHEN 'survey' THEN
                                                'Survey'
                                              ELSE
                                                '-'
                                              END
                                              ) AS aktivitas, i.keterangan  
                                       FROM tb_pelanggan a
                                       LEFT JOIN v_unit_latest_prospek_id b ON b.id_pelanggan = a.id_pelanggan
                                       LEFT JOIN tb_prospek c ON c.id_prospek = b.max_prospek
                                       LEFT JOIN tb_database d ON d.id_database = a.id_database
                                       LEFT JOIN ms_status_prospek_suzuki e ON e.id_status_prospek = c.id_status_prospek
                                       LEFT JOIN ms_tipe_kendaraan f ON f.id_tipe_kendaraan = c.id_tipe_kendaraan
                                       LEFT JOIN ms_warna g ON g.id_warna = c.id_warna
                                       LEFT JOIN v_unit_latest_activity_id h ON h.id_pelanggan = a.id_pelanggan
                                       LEFT JOIN tb_aktivitas_harian_unit i ON i.id_aktivitas_harian = h.max_aktivitas
                                       LEFT JOIN v_data_users u ON u.salesman = a.salesman
                                       WHERE d.id_database = '$id_database'  AND u.supervisor = '$sv'");
              
                !$result?die(mysql_error()):'';
 
                //pengaturan nama file
                $namaFile = "ReportDatabase.xls";
                //pengaturan judul data
                $judul = "Report Database $a_database[nama_database]";
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
                xlsWriteLabel($tablehead,$kolomhead++,"Nama Database");              
                xlsWriteLabel($tablehead,$kolomhead++,"Tgl Mulai");             
                xlsWriteLabel($tablehead,$kolomhead++,"Tgl Selesai");
                xlsWriteLabel($tablehead,$kolomhead++,"Salesman");              
                xlsWriteLabel($tablehead,$kolomhead++,"Koordinator");             
                xlsWriteLabel($tablehead,$kolomhead++,"Nama Pengurus");           
                xlsWriteLabel($tablehead,$kolomhead++,"Tipe");             
                xlsWriteLabel($tablehead,$kolomhead++,"Model");
                xlsWriteLabel($tablehead,$kolomhead++,"Warna");              
                xlsWriteLabel($tablehead,$kolomhead++,"Status Prospek");    
                xlsWriteLabel($tablehead,$kolomhead++,"Tgl Aktivitas");   
                xlsWriteLabel($tablehead,$kolomhead++,"Keterangan");         


                while ($data = mysql_fetch_array($result))
                {
                $kolombody = 0;
                 
                //gunakan xlsWriteNumber untuk penulisan nomor dan xlsWriteLabel untuk penulisan string
                xlsWritelabel($tablebody,$kolombody++,$data['nama_database']);
                xlsWritelabel($tablebody,$kolombody++,$data['tgl_mulai']);
                xlsWriteLabel($tablebody,$kolombody++,$data['tgl_selesai']);
                xlsWritelabel($tablebody,$kolombody++,$data['salesman']);
                xlsWriteLabel($tablebody,$kolombody++,$data['supervisor']);
                xlsWritelabel($tablebody,$kolombody++,$data['nama_pengurus']);
                xlsWritelabel($tablebody,$kolombody++,$data['tipe']);
                xlsWriteLabel($tablebody,$kolombody++,$data['model']);
                xlsWritelabel($tablebody,$kolombody++,$data['warna']);
                xlsWriteLabel($tablebody,$kolombody++,$data['status_prospek']);
                xlsWriteLabel($tablebody,$kolombody++,$data['tgl_aktivitas']);
                xlsWriteLabel($tablebody,$kolombody++,$data['keterangan']);




                $tablebody++;
                $nourut++;
                }
                 
                xlsEOF();
                exit();

?>