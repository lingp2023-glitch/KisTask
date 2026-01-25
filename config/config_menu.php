<?php 
define('MENU_STR', '[
  {
    "name": "setting",
    "meta": {
      "title": "系统设置",
      "menu_id":"1",
      "icon":"el-icon-s-tools"
    },
    "children": [
      {
        "name": "role",
        "meta": {
          "title": "角色",
          "menu_id":"1_1",
          "icon":"el-icon-s-check"
        }
      },
      {
        "name": "group",
        "meta": {
          "title": "部门",
          "menu_id":"1_2",
          "icon":"el-icon-notebook-2"
        }
      },
      {
        "name": "user",
        "meta": {
          "title": "员工",
          "menu_id":"1_3",
          "icon":"el-icon-s-custom"
        }
      },      
      {
        "name": "project",
        "meta": {
          "title": "项目",
          "menu_id":"1_4",
          "icon":"el-icon-s-flag"
        }
      }          
    ]
  },  
  {
    "name": "media",
    "meta": {
        "title": "文件资源",
        "menu_id":"2",
        "icon":"el-icon-folder-opened"      
    }   
  },
  {
    "name": "issues",
    "meta": {
        "title": "我的工作",
        "menu_id":"3",
        "icon":"el-icon-s-grid"      
    }   
  },
  {
    "name": "issuec_reate",
    "meta": {
        "title": "新建事务",
        "menu_id":"4",
        "icon":"el-icon-plus"      
    }   
  }
]');


function checkMenu($grades, &$menus)
{
  if(!$grades) {$menus=[]; return;}
  
	$n=sizeof($menus);
	$key = 0;
	
	for($i=0; $i<$n; $i++)
	{
		$m=$menus[$key];
		
		if(!in_array($m["meta"]["menu_id"], $grades))
		{ 
				array_splice($menus, $key, 1);
				continue;
		}
		
		if(isset($m["children"])) 
			checkMenu($grades, $menus[$key]["children"]);
		
		$key++;
	}
}