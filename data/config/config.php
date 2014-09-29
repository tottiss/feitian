<?php
return array(
    'APP_GROUP_LIST'		=> 'index,admin,m,manage',				// 分组
    'DEFAULT_GROUP'			=> 'index',						// 默认分组
    'DEFAULT_MODULE'		=> 'index',						// 默认控制器
	'TMPL_TEMPLATE_SUFFIX' => '.html',
    'TAGLIB_PRE_LOAD'		=> 'ftx',						// 自动加载标签
    'APP_AUTOLOAD_PATH'		=> '@.Ftxtag,@.Ftxlib,@.ORG',	// 自动加载项目类库
    'TMPL_ACTION_SUCCESS'	=> '/public:success',
    'TMPL_ACTION_ERROR'		=> '/public:error',
    'DATA_CACHE_SUBDIR'		=> false,						// 缓存文件夹
    'DATA_PATH_LEVEL'		=> 3,							// 缓存文件夹层级
    'LOAD_EXT_CONFIG'		=> 'url,db',					// 扩展配置
 
	'DATA_CACHE_TYPE'		=>'file',
	'DATA_CACHE_TIME'		=>'0', 
	'DATA_CACHE_LEVEL'		=>3,							// 设置子目录的层次
	
	#关闭缓存
	'DB_FIELD_CACH'			=>false,	
	'HTML_CACHE_ON'			=>false,
	'TMPL_CACHE_ON' 		=>false,
		
    'SHOW_PAGE_TRACE'		=> false,
	'APP_SUB_DOMAIN_DEPLOY' => false,						// 开启子域名配置
    'APP_SUB_DOMAIN_RULES'  => array(
		'www' => array("index/"),
		'admin' => array("admin/"),
		'm' => array("m/"),
	),

);