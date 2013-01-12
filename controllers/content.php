<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Content extends Admin_Controller {
        
        public function index() 
        {
            $posts = $this->db->query('SELECT bf_tests.title, bf_tests.id, bf_tests.numQuestions, bf_users.username FROM bf_tests JOIN bf_users on bf_tests.owner = bf_users.id')->result_array();
    
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
    
        public function add_question() 
        {
            if ($this->input->post('submit'))
            {
                if ($this->save_question())
                {
                    Template::set_message('The question was successfully saved.', 'success');
                    redirect(SITE_AREA .'/content/cards');
                }
            }
            Template::set('toolbar_title', 'Add New Question');
            Template::set_view('content/post_form');
            Template::render();
        }
        
        private function save_question($type='insert', $id=null) 
        {
            $this->form_validation->set_rules('question', 'Question Text', 'required');
            $this->form_validation->set_rules('answer1', 'Answer 1', 'required');
            $this->form_validation->set_rules('answer2', 'Answer 2', 'required');
            $this->form_validation->set_rules('answer3', 'Answer 3', 'required');
            
            
            
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
        
        public function edit_question($id=null) 
        {
            if ($this->input->post('submit'))
            {
                if ($this->save_post('update', $id))
                {
                    Template::set_message('The question was successfully updated.', 'success');
                    redirect(SITE_AREA .'/content/list_questions');
                }
            }
            
            Template::set('question', $this->question_model->find($id));
            Template::set('answers', $this->answer_model->find_all_by('parent_question', $id));
            Template::set('tests', $this->test_model->find_all_by('owner', $this->auth->user_id()));

            Template::set('toolbar_title', 'Edit Question');
            Template::set_view('content/question_form');
            Template::render();
        }
        
        public function list_questions() 
        {
            Template::set('questions', $this->question_model->order_by('id', 'asc')->find_all());
            //$this->db->query('SELECT bf_tests.title, bf_tests.id, bf_tests.numQuestions, bf_users.username FROM bf_tests JOIN bf_users on bf_tests.owner = bf_users.id')->result_array();
    
            Template::set_view('content/question_index');
            Template::render();
        }
    }
