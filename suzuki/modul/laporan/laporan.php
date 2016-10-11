<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Report <small>Management</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Report</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->

			<?php 
				$tab_large =   '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
				$tab_medium =  '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
				$tab_small =   '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';

				$en=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","January","February","March",
					"April","May","June","July","August","September","October","November","December");
 
 				$idn=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Januari","Pebruari","Maret","April","Mei",
 					"Juni","Juli","Agustus","September","Oktober","Nopember","Desember");

			?>
			
			<?php 
            	switch($_GET[act]){
            	default:
          	?>

          	

			<?php break; ?>


			<?php case "prospek" : ?>

			<?php break ; ?>


			<?php case "visit" : ?>

			<?php break ; ?>


			<?php case "sales_monitoring" : ?>

			<?php break ; ?>

			<?php case "kpi_insentif" : ?>


			<?php break ; ?>

			<?php case "its" : ?>

			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
                  		<div class="portlet-title">
                  			<div class="caption">
								<i class="fa fa-cogs"></i>Filter Report
				  			</div>
                  		</div>
                  		
                  		<div class="portlet-body">
                     
					 	<form method="post" action="">
                        	<div class="row">
                           
								<div class="col-md-4">
									<label class="control-label">Dari Tanggal</label>		
									<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" size="16" type="text"  name="from" id="from" placeholder="Input Tanggal" />
								</div> 
							
							
								<div class="col-md-4">
									<label class="control-label"> Sampai Tanggal</label>
									<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" size="16" type="text" name="to" id="to"  placeholder="Input Tanggal" />
								</div> 
							
								<div class="col-md-1">
								</div>
							
								<div class="col-md-3">
						 	    	<label class="control-label"> &nbsp</label>
									<input type="submit" value="Submit" name="submit" class="btn red btn-block">
                            	</div>

                        	</div>
                     	</form>

                  		</div>
            		</div>
            	</div>
            </div>

            <?php
   
			if(isset($_POST['submit'])){
				$from = $_POST['from'];
				$to = $_POST['to'];

			
			$result = mysql_query("SELECT a.id_pelanggan, a.nama_perush, a.nama_pengurus, b.nama AS asal_prospek,
										  d.no_prospek AS no_inq, 

										  d.tgl_prospek AS tgl_create_prospek,
										  RIGHT (d.tgl_prospek, 2) AS tgl_prospek,
										  SUBSTRING(d.tgl_prospek, 6, 2) AS bln_prospek,
										  LEFT (d.tgl_prospek, 4) AS thn_prospek,

										  d.id_kendaraan, e.merk, d.id_tipe_kendaraan, f.model, f.tipe,	d.id_warna,
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
										  (SELECT username FROM ms_users WHERE username = 'teguh.iman') AS head_sales,
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

								  FROM	tb_pelanggan a
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
								  AND z.supervisor = '$_SESSION[username]'") or die (mysql_error());
			?>

			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Laporan ITS Suzuki
					</div>
					<div class="actions">
						<a href="excel/its.php?from=<?php echo $from;?>&to=<?php echo $to;?>&lv=<?php echo $_SESSION[level];?>&sv=<?php echo $_SESSION[username];?>" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i> Export Excel </a>						
				  	</div>
				</div>
				<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="lap_its">
							<thead>
								<tr>
									<th>#</th>
									<th>No. Inq</th>
									<th>Pelanggan <?php echo $tab_medium ; ?></th>
									<th>Tgl</th>
									<th>Bln</th>
									<th>Thn</th>
									<th>Model <?php echo $tab_small ; ?></th>
									<th>Tipe <?php echo $tab_medium ; ?></th>
									<th>Warna <?php echo $tab_medium ; ?></th>
									<th>Asal Prospek</th>
									<th>Test Drive</th>
									<th>Rencana Pembelian</th>
									<th>Wiraniaga</th>
									<th>Grade</th>
									<th>Koordinator <?php echo $tab_small ; ?></th>
									<th>Sales Head <?php echo $tab_small ; ?></th>
									<th>Tgl</th>
									<th>Bln</th>
									<th>Thn</th>
									<th>Last Progress</th>
									<th>Tgl</th>
									<th>Bln</th>
									<th>Thn</th>
									<th>Lost Case</th>
									<th>Analisa Lost Case</th>
									<th>Actual Jml Pembelian</th>
									<th>Voice Of Customer <?php echo $tab_large ; ?></th>									
									<th>Pembiayaan</th>
									<th>Lembaga Pembiayaan <?php echo $tab_small ; ?></th>
									<th>DP <?php echo $tab_small ; ?></th>
									<th>Tenor</th>
								</tr>
							</thead>
							<tbody>
								<?php
										while ($row = mysql_fetch_array($result)) {
									?>
								<tr>
									<td>#</td>
									<td><?php echo $row['no_inq'];?> </td>
									<td><?php echo $row['nama_perush'];?> </td>
									<td><?php echo $row['tgl_prospek'];?> </td>
									<td><?php echo $row['bln_prospek'];?> </td>
									<td><?php echo $row['thn_prospek'];?> </td>
									<td><?php echo $row['model'];?> </td>
									<td><?php echo $row['tipe'];?> </td>
									<td><?php echo $row['warna'];?> </td>
									<td><?php echo $row['asal_prospek'];?> </td>
									<td><?php echo $row['test_drive'];?> </td>
									<td><?php echo $row['jml_kendaraan'];?> Unit </td>
									<?php 
									$salesman = explode(".",$row[wiraniaga]);
                					$capital = ucwords($salesman[0])
									?>
									<td><?php echo $capital ; ?> </td>
									<td><?php echo $row['grade'];?> </td>
									<td><?php echo $row['supervisor'];?> </td>
									<td><?php echo $row['head_sales'];?> </td>
									<td><?php echo $row['tgl_knjngan'];?> </td>
									<td><?php echo $row['bln_knjngan'];?> </td>
									<td><?php echo $row['thn_knjngan'];?> </td>
									<td><?php echo $row['status_prospek'];?> </td>
									<td><?php echo $row['tgl_spk'];?> </td>
									<td><?php echo $row['bln_spk'];?> </td>
									<td><?php echo $row['thn_spk'];?> </td>
									<td><?php echo $row['lost_case'];?> </td>
									<td><?php echo $row['analisa_lost'];?> </td>
									<td><?php echo $row['jml_kendaraan'];?> Unit </td>
									<td><?php echo $row['keterangan'];?></td>
									<td><?php echo $row['pembayaran'];?></td>
									<td><?php echo $row['perusahaan'];?></td>
									<td><?php echo $row['do'];?></td>
									<td><?php echo $row['tenor'];?> Tahun</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>					
				</div>
			</div>

			<?php } ?>


			<?php break ; ?>

			<?php case "kdp" : ?>

			<div class="row">
				<div class="col-md-7">
					<div class="portlet box red">
                  		<div class="portlet-title">
                  			<div class="caption">
								<i class="fa fa-cogs"></i>Filter Report
				  			</div>
                  		</div>
                  		
                  		<div class="portlet-body">
                     
					 	<form method="post" action="">
                        	<div class="row">
                           		
                        		<div class="col-md-4">
								<label class="control-label">Sales</label>		
								<select required="required" class="form-control form-control-inline select2me" name="sales">
										<option value="" selected="selected">- Pilih Sales</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_users WHERE divisi = 'suzuki' AND level = 'sales'  AND id_parent = $_SESSION[id] AND blokir = 'N' ORDER BY username ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['username'];	
  												
											echo '<option value="'.$id.'">'.$row['username'].'</option>';
													}
											?>
								</select>
							</div>

								<div class="col-md-3">
									<label class="control-label">Dari Tanggal</label>		
									<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" size="16" type="text"  name="from" id="from" placeholder="Input Tanggal" />
								</div> 
							
							
								<div class="col-md-3">
									<label class="control-label"> Sampai Tanggal</label>
									<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" size="16" type="text" name="to" id="to"  placeholder="Input Tanggal" />
								</div> 
							

							
								<div class="col-md-2">
						 	    	<label class="control-label"> &nbsp</label>
									<input type="submit" value="Submit" name="submit" class="btn red btn-block">
                            	</div>

                        	</div>
                     	</form>

                  		</div>
            		</div>
            	</div>
            </div>

            <?php
   
			if(isset($_POST['submit'])){
				$sales= $_POST['sales'];
				$from = $_POST['from'];
				$to = $_POST['to'];

			$result = mysql_query("SELECT a.id_prospek,	a.id_pelanggan, a.tgl_prospek AS tgl_create_prospek,
										  DATE_FORMAT(a.tgl_prospek, '%d %M %Y') AS 
										  tgl_prospek, a.no_prospek,b.merk,	c.tipe,	d.warna,
                           					(
                           						CASE a.test_drive
                           						WHEN 'Y' THEN 'Ya'
                           						WHEN 'N' THEN 'Tidak'
                           						ELSE '-'
                           						END
                           					 ) AS test_drive,
                           				   
                           				   a.jml_kendaraan, a.id_pembayaran,
                           					(
                           						CASE a.id_pembayaran
                           						WHEN '1' THEN 'Cash/Tunai'
                           						WHEN '2' THEN 'Kredit'
                           						ELSE '-'
                           						END
                           					) AS pembayaran,
                           					
                           					f.perusahaan,	g.kota_perusahaan, h.dp, w.tenor,
                           					a.id_status_prospek, i.status_prospek, k.no_spk,
                           					DATE_FORMAT(z.tgl_do, '%d %M %Y') AS tgl_pengiriman,
                           					a.created_by,	a.created_date
                           									
                           					FROM tb_prospek a
															
											LEFT JOIN tb_kredit w ON w.id_prospek = a.id_prospek
											LEFT JOIN v_unit_latest_spk_id j ON j.id_pelanggan = a.id_pelanggan
								  			LEFT JOIN tb_spk k ON k.id_spk = j.max_spk
											LEFT JOIN tb_do z ON z.id_prospek = a.id_prospek

											LEFT JOIN ms_kendaraan b ON b.id_kendaraan = a.id_kendaraan
											LEFT JOIN ms_tipe_kendaraan c ON c.id_tipe_kendaraan = a.id_tipe_kendaraan
											LEFT JOIN ms_warna d ON d.id_warna = a.id_warna
											LEFT JOIN ms_karoseri e ON e.id_karoseri = a.id_karoseri
											LEFT JOIN ms_perusahaan f ON f.id_perusahaan = w.id_perusahaan
											LEFT JOIN ms_kota_perusahaan g ON g.id_kota_perusahaan = w.id_kota_perusahaan
											LEFT JOIN ms_dp h ON h.id_dp = w.id_dp
											LEFT JOIN ms_status_prospek_suzuki i ON i.id_status_prospek = a.id_status_prospek

											WHERE a.created_by = '$sales' AND a.tgl_prospek BETWEEN '$from' AND '$to' ORDER BY id_prospek DESC") 
											or die (mysql_error());
			?>

			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Laporan KDP Periode  <?php echo $from; ?> s/d  <?php echo $to; ?>
					</div>
				</div>
				<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="lap_its">
							<thead>
								<tr>
									<th>Salesman</th>
									<th>Tgl Prospek <?php echo $tab_small ; ?></th>
									<th>No. Prospek</th>
									<th>Data Kendaraan <?php echo $tab_large ; ?></th>
									<th>Test Drive </th>
									<th>Jumlah</th>
									<th>Pembayaran</th>
									<th>Lembaga <?php echo $tab_medium; ?></th>
									<th>DP <?php echo $tab_small ; ?></th>
									<th>Tenor <?php echo $tab_small ; ?></th>
									<th>Status Prospek</th>
									<th>No. SPK</th>
									<th>Tgl Pengiriman (DO)</th>
									<th>KDP</th>
								</tr>
							</thead>
							<tbody>
								<?php
										while ($row = mysql_fetch_array($result)) {
									?>
								<tr>
								<td><?php echo $row['created_by']; ?></td>
									<td><?php echo str_replace($en, $idn, $row['tgl_prospek']); ?></td>
									<td><?php echo $row['no_prospek']; ?></td>
									<td><?php echo $row['merk']; ?>-<?php echo $row['tipe']; ?></td>
									<td><?php echo $row['test_drive']; ?></td>
									<td><?php echo $row['jml_kendaraan']; ?></td>
									<td><?php echo $row['pembayaran']; ?></td>

									<?php if ($row['id_pembayaran'] == '2') { ?> 
									<td><?php echo $row['perusahaan']; ?></td>
									<?php } elseif ($row['id_pembayaran'] == '1') { ?>
									<td>-</td> <?php } ?>

									<?php if ($row['id_pembayaran'] == '2') { ?> 
									<td><?php echo $row['dp']; ?></td>
									<?php } elseif ($row['id_pembayaran'] == '1') { ?>
									<td>-</td> <?php } ?>

									<?php if ($row['id_pembayaran'] == '2') { ?> 
									<td><?php echo $row['tenor']; ?> Tahun</td>
									<?php } elseif ($row['id_pembayaran'] == '1') { ?>
									<td>-</td> <?php } ?>
									<td><?php echo $row['status_prospek']; ?></td>
									<td><?php echo $row['no_spk']; ?></td>
									<td><?php echo str_replace($en, $idn, $row['tgl_pengiriman']); ?></td>
									<td align="center">
										 <a href="modul/laporan/cetak_kdp.php?id_prospek=<?php echo $row[id_prospek] ;?>&id_pelanggan=<?php echo $row[id_pelanggan] ;?>" target="_blank" class="btn btn-xs red tooltips" data-original-title="Cetak KDP" >
										 	<i class="fa fa-fax"></i>
										 </a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>					
				</div>
			</div>

			<?php } ?>

			<?php break ; ?>


			<?php case "database" : ?>

			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
                  		<div class="portlet-title">
                  			<div class="caption">
								<i class="fa fa-cogs"></i>Filter Report
				  			</div>
                  		</div>
                  		
                  		<div class="portlet-body">
                     
					 	<form method="post" action="">
                        	<div class="row">
                           		
                        		<div class="col-md-7">
									<label class="control-label">Database</label>		
									<select required class="form-control form-control-inline select2me" name="id_database">
										<option value="" selected="selected">- Pilih Database</option>
											<?php
 											$sql= mysql_query("SELECT * FROM tb_database WHERE divisi = 'suzuki' AND deleted_flag = 0 ORDER BY nama_database ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['id_database'];	
  												
											echo '<option value="'.$id.'">'.$row['nama_database'].'</option>';
													}
											?>
									</select>
								</div>
							
								<div class="col-md-3">
						 	    	<label class="control-label"> &nbsp</label>
									<input type="submit" value="Submit" name="submit" class="btn red btn-block">
                            	</div>

                        	</div>
                     	</form>

                  		</div>
            		</div>
            	</div>
            </div>

            <?php
   
			if(isset($_POST['submit'])){
			$id_database= $_POST['id_database'];
				
			$r_database = mysql_query("SELECT * FROM tb_database WHERE id_database=$id_database");
			$a_database = mysql_fetch_array($r_database);
				
			$result = mysql_query("SELECT d.nama_database, d.tgl_mulai,	d.tgl_selesai, a.salesman, u.supervisor, a.id_pelanggan,
										  a.nama_perush, a.nama_pengurus, a.alamat_rumah, c.id_prospek, 
										  IFNULL(e.status_prospek,'Belum Prospek') AS status_prospek, f.tipe, f.model, f.transmisi,
										  g.warna, i.tgl_aktivitas, 
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
								  WHERE	d.id_database = '$id_database'	AND u.supervisor = '$_SESSION[username]'") 
								  or die (mysql_error());
			?>

			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Laporan Database  <?php echo $a_database[nama_database]; ?>
					</div>
					<div class="actions">
						<a href="excel/database.php?id_database=<?php echo $id_database;?>&sv=<?php echo $_SESSION[username];?>" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i> Export Excel </a>						
				  	</div>
				</div>
				<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="lap_database">
							<thead>
								<tr>
									<th>Nama Database <?php echo $tab_small ; ?></th>
									<th>Tgl Mulai</th>
									<th>Tgl Selesai</th>
									<th>Salesman</th>
									<th>Koordinator</th>
									<th>Nama Pengurus </th>
									<th>Tipe <?php echo $tab_large; ?></th>
									<th>Warna <?php echo $tab_large; ?></th>
									<th>Status Prospek</th>
									<th>Tgl Aktivitas</th>
									<th>Aktivitas</th>
									<th>Keterangan <?php echo $tab_large; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
										while ($row = mysql_fetch_array($result)) {
									?>
								<tr>
									<td><?php echo $row['nama_database']; ?></td>
									<td><?php echo $row['tgl_mulai']; ?></td>
									<td><?php echo $row['tgl_selesai']; ?></td>
									<td><?php echo $row['salesman']; ?></td>
									<td><?php echo $row['supervisor']; ?></td>
									<td><?php echo $row['nama_pengurus']; ?></td>
									<td><?php echo $row['tipe']; ?> - <?php echo $row['model']; ?> </td>
									<td><?php echo $row['warna']; ?></td>
									<td><?php echo $row['status_prospek']; ?></td>
									<td><?php echo $row['tgl_aktivitas']; ?></td>
									<td><?php echo $row['aktivitas']; ?></td>
									<td><?php echo $row['keterangan']; ?></td>
									
								</tr>
								<?php } ?>
							</tbody>
						</table>					
				</div>
			</div>

			<?php } ?>

			<?php break ; ?>

			<?php case "asal_prospek" : ?>

			<div class="row">
				<div class="col-md-5">
					<div class="portlet box red">
                  		<div class="portlet-title">
                  			<div class="caption">
								<i class="fa fa-cogs"></i>Filter Report
				  			</div>
                  		</div>
                  		
                  		<div class="portlet-body">
                     
					 	<form method="post" action="">
                        	<div class="row">
                           		
								<div class="col-md-4">
									<label class="control-label">Dari Tanggal</label>		
									<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" size="16" type="text"  name="from" id="from" placeholder="Input Tanggal" />
								</div> 
							
							
								<div class="col-md-4">
									<label class="control-label"> Sampai Tanggal</label>
									<input class="form-control form-control-inline date-picker" data-date-format="yyyy-mm-dd" autocomplete="off" size="16" type="text" name="to" id="to"  placeholder="Input Tanggal" />
								</div> 
							

							
								<div class="col-md-3">
						 	    	<label class="control-label"> &nbsp</label>
									<input type="submit" value="Submit" name="submit" class="btn red btn-block">
                            	</div>

                        	</div>
                     	</form>

                  		</div>
            		</div>
            	</div>
            </div>

            <?php
   
			if(isset($_POST['submit'])){
			
			$id_asal_prospek= $_POST['id_asal'];
			$from = $_POST['from'];
			$to = $_POST['to'];	

			$r_asal = mysql_query("SELECT * FROM ms_asal_prospek WHERE id_asal_prospek=$id_asal_prospek");
			$a_asal = mysql_fetch_array($r_asal);
				
			$result = mysql_query("SELECT d.nama AS asal_prospek, a.created_date AS tgl_input_customer, a.salesman, u.supervisor, 
										  a.id_pelanggan, a.nama_perush, a.nama_pengurus, a.alamat_rumah, c.id_prospek, 
										  IFNULL(e.status_prospek,'Belum Prospek') AS status_prospek, f.tipe, f.model, f.transmisi,
										  g.warna, i.tgl_aktivitas, 
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
								  LEFT JOIN ms_asal_prospek d ON d.id_asal_prospek = a.id_asal_prospek
								  LEFT JOIN ms_status_prospek_suzuki e ON e.id_status_prospek = c.id_status_prospek
								  LEFT JOIN ms_tipe_kendaraan f ON f.id_tipe_kendaraan = c.id_tipe_kendaraan
								  LEFT JOIN ms_warna g ON g.id_warna = c.id_warna
								  LEFT JOIN v_unit_latest_activity_id h ON h.id_pelanggan = a.id_pelanggan
								  LEFT JOIN tb_aktivitas_harian_unit i ON i.id_aktivitas_harian = h.max_aktivitas
								  LEFT JOIN v_data_users u ON u.salesman = a.salesman
								  WHERE	a.created_date BETWEEN '$from' AND '$to' 
								  AND u.divisi = 'suzuki' AND u.supervisor = '$_SESSION[username]'") 
								  or die (mysql_error());
			?>

			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Laporan Asal Prospek  <?php echo $a_asal[nama]; ?>
					</div>
					<div class="actions">
						<a href="excel/asal_prospek.php?from=<?php echo $from;?>&to=<?php echo $to;?>&sv=<?php echo $_SESSION[username];?>" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i> Export Excel </a>						
				  	</div>
				</div>
				<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="lap_asal_prospek">
							<thead>
								<tr>
									<th>Asal Prospek</th>
									<th>Tgl Input Customer</th>
									<th>Salesman</th>
									<th>Koordinator</th>
									<th>Nama Pengurus </th>
									<th>Alamat Rumah <?php echo $tab_large; ?></th>
									<th>Tipe <?php echo $tab_large; ?></th>
									<th>Warna <?php echo $tab_large; ?></th>
									<th>Status Prospek</th>
									<th>Tgl Aktivitas</th>
									<th>Aktivitas</th>
									<th>Keterangan <?php echo $tab_large; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
										while ($row = mysql_fetch_array($result)) {
									?>
								<tr>
									<td><?php echo $row['asal_prospek']; ?></td>
									<td><?php echo $row['tgl_input_customer']; ?></td>
									<td><?php echo $row['salesman']; ?></td>
									<td><?php echo $row['supervisor']; ?></td>
									<td><?php echo $row['nama_pengurus']; ?></td>
									<td><?php echo $row['alamat_rumah']; ?></td>
									<td><?php echo $row['tipe']; ?> - <?php echo $row['model']; ?> </td>
									<td><?php echo $row['warna']; ?></td>
									<td><?php echo $row['status_prospek']; ?></td>
									<td><?php echo $row['tgl_aktivitas']; ?></td>
									<td><?php echo $row['aktivitas']; ?></td>
									<td><?php echo $row['keterangan']; ?></td>
									
								</tr>
								<?php } ?>
							</tbody>
						</table>					
				</div>
			</div>

			<?php } ?>

			<?php break ; ?>

			<?php } ?>
		</div>
</div>