<?php 

function autoriza() {
	$ci = get_instance();
	$usuarioLogado = $ci->session->userdata("usuario_logado");
		if (!$usuarioLogado) {
			$ci->session->set_flashdata("danger", "Voc� precisa estar logado");
			redirect("/");
		}

	return $usuarioLogado;

}