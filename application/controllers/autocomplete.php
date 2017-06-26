<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller { 
 
 public function __construct()  {
        parent:: __construct();
  $this->load->model("MAutocomplete");
  $this->load->helper("url");
  $this->load->helper('form');
    }
     
    public function index(){
        $this->load->template('autocomplete/show');
    }
     
    public function lookup(){
        // process posted form data
        $keyword = $this->input->post('term');
        
        $data['response'] = 'false'; //Set default response
        $query = $this->MAutocomplete->lookup($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array( 
                                        'id'=>$row->id,
                                        'value' => $row->nomeproduto,
                						'preco' => $row->preco,
                                        ''
                                     );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request
             
        }
        else
        {
            $this->load->view('autocomplete/index',$data); //Load html view of search results
        }
    }
    
    //CLIENTE
    
    public function cliente(){
        // process posted form data
        $keyword = $this->input->post('term');
        
        $data['response'] = 'false'; //Set default response
        $query = $this->MAutocomplete->pessoa($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array( 
                                        'id'=>$row->idpessoa,
                                        'value' => $row->nome,
                                        ''
                                     );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request
             
        }
        else
        {
            $this->load->view('autocomplete/index',$data); //Load html view of search results
        }
    }
    
    
    
    
    
    
}