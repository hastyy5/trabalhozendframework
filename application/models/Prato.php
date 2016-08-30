<?php

class Application_Model_Prato {
    
    public function apagar($idprato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->delete("idprato = $idprato");
            
            return true;
        }
    public function atualizar(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->update(array(
                'idcategoria' => $prato->getIdcategoria(),
                'pratonome' => $prato->getNomePrato(),
            ), 'idprato = '. $prato->getIdprato());
            
            return true;
        }
    public function atualizarTudo(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->update(array(
                'idcategoria' => $prato->getIdcategoria(),
                'pratonome' => $prato->getNomePrato(),
                'precodoprato' => $prato->getPrecoPrato(),
            ), 'idprato = '. $prato->getIdprato());
            
            return true;
    }    
    
    public function salvar(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->insert(array(
                'idcategoria' => $prato->getIdcategoria(),
                'pratonome' => $prato->getNomePrato(),
                'precodoprato' => $prato->getPrecoPrato()
            ));
            
            $idprato = $tab->getAdapter()->lastInsertId();
            $prato->setIdprato($idprato);  
            return true;
                
    }
        

    }
