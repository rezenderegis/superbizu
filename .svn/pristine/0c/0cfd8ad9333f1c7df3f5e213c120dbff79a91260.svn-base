<?php

class Migration_vendas_teste extends CI_migration {

public function up(){

	$this->dbforge->add_field(array(
	'id' => array(
		'type' => 'INT',
		'auto_increment' => true
	),
	'produto_id' =>array(
	'type' => 'INT'
	),
	'idcliente' => array (
		'type' => 'INT'	
	),
	'data_entrega' => array (
		'type' => 'DATE'
	)
	
	));
	$this->dbforge->add_key('id', true);
	$this->dbforge->create_table('vendas_teste');


}	


public function down() {

	$this->dbforge->drop_table('vendas');

}



}