<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
	<div class="page">
		<div class="page-title orange">
			<h3>
				<?php echo $breadcrumb; ?>
			</h3>
			<p>Información sobre
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
													<?php array_pilihan('cari', $berdasarkan, $cari);?>
												</div>
											</div>
											<div class='col-md-3 col-sm-12 select-search'>
												<div class="input-group">
												<select name="q" class="form-control">
												<?php foreach ($this->ADM->grid_all_barang('', 'id_barang', 'DESC', $batas, $page, '' , '') as $barang){ ?>
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
												<a class="btn btn-success" href="<?php echo site_url();?>website/keluar"><i class="fa fa-refresh"></i></a>
											</div>
										</div>
									</form>
								</div>
								<div class="table-responsive">
									<table class="table table-hover table-striped table-bordered">
										<thead>
											<th>#</th>
											<th>Mercancía</th>
											<th>Proveedor</th>
											<th>Cliente</th>
											<th class="text-center">Total</th>
											<th class="text-center">Estado</th>
											<th width=270>Fecha</th>
											<th class="text-center">Acción</th>
										</thead>
										<tbody>
											<?php 
									$i	= $page+1;
									$like_transaksi[$cari]			= $q;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_transaksi('', 'tanggal_transaksi', 'DESC', $batas, $page, '', $like_transaksi) as $row){
									?>
											<tr>
												<td>
													<?php echo $i; ?>
												</td>
												<td>
												<?php 
									$where_barang['id_barang'] 	= $row->id_barang;
									foreach ($this->ADM->grid_all_barang('', 'id_barang', 'DESC', 100, '', $where_barang, '') as $row2){ ?>
									<b>Nombre: <?php echo $row2->nama_barang;?></b> <br>
									Marca: <?php echo $row2->merek;?>
									<?php } ?>
												</td>
												<td>
								<?php if($row->id_supplier != 0) { ?>
									<?php 
									$where_supplier['id_supplier'] 	= $row->id_supplier;
									foreach ($this->ADM->grid_all_supplier('', 'id_supplier', 'DESC', 100, '', $where_supplier, '') as $row3){ ?>
									<b>Nombre: <?php echo $row3->nama_supplier;?></b> <br>
									Dirección: <?php echo $row3->alamat_supplier;?> <br>
									Teléfono: <?php echo $row3->notelp_supplier;?> <br>
									<?php } ?>
									<?php } else { ?>
										-
										<?php } ?>
												</td>
												<td>
								<?php if($row->id_customer != 0) { ?>
									<?php 
									$where_customer['id_customer'] 	= $row->id_customer;
									foreach ($this->ADM->grid_all_customer('', 'id_customer', 'DESC', 100, '', $where_customer, '') as $row3){ ?>
									<b>Nombre: <?php echo $row3->nama_customer;?></b> <br>
									Dirección: <?php echo $row3->alamat_customer;?> <br>
									Teléfono: <?php echo $row3->notelp_customer;?> <br>
									<?php } ?>
									<?php } else {?>
										-
										<?php } ?>
												</td>
												<td class="text-center" style="color: red !important">
													<?php echo $row->jumlah;?>
												</td>
								<td>
								<?php if($row->status_pergerakan == 1) { ?>
									<small class="badge badge-success bg-success rounded-pill" style="text-decoration: none">Mercancía entrante</small>
									<?php } else { ?>
										
									<small class="badge badge-danger bg-danger rounded-pill" style="text-decoration: none">Mercancía saliente</small>
									<?php } ?>
								</td>
												<td>
													<b>Creado:</b> <?php echo dateIndo($row->tanggal_transaksi);?><br>
													<b>Última actualización:</b> <?php echo dateIndo($row->transaksi_updated);?>
									</td>
												<td class="text-center action">
											
													<a class="text-danger" href="javascript:;" data-id="<?php echo $row->id_transaksi;?>" data-toggle="modal" data-target="#modal-konfirmasi"
														title="<?php echo $row->id_transaksi;?>">
														<i class="icon wb-trash"></i>
													</a>
												</td>
											</tr>
											<?php
										$i++;
									} 
								} else {
									?>
												<tr>
													<td colspan="7">¡Aún no hay datos!</td>
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
													<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'website/penyesuaian/view', $id=""); }?>
												</ul>
											</div>
										</div>
									</div>
									<div class="total">Total :
										<?php echo $jml_data;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
				¿Estás seguro de que quieres borrar estos datos?
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" id="hapus-penyesuaian">Sí</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
	<!-- ========== End Modal Konfirmasi ========== -->
	<!-- ================================================== END VIEW ================================================== -->
	
	<?php } ?>