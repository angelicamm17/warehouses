<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			$data['dashboard_info']			= TRUE;
			$data['breadcrumb']				= 'Dashboard';
			$data['dashboard']				= 'admin/dashboard/statistik';
			$data['boxmenu']				= 'admin/boxmenu/setting';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '';
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("login");
		}
	 }
	 
	 //IDENTITAS
	 public function identitas($filter1='', $filter2='', $filter3='')
	 {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->admin_level_kode == 1) {
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
			$data['breadcrumb']				= 'System Identity';
			$data['content']				= 'admin/content/website/identitas';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '105';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('identitas_website'=>'Website Name',
													'identitas_deskripsi'=>'Description',
													'identitas_keyword'=>'Keyword',
													'identitas_notelp'=>'Telephone No',
													'identitas_email'=>'Email',
													'identitas_fb'=>'Facebook',
													'identitas_tw'=>'Twitter',
													'identitas_yb'=>'Youtube',													
													'identitas_favicon' => 'Favicon');
			if($data['action'] == 'view' ) {
				$data['berdasarkan']		= array('identitas_website'=>'System Identity');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'identitas_website';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_identitas[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_identitas('', $like_identitas);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah') {
				$data['onload']						= 'identitas_website';
				$data['identitas_website']			= ($this->input->post('identitas_website'))?$this->input->post('identitas_website'):'';
				$data['identitas_deskripsi']		= ($this->input->post('identitas_deskripsi'))?$this->input->post('identitas_deskripsi'):'';
				$data['identitas_keyword']			= ($this->input->post('identitas_keyword'))?$this->input->post('identitas_keyword'):'';
				$data['identitas_email']				= ($this->input->post('identitas_email'))?$this->input->post('identitas_email'):'';
				$data['identitas_fb']				= ($this->input->post('identitas_fb'))?$this->input->post('identitas_fb'):'';
				$data['identitas_tw']				= ($this->input->post('identitas_tw'))?$this->input->post('identitas_tw'):'';
				$data['identitas_gp']				= ($this->input->post('identitas_gb'))?$this->input->post('identitas_gp'):'';
				$data['identitas_yb']				= ($this->input->post('identitas_yb'))?$this->input->post('identitas_yb'):'';
				$data['identitas_favicon']			= ($this->input->post('identitas_favicon'))?$this->input->post('identitas_favicon'):'';
				$data['identitas_created']				= ($this->input->post('identitas_created'))?$this->input->post('identitas_created'):'';
				$data['identitas_updated']			= ($this->input->post('identitas_updated'))?$this->input->post('identitas_updated'):'';
				$simpan								=  $this->input->post('simpan');
				if($simpan) {
					$insert['identitas_website']	= validasi_sql($data['identitas_website']);
					$insert['identitas_deskripsi']	= validasi_sql($data['identitas_deskripsi']);
					$insert['identitas_keyword']	= validasi_sql($data['identitas_keyword']);
					$insert['identitas_notelp']		= validasi_sql($data['identitas_notelp']);
					$insert['identitas_email']		= validasi_sql($data['identitas_email']);
					$insert['identitas_fb']			= validasi_sql($data['identitas_fb']);
					$insert['identitas_tw']			= validasi_sql($data['identitas_tw']);
					$insert['identitas_gp']			= validasi_sql($data['identitas_gp']);
					$insert['identitas_yb']			= validasi_sql($data['identitas_yb']);
					$insert['identitas_favicon']	= validasi_sql($data['identitas_favicon']);
					$this->ADM->insert_identitas($insert);
					$this->session->set_flashdata('success','Identity data has been successfully added!,');
					redirect("website/identitas/edit/1");
				}
			} elseif ($data['action'] == 'edit') {
				$data['ckeditor']			= $this->ckeditor('identitas_deskripsi');
				$data['onload']					= 'identitas_website';
				$where_identitas['identitas_id']	= $filter2;
				$identitas						= $this->ADM->get_identitas('',$where_identitas);
				$data['identitas_id']			= ($this->input->post('identitas_id'))?$this->input->post('identitas_id'):$identitas->identitas_id;
				$data['identitas_website']		= ($this->input->post('identitas_website'))?$this->input->post('identitas_website'):$identitas->identitas_website;
				$data['identitas_deskripsi']	= ($this->input->post('identitas_deskripsi'))?$this->input->post('identitas_deskripsi'):$identitas->identitas_deskripsi;
				$data['identitas_keyword']		= ($this->input->post('identitas_keyword'))?$this->input->post('identitas_keyword'):$identitas->identitas_keyword;
				$data['identitas_alamat']		= ($this->input->post('identitas_alamat'))?$this->input->post('identitas_alamat'):$identitas->identitas_alamat;
				$data['identitas_notelp']		= ($this->input->post('identitas_notelp'))?$this->input->post('identitas_notelp'):$identitas->identitas_notelp;
				$data['identitas_email']		= ($this->input->post('identitas_email'))?$this->input->post('identitas_email'):$identitas->identitas_email;
				$data['identitas_fb']			= ($this->input->post('identitas_fb'))?$this->input->post('identitas_fb'):$identitas->identitas_fb;
				$data['identitas_tw']			= ($this->input->post('identitas_tw'))?$this->input->post('identitas_tw'):$identitas->identitas_tw;
				$data['identitas_gp']			= ($this->input->post('identitas_gp'))?$this->input->post('identitas_gp'):$identitas->identitas_gp;
				$data['identitas_yb']			= ($this->input->post('identitas_yb'))?$this->input->post('identitas_yb'):$identitas->identitas_yb;
				$data['identitas_favicon']		= ($this->input->post('identitas_favicon'))?$this->input->post('identitas_favicon'):$identitas->identitas_favicon;	
				$data['identitas_created']				= ($this->input->post('identitas_created'))?$this->input->post('identitas_created'):$identitas->identitas_created;
				$data['identitas_updated']			= ($this->input->post('identitas_updated'))?$this->input->post('identitas_updated'):$identitas->identitas_updated;
				$simpan							= $this->input->post('simpan');
				if($simpan) {			
					$config['upload_path']          = './assets/'; 
					$config['allowed_types']        = 'png|jpg|jpeg';
					$config['encrypt_name'] 		= TRUE;
					$config['max_size']             = 11000;
					$config['max_width']            = 4096;
					$config['max_height']           = 2048;
					
					$this->upload->initialize($config);
		
					$data['identitas_favicon']	= $gambar;
					$where_edit['identitas_id']				= validasi_sql($data['identitas_id']);
					$edit['identitas_website']				= validasi_sql($data['identitas_website']);
					$edit['identitas_deskripsi']			= validasi_sql($data['identitas_deskripsi']);
					$edit['identitas_keyword']				= validasi_sql($data['identitas_keyword']);
					$edit['identitas_alamat']				= validasi_sql($data['identitas_alamat']);
					$edit['identitas_notelp']				= validasi_sql($data['identitas_notelp']);
					$edit['identitas_email']				= validasi_sql($data['identitas_email']);
					$edit['identitas_fb']					= validasi_sql($data['identitas_fb']);
					$edit['identitas_tw']					= validasi_sql($data['identitas_tw']);
					$edit['identitas_gp']					= validasi_sql($data['identitas_gp']);
					$edit['identitas_yb']					= validasi_sql($data['identitas_yb']);		
					if ($this->upload->do_upload('identitas_favicon'))
					{
						@unlink('./assets/'.$row->identitas_favicon);

						$data = array('upload_data' => $this->upload->data());
						$edit['identitas_favicon'] 	= $this->upload->data('file_name');
					}
					
					$this->ADM->update_identitas($where_edit, $edit);
					$this->session->set_flashdata('success','Identity data has been successfully edited!,');
					redirect("website/identitas/edit/1");
				}
			} elseif ($data['action'] == 'hapus') {
				$where_delete['identitas_id']		= validasi_sql($filter2);
				$this->ADM->delete_identitas($where_delete);
				$this->session->set_flashdata('success','Identity data has been successfully deleted!,');
				redirect("website/identitas/edit/1");				
			}
		 
			$this->load->vars($data);
			$this->load->view('admin/home');
			} else {
				redirect("admin");	
			}
		 } else {
			 redirect("login");		 	
			}
	 }

	 
	 
	 //IDENTITAS
	 public function stock($filter1='', $filter2='', $filter3='')
	 {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user']		= $this->session->userdata('admin_user');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->admin_level_kode == 1) {
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
			$data['breadcrumb']				= 'Notificación de Existencias'; // Stock Notification
			$data['content']				= 'admin/content/website/stock';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '105';
			$data['action']					= (empty($filter1))?'view':$filter1;
			if($data['action'] == 'view' ) {
			
			} elseif ($data['action'] == 'tambah') {
			} elseif ($data['action'] == 'edit') {
				$data['onload']					= 'limitstock_id';
				$where_limitstock['limitstock_id']	= $filter2;
				$limitstock						= $this->ADM->get_limitstock('',$where_limitstock);
				$data['limitstock_id']			= ($this->input->post('limitstock_id'))?$this->input->post('limitstock_id'):$limitstock->limitstock_id;
				$data['stock']		= ($this->input->post('stock'))?$this->input->post('stock'):$limitstock->stock;
				$data['limitstock_created']				= ($this->input->post('limitstock_created'))?$this->input->post('limitstock_created'):$limitstock->limitstock_created;
				$data['limitstock_updated']			= ($this->input->post('limitstock_updated'))?$this->input->post('limitstock_updated'):$limitstock->limitstock_updated;
				$simpan							= $this->input->post('simpan');
				if($simpan) {			
					$where_edit['limitstock_id']				= validasi_sql($data['limitstock_id']);
					$edit['stock']				= validasi_sql($data['stock']);
					$this->ADM->update_limitstock($where_edit, $edit);
					$this->session->set_flashdata('success','Stock Notification Data has been successfully edited!,');
					redirect("website/stock/edit/1");
				}
			} elseif ($data['action'] == 'hapus') {
			}
		 
			$this->load->vars($data);
			$this->load->view('admin/home');
			} else {
				redirect("admin");	
			}
		 } else {
			 redirect("login");		 	
			}
	 }

	//FUNCTION MASTER BARANG
	public function barang($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Mercancía';
			$data['content'] 			= 'admin/content/website/barang';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('nama_barang'=>'Name',
												'merek'=>'Brand'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('nama_barang'=>'Nombre','merek'=>'Marca');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'nama_barang';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_barang[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_barang('', $like_barang);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
			if ($data['admin']->admin_level_kode == 1 || $data['admin']->admin_level_kode == 2) {
				$data['onload']				= 'barang';
				$data['nama_barang']	= ($this->input->post('nama_barang'))?$this->input->post('nama_barang'):'';
				$data['merek']	= ($this->input->post('merek'))?$this->input->post('merek'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$insert['nama_barang']			= validasi_sql($data['nama_barang']);
					$insert['merek']			= validasi_sql($data['merek']);
					$insert['stock']			= 0;
					$this->ADM->insert_barang($insert);
					$this->session->set_flashdata('success','New item has been successfully added!,');
					redirect("website/barang");	
				}
			} else {
				redirect("website/barang");	
			}
			} elseif ($data['action'] == 'edit'){
				if ($data['admin']->admin_level_kode == 1 || $data['admin']->admin_level_kode == 2) {
				$data['onload']				= 'nama_barang';
				$where_barang['id_barang']	= $filter2; 
				$barang				= $this->ADM->get_barang('*', $where_barang);
				$data['id_barang']	= ($this->input->post('id_barang'))?$this->input->post('id_barang'):$barang->id_barang;				
				$data['nama_barang']	= ($this->input->post('nama_barang'))?$this->input->post('nama_barang'):$barang->nama_barang;				
				$data['merek']	= ($this->input->post('merek'))?$this->input->post('merek'):$barang->merek;				
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$where_edit['id_barang']	= $data['id_barang'];
					$edit['nama_barang']	= $data['nama_barang'];
					$edit['merek']	= $data['merek'];
					$this->ADM->update_barang($where_edit, $edit);
					$this->session->set_flashdata('success','Item has been edited successfully!,');
					redirect("website/barang");
				}
				} else {
				redirect("website/barang");	
				}
			} elseif ($data['action'] == 'hapus'){
				if ($data['admin']->admin_level_kode == 1 || $data['admin']->admin_level_kode == 2) {
				$where_delete['id_barang']		= validasi_sql($filter2);
				$this->ADM->delete_barang($where_delete);
				$this->session->set_flashdata('success','Item has been successfully removed!,');
				redirect("website/barang");
				} else {
				redirect("website/barang");	
				}
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION MASTER SUPPLIER
	public function supplier($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Proveedor'; // Supplier
			$data['content'] 			= 'admin/content/website/supplier';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('nama_supplier'=>'Name'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('nama_supplier'=>'NOMBRE','alamat_supplier'=>'DIRECCIÓN','notelp_supplier'=>'NUM DE TELÉFONO');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'nama_supplier';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_supplier[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_supplier('', $like_supplier);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
			if ($data['admin']->admin_level_kode == 1) {
				$data['onload']				  = 'supplier';
				$data['nama_supplier']	      = ($this->input->post('nama_supplier'))?$this->input->post('nama_supplier'):'';
				$data['paternal_last_name']   = ($this->input->post('paternal_last_name'))?$this->input->post('paternal_last_name'):'';
				$data['maternal_last_name']   = ($this->input->post('maternal_last_name'))?$this->input->post('paternal_last_name'):'';
				$data['curp']                 = ($this->input->post('curp'))?$this->input->post('curp'):'';
				$data['commercial_name']      = ($this->input->post('commercial_name'))?$this->input->post('commercial_name'):'';
				$data['person_type']          = ($this->input->post('person_type'))?$this->input->post('person_type'):''; 
				$data['rfc']                  = ($this->input->post('rfc'))?$this->input->post('rfc'):'';
				$data['street']               = ($this->input->post('street'))?$this->input->post('street'):'';
				$data['num_ext']              = ($this->input->post('num_ext'))?$this->input->post('num_ext'):'';
				$data['num_in']               = ($this->input->post('num_in'))?$this->input->post('num_in'):'';
				$data['neighborhood']         = ($this->input->post('neighborhood'))?$this->input->post('neighborhood'):'';
				$data['locality']             = ($this->input->post('locality'))?$this->input->post('locality'):'';    
				$data['city']                 = ($this->input->post('city'))?$this->input->post('locality'):'';  
				$data['federal_entity']       = ($this->input->post('federal_entity'))?$this->input->post('federal_entity'):'';
				$data['cp']                   = ($this->input->post('cp'))?$this->input->post('cp'):'';
				$data['municipality']         = ($this->input->post('municipality'))?$this->input->post('municipality'):'';
				$data['email']                = ($this->input->post('email'))?$this->input->post('email'):'';
				$data['created_by']           = ($this->input->post('created_by'))?$this->input->post('created_by'):'';
				$date['status']               = ($this->input->post('status'))?$this->input->post('status'):''; 
				$data['modified_by']          = ($this->input->post('modified_by'))?$this->input->post('modified_by'):'';
				$data['disablement_date']     = ($this->input->post('disablement_date'))?$this->input->post('disablement_date'):''; 
				$data['disablement_reason']   = ($this->input->post('disablement_reason'))?$this->input->post('disablement_reason'):'';
				$data['notelp_supplier']	  = ($this->input->post('notelp_supplier'))?$this->input->post('notelp_supplier'):'';
				$simpan						  = $this->input->post('simpan');
				if ($simpan){
					$insert['nama_supplier']			= validasi_sql($data['nama_supplier']);
					$insert['paternal_last_name']       = validasi_sql($data['paternal_last_name']);
					$insert['maternal_last_name']       = validasi_sql($data['maternal_last_name']);
					$insert['curp']                     = validasi_sql($data['curp']);
					$insert['commercial_name']          = validasi_sql($data['commercial_name']);
					$insert['person_type']              = validasi_sql($data['person_type']);  
					$insert['rfc']                      = validasi_sql($data['rfc']);
					$insert['street']                   = validasi_sql($data['street']);
					$insert['num_ext']                  = validasi_sql($data['num_ext']);    
					$insert['num_in']                   = validasi_sql($data['num_in']);
					$insert['neighborhood']             = validasi_sql($data['neighborhood']);  
					$insert['locality']                 = validasi_sql($data['locality']);
					$insert['city']                     = validasi_sql($data['city']);
					$insert['federal_entity']           = validasi_sql($data['federal_entity']);
					$insert['cp']                       = validasi_sql($data['cp']);
					$insert['municipality']             = validasi_sql($data['municipality']);
					$insert['email']                    = validasi_sql($data['email']);
					$insert['created_by']               = validasi_sql($data['created_by']);
					$insert['status']                   = validasi_sql($data['status']);
					$insert['modified_by']              = validasi_sql($data['modified_by']);
					$insert['disablement_date']         = validasi_sql($data['disablement_date']);
					$insert['disablement_reason']       = validasi_sql($date['disablement_reason']); 
 					$insert['notelp_supplier']		 	= validasi_sql($data['notelp_supplier']);
					$this->ADM->insert_supplier($insert);
					$this->session->set_flashdata('success','New supplier has been added successfully,');
					redirect("website/supplier");	
				}
			} else {
				redirect("website/supplier");	
			}
			} elseif ($data['action'] == 'edit'){
				if ($data['admin']->admin_level_kode == 1) {
				$data['onload']				= 'nama_supplier';
				$where_supplier['id_supplier']	= $filter2; 
				$supplier				= $this->ADM->get_supplier('*', $where_supplier);
				$data['id_supplier']	= ($this->input->post('id_supplier'))?$this->input->post('id_supplier'):$supplier->id_supplier;				
				$data['nama_supplier']	= ($this->input->post('nama_supplier'))?$this->input->post('nama_supplier'):$supplier->nama_supplier;				
				$data['alamat_supplier']	= ($this->input->post('alamat_supplier'))?$this->input->post('alamat_supplier'):$supplier->alamat_supplier;							
				$data['notelp_supplier']	= ($this->input->post('notelp_supplier'))?$this->input->post('notelp_supplier'):$supplier->notelp_supplier;				
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$where_edit['id_supplier']	= $data['id_supplier'];
					$edit['nama_supplier']	= $data['nama_supplier'];
					$edit['alamat_supplier']	= $data['alamat_supplier'];
					$edit['notelp_supplier']	= $data['notelp_supplier'];
					$this->ADM->update_supplier($where_edit, $edit);
					$this->session->set_flashdata('success','Supplier has been successfully edited!,');
					redirect("website/supplier");
				}
				} else {
				redirect("website/supplier");	
				}
			} elseif ($data['action'] == 'hapus'){
				if ($data['admin']->admin_level_kode == 1) {
				$where_delete['id_supplier']		= validasi_sql($filter2);
				$this->ADM->delete_supplier($where_delete);
				$this->session->set_flashdata('success','The supplier has been successfully removed!,');
				redirect("website/supplier");
				} else {
				redirect("website/supplier");	
				}
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION MASTER CUSTOMER
	public function customer($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Cliente';
			$data['content'] 			= 'admin/content/website/customer';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('nama_customer'=>'Name'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('nama_customer'=>'NOMBRE','alamat_customer'=>'DIRECCIÓN','notelp_customer'=>'NUM DE TELÉFONO');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'nama_customer';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_customer[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_customer('', $like_customer);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
			if ($data['admin']->admin_level_kode == 1) {
				$data['onload']				= 'customer';
				$data['nama_customer']	= ($this->input->post('nama_customer'))?$this->input->post('nama_customer'):'';
				$data['alamat_customer']	= ($this->input->post('alamat_customer'))?$this->input->post('alamat_customer'):'';
				$data['notelp_customer']	= ($this->input->post('notelp_customer'))?$this->input->post('notelp_customer'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$insert['nama_customer']			= validasi_sql($data['nama_customer']);
					$insert['alamat_customer']			= validasi_sql($data['alamat_customer']);
					$insert['notelp_customer']			= validasi_sql($data['notelp_customer']);
					$this->ADM->insert_customer($insert);
					$this->session->set_flashdata('success','New customer has been added successfully!,');
					redirect("website/customer");	
				}
			} else {
				redirect("website/customer");	
			}
			} elseif ($data['action'] == 'edit'){
				if ($data['admin']->admin_level_kode == 1) {
				$data['onload']				= 'nama_customer';
				$where_customer['id_customer']	= $filter2; 
				$customer				= $this->ADM->get_customer('*', $where_customer);
				$data['id_customer']	= ($this->input->post('id_customer'))?$this->input->post('id_customer'):$customer->id_customer;				
				$data['nama_customer']	= ($this->input->post('nama_customer'))?$this->input->post('nama_customer'):$customer->nama_customer;				
				$data['alamat_customer']	= ($this->input->post('alamat_customer'))?$this->input->post('alamat_customer'):$customer->alamat_customer;							
				$data['notelp_customer']	= ($this->input->post('notelp_customer'))?$this->input->post('notelp_customer'):$customer->notelp_customer;				
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$where_edit['id_customer']	= $data['id_customer'];
					$edit['nama_customer']	= $data['nama_customer'];
					$edit['alamat_customer']	= $data['alamat_customer'];
					$edit['notelp_customer']	= $data['notelp_customer'];
					$this->ADM->update_customer($where_edit, $edit);
					$this->session->set_flashdata('success','Customer has been successfully edited!,');
					redirect("website/customer");
				}
				} else {
				redirect("website/customer");	
				}
			} elseif ($data['action'] == 'hapus'){
				if ($data['admin']->admin_level_kode == 1) {
				$where_delete['id_customer']		= validasi_sql($filter2);
				$this->ADM->delete_customer($where_delete);
				$this->session->set_flashdata('success','The customer has been successfully deleted!,');
				redirect("website/customer");
				} else {
				redirect("website/customer");	
				}
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION TRANSACTION Incoming Goods
	
	/*public function masuk($filter1='', $filter2='', $filter3='') {
		if ($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user'] = $this->session->userdata('admin_user');
			$data['admin'] = $this->ADM->get_admin('', $where_admin);
			$data['web'] = $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info'] = FALSE;
			$data['breadcrumb'] = 'Mercancías entrantes';
			$data['content'] = 'admin/content/website/masuk';
			$data['menu_terpilih'] = '1';
			$data['submenu_terpilih'] = '13';
			$data['action'] = (empty($filter1)) ? 'view' : $filter1;
			$data['validate'] = array('id_barang' => 'Item name');
			if ($data['action'] == 'view') {
				$data['berdasarkan'] = array('id_barang' => 'Nombre de producto');
				$data['cari'] = ($this->input->post('cari')) ? $this->input->post('cari') : 'id_barang';
				$data['q'] = ($this->input->post('q')) ? $this->input->post('q') : '';
				$data['halaman'] = (empty($filter2)) ? 1 : $filter2;
				$data['batas'] = 10;
				$data['page'] = ($data['halaman'] - 1) * $data['batas'];
				$like_transaksi[$data['cari']] = $data['q'];
				$where_transaksi['status_pergerakan'] = 1;
				$data['jml_data'] = $this->ADM->count_all_transaksi($where_transaksi, $like_transaksi);
				$data['jml_halaman'] = ceil($data['jml_data'] / $data['batas']);
			} elseif ($data['action'] == 'tambah') {
				if ($data['admin']->admin_level_kode == 1 || $data['admin']->admin_level_kode == 2) {
					$data['onload'] = 'supplier';
					if ($this->input->post('newRow')) {
						$newRows = $this->input->post('newRow');
						foreach ($newRows as $row) {
							$insert['id_barang'] = validasi_sql($row['id_barang']);
							$insert['id_supplier'] = validasi_sql($row['id_supplier']);
							$insert['quantity'] = validasi_sql($row['quantity']);
							$insert['pallet'] = validasi_sql($row['pallet']);
							$insert['measurement_unit'] = validasi_sql($row['measurement_unit']);
							$insert['admin_user'] = $this->session->userdata('admin_user');
							$insert['status_pergerakan'] = 1;
							$this->ADM->insert_transaksi($insert);
	
							$where_barang['id_barang'] = $row['id_barang'];
							$barang = $this->ADM->get_barang('*', $where_barang);
	
							$where_edit['id_barang'] = $row['id_barang'];
							$edit['stock'] = $barang->stock + $row['quantity'];
	
							$this->ADM->update_barang($where_edit, $edit);
						}
						$this->session->set_flashdata('success', 'New Incoming Item has been added successfully!');
						redirect("website/masuk/tambah");
					}
				} else {
					redirect("website/masuk");
				}
			} elseif ($data['action'] == 'hapus') {
				$where_delete['id_transaksi'] = validasi_sql($filter2);
				$this->ADM->delete_transaksi($where_delete);
				$this->session->set_flashdata('success', 'Incoming Item has been successfully removed!');
				redirect("website/masuk");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}*/
	
	
	

	//FUNCTION GOODS TRANSACTION OUT
	public function masuk($filter1='', $filter2='', $filter3='') {
		if ($this->session->userdata('logged_in') == TRUE) {
			$where_admin['admin_user'] = $this->session->userdata('admin_user');
			$data['admin'] = $this->ADM->get_admin('', $where_admin);
			$data['web'] = $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info'] = FALSE;
			$data['breadcrumb'] = 'Mercancías entrantes';
			$data['content'] = 'admin/content/website/masuk';
			$data['menu_terpilih'] = '1';
			$data['submenu_terpilih'] = '13';
			$data['action'] = (empty($filter1)) ? 'view' : $filter1;
			$data['validate'] = array('id_barang' => 'Item name');
			if ($data['action'] == 'view') {
				$data['berdasarkan'] = array('id_barang' => 'Nombre de producto');
				$data['cari'] = ($this->input->post('cari')) ? $this->input->post('cari') : 'id_barang';
				$data['q'] = ($this->input->post('q')) ? $this->input->post('q') : '';
				$data['halaman'] = (empty($filter2)) ? 1 : $filter2;
				$data['batas'] = 10;
				$data['page'] = ($data['halaman'] - 1) * $data['batas'];
				$like_transaksi[$data['cari']] = $data['q'];
				$where_transaksi['status_pergerakan'] = 1;
				$data['jml_data'] = $this->ADM->count_all_transaksi($where_transaksi, $like_transaksi);
				$data['jml_halaman'] = ceil($data['jml_data'] / $data['batas']);
			} elseif ($data['action'] == 'tambah') {
				if ($data['admin']->admin_level_kode == 1 || $data['admin']->admin_level_kode == 2) {
					$data['onload'] = 'supplier';
					if ($this->input->post('newRow')) {
						$newRows = $this->input->post('newRow');
						foreach ($newRows as $row) {
							$insert['id_barang'] = validasi_sql($row['id_barang']);
							$insert['id_supplier'] = validasi_sql($row['id_supplier']);
							$insert['quantity'] = validasi_sql($row['quantity']);
							$insert['pallet'] = validasi_sql($row['pallet']);
							$insert['measurement_unit'] = validasi_sql($row['measurement_unit']);
							$insert['admin_user'] = $this->session->userdata('admin_user');
							$insert['status_pergerakan'] = 1;
							
							// Cálculo del total
							$insert['jumlah'] = $row['quantity'] * $row['pallet'];
							
							$this->ADM->insert_transaksi($insert);
	
							$where_barang['id_barang'] = $row['id_barang'];
							$barang = $this->ADM->get_barang('*', $where_barang);
	
							$where_edit['id_barang'] = $row['id_barang'];
							$edit['stock'] = $barang->stock + $row['quantity'];
	
							$this->ADM->update_barang($where_edit, $edit);
						}
						$this->session->set_flashdata('success', 'New Incoming Item has been added successfully!');
						redirect("website/masuk/tambah");
					}
				} else {
					redirect("website/masuk");
				}
			} elseif ($data['action'] == 'hapus') {
				$where_delete['id_transaksi'] = validasi_sql($filter2);
				$this->ADM->delete_transaksi($where_delete);
				$this->session->set_flashdata('success', 'Incoming Item has been successfully removed!');
				redirect("website/masuk");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	
	
	public function keluar($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Mercancías salientes';
			$data['content'] 			= 'admin/content/website/keluar';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('id_barang'=>'Item name'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('id_barang'=>'Nombre de producto');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'id_barang';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_transaksi[$data['cari']]	= $data['q'];
				$where_transaksi['status_pergerakan'] 	= 2;
				$data['jml_data']			= $this->ADM->count_all_transaksi($where_transaksi, $like_transaksi);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			} elseif ($data['action'] == 'tambah'){
			if ($data['admin']->admin_level_kode == 1 || $data['admin']->admin_level_kode == 2) {
				$data['onload']				= 'supplier';
				$data['id_barang']	= ($this->input->post('id_barang'))?$this->input->post('id_barang'):'';
				$data['id_customer']	= ($this->input->post('id_customer'))?$this->input->post('id_customer'):'';
				$data['jumlah']	= ($this->input->post('jumlah'))?$this->input->post('jumlah'):'';
				$simpan						= $this->input->post('simpan');
				if ($simpan){
					$where_barang['id_barang']	= $data['id_barang']; 
					$barang	= $this->ADM->get_barang('*', $where_barang);

					$where_limitstock['limitstock_id']	= 1; 
					$limitstock	= $this->ADM->get_limitstock('*', $where_limitstock);
					
					if ($barang->stock >= $data['jumlah']) {
					$insert['id_barang']			= validasi_sql($data['id_barang']);
					$insert['id_customer']			= validasi_sql($data['id_customer']);
					$insert['jumlah']				= validasi_sql($data['jumlah']);
					$insert['admin_user']			= $this->session->userdata('admin_user');
					$insert['status_pergerakan']	= 2;
					$this->ADM->insert_transaksi($insert);


					$where_edit['id_barang']	= $data['id_barang'];
					$edit['stock']	= $barang->stock - $data['jumlah'] ;
					$this->ADM->update_barang($where_edit, $edit);

if ($barang->stock <= $limitstock->stock) {
					$message = "Stock with products ".$barang->nama_barang." less than the minimum stock limit"; 
					$user_id = 4444;
					$url = "https://www.wms.ngodings.com";
					$headings = "WMS - Stock Warning";
					$img = "https://www.wms.ngodings.com/assets/3691adaa4a69024b73dc5c1ddb3c43ea.png";
					
					
					$content = array(
						"en" => "$message"
					);
					$headings = array(
						"en" => "$headings"
					);
					$fields = array(
						'app_id' => "13219ce1-3c03-40bb-9043-13325e84a94c",
						'filters' => array(array("field" => "tag", "key" => "user_id", "relation" => "=", "value" => "$user_id")),
						'url' => $url,
						'contents' => $content,
						'chrome_web_icon' => $img,
						'headings' => $headings
					);
					$fields = json_encode($fields);
					print("\nJSON sent:\n");
					print($fields);
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
						'Authorization: Basic ZTE1NzBjY2MtMTE1YS00NjA0LTllNzctNTJjNTZmZGU0YmFm'));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
					curl_setopt($ch, CURLOPT_HEADER, FALSE);
					curl_setopt($ch, CURLOPT_POST, TRUE);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					$response = curl_exec($ch);
					curl_close($ch);
}

					$this->session->set_flashdata('success','¡El nuevo producto de salida se ha añadido correctamente!'); // New Exit Item has been successfully added!
					redirect("website/keluar");	
					} else {
						$this->session->set_flashdata('error','¡Stock de productos insuficiente!'); // Insufficient stock of goods!
						redirect("website/keluar");	
					}
				}
			} else {
				redirect("website/keluar");	
			}
			
		} elseif ($data['action'] == 'hapus'){
			$where_delete['id_transaksi']		= validasi_sql($filter2);
			$this->ADM->delete_transaksi($where_delete);
			$this->session->set_flashdata('success','Outgoing Item has been successfully removed!');
			redirect("website/keluar");
		
		}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION TRANSACTION ADJUSTMENT
	public function penyesuaian($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Ajustamiento';
			$data['content'] 			= 'admin/content/website/penyesuaian';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('id_barang'=>'Item name'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('id_barang'=>'Nombre de producto');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'id_barang';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_transaksi[$data['cari']]	= $data['q'];
				$data['jml_data']			= $this->ADM->count_all_transaksi('', $like_transaksi);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			
			} elseif ($data['action'] == 'hapus'){
				$where_delete['id_transaksi']		= validasi_sql($filter2);
				$this->ADM->delete_transaksi($where_delete);
				$this->session->set_flashdata('success','Item has been successfully deleted!');
				redirect("website/penyesuaian");
			
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	//FUNCTION INCOMING GOODS REPORT
	public function laporanmasuk($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Reporte de Mercancía Entrante'; //Incoming Goods Report
			$data['content'] 			= 'admin/content/website/laporanmasuk';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('id_barang'=>'Item name' // Item name
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('id_barang'=>'ITEM NAME');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'id_barang';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_transaksi[$data['cari']]	= $data['q'];
				$where_transaksi['status_pergerakan'] 	= 1;
				$data['jml_data']			= $this->ADM->count_all_transaksi($where_transaksi, $like_transaksi);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	public function laporanmasukpdf(){
		$web					= $this->ADM->identitaswebsite();
		$where_admin['admin_user']		= $this->session->userdata('admin_user');
		$data['admin']					= $this->ADM->get_admin('',$where_admin);
   		$data['title'] = 'Print PDF of Incoming Items'; 
   		$where_transaksi['status_pergerakan'] 	= 1;
   		$data['jml_data']			= $this->ADM->count_all_transaksi($where_transaksi, '');
		// echo PDF_HEADER_LOGO;exit;
   		$this->load->view('admin/content/website/pdf/laporanmasuk', $data);
   		$html = $this->output->get_output();
		// set document information
		$this->tcpdf->SetCreator(PDF_CREATOR);
		$this->tcpdf->SetAuthor('-----');
		$this->tcpdf->SetTitle('Incoming Items');
		$this->tcpdf->SetSubject('Incoming Item');

		$this->tcpdf->SetHeaderData('', 33.33, $web->identitas_deskripsi, "");
		$this->tcpdf->AddPage();
		$this->tcpdf->writeHTML($html, true, false, true, false, '');
		$this->tcpdf->LastPage();
		$this->tcpdf->Output('Incoming_Goods_Report.pdf', 'I');

		
	}

	//FUNCTION EXIT GOODS REPORT
	public function laporankeluar($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Reporte de Mercancía saliente';
			$data['content'] 			= 'admin/content/website/laporankeluar';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('id_barang'=>'Item name'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('id_barang'=>'ITEM NAME');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'id_barang';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_transaksi[$data['cari']]	= $data['q'];
				$where_transaksi['status_pergerakan'] 	= 2;
				$data['jml_data']			= $this->ADM->count_all_transaksi($where_transaksi, $like_transaksi);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}

	public function laporankeluarpdf(){
		$where_admin['admin_user']		= $this->session->userdata('admin_user');
		$data['admin']					= $this->ADM->get_admin('',$where_admin);
   		$this->load->library('dompdf_gen');
   		$data['title'] = 'Cetak PDF Barang Keluar'; 
   		$where_transaksi['status_pergerakan'] 	= 2;
   		$data['jml_data']			= $this->ADM->count_all_transaksi($where_transaksi, '');

   		$this->load->view('admin/content/website/pdf/laporankeluar', $data);
   		$paper_size  = 'A4'; //paper size
   		$orientation = 'landscape'; //tipe format kertas
   		$html = $this->output->get_output();
		$web = $this->ADM->identitaswebsite();

		$this->tcpdf->SetCreator(PDF_CREATOR);
		$this->tcpdf->SetAuthor('-----');
		$this->tcpdf->SetTitle('Outgoing Items');
		$this->tcpdf->SetSubject('Outgoing Item');

		$this->tcpdf->SetHeaderData('', 33.33, $web->identitas_deskripsi, "");
		$this->tcpdf->AddPage();
		$this->tcpdf->writeHTML($html, true, false, true, false, '');
		$this->tcpdf->LastPage();
		$this->tcpdf->Output('Outgoing_Goods_Report.pdf', 'I');
	}

	//FUNCTION LAPORAN PENYESUAIAN
	public function laporanpenyesuaian($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Reporte de ajustamiento';
			$data['content'] 			= 'admin/content/website/laporanpenyesuaian';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('id_barang'=>'Item name'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']		= array('id_barang'=>'ITEM NAME');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'id_barang';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_transaksi[$data['cari']]	= $data['q'];
				$where_transaksi['status_pergerakan'] 	= 2;
				$data['jml_data']			= $this->ADM->count_all_transaksi($where_transaksi, $like_transaksi);
				$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	//************************************************/
	//***********************************************/
	public function transport($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_user'] 	= $this->session->userdata('admin_user');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			$data['web']					= $this->ADM->identitaswebsite();
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']		= FALSE;
			$data['breadcrumb']				= 'Registro de transporte';
			$data['content'] 			= 'admin/content/website/transport';
			$data['menu_terpilih']		= '1';
			$data['submenu_terpilih']	= '13';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$data['validate']			= array('platenumber'=>'number'
											);
			if ($data['action'] == 'view'){
				$data['berdasarkan']      = array('platenumber'=>'NÚMERO DE PLACA','drivername'=>'NOMBRE DEL CONDUCTOR', 'licensenumber'=>'NÚMERO DE LICENCIA');
				$data['cari']             = ($this->input->post('cari'))?$this->input->post('cari'):'platenumber';
				$data['q']                = ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']          = (empty($filter2))?1:$filter2;
				$data['batas']            = 10;
				$data['page']             = ($data['halaman']-1) * $data['batas'];
				$like_transport[$data['cari']]      =      $data['q'];
				$data['jml_data']                   =      $this->ADM->count_all_transport('',$like_transport);
				$data['jml_halaman']                =      ceil($data['jml_data']/$data['batas']);
				//$data['berdasarkan'] = array('id_transport'=>)
			} elseif ($data['action'] == 'trans'){
			if ($data['admin']->admin_level_kode == 1) {
				$data['onload'] = 'transport';
				$data['platenumber'] = ($this->input->post('platenumber'))?$this->input->post('platenumber'):'';
				$data['vehicletype'] = ($this->input->post('vehicletype'))?$this->input->post('vehicletype'):'';
				$data['loadcapacity'] = ($this->input->post('loadcapacity'))?$this->input->post('loadcapacity'):'';
				$data['vehiclemodel'] = ($this->input->post('vehiclemodel'))?$this->input->post('vehiclemodel'):'';
				$data['vehiclestatus'] = ($this->input->post('vehiclestatus'))?$this->input->post('vehiclestatus'):'';
				$data['drivername']  = ($this->input->post('drivername'))?$this->input->post('drivername'):'';
				$data['licensenumber'] = ($this->input->post('licensenumber'))?$this->input->post('licensenumber'):'';
				$data['licenseexpiry'] = ($this->input->post('licenseexpiry'))?$this->input->post('licenseexpiry'):'';
				$data['tripnumber'] = ($this->input->post('tripnumber'))?$this->input->post('tripnumber'):'';
				$data['departuredate'] = ($this->input->post('departuredate'))?$this->input->post('departuredate'):'';
				$data['arrivaldate'] = ($this->input->post('arrivaldate'))?$this->input->post('arrivaldate'):'';
				$data['origin'] = ($this->input->post('origin'))?$this->input->post('origin'):'';
				$data['destination'] = ($this->input->post('destination'))?$this->input->post('destination'):'';
				$data['route'] = ($this->input->post('route'))?$this->input->post('route'):'';
				$data['tripstatus'] = ($this->input->post('tripstatus'))?$this->input->post('tripstatus'):'';
				$data['notes'] = ($this->input->post('notes'))?$this->input->post('notes'):'';
				$data['attachments'] = ($this->input->post('attachments'))?$this->input->post('attachments'):'';
				$simpan              = $this->input->post('simpan');
				if ($simpan){
					$insert['platenumber']          = validasi_sql($data['platenumber']);
					$insert['vehicletype']          = validasi_sql($data['vehicletype']);
					$insert['loadcapacity']         = validasi_sql($data['loadcapacity']);
					$insert['vehiclemodel']         = validasi_sql($data['vehiclemodel']);
					$insert['vehiclestatus']        = validasi_sql($data['vehiclestatus']);
					$insert['drivername']           = validasi_sql($data['drivername']);
					$insert['licensenumber']        = validasi_sql($data['licensenumber']);
					$insert['licenseexpiry']        = validasi_sql($data['licenseexpiry']);
					$insert['tripnumber']           = validasi_sql($data['tripnumber']);
					$insert['departuredate']        = validasi_sql($data['departuredate']);
					$insert['arrivaldate']          = validasi_sql($data['arrivaldate']);
					$insert['origin']               = validasi_sql($data['origin']);
					$insert['destination']          = validasi_sql($data['destination']);
					$insert['route']                = validasi_sql($data['route']);
					$insert['tripstatus']           = validasi_sql($data['tripstatus']);
					$insert['notes']                = validasi_sql($data['notes']);
					$insert['attachments']          = validasi_sql($data['attachments']);
					$this->ADM->insert_transport($insert);
					$this->session->set_flashdata('success', 'New transport has been added successfully!,');
					redirect("website/transport");
				}
			}	
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("wp_login");
		}
	}
	//************************************************//

	public function laporanpenyesuaianpdf(){
		$where_admin['admin_user']		= $this->session->userdata('admin_user');
		$data['admin']					= $this->ADM->get_admin('',$where_admin);
   		$this->load->library('dompdf_gen');
   		$data['title'] = 'Print PDF of Incoming & Outgoing Items'; 
   		$data['jml_data']			= $this->ADM->count_all_transaksi('', '');
   		$this->load->view('admin/content/website/pdf/laporanpenyesuaian', $data);
   		$html = $this->output->get_output();
   		// exit;

		$web = $this->ADM->identitaswebsite();

		$this->tcpdf->SetCreator(PDF_CREATOR);
		$this->tcpdf->SetAuthor('-----');
		$this->tcpdf->SetTitle('In an d Out Items');
		$this->tcpdf->SetSubject('In an d Out Item');

		$this->tcpdf->SetHeaderData('', 33.33, $web->identitas_deskripsi, "");
		$this->tcpdf->AddPage();
		$this->tcpdf->writeHTML($html, true, false, true, false, '');
		$this->tcpdf->LastPage();
		$this->tcpdf->Output('in&outgoods.pdf', 'I');
	}

  //CKEDITOR
  private function ckeditor($text) {
		return '
		<script type="text/javascript" src="'.base_url().'editor/ckeditor.js"></script>
		<script type="text/javascript">
		var editor = CKEDITOR.replace("'.$text.'",
		{
			filebrowserBrowseUrl 	  : "'.base_url().'finder/ckfinder.html",
			filebrowserImageBrowseUrl : "'.base_url().'finder/ckfinder.html?Type=Images",
			filebrowserFlashBrowseUrl : "'.base_url().'finder/ckfinder.html?Type=Flash",
			filebrowserUploadUrl 	  : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Files",
			filebrowserImageUploadUrl : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Images",
			filebrowserFlashUploadUrl : "'.base_url().'finder/core/connector/php/connector.php?command=QuickUpload&type=Flash",
			filebrowserWindowWidth    : 900,
			filebrowserWindowHeight   : 700,
			toolbarStartupExpanded 	  : false,
			height					  : 400	
		}
		);
	</script>';
	}
	 
}