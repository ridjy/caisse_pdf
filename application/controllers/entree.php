<?php
class Entree extends CI_Controller
{	
public function __construct()
{
	// Obligatoire
	parent::__construct();
	// Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
	$this->load->helper('url');
	$data = array();
}

public function index()
{
	$this->formulaire();
}

public function formulaire()
{
	$data['titre'] = 'ENTREE DE CAISSE' ;
	$data['n'] = $this->model->numeroauto();
	$this->model->incrementer(); 
	$this->load->view('entree/form',$data);	
}
}
