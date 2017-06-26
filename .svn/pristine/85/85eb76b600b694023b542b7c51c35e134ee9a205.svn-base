<?php 

class Migration_Adiciona_Vendido_Produto extends CI_Migration {

	public function up(){
	
		$this->dbforge->add_column('produto', array(
			'vendido' => array(
				'type' => 'boolean',
				'default' => '0'
			
			)
		
		));
	
	}

	public function down(){
	
		$this->dbforge->drop_column('produto', 'vendido');
	
	}


}