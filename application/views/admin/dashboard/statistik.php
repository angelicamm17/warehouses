<div class="page">
    <div class="page-title orange">
        <h3>
            <?php echo $breadcrumb; ?>
        </h3>
       
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel rounded-0">
                    <div class="panel-heading rounded-0">
                        <h3 class="panel-title">¡Bienvenido al panel de administración!</h3> <!--Welcome to the Administrator's-->
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="blockquote gray">
                            <h3>Bienvenido,&nbsp;
                                <?php echo $admin->admin_nama; ?>!
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>
                                    <?php echo $jml_data_transaksi_masuk ?>
                                </h3>
                                <p>Mercancías entrantes</p> <!--Incoming Goods-->
                            </div>
                            <div class="icon">
                                <i class="fa fa-archive"></i>
                            </div>
                            <a href="<?php echo site_url();?>website/masuk" class="small-box-footer">
                            <!--View Incoming Goods-->
                            Ver Mercancía Entrante
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>
                                    <?php echo $jml_data_transaksi_keluar ?>
                                </h3>
                                <p>Mercancía saliente</p> <!--Outgoing Goods-->
                            </div>
                            <div class="icon">
                                <i class="fa fa-archive"></i>
                            </div>
                            <a href="<?php echo site_url();?>website/keluar" class="small-box-footer">
                            <!--View Outgoing Goods-->
                            Ver Mercancía saliente
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-xs-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php $query = $this->db->query('SELECT * FROM supplier'); echo $query->num_rows();?>
                                </h3>
                                <p>Proveedores</p> <!--Suppliers-->
                            </div>
                            <div class="icon">
                                <i class="fa fa-th-large"></i>
                            </div>
                            <a href="<?php echo site_url();?>website/supplier" class="small-box-footer">
                            <!--View Suppliers Info-->
                            Ver información de proveedores
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>
                                    <?php $query = $this->db->query('SELECT * FROM customer'); echo $query->num_rows();?>
                                </h3>
                                <p>Clientes</p> <!--Customers-->
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="<?php echo site_url();?>website/customer" class="small-box-footer">
                            <!--View Customers Info-->
                            Ver información de clientes
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4><b>Mercancía con Bajo Stock:</b></h4> <!--Low Stock Goods-->
                <hr>
                <div class="list-group rounded-0" id="notif-list">
                    <?php foreach($notif as $row): ?>
                        <div class="list-group-item list-group-item-action bg-danger rounded-0 border border-light"><?= $row['nama_barang'] ?> solo le queda <b><?= $row['qty'] ?></b> Stock.</div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>