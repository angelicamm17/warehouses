                   
<script type="text/javascript">
function checkPass(){
	//Store the password field objects into variables ...
	var pass1 = document.getElementById('admin_pass');
	var pass2 = document.getElementById('admin_pass_ulang');
	//Store the Confimation Message Object ...
	var message = document.getElementById('confirmMessage');
	//Set the colors we will be using ...
	var goodColor = "#66cc66";
	var badColor = "#ff6666";
	//Compare the values in the password field 
	//and the confirmation field
	if(pass1.value == pass2.value){
		//The passwords match. 
		//Set the color to the good color and inform
		//the user that they have entered the correct password 
		//pass2.style.backgroundColor = goodColor;
		message.style.color = goodColor;
		message.innerHTML = "Password Correct!"
	}else{
		//The passwords do not match.
		//Set the color to the bad color and
		//notify the user.
		//pass2.style.backgroundColor = badColor;
		message.style.color = badColor;
		message.innerHTML = "Password Incompatible!"
	}
}  
</script>
<style type="text/css">
#formMenu .short{color:#FF0000;}
#formMenu .short_param{width:25px;background:#FF0000;}
#formMenu .weak{color:#E66C2C;}
#formMenu .weak_param{width:50px;background:#E66C2C;}
#formMenu .good{color:#2D98F3; }
#formMenu .good_param{width:75px;background:#2D98F3;}
#formMenu .strong{color:#006400;}
#formMenu .strong_param{width:100px;background:#006400;}
</style>
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
                        <h5 class="panel-title">Editar contraseña</h5>
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
                    <div class="panel-body container-fluid">
                        <form action="<?php echo site_url();?>pengaturan/edit_password/<?php echo $admin_user;?>" method="post" enctype="multipart/form-data" id="exampleStandardForm"
                            autocomplete="off">
                            <input type="hidden" name="admin_user" value="<?php echo $admin_user;?>" />
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Contraseña actual</label> <!--Current Password-->
                                <input type="password" class="form-control input-sm" id="admin_pass_recent" name="admin_pass_recent" placeholder="Ingrese la contraseña actual" required /> <!--Enter Current Password-->
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Nueva contraseña</label>
                                <input type="password" class="form-control input-sm" id="admin_pass" name="admin_pass" placeholder="Ingrese la nueva contraseña" required /> <!--Enter new password-->
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Repetir contraseña</label> <!--Repeat Password-->
                                <input type="password" class="form-control input-sm" id="admin_pass_ulang" name="admin_pass_ulang" placeholder="Repetir contraseña" required /> <!--Repeat Password-->
                            </div>
                            <div class='button center'>
                                <input class="btn btn-success btn-sm" type="submit" name="simpan" value="Actualizar contraseña" id="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>