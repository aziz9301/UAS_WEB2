<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('register_model', 'register');
	}

	public function index()
	{
		if ($this->session->userdata('email')){
			redirect('home');
		}
		$data['title']	= 'Register';
		$data['page']	= 'pages/auth/register';

		$this->load->view('layouts/app', $data);
	}

	public function register()
	{

		$this->form_validation->set_rules('name', 'Name', 'required', [
			'required'		=> 'Name is required',
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required'		=> 'Email is required',
			'valid_email'	=> 'Email not valid'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required'		=> 'Password is required'
		]);
		$this->form_validation->set_rules('password2', 'Password confirmation', 'required|trim|matches[password]', [
			'required'		=> 'Password confirmation is required',
			'matches'		=> 'Password confirmation not same with password'
		]);
		

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$email = $this->input->post('email');
			$data = [
				'name'        => $this->input->post('name'),
				'email'        => $email,
				'password'    => hashEncrypt($this->input->post('password')),
				'role'        => 2,
				'is_active' => 0,
			];
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('users', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token, 'verify');


			$this->session->set_flashdata('success', 'Successfully registered, Please Activate Your Account !!');

			redirect(base_url('login'));
		}
	}
	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'suprafit9301@gmail.com',
			'smtp_pass' => 'dijhqnbbmqkeewxq',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->load->library('email', $config);

		$this->email->from('suprafit9301@gmail.com', 'Game');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify you account : <a href="' . base_url() . 'register/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="' . base_url() . 'forgot/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}
	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('users', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('users');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
					redirect('login');
				} else {
					$this->db->delete('users', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
			redirect('login');
		}
	}
}

/* End of file Register.php */
