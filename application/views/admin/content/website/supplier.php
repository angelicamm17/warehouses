<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)) { ?>
    <div class="page">
        <div class="page-title orange">
            <h3>
                <?php echo $breadcrumb; ?>
            </h3>
            <p>Información sobre el
                <?php echo $breadcrumb; ?>
            </p>
        </div>
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel rounded-0">
                        <div class="panel-heading">
                            <h5 class="panel-title">Ver datos del
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
                                                    <input type="text" name="q" class="form-control" value="<?php echo $q; ?>" />
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
                                                <a class="btn btn-success" href="<?php echo site_url(); ?>website/supplier"><i class="fa fa-refresh"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <th width=80>#</th>
                                            <th width=120>Nombre</th>
                                            <th width=150>Dirección</th>
                                            <th width=120>Teléfono</th>
                                            <th width=270>Fecha</th>
                                            <?php if ($admin->admin_level_kode == 1) { ?>
                                                <th class="text-center">Acción</th>
                                            <?php } ?>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i    = $page + 1;
                                            $like_supplier[$cari]            = $q;
                                            if ($jml_data > 0) {
                                                foreach ($this->ADM->grid_all_supplier('', 'nama_supplier', 'ASC', $batas, $page, '', $like_supplier) as $row) {
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->nama_supplier; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->alamat_supplier; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->notelp_supplier; ?>
                                                        </td>
                                                        <td>
                                                            <b>Creado:</b> <?php echo dateIndo($row->supplier_created); ?><br>
                                                            <b>Última actualización:</b> <?php echo dateIndo($row->supplier_updated); ?>
                                                        </td>
                                                        <?php if ($admin->admin_level_kode == 1) { ?>
                                                            <td class="text-center action">
                                                                <a class="btn-update" href="<?php echo site_url(); ?>website/supplier/edit/<?php echo $row->id_supplier; ?>">
                                                                    <i class="icon wb-pencil"></i>
                                                                </a>
                                                                <a class="text-danger" href="javascript:;" data-id="<?php echo $row->id_supplier; ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="<?php echo $row->nama_supplier; ?>">
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
                                                    <td colspan="7">¡No hay datos aún!</td> <!--No data yet!-->
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
                                                        echo pages($halaman, $jml_halaman, 'website/supplier/view', $id = "");
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
            <a href="<?php echo site_url(); ?>website/supplier/tambah">
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
                    ¿Estás seguro de que quieres borrar estos datos?
                    <!--Are you sure want to delete this data?-->
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-danger" id="hapus-supplier">Sí</a>
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
            <h3>
                <?php echo $breadcrumb; ?>
            </h3>
            <p>Información sobre el
                <?php echo $breadcrumb; ?>
            </p>
        </div>
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel rounded-0">
                        <div class="panel-heading">
                            <h5 class="panel-title">Agregar <?php echo $breadcrumb; ?></h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <form>
                                <div class="form-group form-material">
                                    <label class="control-label" for="person_type">Tipo de persona</label>
                                    <select id="person_type" name="person_type" class="form-control input-sm" onchange="toggleForm()">
                                        <option value="Moral">Moral</option>
                                        <option value="Fisica">Física</option>
                                    </select>
                                </div>
                            </form>
                            <form action="<?php echo site_url(); ?>website/supplier/tambah" method="post" id="formMoral" autocomplete="off" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-material">
                                            <input type="hidden" name="person_type" value="Moral">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Nombre de la empresa</label>
                                            <input type="text" class="form-control input-sm" id="nama_supplier" name="nama_supplier" placeholder="Nombre de la empresa" required />
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Nombre comercial</label>
                                            <input type="text" class="form-control input-sm" id="commercial_name" name="commercial_name" placeholder="Nombre comercial" required>
                                        </div>
                                        <p>Datos fiscales</p>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">RFC</label>
                                            <input type="text" class="form-control input-sm" id="rfc" name="rfc" placeholder="Introduce el RFC" required>
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Calle</label>
                                            <input type="text" class="form-control input-sm" id="street" name="street" placeholder="Introduce el nombre de la calle" required>
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Número exterior</label>
                                            <input type="text" class="form-control input-sm" id="num_ext" name="num_ext" placeholder="Introduce el número exterior">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Número interior</label>
                                            <input type="text" class="form-control input-sm" id="num_in" name="num_in" placeholder="Introduce el número interior">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Colonia</label>
                                            <input type="text" class="form-control input-sm" id="neighborhood" name="neighborhood" placeholder="Introduce el nombre de la colonia">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Localidad</label>
                                            <input type="text" class="form-control input-sm" id="locality" name="locality" placeholder="Introduce el nombre de la localidad">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Estado</label>
                                            <input type="text" class="form-control input-sm" id="federal_entity" name="federal_entity" placeholder="Escribe el nombre del Estado">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Ciudad</label>
                                            <input type="text" class="form-control input-sm" id="city" name="city" placeholder="Escribe el nombre de la ciudad">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Municipio</label>
                                            <input type="text" class="form-control input-sm" id="minicipality" name="municipality" placeholder="Escribe el nombre del municipio">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <p>Datos adicionales</p>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Correo electrónico</label>
                                            <input type="text" class="form-control input-sm" id="email" name="email" placeholder="Escribe el correo electrónico">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Número de teléfono</label>
                                            <input type="text" class="form-control input-sm" id="notelp_supplier" name="notelp_supplier" placeholder="Número de teléfono" required />
                                        </div>
                                        <p>Auditoría</p>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Creado por</label>
                                            <input type="text" class="form-control input-sm" id="created_by" name="created_by">
                                        </div>
                                        <div form="form-group form-material">
                                            <label class="control-label" for="select">Estatus</label>
                                            <select name="status" class="form-control input-sm">
                                                <?php
                                                $statuss = array("Deshabilitado", "Suspendido", "Activo");
                                                foreach ($statuss as $status) {
                                                    echo "<option value='$status'>$status</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Modificado por</label>
                                            <input type="text" class="form-control input-sm" id="modified_by" name="modified_by">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputDate">Fecha deshabilitado</label>
                                            <input type="date" class="form-control inout-sm" id="disablement_date" name="disablement_date">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Motivo de deshabilitado</label>
                                            <input type="text" class="form-control input-sm" id="disablement_reason" name="disablement_reason" placeholder="Escribe aquí el motivo de deshabilitado">
                                        </div>
                                        <div class='button center'>
                                            <input class="btn btn-success btn-sm" type="submit" name="simpan" value="Añadir datos" id="validateButton2">
                                            <input class="btn btn-danger btn-sm" type="reset" name="batal" value="Cancelar" onclick="location.href='<?php echo site_url(); ?>website/supplier'" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="<?php echo site_url(); ?>website/supplier/tambah" method="post" id="formFisica" autocomplete="off" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-material">
                                            <input type="hidden" name="person_type" value="Fisica">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Nombre</label>
                                            <input type="text" class="form-control input-sm" id="nama_supplier" name="nama_supplier" placeholder="Nombre de la empresa" required />
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Nombre comercial</label>
                                            <input type="text" class="form-control input-sm" id="commercial_name" name="commercial_name" placeholder="Nombre comercial" required>
                                        </div>
                                        <p>Datos fiscales</p>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">RFC</label>
                                            <input type="text" class="form-control input-sm" id="rfc" name="rfc" placeholder="Introduce el RFC" required>
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="curp">CURP</label>
                                            <input type="text" class="form-control input-sm" id="curp" name="curp" placeholder="Escribe aquí tu curp" required>
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Calle</label>
                                            <input type="text" class="form-control input-sm" id="street" name="street" placeholder="Introduce el nombre de la calle" required>
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Número exterior</label>
                                            <input type="text" class="form-control input-sm" id="num_ext" name="num_ext" placeholder="Introduce el número exterior">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Número interior</label>
                                            <input type="text" class="form-control input-sm" id="num_in" name="num_in" placeholder="Introduce el número interior">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Colonia</label>
                                            <input type="text" class="form-control input-sm" id="neighborhood" name="neighborhood" placeholder="Introduce el nombre de la colonia">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Localidad</label>
                                            <input type="text" class="form-control input-sm" id="locality" name="locality" placeholder="Introduce el nombre de la localidad">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Estado</label>
                                            <input type="text" class="form-control input-sm" id="federal_entity" name="federal_entity" placeholder="Escribe el nombre del Estado">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Ciudad</label>
                                            <input type="text" class="form-control input-sm" id="city" name="city" placeholder="Escribe el nombre de la ciudad">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Municipio</label>
                                            <input type="text" class="form-control input-sm" id="minicipality" name="municipality" placeholder="Escribe el nombre del municipio">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <p>Datos adicionales</p>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Correo electrónico</label>
                                            <input type="text" class="form-control input-sm" id="email" name="email" placeholder="Escribe el correo electrónico">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Número de teléfono</label>
                                            <input type="text" class="form-control input-sm" id="notelp_supplier" name="notelp_supplier" placeholder="Número de teléfono" required />
                                        </div>
                                        <p>Auditoría</p>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Creado por</label>
                                            <input type="text" class="form-control input-sm" id="created_by" name="created_by">
                                        </div>
                                        <div form="form-group form-material">
                                            <label class="control-label" for="select">Estatus</label>
                                            <select name="status" class="form-control input-sm">
                                                <?php
                                                $statuss = array("Deshabilitado", "Suspendido", "Activo");
                                                foreach ($statuss as $status) {
                                                    echo "<option value='$status'>$status</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Modificado por</label>
                                            <input type="text" class="form-control input-sm" id="modified_by" name="modified_by">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputDate">Fecha deshabilitado</label>
                                            <input type="date" class="form-control inout-sm" id="disablement_date" name="disablement_date">
                                        </div>
                                        <div class="form-group form-material">
                                            <label class="control-label" for="inputText">Motivo de deshabilitado</label>
                                            <input type="text" class="form-control input-sm" id="disablement_reason" name="disablement_reason" placeholder="Escribe aquí el motivo de deshabilitado">
                                        </div>
                                        <div class='button center'>
                                            <input class="btn btn-success btn-sm" type="submit" name="simpan" value="Añadir datos" id="validateButton2">
                                            <input class="btn btn-danger btn-sm" type="reset" name="batal" value="Cancelar" onclick="location.href='<?php echo site_url(); ?>website/supplier'" />
                                        </div>
                                    </div>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <a href="<?php echo site_url(); ?>website/supplier">
            <button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
                <i class="icon wb-eye" aria-hidden="true"></i>
            </button>
        </a>
    </div>
    <script>
        window.onload = function() {
            toggleForm(); //Llamar a toggleForm al cargar la página
        };

        function toggleForm() {
            var personType = document.getElementById('person_type').value;
            if (personType === 'Moral') {
                document.getElementById('formMoral').style.display = 'block';
                document.getElementById('formFisica').style.display = 'none';
            } else {
                document.getElementById('formMoral').style.display = 'none';
                document.getElementById('formFisica').style.display = 'block';
            }
        }
    </script>
    <!-- ================================================== END TAMBAH ================================================== -->

    <!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
    <div class="page">
        <div class="page-title orange">
            <h3>
                <?php echo $breadcrumb; ?>
            </h3>
            <p>Información sobre el
                <?php echo $breadcrumb; ?>
            </p>
        </div>
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel rounded-0">
                        <div class="panel-heading">
                            <h5 class="panel-title">Editar <?php echo $breadcrumb; ?></h5>
                        </div>
                        <div class="panel-body container-fluid">
                            <form action="<?php echo site_url(); ?>website/supplier/edit/<?php echo $id_supplier; ?>" method="post" id="exampleStandardForm" autocomplete="off">
                                <input type="hidden" name="id_supplier" value="<?php echo $id_supplier; ?>" />
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Nombre del proveedor</label>
                                    <input type="text" value="<?php echo $nama_supplier; ?>" class="form-control input-sm" id="nama_supplier" name="nama_supplier" placeholder="Supplier Name" required />
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Dirección</label>
                                    <input type="text" value="<?php echo $alamat_supplier; ?>" class="form-control input-sm" id="alamat_supplier" name="alamat_supplier" placeholder="Address" required />
                                </div>
                                <div class="form-group form-material">
                                    <label class="control-label" for="inputText">Número de teléfono</label>
                                    <input type="text" value="<?php echo $notelp_supplier; ?>" class="form-control input-sm" id="notelp_supplier" name="notelp_supplier" placeholder="Telephone Number" required />
                                </div>
                        </div>
                    </div>


                    <div class='button center'>
                        <input class="btn btn-success btn-sm" type="submit" name="simpan" value="Actualizar datos" id="validateButton2">
                        <input class="btn btn-danger btn-sm" type="reset" name="batal" value="Cancelar" onclick="location.href='<?php echo site_url(); ?>website/supplier'" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <a href="<?php echo site_url(); ?>website/supplier">
        <button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
            <i class="icon wb-eye" aria-hidden="true"></i>
        </button>
    </a>
    </div>
    <!-- ================================================== END EDIT ================================================== -->
<?php } ?>