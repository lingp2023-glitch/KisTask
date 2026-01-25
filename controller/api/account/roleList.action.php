<?php
$model = init_submodel("role", "account");
$data = $model->__list();
$this->__exit(0, "", $data);