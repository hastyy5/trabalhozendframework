<?php

class Application_Form_Categoria extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        $val = new Zend_Validate_StringLength();
        $val->setMin(3);
        
        $categoria = new Zend_Form_Element_Text('categoria', array(
            'label' => 'Nome da categoria',
            'required' => true
        ));
        $categoria->addValidator($val);
        $this->addElement($categoria);
        
        $submit  = new Zend_Form_Element_Submit('submit', array(
            'label' => 'Salvar'
        ));
        $this->addElement($submit);
        
    }
    
    

}
