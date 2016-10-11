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

                $id_gathering = $_GET['id_gathering'];
                $result = mysql_query("SELECT * FROM tb_pelanggan 
                                       JOIN tb_undangan ON tb_undangan.id_pelanggan = tb_pelanggan.id_pelanggan
                                       LEFT JOIN ms_kota ON ms_kota.id_kota = tb_pelanggan.id_kota
                                       LEFT JOIN ms_kecamatan ON ms_kecamatan.id_kecamatan = tb_pelanggan.id_kecamatan
                                       LEFT JOIN ms_kelurahan ON ms_kelurahan.id_kelurahan = tb_pelanggan.id_kelurahan
                                       WHERE tb_pelanggan.deleted_flag = '0' AND tb_undangan.id_gathering = $id_gathering
                                       ORDER BY tb_pelanggan.salesman ASC");
                !$result?die(mysql_error()):'';
 
                //pengaturan nama file
                $namaFile = "UndanganGathering.xls";
                //pengaturan judul data
                $judul = "Customer Penerima Undangan";
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
                xlsWriteLabel($tablehead,$kolomhead++,"No");              
                xlsWriteLabel($tablehead,$kolomhead++,"Perusahaan");             
                xlsWriteLabel($tablehead,$kolomhead++,"Pengurus");
                xlsWriteLabel($tablehead,$kolomhead++,"Kota");              
                xlsWriteLabel($tablehead,$kolomhead++,"Kecamatan");             
                xlsWriteLabel($tablehead,$kolomhead++,"Kelurahan");
                xlsWriteLabel($tablehead,$kolomhead++,"Alamat Rumah");              
                xlsWriteLabel($tablehead,$kolomhead++,"No. HP");             
                xlsWriteLabel($tablehead,$kolomhead++,"Salesman");
                 
                while ($data = mysql_fetch_array($result))
                {
                $kolombody = 0;
                 
                //gunakan xlsWriteNumber untuk penulisan nomor dan xlsWriteLabel untuk penulisan string
                xlsWriteNumber($tablebody,$kolombody++,$nourut);
                xlsWritelabel($tablebody,$kolombody++,$data['nama_perush']);
                xlsWriteLabel($tablebody,$kolombody++,$data['nama_pengurus']);
                xlsWritelabel($tablebody,$kolombody++,$data['nama_kota']);
                xlsWriteLabel($tablebody,$kolombody++,$data['nama_kecamatan']);
                xlsWritelabel($tablebody,$kolombody++,$data['nama_kelurahan']);
                xlsWriteLabel($tablebody,$kolombody++,$data['alamat_rumah']);
                xlsWriteNumber($tablebody,$kolombody++,$data['no_hp']);
                xlsWriteLabel($tablebody,$kolombody++,$data['salesman']);

                 
                $tablebody++;
                $nourut++;
                }
                 
                xlsEOF();
                exit();

?>