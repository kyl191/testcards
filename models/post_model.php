<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post_model extends MY_Model {

	protected $table		= 'posts';
	protected $key			= 'post_id';
	protected $set_created	= true;
	protected $set_modified	= true;
	protected $soft_deletes	= true;
	protected $date_format	= 'datetime';

	//---------------------------------------------------------------

}