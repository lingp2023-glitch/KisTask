<?php
$model = init_submodel("account", "account");
$model->__bindQuery("userid", $this->in["userid"]);	
$model->__del();		
$this->__exit(0, 'api request ok');