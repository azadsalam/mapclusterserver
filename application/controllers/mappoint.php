<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mappoint extends CI_Controller {

	public function index()
	{
            $data['points'] = 2.0;
            print_r(json_encode($data,JSON_FORCE_OBJECT));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */