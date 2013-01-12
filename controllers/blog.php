<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cards extends Front_Controller {

    public function __construct() 
    { 
        parent::__construct();
        
        $this->load->model('test_model');
        $this->load->model('question_model');
        $this->load->model('answer_model');
        
    }
    
    //--------------------------------------------------------------------
    
    public function index() 
    {
        $this->load->helper('typography');
    
        Template::set('posts', $this->test_model->order_by('id', 'asc')->find_all());
    
        Template::render();
    }
    
    //--------------------------------------------------------------------
    
}