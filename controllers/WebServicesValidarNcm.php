<?php

function ValidarNcm($dados){     
   
    // Busco os pedidos realizados
    $webService = new WebServicesApi();
    $arrayNcm = $webService->getNcm($dados);
    

    // if ($arrayNcm == '200'){
    //   $arrayRetorno['code'] = '200';        
    //   $arrayRetorno['msg'] = 'OK';      
    // } elseif ($arrayNcm == '404')  {
    //   $arrayRetorno['code'] = '404';        
    //   $arrayRetorno['msg'] = 'Not Found';        
    // } else { 
    //   $arrayRetorno['code'] = $arrayNcm;
    //   $arrayRetorno['msg'] = 'Erro interno '.$arrayNcm.': Erro na consulta dos ncm';        
    // }  
    return $arrayNcm;     
}