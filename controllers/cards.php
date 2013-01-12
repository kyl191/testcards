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
    
        Template::set('posts', $this->test_model->order_by('id', 'asc')->find_all());
    
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
        Template::render();
    }
    
    public function generate_set($id){
        $data = array();
        $questions = $this->db->query("select id, question from bf_questions WHERE parent_test =". $id)->result_array();
        for($i = 0; $i < count($questions); $i++){
            $data[$i]['question'] = $questions[$i]['question'];
            $answers = $this->db->query('select answer, correct from bf_answers WHERE parent_question ='. $questions[$i]['id'])->result_array();
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
