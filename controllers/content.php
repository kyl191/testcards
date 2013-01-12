<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Content extends Admin_Controller {
        
        public function index() 
        {
            $posts = $this->test_model->find_all();
    
            Template::set('posts', $posts);
            Template::render();
        }
        
        //--------------------------------------------------------------------
        
        public function __construct() 
        {
            parent::__construct();
            
            $this->load->model('test_model');
            
            Template::set('toolbar_title', 'Manage All Tests');
            Template::set_block('sub_nav', 'content/sub_nav');
        }
        
        public function create() 
        {
            if ($this->input->post('submit'))
            {
                if ($this->save_post())
                {
                    Template::set_message('The quiz was successfully saved.', 'success');
                    redirect(SITE_AREA .'/content/cards');
                }
            }
            Template::set('toolbar_title', 'Create New Quiz');
            Template::set_view('content/post_form');
            Template::render();
        }
        
        private function save_post($type='insert', $id=null) 
        {
            $this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('description', 'Description', 'required|trim|strip_tags');
            
            if ($this->form_validation->run() === false)
            {
                return false;
            }
            
            
            
            // Compile our post data to make sure nothing
            // else gets through.
            $data = array(
                'title' => $this->input->post('title'),
                'description'  => $this->input->post('description'),
                'owner' => $this->auth->user_id()
            );
            
            if ($type == 'insert')
            {
                $data['numQuestions'] = 0;
                $return = $this->test_model->insert($data);
            }
            else    // Update
            {
                $data['numQuestions'] = $this->question_model->where('parent_test', $id);
                $return = $this->test_model->update($id, $data);
            }
            
            return $return;
}

//--------------------------------------------------------------------
        public function edit_test($id=null) 
        {
            if ($this->input->post('submit'))
            {
                if ($this->save_post('update', $id))
                {
                    Template::set_message('The quiz was successfully updated.', 'success');
                    redirect(SITE_AREA .'/content/cards');
                }
            }
            
            Template::set('post', $this->test_model->find($id));

            Template::set('toolbar_title', 'Edit Quiz');
            Template::set_view('content/post_form');
            Template::render();
        }
    }
