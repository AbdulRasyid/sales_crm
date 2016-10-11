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

                        	<?php if ($_SESSION['level'] == 'sales') { ?> 
                        	
                        		<div class="col-md-4">
									<?php if($_SESSION[sublevel] == 'unit'){ ?>
										<label class="control-label">Sales Unit</label>
									<?php } elseif($_SESSION[sublevel] == 'part'){ ?>
										<label class="control-label">Sales Part</label>
									<?php } elseif($_SESSION[sublevel] == 'service'){ ?>
										<label class="control-label">Sales Service</label>
									<?php } ?>		
										<input class="form-control form-control-inline "  type="text" readonly name="sales" value="<?php echo $_SESSION[username] ; ?>" />
								</div>
                           	
                           	<?php } elseif ($_SESSION['level'] == 'supervisor') { ?>
                        			
                        		<div class="col-md-4">
									<label class="control-label">Sales</label>		
									<select required="required" class="form-control form-control-inline select2me" name="sales">
										<option value="" selected="selected">- Pilih Sales</option>
											<?php
 											$sql= mysql_query("SELECT * FROM ms_users WHERE id_parent = '$_SESSION[id]'  AND blokir = 'N' OR username = '$_SESSION[username]' ORDER BY username ASC");
 											while($row=mysql_fetch_array($sql))
																	{
											$id = $row['username'];	
  												
											echo '<option value="'.$id.'">'.$row['username'].'</option>';
													}
											?>
									</select>
								</div>

							<?php } ?>

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


			if ($_SESSION[sublevel] == 'unit') {
			$result = mysql_query("SELECT a.day_name, a.db_date, SUBSTR(b.nama_perush, 1, 22) AS nama_perush,
										  b.kategori_segmen, b.segmen,	SUBSTR(b.nama_pengurus, 1, 20) AS nama_pengurus,
										  b.jabatan, b.id_kota, b.nama_kota, b.aktivitas, b.dalam, b.luar,
										  SUBSTR(b.keterangan, 1, 55) AS keterangan, b.tgl_kunjungan_berikut
								  FROM 	time_dimension a
								  LEFT JOIN ( SELECT d.tgl_aktivitas, a.id_pelanggan, a.nama_perush, a.nama_pengurus, a.jabatan,
								  					 a.id_kota,	e.nama_kota, b.kategori_segmen,	c.segmen,
								  					  (
														CASE d.aktivitas
														WHEN 'visit' THEN
															'1'
														WHEN 'telp' THEN
															'2'
														WHEN 'survey' THEN
															'3'
														ELSE
															'-'
														END
													) AS id_aktivitas,
													(
														CASE d.aktivitas
														WHEN 'visit' THEN
															'Visit'
														WHEN 'telp' THEN
															'Telp'
														WHEN 'survey' THEN
															'Survey'
														ELSE
															'-'
														END
													) AS aktivitas,

													IF (
														a.id_kota = 3374
														OR d.aktivitas = 'telp',
														'Ya',
														'-'
													) AS dalam,

													IF (
														a.id_kota != 3374
														AND d.aktivitas = 'visit',
														'Ya',
														'-'
													) AS luar,
													 d.keterangan, d.tgl_kunjungan_berikut, a.salesman
											  
											  FROM tb_pelanggan a
											  LEFT JOIN ms_segmen_kategori b ON b.id_kategori_segmen = a.id_kategori_segmen
											  LEFT JOIN ms_segmen c ON c.id_segmen = a.id_segmen
											  JOIN tb_aktivitas_harian_unit d ON d.id_pelanggan = a.id_pelanggan
											  LEFT JOIN ms_kota e ON e.id_kota = a.id_kota
											  
											  WHERE	a.salesman = '$sales'
											  AND tgl_aktivitas BETWEEN '$from'
											  AND '$to'
											) b ON b.tgl_aktivitas = a.db_date
								  WHERE
										a.db_date BETWEEN '$from'
								  AND '$to'
								  ORDER BY a.db_date ASC") 
								  or die (mysql_error());

			} elseif ($_SESSION[sublevel] == 'part') {
			$result = mysql_query("SELECT a.day_name, a.db_date, SUBSTR(b.nama_perush, 1, 22) AS nama_perush,
										  b.kategori_segmen, b.segmen,	SUBSTR(b.nama_pengurus, 1, 20) AS nama_pengurus,
										  b.jabatan, b.id_kota, b.nama_kota, b.aktivitas, b.dalam, b.luar,
										  SUBSTR(b.keterangan, 1, 55) AS keterangan, b.tgl_kunjungan_berikut
								  FROM 	time_dimension a
								  LEFT JOIN ( SELECT d.tgl_aktivitas, a.id_pelanggan, a.nama_perush, a.nama_pengurus, a.jabatan,
								  					 a.id_kota,	e.nama_kota, b.kategori_segmen,	c.segmen,
								  					  (
														CASE d.aktivitas
														WHEN 'Visit' THEN
															'1'
														WHEN 'Telepon' THEN
															'2'
														ELSE
															'-'
														END
													) AS id_aktivitas,
													 d.aktivitas
														,

													IF (
														a.id_kota = 3374
														OR d.aktivitas = 'telp',
														'Ya',
														'-'
													) AS dalam,

													IF (
														a.id_kota != 3374
														AND d.aktivitas = 'visit',
														'Ya',
														'-'
													) AS luar,
													 d.keterangan, d.tgl_kunjungan_berikut, a.salesman
											  
											  FROM tb_pelanggan a
											  LEFT JOIN ms_segmen_kategori b ON b.id_kategori_segmen = a.id_kategori_segmen
											  LEFT JOIN ms_segmen c ON c.id_segmen = a.id_segmen
											  JOIN tb_aktivitas_harian_part d ON d.id_pelanggan = a.id_pelanggan
											  LEFT JOIN ms_kota e ON e.id_kota = a.id_kota
											  
											  WHERE	a.salespart = '$sales'
											  AND tgl_aktivitas BETWEEN '$from'
											  AND '$to'
											) b ON b.tgl_aktivitas = a.db_date
								  WHERE
										a.db_date BETWEEN '$from'
								  AND '$to'
								  ORDER BY a.db_date ASC") 
								  or die (mysql_error());

			} elseif ($_SESSION[sublevel] == 'service') {
			$result = mysql_query("SELECT a.day_name, a.db_date, SUBSTR(b.nama_perush, 1, 22) AS nama_perush,
										  b.kategori_segmen, b.segmen,	SUBSTR(b.nama_pengurus, 1, 20) AS nama_pengurus,
										  b.jabatan, b.id_kota, b.nama_kota, b.aktivitas, b.dalam, b.luar,
										  SUBSTR(b.keterangan, 1, 55) AS keterangan, b.tgl_kunjungan_berikut
								  FROM 	time_dimension a
								  LEFT JOIN ( SELECT d.tgl_aktivitas, a.id_pelanggan, a.nama_perush, a.nama_pengurus, a.jabatan,
								  					 a.id_kota,	e.nama_kota, b.kategori_segmen,	c.segmen,
								  					  (
														CASE d.aktivitas
														WHEN 'visit' THEN
															'1'
														WHEN 'telp' THEN
															'2'
														WHEN 'survey' THEN
															'3'
														ELSE
															'-'
														END
													) AS id_aktivitas,
													(
														CASE d.aktivitas
														WHEN 'visit' THEN
															'Visit'
														WHEN 'telp' THEN
															'Telp'
														WHEN 'survey' THEN
															'Survey'
														ELSE
															'-'
														END
													) AS aktivitas,

													IF (
														a.id_kota = 3374
														OR d.aktivitas = 'telp',
														'Ya',
														'-'
													) AS dalam,

													IF (
														a.id_kota != 3374
														AND d.aktivitas = 'visit',
														'Ya',
														'-'
													) AS luar,
													 d.keterangan, d.tgl_kunjungan_berikut, a.salesman
											  
											  FROM tb_pelanggan a
											  LEFT JOIN ms_segmen_kategori b ON b.id_kategori_segmen = a.id_kategori_segmen
											  LEFT JOIN ms_segmen c ON c.id_segmen = a.id_segmen
											  JOIN tb_aktivitas_harian_serv d ON d.id_pelanggan = a.id_pelanggan
											  LEFT JOIN ms_kota e ON e.id_kota = a.id_kota
											  
											  WHERE	a.salesman = '$sales'
											  AND tgl_aktivitas BETWEEN '$from'
											  AND '$to'
											) b ON b.tgl_aktivitas = a.db_date
								  WHERE
										a.db_date BETWEEN '$from'
								  AND '$to'
								  ORDER BY a.db_date ASC") 
								  or die (mysql_error());
			}

			?>

			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Laporan Aktivitas Periode  <?php echo $from; ?> s/d  <?php echo $to; ?>
					</div>
					<div class="actions">
						<?php if ($_SESSION[sublevel] == 'unit'){ ?> 
						<a href="modul/laporan/cetak_aktivitas_unit.php?&sales=<?php echo $sales ;?>&from=<?php echo $from ;?>&to=<?php echo $to ;?>" target="_blank" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i> Cetak </a>	
						<?php } elseif ($_SESSION[sublevel] == 'part') { ?>	
						<a href="modul/laporan/cetak_aktivitas_part.php?&sales=<?php echo $sales ;?>&from=<?php echo $from ;?>&to=<?php echo $to ;?>" target="_blank" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i> Cetak </a>		
						<?php } elseif ($_SESSION[sublevel] == 'service') { ?>		
						<a href="modul/laporan/cetak_aktivitas_service.php?&sales=<?php echo $sales ;?>&from=<?php echo $from ;?>&to=<?php echo $to ;?>" target="_blank" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i> Cetak </a>
						<?php } ?>		
				  	</div>
				</div>
				<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="lap_its">
							<thead>
								<tr>
									<th>Hari </th>
									<th>Tgl Aktivitas</th>
									<th>Aktivitas <?php echo $tab_medium ; ?></th>
									<th>Pengurus <?php echo $tab_medium ; ?></th>
									<th>DK </th>
									<th>LK</th>
									<th>Keterangan <?php echo $tab_large ; ?></th>
									<th>Kunjungan Berikut</th>
								</tr>
							</thead>
							<tbody>
								<?php
										while ($row = mysql_fetch_array($result)) {
									?>
								<tr>
									<td><?php echo $row['day_name']; ?></td>
									<td><?php echo $row['db_date']; ?></td>
									<td><?php echo $row['aktivitas']; ?> - <?php echo $row['nama_perush']; ?></td>
									<td><?php echo $row['nama_pengurus']; ?></td>
									<td><?php echo $row['dalam']; ?></td>
									<td><?php echo $row['luar']; ?></td>
									<td><?php echo $row['keterangan']; ?></td>
									<td><?php echo $row['tgl_k']; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>					
				</div>
			</div>

			<?php } ?>


			<?php break; ?>


			<?php case "prospek" : ?>

			<?php break ; ?>


			<?php case "visit" : ?>

			<?php break ; ?>

			<?php case "monitor" : ?>

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
				$sales= $_POST['sales'];
				$from = $_POST['from'];
				$to = $_POST['to'];

			 $aktivitas = "SELECT	tb_pelanggan.id_pelanggan,tb_pelanggan.salesman,users.supervisor,users.grade,users.poin,
			 					tb_pelanggan.nama_perush,COUNT(aktivitas.visit) AS visit,COUNT(aktivitas.telp) AS telp,
			 					COUNT(aktivitas.survey) AS survey
			 			FROM	tb_pelanggan

			 			JOIN (SELECT salesman,supervisor,grade,poin
			 			      FROM v_data_users
			 			      WHERE	divisi = 'hino'
			 			      AND department = 'unit'
			 			      AND jabatan IN ('sales', 'supervisor')) 
			 			      users ON users.salesman = tb_pelanggan.salesman

			 			LEFT JOIN (SELECT id_pelanggan,visit,telp,survey			
			 					   FROM	v_unit_aktivitas_rowtocolumn
			 					   WHERE tgl_aktivitas BETWEEN '$from' AND '$to') 
			 					   aktivitas ON aktivitas.id_pelanggan = tb_pelanggan.id_pelanggan
		
						GROUP BY
							tb_pelanggan.id_pelanggan
						ORDER BY
							tb_pelanggan.salesman,
							tb_pelanggan.nama_perush";

			 $new_customer = "SELECT v_data_users.supervisor, v_data_users.salesman, v_data_users.grade, 
										COUNT(tb_pelanggan.id_pelanggan) AS new_customer 
					          FROM tb_pelanggan
							  JOIN v_data_users ON v_data_users.salesman = tb_pelanggan.salesman
							  JOIN tb_database ON tb_database.id_database = tb_pelanggan.id_database
							  WHERE tb_pelanggan.deleted_flag = 0
							    AND tb_pelanggan.created_date  BETWEEN '$from' AND '$to'
							    AND v_data_users.divisi = 'hino' AND v_data_users.department = 'unit'
							    AND tb_database.nama_database <> '%POLREG%'
							  
							  GROUP BY v_data_users.salesman
							  ORDER BY v_data_users.supervisor";

			 $new_polreg = "SELECT 	tb_pelanggan.salesman, tb_aktivitas_harian_unit.id_aktivitas_harian, 
    								tb_aktivitas_harian_unit.tgl_aktivitas,
                    				COUNT(tb_pelanggan.id_pelanggan) AS jml_polreg	
                    		FROM tb_pelanggan 
                    		JOIN tb_database ON tb_database.id_database = tb_pelanggan.id_database
                    		JOIN tb_aktivitas_harian_unit ON tb_aktivitas_harian_unit.id_pelanggan = tb_pelanggan.id_pelanggan
                    		
                    		WHERE tb_database.nama_database LIKE '%polreg%'
                   				AND tb_pelanggan.deleted_flag = 0
                    			AND tb_aktivitas_harian_unit.deleted_flag = 0
                    			AND tb_aktivitas_harian_unit.tgl_aktivitas BETWEEN '$from'  AND '$to'
                    		
                    		GROUP BY tb_pelanggan.salesman";

			 $status_do = "SELECT pelanggan.salesman,v_data_user.supervisor,pelanggan.id_pelanggan,pelanggan.nama_perush,
									 prospek.id_status_prospek,SUM(prospek.jml_kendaraan) AS jml_do,tb_do.tgl_do
							FROM	tb_pelanggan pelanggan
							JOIN (SELECT salesman,supervisor FROM  v_data_users	WHERE divisi = 'hino'AND department = 'unit' 
							  AND jabatan IN ('sales', 'supervisor')) AS v_data_user ON v_data_user.salesman = pelanggan.salesman

							LEFT JOIN v_unit_latest_prospek_id last_prospek ON last_prospek.id_pelanggan = pelanggan.id_pelanggan
							LEFT JOIN tb_prospek prospek ON prospek.id_prospek = last_prospek.max_prospek
							LEFT JOIN tb_do ON tb_do.id_prospek = prospek.id_prospek
							
							WHERE
								prospek.id_status_prospek = 5
							  AND tb_do.tgl_do BETWEEN '$from' AND '$to' GROUP BY salesman";

			 $status_prospek = "SELECT 	v_unit_prospek_rowtocolumn.salesman,
		                             	v_unit_prospek_rowtocolumn.nama_perush,
		                             	v_unit_prospek_rowtocolumn.id_pelanggan,
		                            	COUNT(v_unit_prospek_rowtocolumn.touch) AS prospekTouch,   
		                             	COUNT(v_unit_prospek_rowtocolumn.nego) AS prospekNego,
		                             	COUNT(v_unit_prospek_rowtocolumn.spk) AS prospekSpk,  
		                             	COUNT(v_unit_prospek_rowtocolumn.do) AS prospekDo
		                        FROM v_unit_prospek_rowtocolumn 

		                    	WHERE ((v_unit_prospek_rowtocolumn.tgl_touch BETWEEN '$from' AND '$to') 
		                     		OR
									(v_unit_prospek_rowtocolumn.tgl_nego BETWEEN '$from' AND '$to')
									OR
									(v_unit_prospek_rowtocolumn.tgl_spk BETWEEN '$from' AND '$to') 
									OR
									(v_unit_prospek_rowtocolumn.tgl_do BETWEEN '$from' AND '$to'))  
                          	 
                          	 	GROUP BY v_unit_prospek_rowtocolumn.salesman";

			 $query = "SELECT	table1.supervisor, table1.salesman,	table1.grade, table1.poin, SUM(table1.visit) AS jml_visit,
			 					SUM(table1.telp) AS jml_telp, SUM(table1.survey) AS jml_survey,	table3.jml_do, 
			 					table2.new_customer, table4.jml_polreg, table5.prospekTouch,
		    				 	table5.prospekNego, table5.prospekSpk, table5.prospekDo
								
					   FROM ($aktivitas) AS table1

					   LEFT JOIN ($new_customer) table2 ON table2.salesman = table1.salesman
					   LEFT JOIN ($status_do) table3 ON table3.salesman = table1.salesman
					   LEFT JOIN ($new_polreg) table4 ON table4.salesman = table1.salesman
					   LEFT JOIN ($status_prospek) table5 ON table5.salesman = table1.salesman

					   GROUP BY
					   	table1.salesman
					   ORDER BY
						table1.supervisor,
						table1.salesman ASC";

		    $aktivitas=mysql_query($query);

			?>

			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Best Sales
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Supervisor</th>
									<th>Salesman</th>
									<th>Grade</th>
									<th>Touch</th>
									<th>Nego</th>
									<th>SPK</th>
									<th>Telp</th>
									<th>Visit</th>
									<th>Survey</th>
									<th>Polreg</th>
									<th>Pelanggan Baru</th>
									<th>Target</th>
									<th>DO</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									while ($r=mysql_fetch_array($aktivitas)){
							 	?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $r['supervisor']; ?></td>
									<td><?php echo $r['salesman']; ?><?php echo $row['tipe']; ?></td>
									<td><?php echo $r['grade']; ?></td>
									<td><?php echo $r['prospekTouch']; ?></td>
									<td><?php echo $r['prospekNego']; ?></td>
									<td><?php echo $r['prospekSpk']; ?></td>
									<td><?php echo $r['jml_telp']; ?></td>
									<td><?php echo $r['jml_visit']; ?></td>
									<td><?php echo $r['jml_survey']; ?></td>
									<td><?php echo $r['jml_polreg']; ?></td>
									<td><?php echo $r['new_customer']; ?></td>
									<td><?php echo $r['poin']; ?></td>
									<td><?php echo $r['prospekDo']; ?></td>
								</tr>
								
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<?php } ?>

			<?php break ; ?>

			<?php case "join_visit" : ?>

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
				$sales= $_POST['sales'];
				$from = $_POST['from'];
				$to = $_POST['to'];

			$result = mysql_query("SELECT b.created_by,	DATE_FORMAT(b.tgl_prospek, '%d %M %Y') AS tgl_prospek, c.nama_perush, d.model,	d.tipe,	e.warna,
										  a.tgl AS tgl_join_visit, a.keterangan, a.action_plan
								   FROM	tb_join_visit a
								   JOIN tb_prospek b ON b.id_prospek = a.id_prospek 
								   JOIN tb_pelanggan c ON c.id_pelanggan = b.id_pelanggan
								   JOIN ms_tipe_kendaraan d ON d.id_tipe_kendaraan = b.id_tipe_kendaraan
								   JOIN ms_warna e ON e.id_warna = b.id_warna
								   JOIN v_data_users f ON f.salesman = b.created_by

								   WHERE (a.tgl BETWEEN '$from' AND '$to' ) AND f.supervisor = '$_SESSION[username]'") 
								  or die (mysql_error());

			?>

			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Laporan Join Visit Periode  <?php echo $from; ?> s/d  <?php echo $to; ?>
					</div>
					<div class="actions">
						<a href="modul/laporan/cetak_join_visit.php?&spv=<?php echo $_SESSION[username] ;?>&from=<?php echo $from ;?>&to=<?php echo $to ;?>" target="_blank" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i> Cetak Laporan </a>	
				  	</div>
				</div>
				<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover" id="lap_its">
							<thead>
								<tr>
									<th>Salesman</th>
									<th>Tgl Prospek</th>
									<th>Nama Perush <?php echo $tab_medium ; ?></th>
									<th>Model/Tipe <?php echo $tab_medium ; ?></th>
									<th>Tgl Join Visit </th>
									<th>Keterangan <?php echo $tab_large ; ?></th>
									<th>Action Plan <?php echo $tab_large ; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
										while ($row = mysql_fetch_array($result)) {
									?>
								<tr>
									<td><?php echo $row['created_by']; ?></td>
									<td><?php echo $row['tgl_prospek']; ?></td>
									<td><?php echo $row['nama_perush']; ?></td>
									<td><?php echo $row['tipe']; ?></td>
									<td><?php echo $row['tgl_join_visit']; ?></td>
									<td><?php echo $row['keterangan']; ?></td>
									<td><?php echo $row['action_plan']; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>					
				</div>
			</div>

			<?php } ?>

			<?php break ; ?>

			<?php case "kpi" : ?>

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
									<label class="control-label">Bulan</label>		
									<select class="form-control" name="bulan">
										<option value='0' selected>- Bulan -</option>

										<?php
											$bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
												for($y=1;$y<=12;$y++){
												if($y==date("m")){ $pilih="selected";}
												else {$pilih="";}
										?>
		
										<option value="<?php echo $y ?>" <?php echo $pilih ?> ><?php echo $bulan[$y]?></option>

										<?php } ?>
										
									</select>
								</div> 
							
							
								<div class="col-md-4">
									<label class="control-label"> Tahun</label>
									<select class="form-control" name="tahun">
										<?php
                							$thn_skr = date('Y');
                							for ($x = $thn_skr; $x >= 2010; $x--) {
                						?>

                    					<option value="<?php echo $x ?>"><?php echo $x ?></option>
                						
                						<?php
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

				$bln_history = $_POST['bulan'];
				$thn_history = $_POST['tahun'];


				$v_act = "SELECT * FROM v_unit_aktivitas_rowtocolumn 
            			  WHERE MONTH(tgl_aktivitas) = '$bln_history' 
            			  AND YEAR(tgl_aktivitas) = '$thn_history'";

			    $table1 = "SELECT   tb_pelanggan.`id_pelanggan`, tb_pelanggan.`salesman`, tb_pelanggan.`nama_perush`, 
			                        v_data_users.`supervisor`, v_data_users.`grade`, v_data_users.`nik`, v_data_users.id_grade,
			            			COUNT(mi.visit) AS 'visit',	COUNT(mi.telp) AS 'telp', COUNT(mi.survey) AS 'survey'
			               FROM tb_pelanggan
			               JOIN ($v_act) mi ON mi.id_pelanggan = tb_pelanggan.`id_pelanggan`
						   JOIN v_data_users ON v_data_users.`salesman` = tb_pelanggan.`salesman`
			               GROUP BY tb_pelanggan.`id_pelanggan`
			               ORDER BY tb_pelanggan.`salesman`, tb_pelanggan.`nama_perush`";

			   	$table2 = "SELECT v_unit_prospek_rowtocolumn.`salesman`, v_unit_prospek_rowtocolumn.nama_perush,
			   	 				  v_unit_prospek_rowtocolumn.tgl_do, v_unit_prospek_rowtocolumn.`id_pelanggan`,
			   	 				  SUM(v_unit_prospek_rowtocolumn.`jml_kendaraan`) AS 'jml_do'
			   	 		   FROM v_unit_prospek_rowtocolumn
			   			   WHERE MONTH(v_unit_prospek_rowtocolumn.tgl_do) = '$bln_history' 
			         	   AND YEAR(v_unit_prospek_rowtocolumn.tgl_do) = '$thn_history' 
			   			   GROUP BY v_unit_prospek_rowtocolumn.`salesman`";
   
			    $table3  = "SELECT v_data_users.`supervisor`, v_data_users.salesman, v_data_users.grade, 
			            		   COUNT(tb_pelanggan.id_pelanggan) AS 'new_customer' 
			            	FROM tb_pelanggan
			            	JOIN v_data_users ON v_data_users.`salesman` = tb_pelanggan.`salesman`
			            	JOIN tb_database ON tb_database.`id_database` = tb_pelanggan.`id_database`
			            	WHERE tb_pelanggan.`deleted_flag` = 0
			            	AND MONTH(tb_pelanggan.`created_date`) = '$bln_history'
			            	AND YEAR(tb_pelanggan.`created_date`) = '$thn_history'
			            	AND tb_database.`nama_database` NOT LIKE ('%polreg%')
			                AND tb_pelanggan.id_database <> 0
			            	AND v_data_users.`divisi` = 'hino'
			            	GROUP BY v_data_users.salesman
			            	ORDER BY v_data_users.supervisor";

			    $table4 = "SELECT tb_pelanggan.id_pelanggan AS id_pelanggan, tb_pelanggan.salesman AS salesman,
			    				  tb_pelanggan.created_date AS created_date, tb_pelanggan.nama_perush  AS nama_perush,
			    				  tb_prospek.jml_kendaraan  AS jml_kendaraan, tb_prospek.created_date AS 'prospek_baru'
			        	   FROM tb_pelanggan
			        	   JOIN tb_prospek ON tb_prospek.id_pelanggan = tb_pelanggan.id_pelanggan
			        	   JOIN v_data_users ON v_data_users.salesman = tb_pelanggan.salesman
			        	   WHERE tb_prospek.jml_kendaraan >= 5
			        	   AND v_data_users.divisi = 'hino'
			        	   AND MONTH(tb_prospek.`created_date`) = '$bln_history'
			        	   AND YEAR(tb_prospek.`created_date`) = '$thn_history'
			        	   AND tb_pelanggan.deleted_flag = 0
			        	   AND tb_prospek.deleted_flag = 0";

			    $query = "SELECT table1.supervisor, table1.salesman, table1.grade, table1.id_grade,	SUM(visit) AS 'jml_visit',
			    				 SUM(telp) AS 'jml_telp', SUM(survey) AS 'jml_survey', table2.jml_do,	table3.new_customer,
			    				 tb_absensi.poin, COUNT(table4.jml_kendaraan) AS 'fleet_prospek'
			              FROM ($table1) AS table1
			              LEFT JOIN ($table2) AS table2 ON table2.salesman = table1.salesman
			              LEFT JOIN ($table3) table3 ON table3.`salesman` = table1.salesman
			              LEFT JOIN tb_absensi ON tb_absensi.nik = table1.nik
			              LEFT JOIN ($table4) table4 ON table4.`id_pelanggan` = table1.id_pelanggan
			              WHERE (MONTH(tb_absensi.`tgl_upload`) = '$bln_history' OR MONTH(tb_absensi.`tgl_upload`) IS NULL) 
			              AND (YEAR(tb_absensi.`tgl_upload`) = '$thn_history' OR YEAR(tb_absensi.`tgl_upload`) IS NULL) 
			              GROUP BY table1.salesman";
   
    
			    $bln_indo = getBulan($bln_history);
			    $q = "SELECT $bln_indo FROM tb_efektif_kerja WHERE tahun=$thn_history";
			    $qek = mysql_query($q);
			    $rek = mysql_fetch_array($qek);
			   
			        function persenDaily($jml_daily, $efektif_kerja, $min_aktifitas){
			           $persenDaily = $efektif_kerja * $min_aktifitas;
			           if ($jml_daily >= $persenDaily){
			               echo " 15% ";
			           }
			           else {
			               echo " 0% ";
			           }
			        }

			       	function persenCustomer($jmlCustomer,$min_costomer){
			           if ($jmlCustomer >= $min_costomer){
			               echo " 15% ";
			           }
			           else {
			               echo " 0% ";
			           }
			       	}

			       	function pencapaianTarget($grade, $do){
			           $query = mysql_query("SELECT * FROM ms_grade WHERE id_grade = $grade");
			           $result = mysql_fetch_array($query);
			            if ($do >= $result[poin]){
			               echo " 50% ";
			           }
			           else {
			               echo " 0% ";
			           } 
			       	}

			       	function fleetProspek($fleet, $grade){
			           if (($grade == 4) and ($fleet >= 5)){
			               echo " 10% ";
			           }
			           else {
			               echo " 0% ";
			           } 
			       	}
			       	
			       	function historyTarget($grade, $do){
			           $query = mysql_query("SELECT * FROM ms_grade WHERE id_grade = $grade");
			           $result = mysql_fetch_array($query);
			            if ($do >= $result[poin]){
			               echo " 50% ";
			           }
			           else {
			               echo " 0% ";
			           } 
			       	}

		    $aktivitas=mysql_query($query);

			?>

			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Daily Report
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Supervisor</th>
									<th>Salesman</th>
									<th>Grade</th>
									<th colspan="2">Daily Report</th>
									<th colspan="2">Pencapaian Target</th>
									<th colspan="2">Pelanggan Baru</th>
									<th colspan="2">Fleet Prospect</th>
									<th>History</th>
									<th>Absensi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									while ($r=mysql_fetch_array($aktivitas)){
									$daily_report =  $r[jml_telp]+$r[jml_visit]+$r[jml_survey];
							 	?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $r['supervisor']; ?></td>
									<td><?php echo $r['salesman']; ?><?php echo $row['tipe']; ?></td>
									<td><?php echo $r['grade']; ?></td>
									<td>
										<a href="?module=laporan&act=history&d=dailyreport&bln_history=<?php echo $bln_history ; ?>&thn_history=<?php echo $thn_history ; ?>&salesman=<?php echo $r[salesman] ;?>"><?php echo $daily_report ?>
										</a>
									</td>
									<td><?php echo persenDaily($daily_report, $rek[$bln_indo],5) ; ?></td>
									<td>
										<a href="?module=laporan&act=history&d=dailyreport&bln_history=<?php echo $bln_history ; ?>&thn_history=<?php echo $thn_history ; ?>&salesman=<?php echo $r[salesman] ;?>"><?php echo $r['jml_do'] ?>
										</a>
									</td>
									<td><?php echo pencapaianTarget($r[id_grade], $r[jml_do]) ; ?></td>
									<td>
										<a href="?module=laporan&act=history&d=dailyreport&bln_history=<?php echo $bln_history ; ?>&thn_history=<?php echo $thn_history ; ?>&salesman=<?php echo $r[salesman] ;?>"><?php echo $r['new_customer'] ?>
										</a>
									</td>
									<td><?php echo persenCustomer($r[new_customer], 20) ; ?></td>
									<td>
										<a href="?module=laporan&act=history&d=dailyreport&bln_history=<?php echo $bln_history ; ?>&thn_history=<?php echo $thn_history ; ?>&salesman=<?php echo $r[salesman] ;?>"><?php echo $r['fleet_prospek'] ?>
										</a>
									</td>
									<td><?php echo fleetProspek($r[fleet_prospek], $r[id_grade]) ; ?></td>
									<td><?php echo $r['poin'] ; ?></td>
									<td><?php echo $r['poin'] ; ?></td>

								</tr>
								
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<?php } ?>

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