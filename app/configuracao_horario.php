<?php
if( ! ini_get('date.timezone') )
{
	date_default_timezone_set('GMT');
}


date_default_timezone_set('America/Brasilia');

$dt_atual = date('Y-m-d H:i:s');
