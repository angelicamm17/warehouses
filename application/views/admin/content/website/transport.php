<!-- ================================================== VIEW ================================================== -->

<?php if ($action == 'view' || empty($action)) { ?>
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
                        <di class="panel-heading">
                            <h5 class="panel-title"> Ver datos del
                                <?php echo $breadcrumb; ?>
                            </h5>
                        </div>
                    <!-- ================================FLASHDATA================================================================= -->
                    <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
                        <?php if ($this->session->flashdata('seccess')) { ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-check sing"></i>
                                <?php echo $this->session->flashdata('seccess'); ?>
                            </div>
                        <?php } else if ($this->session->flashdata('warning')) { ?>
                            <div class="alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-warning sing"></i>
                                <?php echo $this->session->flashdata('warning'); ?>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-waening sing"></i>
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <!-- ================================== End Flashdata ======================================= -->
                    <div class="panel-body container-fluid table-detail">
                        <div class="table-full table-view">
                            <div class="navigation-btn">
                                <form action="" method="post" id="form">
                                    <div class='row margin-bottom'>
                                        <div class='btn-search'>Buscar por :</div>
                                        <div class='col-md-3 col-sm-12'>
                                            <div class='buttton-search'>
                                                <?php array_pilihan('cari', $berdasarkan, $cari); ?>
                                            </div>
                                        </div>
                                        <div class='col-md-3 col-sm-12 select-search'>
                                            <div class="input-group">
                                                <input type="text" name="q" class="form-control" value="<?php echo $q;?>" />
                                                <span class="input-group-btn">
                                                    <button type="submit" name="kirim" class="btn btn-success" type="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-navigation">
                                        <div class='pull-right'>
                                            <a class="btn btn-success" href="<?php echo site_url(); ?>website/transport"><i class="fa fa-refresh"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <th width="80">#</th>
                                        <th width="120">Número de placa</th>
                                        <th width="170">Tipo de vehículo</th>
                                        <th width="120">Capacidad de carga</th>
                                        <th width="120">Modelo del vehículo</th>
                                        <th width="120">Estado del vehículo</th>
                                        <th width="120">Nombre del conductor</th>
                                        <th width="120">Número de licencia</th>
                                        <th widht="120">Fecha de vencimiento de la licencia</th>
                                        <th width="120">Número de viaje</th>
                                        <th width="200">Fecha y hora de salida</th>
                                        <th width="200">Fecha y hora estimada de llegada</th>
                                        <th width="120">Origen</th>
                                        <th width="120">Destino</th>
                                        <th width="120">Ruta</th>
                                        <th width="120">Estado de viaje</th>
                                        <th width="120">Notas</th>
                                        <th width="120">Adjuntar documnetos</th>
                                        <?php if ($admin->admin_level_kode == 1) { ?>
                                            <th class="text-center">Acción</th>
                                        <?php } ?>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i =   $page + 1;
                                        $like_transport[$cari]     = $q;
                                        if ($jml_data > 0) {
                                            foreach ($this->ADM->grid_all_transport('', 'platenumber', 'ASC', $batas, $page, '', $like_transport) as $row) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->platenumber; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->vehicletype; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->loadcapacity; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->vehiclemodel; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->vehiclestatus; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->drivername; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->licensenumber; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->licenseexpiry; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->tripnumber; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->departureDate; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->arrivaldate; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->origin; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->destination; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->route; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->tripstatus; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->notes; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row->attachments ?>
                                                    </td>
                                                    <?php if ($admin->admin_level_kode == 1) { ?>
                                                        <td class="text-center action">
                                                            <a class="btn-update" href="<?php echo site_url(); ?> website/transport/edit<?php echo $row->id_transport ?>">
                                                                <i class="icon wb-pencil"></i>
                                                            </a>
                                                            <a class="text-danger" href="javasscript:;" data-id="<?php echo $row->id_transport; ?>" data-toggle="modal" data-target="#modal-konfirmasi" title="<?php echo $row->platenumber; ?>">
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
                                                <td colspam="7">!No hay datos aún¡</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="wrapper">
                                <div class="paging">
                                    <div class="pagination">
                                        <div id="pagination-right">
                                            <ul class="pagination">
                                                <?php if ($jml_halaman > 1) {
                                                    echo pages($halaman, $jml_halaman, 'website/transport/view', $id = "");
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
         <?php if ($admin->admin_level_kode ==1 ) { ?>
    <a href="<?php echo site_url(); ?>website/transport/trans">
        <button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
            <i class="icon wb-plus" aria-hidden="true"></i>
        </button>
    </a>
    <?php } ?>
</div>
   

<?php } elseif ($action == 'trans') { ?>
    <div class="page">
        <div class="page-title orange">
            <h3>
                <?php echo $breadcrumb; ?>
            </h3>
            <p>Información sobre el/div
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
                            <form action="<?php echo site_url(); ?>website/transport/trans" method="post" id="exampleStandardForm">
                                <h4>Información del transporte</h4>
                                <div class="form-group form-material">
                                    <label for="platenumber"> Número de placa: </label>
                                    <input type="text" class="form-control" id="platenumber" name="platenumber" placeholder="Número de placa" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="vehicletype"> Tipo de Vehículo: </label>
                                    <input type="text" class="form-control" id="vehicletype" name="vehicletype" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="loadcapacity"> Capacidad de Carga (toneladas): </label>
                                    <input type="number" class="form-control" id="loadcapaacity" name="loadcapacity" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="vehiclemodel"> Modelo y Marca: </label>
                                    <input type="text" class="form-control" id="vehiclemodel" name="vehiclemodel" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="manufactureYear"> Año de fabricación</label>
                                    <input type="number" class="form-control" id="manufactureYear" name="manufactureYear" required>
                                </div>-->
                                <div class="form-group form-material">
                                    <label for="vehiclestatus">Estado del vículo</label>
                                    <select class="form-control" id="vehiclestatus" name="vehiclestatus" required>
                                        <option value="activo">Activo</option>
                                        <option value="en_mantenimiento"> En mantenimiento </option>
                                        <option value="fuera_de_servicio">Fuera de servicio</option>
                                    </select>
                                </div>
                                <h4>Información del conductor</h4>
                                <div class="form-group form-material">
                                    <label for="drivername">Nombre del conductor: </label>
                                    <input type="text" class="form-control" id="drivername" name="drivername" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="licensenumber">Número de licencia: </label>
                                    <input type="text" class="form-control" id="licensenumber" name="licensenumber" rquired>
                                </div>
                                <div class="form-group form-material">
                                    <label for="licenseexpiry"> Fecha de vencimiento de la licencia: </label>
                                    <input type="date" class="form-control" id="licenseexpiry" name="licenseexpiry" required>
                                </div>
                                <h4>Información del viaje</h4>
                                <div class="form-group form-material">
                                    <label for="tripnumber">Número de viaje: </label>
                                    <input type="text" class="form-control" id="tripnumber" name="tripnumber" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="departuredate"> Fecha y hora de salida: </label>
                                    <input type="datetime-local" class="form-control" id="departuredate" name="departuredate" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="arrivaldate">Fecha y hora estimada de llegada</label>
                                    <input type="datetime-local" class="form-control" id="arrivaldate" name="arrivaldate" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="origin">Punto de origen: </label>
                                    <input type="text" class="form-control" id="origin" name="origin" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="destination">Destino</label>
                                    <input type="text" class="form-control" id="destination" name="destination" required>
                                </div>
                                <div class="form-group form-material">
                                    <label for="route">Ruta planificada: </label>
                                    <textarea class="form-control" id="route" name="route" required></textarea>
                                </div>
                                <div class="form-group form-material">
                                    <label for="tripStatus">Estado del viaje: </label>
                                    <select class="form-control" id="tripstatus" name="tripstatus" required>
                                        <option value="en_curso">En curso</option>
                                        <option value="completado">Completado</option>
                                        <option value="cancelado">Cancelado</option>
                                    </select>
                                </div>
                                <h4>Información adicional</h4>
                                <div class="form-group form-material">
                                    <label for="notes"> Notas o comentarios: </label>
                                    <textarea class="form-control" id="notes" name="notes"></textarea>
                                </div>
                                <div class="form-group form-material">
                                    <label for="attachments"> Documentación adjuta: </label>
                                    <input type="file" class="form-control" id="attachments" name="attachments">
                                </div>
                                <div class='button center'>
                                    <input class="btn btn-success btn-sm" type="submit" name="simpan" value="Añadir datos" id="validateButton2">
                                </div>
                            </form>
                            <a href="<?php echo site_url(); ?>website/transport">
                                <button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
                                    <i class="icon wb-eye" aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>


<?php } ?>


<!----------------------------------------------------end view------------------------------------------------ -->