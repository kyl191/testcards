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
            $this->load->model('question_model');
            $this->load->model('answer_model');
            
            Template::set('toolbar_title', 'Manage Tests');
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
            
            $test_list = $this->db->query('SELECT id, title from bf_tests WHERE owner = '.$this->auth->user_id() . ' ORDER BY bf_tests.id DESC')->result_array();
            $tests = array('0' => "Select a quiz");
            foreach($test_list as $test){
                $tests[$test['id']] = $test['title'];
            }
            Template::set('tests', $tests);
            Template::set('toolbar_title', 'Add New Question');
            Template::set_view('content/question_form');
            Template::render();
        }
        
        private function save_question($type='insert', $id=null) 
        {
            $this->form_validation->set_rules('question', 'Question Text', 'required');
            $this->form_validation->set_rules('test', 'Selected test', 'check_owner');
            
            if ($this->form_validation->run() === false)
            {
                return false;
            }
            
            // Compile our post data to make sure nothing
            // else gets through.
            $data = array(
                'parent_test' => $this->input->post('test'),
                'question'  => $this->input->post('question')
            );
            
            // Add the question
            if ($type == 'insert')
            {
                $return = $this->question_model->insert($data);
                $id = $return;
            }
            else    // Update
            {
                $return = $this->question_model->update($id, $data);
            }
            // Recount the number of questions assigned to a test & update the count in the database
            
            $num_questions = $this->db->from("bf_questions")->where("parent_test", $test)->count_all_results();
            $this->db->set("numQuestions", $num_questions);
            $this->db->where("id", $test)->update("bf_tests");
            
            return $return;
        }
        
        public function check_owner($test){
            // Check that the test we're adding a question to is owned by the user
            $userid = $this->db->select("owner")->get("bf_tests")->where("id", $test)->limit(1)->row();
            if ($userid->owner == $this->auth->user_id()){
                return true;
            } else {
                return false;
            }
        }
        
        public function edit_question($id=null) 
        {
            if ($this->input->post('submit'))
            {
                if ($this->save_question('update', $id))
                {
                    Template::set_message('The question was successfully updated.', 'success');
                    redirect(SITE_AREA .'/content/list_questions');
                }
            }
            
            Template::set('question', $this->question_model->find($id));
            Template::set('tests', $this->test_model->find_all_by('owner', $this->auth->user_id()));

            Template::set('toolbar_title', 'Edit Question');
            Template::set_view('content/question_form');
            Template::render();
        }
        
        public function list_questions() 
        {
            $questions = $this->db->query('SELECT bf_questions.id, bf_questions.question, bf_questions.modified, bf_tests.title FROM bf_questions JOIN bf_tests on bf_questions.parent_test = bf_tests.id ORDER BY bf_tests.id DESC')->result_array();
            Template::set('questions', $questions);
            
            Template::set_view('content/question_index');
            Template::render();
        }
        
        public function add_answer() 
        {
            if ($this->input->post('submit'))
            {
                if ($this->save_answer())
                {
                    Template::set_message('The answer was successfully saved.', 'success');
                    //redirect(SITE_AREA .'/content/cards/list_answers');
                }
            }
            
            $question_list = $this->db->query('SELECT bf_questions.id, bf_questions.question FROM bf_questions JOIN bf_tests ON bf_questions.parent_test = bf_tests.id WHERE bf_tests.owner = '.$this->auth->user_id() . ' ORDER BY bf_questions.id DESC')->result_array();
            $questions = array('0' => "Select a question");
            foreach($question_list as $question){
                $questions[$question['id']] = $question['question'];
            }
            Template::set('questions', $questions);
            Template::set('toolbar_title', 'Add New Answer');
            Template::set_view('content/answer_form');
            Template::render();
        }
        
        private function save_answer($type='insert', $id=null) 
        {
            $this->form_validation->set_rules('answer', 'Answer Text', 'required');
            $this->form_validation->set_rules('question', 'Selected question', 'check_question_owner');
            
            if ($this->form_validation->run() === false)
            {
                return false;
            }
            
            // Compile our post data to make sure nothing
            // else gets through.
            $data = array(
                'parent_question' => $this->input->post('question'),
                'answer'  => $this->input->post('answer'),
                'correct' => $this->input->post('correct')
            );
            
            // Add the question
            if ($type == 'insert')
            {
                $return = $this->answer_model->insert($data);
                $id = $return;
            }
            else    // Update
            {
                $return = $this->answer_model->update($id, $data);
            }
            
            return $return;
        }
        
        public function check_question_owner($test){
            // Check that the test we're adding a question to is owned by the user
            $userid = $this->db->select("owner")->get("bf_tests")->where("id", $test)->limit(1)->row();
            if ($userid->owner == $this->auth->user_id()){
                return true;
            } else {
                return false;
            }
        }
        
        public function edit_answer($id=null) 
        {
            if ($this->input->post('submit'))
            {
                if ($this->save_answer('update', $id))
                {
                    Template::set_message('The answer was successfully updated.', 'success');
                    redirect(SITE_AREA .'/content/cards/list_answers');
                }
            }
            
            Template::set('answer', $this->answer_model->find($id));
            $question_list = $this->db->query('SELECT bf_questions.id, bf_questions.question FROM bf_questions JOIN bf_tests ON bf_questions.parent_test = bf_tests.id WHERE bf_tests.owner = '.$this->auth->user_id())->result_array();
            $questions = array('0' => "Select a question");
            foreach($question_list as $question){
                $questions[$question['id']] = $question['question'];
            }
            Template::set('questions', $questions);
            
            Template::set('toolbar_title', 'Edit Answer');
            Template::set_view('content/answer_form');
            Template::render();
        }
        
        public function list_answers() 
        {
            $answers = $this->db->query('SELECT bf_answers.id, bf_answers.answer, bf_answers.modified, bf_questions.question FROM bf_answers JOIN bf_questions on bf_answers.parent_question = bf_questions.id')->result_array();
            Template::set('answers', $answers);
            
            Template::set_view('content/answer_index');
            Template::render();
        }

    }
