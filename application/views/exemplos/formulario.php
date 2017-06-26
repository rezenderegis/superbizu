   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
 
 
 <script src="<?php echo base_url('js/pick-list/jquery-picklist/jquery-picklist.js');?>"
	type="text/javascript"></script>	
	<script src="<?php echo base_url('js/pick-list/jquery-picklist/jquery.ui.widget.js');?>"
	type="text/javascript"></script>	
	<script
	src="<?php echo base_url('js/jquery-ui-1.11.0.custom/jquery-ui.js');?>"
	type="text/javascript"></script>
	<link rel="stylesheet" href="<?=base_url("js/jquery-ui-1.9.2.custom/css/ui-lightness/jquery-ui-1.9.2.custom.min.css")?>">

<script type="text/javascript">

<script type="text/javascript">


$('#f_city, #f_city_label').hide();
$('#f_state').change(function(){
    var state_id = $('#f_state').val();
    alert('Aqui');
    if (state_id != ""){
        var post_url = "/index.php/exemplo/get_cities/" + state_id;
        $.ajax({
            type: "POST",
             url: post_url,
             success: function(cities) //we're calling the response json array 'cities'
              {
                $('#f_city').empty();
                $('#f_city, #f_city_label').show();
                   $.each(cities,function(id,city) 
                   {
                    var opt = $('<option />'); // here we're creating a new select option for each group
                      opt.val(id);
                      opt.text(city);
                      $('#f_city').append(opt); 
                });
               } //end success
         }); //end AJAX
    } else {
        $('#f_city').empty();
        $('#f_city, #f_city_label').hide();
    }//end if
}); //end change 


</script>
<div class="page-header">
	<!-- Inicio div header -->
	<h1>
		<span class="text-ligth-gray">Alteração de Assunto </span>
	</h1>
</div>


<?= validation_errors("<p class='alert alert-danger'>", "</p>")?>



<?php

// $id = $assunto_informado['ID_ITEM'];
$id = $id_assunto;
echo form_open ( "assuntos/novo", array (
		'id' => 'assunto',
		'class' => 'form-horizontal',
		'role' => 'form' 
) );

?>
<div class="panel-heading">
	<span class="panel-title">Assunto</span>
</div>

<div class="panel-body">

<?php echo form_open('control_form/add_all'); ?>
        <label for="f_state">State<span class="red">*</span></label>
        <select id="f_state" name="f_state">
            <option value=""></option>
            <?php
            foreach($states as $state){
                echo '<option value="' . $state->id . '">' . $state->state_name . '</option>';
            }
            ?>
        </select>
        <label for="f_city">City<span class="red">*</span></label>
        <!--this will be filled based on the tree selection above-->
        <select id="f_city" name="f_city" id="f_city_label"> 
            <option value=""></option>
        </select>
        <label for="f_membername">Member Name<span class="red">*</span></label>
        <!--<input type="text" name="f_membername"/>-->
<?php echo form_close(); ?> 


	


	

</div>
<div class="panel-footer text-center">
<?php

echo form_hidden ( array (
		"id_assunto_alterar" => $id
) );


echo form_button ( array (
		"class" => "btn btn-primary",
		"content" => "Cadastrar",
		"type" => "submit" 
) );

echo form_close ();

?>

</div>

