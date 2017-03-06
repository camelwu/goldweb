<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expect extends HomeBase_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('time');      //系统自带url helper类引用
        $this->load->helper('country');   //自定义国家helper类引用
        $this->load->library('session');  //session类引用
        $this->load->library('mypage');
    }
    // --------------------------------------------------------------------

    /**
     * 首页
     *
     */
    public function index()
    {
        $data['title'] = '敬请期待';
        $data['top_menu_name'] = "index";
        $data["header"] = $this->load->view('common/header', $data, true);
//        banner图数据接口
        $data["footer"] = $this->load->view('common/footer', null, true);
        $this->load->view('common/expect', $data);
    }
}
