<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class question_model extends MY_Model {

    protected $table        = 'questions';
    protected $key          = 'id';
    protected $set_created  = false;
    protected $set_modified = false;
    protected $soft_deletes = false;
    //---------------------------------------------------------------
}
