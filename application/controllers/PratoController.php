<?php

 class PratoController extends Blog_Controller_Action {

    public function indexAction() {
        $tab = new Application_Model_DbTable_Prato();
        $consulta = $tab->getAdapter()->select();
        $consulta->from(array(
            'p' => "prato"
        ), array(
            "idprato",
            "pratonome",
            "precodoprato"
        ));
        
        
        $consulta->joinInner(array("c" =>"categoria"), "c.idcategoria = p.idcategoria", array(
            "categoria"
        ));
        $consulta->where("p.idcategoria > ?", 0, Zend_Db::INT_TYPE);
        $consultaBd = $consulta->query()->fetchAll();
        $this->view->podeApagar = $this->aclIsAllowed('prato', 'delete');
        
        $this->view->prato = $consultaBd;

    }

    public function createAction() {
        
        $frm = new Application_Form_Prato();
                
        if ($this->getRequest()->isPost()) {
            $params = $this->getAllParams();

            if ($frm->isValid($params)) {
                $params = $frm->getValues();

                $prato = new Application_Model_Vo_Prato();
                $prato->setNomePrato($params['prato']);
                $prato->setIdcategoria($params['idcategoria']);
                //$prato->setPrecoPrato($params['precoprato']);


                $model = new Application_Model_Prato();
                $model->salvar($prato);

                $flashMessendge = $this->_helper->FlashMessenger;
                $flashMessendge->addMessage("PRATO SALVO");

                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        }

        $this->view->frm = $frm;
    }

    public function deleteAction() {
        $idprato = (int)$this->getParam('idprato', 0);
        $model = new Application_Model_Prato();
        $model->apagar($idprato);
        
        $flashMessenger = $this->_helper->FlashMessenger;
        $flashMessenger->addMessage('REGISTRO APAGADO');
        
        $this->_helper->Redirector->gotoSimpleAndExit('index');
    }

    public function updateAction() {
        
                
        $idprato = (int)  $this->getParam('idprato', 0);
        
        $tab = new Application_Model_DbTable_Prato();
        $row = $tab->fetchRow('idprato = '.$idprato);
        
        if($row === null){
            echo "PRATO INEXISTENTE";
            exit;
        }
                
        $tipoUsu = $this->aclIsAllowed('usuario', 'delete');
        
        if($tipoUsu){
            $frm = new Application_Form_PratoGeral();
        }else{
            $frm = new Application_Form_Prato();
        }
        
        
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $prato = new Application_Model_Vo_Prato();
                $prato->setNomePrato($params['prato']);
                $prato->setPrecoPrato($params['preco']);
                $prato->setIdcategoria($params['idcategoria']);
                $prato->setIdprato($idprato);
                
                $model = new Application_Model_Prato();
                if($tipoUsu){
                    $model->atualizarTudo($prato);
                }else{
                $model->atualizar($prato);
                }
                $flashMessendge =  $this->_helper->FlashMessenger;
                $flashMessendge->addMessage("O PRATO FOI SALVO!");
                
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        } else{
           // $frm->populate($row->toArray());
            $frm->populate(array(
                'prato' =>$row->pratonome,
                'preco' =>$row->precodoprato,
                'idcategoria' =>$row->idcategoria
            ));
        }
        
        $this->view->frm = $frm;
        
    }

}
