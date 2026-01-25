<?php
define('TIMESTAMP',time());
define('SIGN', md5(APPKEY.APPSECERT.TIMESTAMP));
$model = init_submodel("account", "account");
$user = $model->__getRow("userid", 1);
$token = $user["token"];

define('API_DEF', '[

  {"name": "系统设置", "functions":[
    {
      "name":"权限列表",
      "api":"api/account/gradeList",
      "params":[
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"角色列表",
      "api":"api/account/roleList",
      "params":[
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"新增角色",
      "api":"api/account/roleAdd",
      "params":[
        {"name":"role_name", "type":"string", "cn_name":"角色名称", "is_must":1, "example":"系统管理员"},
        {"name":"role_grade", "type":"string", "cn_name":"角色权限", "is_must":1, "example":"[1, 1_1]"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"删除角色",
      "api":"api/account/roleDel",
      "params":[
        {"name":"roleid", "type":"int", "cn_name":"角色标识", "is_must":1, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"修改角色",
      "api":"api/account/roleMod",
      "params":[
        {"name":"roleid", "type":"int", "cn_name":"角色标识", "is_must":1, "example":"1"},
        {"name":"role_name", "type":"string", "cn_name":"角色名称", "is_must":1, "example":"系统管理员"},
        {"name":"role_grade", "type":"string", "cn_name":"角色权限", "is_must":1, "example":"[1, 1_1]"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"系统账号",
      "api":"api/account/list",
      "params":[       
        {"name":"page", "type":"int", "cn_name":"页码", "is_must":0, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"新增账号",
      "api":"api/account/add",
      "params":[
        {"name":"name", "type":"string", "cn_name":"姓名", "is_must":1, "example":"1"},
        {"name":"phone", "type":"string", "cn_name":"手机号", "is_must":1, "example":"13800138000"},
        {"name":"roleid", "type":"int", "cn_name":"角色标识", "is_must":1, "example":"1"},   
        {"name":"password", "type":"string", "cn_name":"密码", "is_must":1, "example":"123456"},            
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"删除账号",
      "api":"api/account/del",
      "params":[
        {"name":"userid", "type":"int", "cn_name":"账号标识", "is_must":1, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"修改账号",
      "api":"api/account/mod",
      "params":[
        {"name":"userid", "type":"int", "cn_name":"账号标识", "is_must":1, "example":"1"},
        {"name":"name", "type":"string", "cn_name":"姓名", "is_must":1, "example":"1"},
        {"name":"phone", "type":"string", "cn_name":"手机号", "is_must":1, "example":"13800138000"},
        {"name":"roleid", "type":"int", "cn_name":"角色标识", "is_must":1, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },

    {
      "name":"重置账号密码",
      "api":"api/account/modPwd",
      "params":[
        {"name":"userid", "type":"int", "cn_name":"账号标识", "is_must":1, "example":"1"},
        {"name":"password", "type":"string", "cn_name":"密码", "is_must":1, "example":"123456"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },

    {
      "name":"修改密码",
      "api":"api/account/passwordReset",
      "params":[        
        {"name":"password", "type":"string", "cn_name":"密码", "is_must":1, "example":"123456"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },

    {
      "name":"账号设置",
      "api":"api/account/userInfoReset",
      "params":[        
        {"name":"name", "type":"string", "cn_name":"姓名", "is_must":1, "example":"1"},
        {"name":"headimg", "type":"string", "cn_name":"头像", "is_must":1, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    }
  ]},
  {"name": "部门管理", "functions":[
    {
      "name":"分组树",
      "api":"api/group/tree",
      "params":[
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"分组列表",
      "api":"api/group/list",
      "params":[
        {"name":"pid", "type":"string", "cn_name":"父ID", "is_must":1, "example":"0"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"新建分组",
      "api":"api/group/add",
      "params":[
        {"name":"pid", "type":"int", "cn_name":"父ID", "is_must":1, "example":"0"},
        {"name":"group_name", "type":"string", "cn_name":"分组名称", "is_must":1, "example":"艺术品"},
        {"name":"sort", "type":"string", "cn_name":"排序序号", "is_must":0, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"修改分组",
      "api":"api/group/mod",
      "params":[
        {"name":"group_id", "type":"int", "cn_name":"分组ID", "is_must":1, "example":"0"},
        {"name":"group_name", "type":"string", "cn_name":"分组名称", "is_must":1, "example":"艺术品"},
        {"name":"sort", "type":"string", "cn_name":"排序序号", "is_must":0, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"删除分组",
      "api":"api/group/del",
      "params":[
        {"name":"group_id", "type":"int", "cn_name":"分组ID", "is_must":1, "example":"0"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    }
  ]},
  {"name": "项目管理", "functions":[
    {
      "name":"项目列表",
      "api":"api/project/list",
      "params":[
        {"name":"query_str", "type":"string", "cn_name":"查询字符", "is_must":0, "example":"138"}, 
        {"name":"page", "type":"int", "cn_name":"页码", "is_must":0, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"新增项目",
      "api":"api/project/add",
      "params":[
        {"name":"name", "type":"string", "cn_name":"名称", "is_must":1, "example":"1"},
        {"name":"intro", "type":"string", "cn_name":"描述", "is_must":0, "example":"1"},
        {"name":"logo", "type":"string", "cn_name":"logo", "is_must":0, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"修改项目",
      "api":"api/project/mod",
      "params":[
        {"name":"id", "type":"int", "cn_name":"项目标识", "is_must":1, "example":"1"},
        {"name":"name", "type":"string", "cn_name":"名称", "is_must":1, "example":"1"},
        {"name":"intro", "type":"string", "cn_name":"描述", "is_must":0, "example":"1"},
        {"name":"logo", "type":"string", "cn_name":"logo", "is_must":0, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"删除项目",
      "api":"api/project/del",
      "params":[
        {"name":"id", "type":"int", "cn_name":"项目标识", "is_must":1, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"流程列表",
      "api":"api/project/flowList",
      "params":[
        {"name":"project_id", "type":"int", "cn_name":"项目标识", "is_must":1, "example":"1"},       
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"流程信息",
      "api":"api/project/flowInfo",
      "params":[
        {"name":"flow_id", "type":"int", "cn_name":"流程标识", "is_must":1, "example":"1"},       
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"新增流程",
      "api":"api/project/flowAdd",
      "params":[
        {"name":"project_id", "type":"int", "cn_name":"项目标识", "is_must":1, "example":"1"},
        {"name":"name", "type":"int", "cn_name":"流程名称", "is_must":0, "example":"1"},
        {"name":"intro", "type":"int", "cn_name":"流程简介", "is_must":0, "example":"1"},     
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"修改流程",
      "api":"api/project/flowMod",
      "params":[
        {"name":"flow_id", "type":"int", "cn_name":"流程标识", "is_must":0, "example":"1"}, 
        {"name":"project_id", "type":"int", "cn_name":"项目标识", "is_must":1, "example":"1"},
        {"name":"name", "type":"int", "cn_name":"流程名称", "is_must":0, "example":"1"},
        {"name":"intro", "type":"int", "cn_name":"流程简介", "is_must":0, "example":"1"},       
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"删除流程",
      "api":"api/project/flowDel",
      "params":[        
        {"name":"flow_id", "type":"int", "cn_name":"流程标识", "is_must":0, "example":"1"},        
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"状态列表",
      "api":"api/project/flowStatus",
      "params":[
        {"name":"flow_id", "type":"int", "cn_name":"流程标识", "is_must":0, "example":"1"},        
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
     {
      "name":"流程状态修改",
      "api":"api/project/flowStautsMod",
      "params":[
        {"name":"flow_id", "type":"int", "cn_name":"流程标识", "is_must":0, "example":"1"},
        {"name":"status", "type":"String", "cn_name":"全部状态信息", "is_must":1, "example":"[{\"name\":\"xx\", \"intro\":\"xxx\", \"is_begin\":0, \"is_end\":0}]"},  
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"流转信息",
      "api":"api/project/flowActions",
      "params":[
        {"name":"flow_id", "type":"int", "cn_name":"流程标识", "is_must":0, "example":"1"},       
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },   
    {
      "name":"流程流转修改",
      "api":"api/project/flowActionMod",
      "params":[
        {"name":"flow_id", "type":"int", "cn_name":"流程标识", "is_must":0, "example":"1"},
        {"name":"actions", "type":"String", "cn_name":"流转信息", "is_must":1, "example":"1"},  
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"流程图修改",
      "api":"api/project/flowChartMod",
      "params":[
        {"name":"flow_id", "type":"int", "cn_name":"流程标识", "is_must":0, "example":"1"},
        {"name":"status", "type":"String", "cn_name":"全部状态信息", "is_must":1, "example":"[{\"name\":\"xx\", \"intro\":\"xxx\", \"is_begin\":0, \"is_end\":0}]"},  
        {"name":"actions", "type":"String", "cn_name":"流转信息", "is_must":1, "example":"1"},
        {"name":"chart", "type":"String", "cn_name":"流转图信息", "is_must":1, "example":"1"},  
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    }
  ]},
  {"name": "任务管理", "functions":[
    {
      "name":"任务列表",
      "api":"api/issue/list",
      "params":[
        {"name":"query_str", "type":"String", "cn_name":"查询字符", "is_must":0, "example":"138"},
        {"name":"query_code", "type":"String", "cn_name":"查询代码", "is_must":0, "example":"138"}, 
        {"name":"page", "type":"int", "cn_name":"页码", "is_must":0, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"任务详情",
      "api":"api/issue/info",
      "params":[
        {"name":"issue_id", "type":"int", "cn_name":"任务标识", "is_must":0, "example":"138"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"任务动作",
      "api":"api/issue/actions",
      "params":[
        {"name":"issue_id", "type":"int", "cn_name":"任务标识", "is_must":0, "example":"138"},
        {"name":"page", "type":"int", "cn_name":"页码", "is_must":0, "example":"138"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"新增任务",
      "api":"api/issue/add",
      "params":[
        {"name":"project_id", "type":"int", "cn_name":"项目标识", "is_must":1, "example":"1"},
        {"name":"flow_id", "type":"int", "cn_name":"应用流程", "is_must":1, "example":"1"},
        {"name":"title", "type":"string", "cn_name":"标题", "is_must":1, "example":"1"},
        {"name":"content", "type":"string", "cn_name":"内容", "is_must":1, "example":"1"},        
        {"name":"severity", "type":"int", "cn_name":"严重程度", "is_must":1, "example":"1"},
        {"name":"priority", "type":"int", "cn_name":"优先级", "is_must":1, "example":"1"},
        {"name":"workers", "type":"string", "cn_name":"处理人", "is_must":1, "example":"1"},
        {"name":"btime", "type":"string", "cn_name":"开始时间", "is_must":1, "example":"1"},
        {"name":"etime", "type":"string", "cn_name":"结束时间", "is_must":1, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"查询处理人",
      "api":"api/issue/queryWorker",
      "params":[
        {"name":"query_str", "type":"string", "cn_name":"查询字符", "is_must":0, "example":"138"}, 
        {"name":"project_id", "type":"int", "cn_name":"项目标识", "is_must":0, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    },
    {
      "name":"处理事务",
      "api":"api/issue/submit",
      "params":[
        {"name":"issue_id", "type":"string", "cn_name":"查询字符", "is_must":1, "example":"138"}, 
        {"name":"workers", "type":"string", "cn_name":"处理人", "is_must":1, "example":"1"},
        {"name":"status", "type":"string", "cn_name":"目标状态", "is_must":1, "example":"1"},
        {"name":"content", "type":"string", "cn_name":"处理内容", "is_must":1, "example":"1"},
        {"name":"token", "type":"string", "cn_name":"用户凭证", "is_must":1, "example":"'.$token.'"}
      ]
    }
  ]}
]');