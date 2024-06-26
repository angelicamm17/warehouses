<!DOCTYPE html>
<html><head>
    <title>Incoming Reports</title>
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
</head><body>
    <h1 style="text-align:center">Lista de productos entrantes</h1> <!--List of incoming items-->
    <table class="table table-bordered table-striped" id="example1">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre de producto</th>
                <th>Proveedor</th>
                <th>Total</th>
                <th>Fecha de transacción</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $i = 1;
        $where_transaksi['status_pergerakan'] 	= 1;
        if ($jml_data > 0){
        foreach ($this->ADM->grid_all_transaksi('', 'id_transaksi', 'DESC', 1000, '', $where_transaksi, '') as $row){
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
                <?php 
            $where_supplier['id_supplier'] 	= $row->id_supplier;
            foreach ($this->ADM->grid_all_supplier('', 'id_supplier', 'DESC', 100, '', $where_supplier, '') as $row3){ ?>
                <?php echo $row3->nama_supplier;?>
                <?php } ?>
            </td>
            <td>
                <?php echo $row->jumlah;?>
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
            <td colspan="5">¡No hay datos todavía!</td> <!--No data yet!-->
        </tr>
        <?php } ?>
        <tr>
            <th colspan="5" align="left">TOTAL :
                <?php echo $jml_data;?>
            </th>
        </tr>
        <tr>
            <th colspan="5" align="left">
                <div class="right" style="text-align:right !important;bottom: 0 !important;">
                    <?php 
                    $date	= date("Y-m-d H:i:s");
                    ?>
                    <?php echo dateIndo($date);?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <?php echo $admin->admin_nama; ?>
                </div>
            </th>
        </tr>
        </tbody>
    </table>
</body></html>