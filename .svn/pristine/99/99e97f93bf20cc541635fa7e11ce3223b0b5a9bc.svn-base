<head>
<link rel="stylesheet" href="<?=base_url("js/multiple-select-master/multiple-select.css")?>">

</head>

    <script
	src="<?php echo base_url('js/multiple-select-master/multiple-select.js');?>"
	type="text/javascript"></script>
<body>
<div class='col-sm-10'>
    <select multiple="multiple" class='form-control'>
   
        <optgroup label="Group 1">
            <option value="1">Matematica</option>
             <option value="2">Fisica</option>
                        <option value="3">Option 1</option>
                        <option value="4">Option 1</option>
            
        </optgroup>
        ...
        <optgroup label="Group 3">
            <option value="1">Matematica</option>
             <option value="2">Fisica</option>
                        <option value="3">Option 1</option>
                        <option value="4">Option 1</option>
            <option value="9">Option 9</option>
        </optgroup>
    </select>
</div>
    <script>
        $('select').multipleSelect();
    </script>
</body>







<table class="table table-condensed">
<tr class="active"><td align="center"><b>Cadastro Nova Questão</b></td></tr>
</table>


<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>



<?php 
$attributes = array (
		'class' => 'col-sm-2 control-label',
		'style' => 'color: #000;'
);
	$id = $id_questao;
	
	

echo form_open("questoes/novo", array (
			'id' => 'questoes',
			'class' => 'form-horizontal',
			'role' => 'form'
	) );
?>

<?php 

echo form_error('aplicacao', "<p class='alert alert-danger'>", "</p>");
echo "<div class='form-group'>";
echo form_label ( "Aplicação", "aplicacao", $attributes );
echo "<div class='col-sm-2'>";
echo "<select multiple='multiple' name='aplicacao' id='aplicacao' class='form-control'>";
echo "<optgroup label='Group 3'>";
echo "<option value=1 ".$apl_1.">1a</option>";
echo "<option value=2 ".$apl_2.">2a</option>";
echo "</optgroup>";
echo "</select>";
echo "</div>";
echo "</div>";




echo form_button(array(
"class" => "btn btn-primary",
"content" => "Cadastrar",
"type" => "submit"
));

echo form_close();


?>
	
	







?>


