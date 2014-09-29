<?php
//品牌管理
class article_brandAction extends BackendAction {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('article_brand');
    }

    public function add() {
        echo 34;
    }

   
}