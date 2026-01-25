<?php
$model = init_submodel("account", "account");
$data = $model->refreshToken($this->user["userid"]);
$this->__exit(0);		