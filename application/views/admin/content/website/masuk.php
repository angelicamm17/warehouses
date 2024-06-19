<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)) { ?>
	<div class="page">
		<div class="page-title orange">
			<h3>
				<?php echo $breadcrumb; ?>
			</h3>
			<p>Información de
				<?php echo $breadcrumb; ?>
			</p>
		</div>
		<div class="page-content container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel rounded-0">
						<div class="panel-heading">
							<h5 class="panel-title">Ver datos de
								<?php echo $breadcrumb; ?>
							</h5>
						</div>
						<!-- ========== Flashdata ========== -->
						<?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
							<?php if ($this->session->flashdata('success')) { ?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<i class="fa fa-check sign"></i>
									<?php echo $this->session->flashdata('success'); ?>
								</div>
							<?php } else if ($this->session->flashdata('warning')) { ?>
								<div class="alert alert-warning">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<i class="fa fa-check sign"></i>
									<?php echo $this->session->flashdata('warning'); ?>
								</div>
							<?php } else { ?>
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<i class="fa fa-warning sign"></i>
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php } ?>
						<?php } ?>
						<!-- ========== End Flashdata ========== -->
						<div class="panel-body container-fluid table-detail">
							<div class="table-full table-view">
								<div class="navigation-btn">
									<form action="" method="post" id="form">
										<div class='row margin-bottom'>
											<div class='btn-search'>Buscar por :</div>
											<div class='col-md-3 col-sm-12'>
												<div class='button-search'>
													<?php array_pilihan('cari', $berdasarkan, $cari); ?>
												</div>
											</div>
											<div class='col-md-3 col-sm-12 select-search'>
												<div class="input-group">
													<select name="q" class="form-control">
														<?php foreach ($this->ADM->grid_all_barang('', 'id_barang', 'DESC', $batas, $page, '', '') as $barang) { ?>
															<option value="<?php echo $barang->id_barang ?>"><?php echo $barang->nama_barang ?></option>
														<?php } ?>
													</select>
													<span class="input-group-btn">
														<button type="submit" name="kirim" class="btn btn-success" type="button">
															<i class="fa fa-search"></i>
														</button>
													</span>
												</div>
											</div>
										</div>
										<div class='btn-navigation'>
											<div class='pull-right'>
												<a class="btn btn-success" href="<?php echo site_url(); ?>website/masuk"><i class="fa fa-refresh"></i></a>
											</div>
										</div>
									</form>
								</div>
								<div class="table-responsive">
									<table class="table table-hover table-striped table-bordered">
										<thead>
											<th width=80>#</th>
											<th width=120>Mercancía</th>
											<th width=150>Proveedores</th>
											<th width=80 class="text-center">Total</th>
											<th width=270>Fecha</th>
											<?php if ($admin->admin_level_kode == 1) { ?>
												<th class="text-center">Acción</th>
											<?php } ?>
										</thead>
										<tbody>
											<?php
											$i	= $page + 1;
											$where_transaksi['status_pergerakan'] 	= 1;
											$like_transaksi[$cari]			= $q;
											if ($jml_data > 0) {
												foreach ($this->ADM->grid_all_transaksi('', 'tanggal_transaksi', 'DESC', $batas, $page, $where_transaksi, $like_transaksi) as $row) {
											?>
													<tr>
														<td>
															<?php echo $i; ?>
														</td>
														<td>
															<?php
															$where_barang['id_barang'] 	= $row->id_barang;
															foreach ($this->ADM->grid_all_barang('', 'id_barang', 'DESC', 100, '', $where_barang, '') as $row2) { ?>
																<b>Nombre: <?php echo $row2->nama_barang; ?></b> <br>
																Marca: <?php echo $row2->merek; ?></b><br>
																Cantidad: <?php echo $row->quantity; ?></b><br>
																Tarima: <?php echo $row->pallet; ?></b><br>
																Unidad: <?php echo $row->measurement_unit; ?></b><br>
																Total: <?php echo $row->jumlah; ?></b><br>
															<?php } ?>
														</td>
														<td>
															<?php
															$where_supplier['id_supplier'] 	= $row->id_supplier;
															foreach ($this->ADM->grid_all_supplier('', 'id_supplier', 'DESC', 100, '', $where_supplier, '') as $row3) { ?>
																<b>Nombre: <?php echo $row3->nama_supplier; ?></b> <br>
																Dirección: <?php echo $row3->alamat_supplier; ?> <br>
																Teléfono: <?php echo $row3->notelp_supplier; ?> <br>
															<?php } ?>
														</td>
														<td class="text-center" style="color: red !important">
															<?php echo $row->jumlah; ?>
														</td>
														<td>
															<b>Creado:</b> <?php echo dateIndo($row->tanggal_transaksi); ?><br>
															<b>Última actualización:</b> <?php echo dateIndo($row->transaksi_updated); ?>
														</td>
														<?php if ($admin->admin_level_kode == 1) { ?>
															<td class="text-center action">

																<a class="text-danger" href="javascript:;" data-id="<?php echo $row->id_transaksi; ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="<?php echo $row->id_transaksi; ?>">
																	<i class="icon wb-trash"></i>
																</a>
															</td>
														<?php } ?>
													</tr>
												<?php
													$i++;
												}
											} else {
												?>
												<tr>
													<td colspan="7">No data yet!</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="wrapper">
									<div class="paging">
										<div id='pagination'>
											<div class='pagination-right'>
												<ul class="pagination">
													<?php if ($jml_halaman > 1) {
														echo pages($halaman, $jml_halaman, 'website/masuk/view', $id = "");
													} ?>
												</ul>
											</div>
										</div>
									</div>
									<div class="total">Total :
										<?php echo $jml_data; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if ($admin->admin_level_kode == 1) { ?>
			<a href="<?php echo site_url(); ?>website/masuk/tambah">
				<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
					<i class="icon wb-plus" aria-hidden="true"></i>
				</button>
			</a>
		<?php } ?>
	</div>
	<!-- ========== Modal Konfirmasi ========== -->
	<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirmación</h4>
				</div>

				<div class="modal-body" style="background:#d9534f;color:#fff">
					<!--Are you sure you want to delete this data?-->
					¿Estás seguro de que deseas eliminar estos datos?
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" id="hapus-masuk">Sí</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
	<!-- ========== End Modal Konfirmasi ========== -->
	<!-- ================================================== END VIEW ================================================== -->
	<!-- ================================================== TAMBAH ================================================== -->
<?php } elseif ($action == 'tambah') { ?>
	<div class="page">
		<div class="page-title orange">
			<h3><?php echo $breadcrumb; ?></h3>
			<p>Información sobre <?php echo $breadcrumb; ?></p>
		</div>
		<div class="page-content container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel rounded-0">
						<div class="panel-heading">
							<h5 class="panel-title">Agregar <?php echo $breadcrumb; ?></h5>
						</div>
						<div class="panel-body container-fluid">

							<body>
								<p>Pegar Datos desde Excel</p>
								<form action="<?php echo site_url();?>website/masuk/tambah" method="post" id="exampleStandarForm" autocomplete="off">
									<textarea name="excel_data" rows="10" cols="50" placeholder="Pega los datos aquí"></textarea>
									<br>
									<button type="submit" name="simpan">Insertar</button>
								</form>

								<p>Datos Insertados</p>
								<table class="table table-hover table-striped table-bordered">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Edad</th>
											<th>Estatura (m)</th>
											<th>Talla</th>
											<th>Peso (kg)</th>
											<th>IMC</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($personas)) : ?>
											<?php foreach ($personas as $persona) : ?>
												<tr>
													<td><?= $persona['nombre'] ?></td>
													<td><?= $persona['edad'] ?></td>
													<td><?= $persona['estatura'] ?></td>
													<td><?= $persona['talla'] ?></td>
													<td><?= $persona['peso'] ?></td>
													<td><?= $persona['imc'] ?></td>
												</tr>
											<?php endforeach; ?>
										<?php else : ?>
											<tr>
												<td colspan="6">No hay datos</td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="<?php echo site_url(); ?>website/masuk">
			<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
				<i class="icon wb-eye" aria-hidden="true"></i>
			</button>
		</a>
	</div>
	
<?php } ?>