<?php
$model = init_submodel("role", "account");
$model->__bindQuery("roleid", $this->in["roleid"]);
$model->__del();
$this->__exit(0, 'api request ok');