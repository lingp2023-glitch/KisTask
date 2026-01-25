<?php
//菜单相关配置
include('config/config_menu.php');
$menus = json_decode(MENU_STR,true);
checkMenu($this->user["role_grade"], $menus);
$this->__exit(0, "", $menus);