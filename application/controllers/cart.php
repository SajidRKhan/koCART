<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	
	public function index()
	{
		$this->load->model('menu');
		$this->load->model('products');
		$this->load->model('categorys');
		$this->lang->load('cart', $this->session->userdata('lang_file'));

		$this->load->library('cart');
		//Products...
		$data['most_sell_products'] = $this->products->most_sell_products();
		$data['slider_products'] = $this->products->slider_products();
		
		//Category...
		$data['all_categorys'] = $this->categorys->all_categorys();
		
		//Menu...
        $data['menu'] = $this->menu->menu();


 
		$this->load->view('cart', $data);
	}
	public function update(){
	
			$this->load->library('cart');
 			
			$qtys = $this->input->post("qty");
			$i = 0;
			$total = count($this->input->post('rowid'));
			
            foreach ($this->input->post('rowid') as $index => $id){
 
			$data = array(
               array(
                       'rowid'   => $id,
                       'qty'     => $qtys[$index],	
                    )
            );
			
			$this->cart->update($data);
			$i++;
 
 			if($total == $i){
				redirect($_SERVER['HTTP_REFERER']);
			}
			
 		 }
		

 
}
		function remove() {
 			$this->load->library('cart');

			$data = array(
               array(
                       'rowid'   => $this->uri->segment(3),
                       'qty'     => 0,	
                    )
            );
			$this->cart->update($data);
		 
		
						redirect($_SERVER['HTTP_REFERER']);
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */