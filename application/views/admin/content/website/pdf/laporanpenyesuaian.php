<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin: 0 auto;
		}

		table th {
			border: 1px solid #000;
			padding: 3px;
			font-weight: bold;
			text-align: center;
		}

		table td {
			border: 1px solid #000;
			padding: 3px;
			vertical-align: top;
		}
	</style>
</head>
<body>
	<h1 style="text-align: center;font-size: 30px;font-weight: bold">Lista de productos entrante y saliente</h1> <!--Item List In & Out-->
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre de producto</th>
					<th>Proveedor</th>
					<th>Cliente</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Fecha de transsacción</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i	= 1;
					if ($jml_data > 0){
					foreach ($this->ADM->grid_all_transaksi('', 'id_transaksi', 'DESC', 1000, '', '', '') as $row){
					?>
				<tr>
					<td align="center">
						<?php echo $i;?>
					</td>
					<td>
						<?php 
						$where_barang['id_barang'] 	= $row->id_barang;
						foreach ($this->ADM->grid_all_barang('', 'id_barang', 'DESC', 100, '', $where_barang, '') as $row2){ ?>
						<?php echo $row2->nama_barang;?>
						<?php } ?>
					
					</td>
					<td>
					<?php if($row->id_supplier != 0) { ?>
						<?php 
						$where_supplier['id_supplier'] 	= $row->id_supplier;
						foreach ($this->ADM->grid_all_supplier('', 'id_supplier', 'DESC', 100, '', $where_supplier, '') as $row3){ ?>
						<?php echo $row3->nama_supplier;?>
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
						<?php echo $row3->nama_customer;?>
						<?php } ?>
						<?php } else {?>
							-
							<?php } ?>
					</td>


					<td>
						<?php echo $row->jumlah;?>
					</td>

					<td>
					<?php if($row->status_pergerakan == 1) { ?>
						<span style="color:#5cd29d">Mercancía entrante</span> <!--Incoming Goods-->
						<?php } else { ?>
						<span style="color:#f96868">Mercancía saliente</span><!--Outgoing Goods-->
						<?php } ?>
					</td>
					<td>
						<?php echo $row->tanggal_transaksi;?>
					</td>
				</tr>
				<?php 
				$i++; 
				} 
				} else { 
				?>
				<tr>
					<td colspan="7">¡No hay datos aún!</td> <!--No data yet!-->
				</tr>
				<?php } ?>
				<tr>
					<th colspan="7" align="left">TOTAL :
						<?php echo $jml_data;?></th>
				</tr>
				<tr>
					<th colspan="7" align="left">
						<div class="right" style="text-align:right !important;bottom: 0 !important;">
							<?php 
							$date	= date("Y-m-d H:i:s");
							?>
							<?php echo dateIndo($date);?>
							<br>
							<br>
							<?php echo $admin->admin_nama; ?>
						</div>		
					</th>
				</tr>
			</tbody>
		</table>
</body>
</html>