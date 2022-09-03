<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Other 其他管理控制器
 */
class Other extends CI_Controller {

	public function index()
	{
        $this->load->view('/other/table');
	}	

	public function form()
	{
		$this->load->view('/other/form');
	}

	public function form_step()
	{
		$this->load->view('/other/form-step');
	}

	public function button()
    {
        $this->load->view('/other/button');
    }

    public function layer()
    {
        $this->load->view('/other/layer');
    }

    public function errors()
    {
        $this->load->view('/errors/404');
    }

}
