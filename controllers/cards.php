<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cards extends Front_Controller {

    public function __construct() 
    { 
        parent::__construct();
        
        $this->load->model('test_model');
        $this->load->model('question_model');
        $this->load->model('answer_model');
        
        Assets::add_module_css("cards", "layout.css");
        Assets::add_module_js("cards", "jquery.ninjaui.min.js");
        Assets::add_module_js("cards", "mathcards.js");
        
    }
    
    //--------------------------------------------------------------------
    
    public function index() 
    {
        $this->load->helper('typography');
    
        $data = $this->db->query('SELECT bf_tests.title, bf_tests.id, bf_tests.description, bf_users.username FROM bf_tests JOIN bf_users on bf_tests.owner = bf_users.id ORDER BY bf_tests.id DESC')->result_array();
        Template::set('posts', $data);
        Template::render();
    }
    
    //--------------------------------------------------------------------
    
    public function start_quiz($id){
        
        Assets::add_js("$('#question').html(\"Loading questions... and answers.\").append($.ninja.icon({value: 'spin'}));
        // http://stackoverflow.com/questions/3014018/how-to-detect-when-mathjax-is-fully-loaded?rq=1
        MathJax.Hub.Register.StartupHook(\"End\", function () { 
            init();
        });", "inline");
        Template::set('js', Assets::module_js());
        Template::set('id', $id);
        Template::set('title', $this->db->query("select bf_tests.title, bf_tests.description from bf_tests where bf_tests.id =".$id)->row());
        Template::render();
    }
    
    public function generate_set($id){
        $data = array();
        $questions = $this->db->query("select id, question from bf_questions WHERE parent_test =". $id)->result_array();
        for($i = 0; $i < count($questions); $i++){
            $data[$i]['question'] = $questions[$i]['question'];
            $answers = $this->db->query('select answer, correct from bf_answers WHERE parent_question ='. $questions[$i]['id']." ORDER BY RAND()")->result_array();
            for($j = 1; $j <= count($answers); $j++){
                $data[$i]['label'.$j] = $answers[$j-1]['answer'];
                if ($answers[$j-1]['correct'] == 1){
                    $data[$i]['answer'] = $j;
                }
            }
        }
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($data));
    }
}
