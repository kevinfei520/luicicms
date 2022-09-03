<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Component  组件管理控制器  
 */
class Component extends CI_Controller {

	public function icon()
	{
        $this->load->view('/component/icon');
	}	

	public function upload()
	{
		$this->load->view('/component/upload');
	}

	public function editor()
	{
		$this->load->view('/component/editor');
	}

	public function iconpicker()
	{
		$this->load->view('/component/icon-picker');
	}

	public function colorselect(){
		$this->load->view('/component/color-select');
	}

	public function tableselect()
	{
		$this->load->view('/component/table-select');
	}
	
}
