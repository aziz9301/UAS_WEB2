<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', 'forgot');
    }
    public function forgotPassword()
    {
        if ($this->session->userdata('email')){
			redirect('home');
		}
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        if ($this->form_validation->run() == false) {
            $data['title']    = 'Forgot Password';
            $data['page']    = 'pages/auth/forgot';
            $this->load->view('layouts/app1', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', ['email' => $email,'is_active'=>1])->row_array();

            if ($user) {
                $token=base64_encode(random_bytes(32));
                $user_token=[
                    'email'=>$email,
                    'token'=>$token,
                    'date_created'=>time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('forgot/forgotPassword');
            } else {
                $this->session->set_flashdata('error', 'Email not found or not Activated');
                redirect('forgot/forgotPassword');
            }
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
        }else if ($type == 'forgot') {
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
    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('forgot/forgotPassword');
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('forgot/forgotPassword');
        }
    }


    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('login');
        }

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password]');

        if ($this->form_validation->run() == false) {
            $data['title']    = 'Change Password';
            $data['page']    = 'pages/auth/change-password';
            $this->load->view('layouts/app1', $data);
        } else {
            $password = hashEncrypt($this->input->post('password'));
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('login');
        }
    }
}
