<?php
class WebServicesController extends controller {
    public function __construct() {
      parent::__construct();   
      require_once('WebServicesValidarNcm.php');   
    }
    
    public function index() {
      $array['code'] = '000';
      $array['msg'] = 'Método de requisição incompatível.';
      $this->returnJson($array);
    }

    public function getValidarNcm() {
      $method = $this->getMethod();
      if ($method == 'POST'){
        $dados = $this->getRequestData(); 
        
        if (!isset($dados['chave'])){
          $array['code'] = '201';
          $array['msg'] = 'Erro chave não informada.';
        }else{
            if (!isset($dados['ncm'])){
                $array['code'] = '201';
                $array['msg'] = 'Erro de autenticação de chave.';
            }
            else{
                if (CHAVE == $dados['chave']){
                    $array = ValidarNcm($dados['ncm']);               
                }else{
                    $array['code'] = '201';
                    $array['msg'] = 'Erro de autenticação de chave.';
                }
            }
        }
      }else{
        $array['code'] = '205';
        $array['msg'] = 'Método de requisição incompatível.';
      }      
      $this->returnJson($array);
    }
  
}