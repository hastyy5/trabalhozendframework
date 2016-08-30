<?php

class Application_Model_Vo_Prato {
        
    private $idprato;
    private $idcategoria;
    private $nomeprato;
    private $precoprato;
        
        function getIdprato(){
            return $this->idprato;
        }
        function getIdcategoria(){
            return $this->idcategoria;
        }
        function getNomePrato(){
            return $this->nomeprato;
        }
        function getPrecoPrato(){
            return $this->precoprato;
        }
        function setIdprato($idprato){
            $this->idprato = $idprato;
        }
        function setIdcategoria($idcategoria){
            $this->idcategoria = $idcategoria;
        }
        function setNomePrato($prato){
            $this->nomeprato = $prato;
        }
        function setPrecoPrato($preco){
            $this->precoprato = $preco;
        }
    }
