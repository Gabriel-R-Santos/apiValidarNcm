<?php
class WebServicesApi extends model
{
    private $userInfo;

    public function getNcm($ncm)
    {
        try {
            $jsonReturn = "{ ncm:[";

            foreach ($ncm as $value) {
                $sql = $this->db->prepare("SELECT codigo,ncm,fimvigencia FROM classificacao  WHERE ncm = :ncm");
                $sql->bindValue(':ncm', addslashes($value));
                $sql->execute();

                if ($sql->rowCount() > 0) {
                    $array = $sql->fetch();
                    $jsonReturn = $jsonReturn .'{"200",'.'"'.$value.'","'.$array['fimvigencia'].'","NCM"}';    
                }else
                {
                    $jsonReturn = $jsonReturn .'{"404",'.'"'.$value.'","","NCM Inválido"}';    
                }

            }
            $jsonReturn = $jsonReturn. "]}";
            return $jsonReturn;
        } catch (PDOException $e){
            return '202';
        }
    }


    
}
