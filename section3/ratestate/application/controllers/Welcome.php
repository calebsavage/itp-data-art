<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    if(!isset($_COOKIE['ratestate_id'])){
	        setcookie('ratestate_id', md5(uniqid()));
        }
        $data['user_id'] = $_COOKIE['ratestate_id'] ?? null;



		$this->load->view('map');
	}

	public function states_json(){
        $res = $this->db->query("select `states`.abbr, `states`.state, AVG(`vote`.rating) as rating FROM `vote`, `states` WHERE `states`.id=`vote`.state_id GROUP BY `vote`.state_id")->result();



	    echo json_encode($res);
    }

    public function state_profile(){
        $last = $this->uri->total_segments();
        $state = $this->uri->segment($last);


        $data['state'] = $this->db->query("select `states`.id,`states`.abbr, `states`.abbr,`states`.id,`states`.state, AVG(`vote`.rating) as rating FROM `vote`, `states` WHERE `states`.id=`vote`.state_id AND `states`.abbr = ? GROUP BY `vote`.state_id", array($state))->row();

        $this->db->where('state_id', $data['state']->id ?? null);
        $data['votes'] = $this->db->get('vote')->result();

        //word cloud
        $cloud = array();
        foreach($data['votes'] as $vote){
            if(!isset($cloud[$vote->word]) && $vote->word !=''){
                $cloud[$vote->word] = 1;
            }else if($vote->word !=''){
                $cloud[$vote->word] +=1;
            }
        }

       $data['cloud'] = $cloud;
        if(!isset($_COOKIE['ratestate_id'])){
            setcookie('ratestate_id', md5(uniqid()));
        }
        $data['user_id'] = $_COOKIE['ratestate_id'];

        $this->load->view('state', $data);

    }

    public function vote(){
	    print_r($_POST);
	    $this->db->where('client_id', $_COOKIE['ratestate_id']);
	    $this->db->where('state_id', $this->input->post('state_id'));
	    setcookie('ratestate_name', $this->input->post('name'));
        setcookie('ratestate_state_abbr', $this->input->post('homestate'));
        $row = array(
            'client_id'=>$_COOKIE['ratestate_id'],
            'state_id' =>$this->input->post('state_id'),
            'rating' =>$this->input->post('rating'),
            'word' => $this->input->post('word'),
            'user'=>$this->input->post('name'),
            'homestate'=> $_COOKIE['ratestate_state_abbr'] ?? ''
        );
	    if($res =$this->db->get('vote')->row()){
	        $this->db->where('id', $res->id);
	        $this->db->update('vote', $row);

        }else{
	        $this->db->insert('vote', $row);

        }
        echo $this->db->last_query();
    }
}
