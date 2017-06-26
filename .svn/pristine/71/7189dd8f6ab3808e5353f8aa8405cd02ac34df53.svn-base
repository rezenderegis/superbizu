<?php

class Exemplo_model extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function get_state(){
		$query = $this->db->query('SELECT id_materia id, nome_materia state_name FROM tb_materia');
		return $query->result();
	}
	
	function get_cities_by_state ($state){
		
		$this->db->select('select id_assunto id, descricao_assunto city_name  from tb_assunto a inner join tb_materia m on m.id_materia = a.id_materia where m.id_materia = '.$state);
	
	
		$query = $this->db->get('cities');
		$cities = array();
	
		if($query->result()){
			foreach ($query->result() as $city) {
				$cities[$city->id] = $city->city_name;
			}
			return $cities;
		} else {
			return FALSE;
		}
	}
	
	
	
}