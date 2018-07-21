<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}
// form
	public function userlog(){

		$this->load->view('login');

		// data['database'] = $this->mobil_model->get_all_data();
	}

	public function login(){
		$this->validasilogin();
		if($this->form_validation->run() === FALSE)
		{
			$this->index();
		}
		else
		{
		$username = $this->input->post('usernm');
		$pass = $this->input->post('pwd');
		if(strcmp($username, "bendahara")==0){
			$level = "admin";
		}else{
			$level = "user";
		}
		if($this->admin_model->m_login($username,$pass)== 1) {
			$userdata = array(
				'usernm' =>$username,
				'logged_in' => TRUE,
				'level' => $level
				);
			$this->session->set_userdata($userdata);
			echo $this->session->userdata('level');
			if(strcmp($this->session->userdata('level'), "admin")==0){
					redirect('home/formdeber');
			}else{
				redirect('home/index');
			}


		}
	
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		//redirect('home/login');
		$this->load->view('login');
	}

	public function index(){
		
			$data['debetku'] = $this->admin_model->get_datadebet();
			$data['kreditku'] = $this->admin_model->get_datakredit();
			$data['usn']=$this->session->userdata('usernm');
			$this->load->view('main',$data);
			
	}

	public function formdeber(){
	$data['debetku'] = $this->admin_model->get_datadebet();
		$data['kreditku'] = $this->admin_model->get_datakredit();
		$data['status']="add";
	$this->load->view('form_debet',$data);
	}

	public function formkredit(){
	$data['debetku'] = $this->admin_model->get_datadebet();
		$data['kreditku'] = $this->admin_model->get_datakredit();
		$data['status']="add";
	$this->load->view('form_kredit',$data);
	}

	public function debet($stats){

		$this->validasidebet();
		if($this->form_validation->run() === FALSE)
		{
			$this->index();
		}
		else
		{
			if(strcmp($stats, "add")==0){
			$this->admin_model->tambah_debet();
			}else{
			$this->admin_model->update_debet();
			}
			redirect('home/index');
		}
	}

		public function kredit($stats){

		$this->validasikredit();
		if($this->form_validation->run() === FALSE)
		{
			$this->index();
		}
		else
		{
			if(strcmp($stats, "add")==0){
			$this->admin_model->tambah_kredit();
			}else{
			$this->admin_model->update_kredit();
			}
			redirect('home/index');
		}
	}

	public function hapusdebet($id){
		$this->admin_model->hapus_debet($id);
	 	redirect('/home/');
	}

	public function hapuskredit($id){
		$this->admin_model->hapus_kredit($id);
	 	redirect('/home/');
	}

	public function editdebet($id){
		$data['edt']=$this->admin_model->select_debet($id);
		$data['status']="edit";
		$this->load->view('debet_form',$data);
	 	// redirect('/home/',);
	}

	public function editkredit($id){
		$data['edt']=$this->admin_model->select_kredit($id);
		$data['status']="edit";
		$this->load->view('form_kredit',$data);
	 	// redirect('/home/',);
	}

public function validasilogin()
	{
		$this->form_validation->set_message('required', '{field} tidak boleh kosong');

		$config = [[
					'field' => 'usernm',
					'label' => 'usernm',
					'rules' => 'required'
				],
				[
					'field' => 'pwd',
					'label' => 'pwd',
					'rules' => 'required'
				]
				];

		$this->form_validation->set_rules($config);
	}

	public function validasidebet()
	{
		$this->form_validation->set_message('required', '{field} tidak boleh kosong');

		$config = [[
					'field' => 'id_debet',
					'label' => 'Id_debet',
					
				],
				[
					'field' => 'ket',
					'label' => 'Keterangan',
					'rules' => 'required'
				],
				[
					'field' => 'jml',
					'label' => 'Jumlah',
					'rules' => 'required'
				],
				[
					'field' => 'tgl',
					'label' => 'Tanggal',
				
				]];

		$this->form_validation->set_rules($config);
	}

	public function validasikredit()
	{
		$this->form_validation->set_message('required', '{field} tidak boleh kosong');

		$config = [[
					'field' => 'id_kredit',
					'label' => 'Id_kredit',
					
				],
				[
					'field' => 'ket',
					'label' => 'Keterangan',
					'rules' => 'required'
				],
				[
					'field' => 'jml',
					'label' => 'Jumlah',
					'rules' => 'required'
				],
				[
					'field' => 'tgl',
					'label' => 'Tanggal',
				
				]];

		$this->form_validation->set_rules($config);
	}

	// /*public function index($page = 'home_view')
	// {
	// 	if(! file_exists(APPPATH.'views/'.$page.'.php'))
	// 	{
	// 		show_404();
	// 	}

	// 	$data['title'] = 'Beranda';
	// 	$data['jembut'] = 'LOL';

	// 	$this->load->view($page, $data);
	// }

	// public function about($page = 'about')
	// {
	// 	if(! file_exists(APPPATH.'views/'.$page.'.php'))
	// 	{
	// 		show_404();
	// 	}

	// 	$data['title'] = 'About';

	// 	$this->load->view($page, $data);
	// }*/

	// public function lihatdata()
	// {
	// 	$data['database'] = $this->mobil_model->get_all_data();

	// 	$data['title'] = "Test tampil Database";

	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('tampildata', $data);
	// 	$this->load->view('templates/footer');
	// }

	// public function formtambah()
	// {
	// 	$data['title'] = "Tambah Data | Test tampil Database";

	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('formtambah');
	// 	$this->load->view('templates/footer');
	// }

	// public function tambahmobil()
	// {
	// 	$this->form_validation->set_message('is_unique', '{field} sudah terpakai');

	// 	$this->form_validation->set_rules('kdmobil', 'Kode Mobil', ['required', 'is_unique[mobil.kdmobil]']);

	// 	$this->validasi();

	// 	if($this->form_validation->run() === FALSE)
	// 	{
	// 		$this->formtambah();
	// 	}
	// 	else
	// 	{
	// 		$this->mobil_model->tambah_mobil();
	// 		$this->session->set_flashdata('input_sukses','Data mobil berhasil di input');
	// 		redirect(current_url());
	// 	}
	// }

	// public function hapusdata($id)
	// {
	// 	$this->mobil_model->hapus_mobil($id);
	// 	$this->session->set_flashdata('hapus_sukses','Data mobil berhasil di hapus');
	// 	redirect('/home/lihatdata');
	// }

	// public function formedit($id)
	// {
	// 	$data['title'] = 'Edit Data | Test tampil Database';

	// 	$data['db'] = $this->mobil_model->edit_mobil($id);

	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('formedit', $data);
	// 	$this->load->view('templates/footer');
	// }

	// public function updatemobil($id)
	// {
	// 	$this->validasi();

	// 	if($this->form_validation->run() === FALSE)
	// 	{
	// 		$this->formedit($id);
	// 	}
	// 	else
	// 	{
	// 		$this->mobil_model->update_mobil();
	// 		$this->session->set_flashdata('update_sukses', 'Data mobil berhasil diperbaharui');
	// 		redirect('/home/lihatdata');
	// 	}
	// }

	// public function validasi()
	// {
	// 	$this->form_validation->set_message('required', '{field} tidak boleh kosong');

	// 	$config = [[
	// 				'field' => 'jenis',
	// 				'label' => 'Jenis',
	// 				'rules' => 'required'
	// 			],
	// 			[
	// 				'field' => 'tahun',
	// 				'label' => 'Tahun',
	// 				'rules' => 'required'
	// 			],
	// 			[
	// 				'field' => 'harga',
	// 				'label' => 'Harga',
	// 				'rules' => 'required'
	// 			],
	// 			[
	// 				'field' => 'nopol',
	// 				'label' => 'No. Polisi',
	// 				'rules' => 'required'
	// 			]];

	// 	$this->form_validation->set_rules($config);
	// }
}
?>