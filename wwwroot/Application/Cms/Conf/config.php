<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi.cn@gmail.com> <http://www.thinkphp.cn>
// +----------------------------------------------------------------------

/**
 * 前台配置文件
 * 所有除开系统级别的前台配置
 */
return array(
    /* 模块相关配置 */
    'EXTEND_MODULE'  => array('Addons' => MODULE_PATH . 'Addons/'), //扩展模块列表

    /* 数据库配置 */
    'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => '192.168.1.200'/*'localhost'*/, // 服务器地址
    'DB_NAME'   => 'thinkcms', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'think_', // 数据库表前缀

    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX' => 'think_cms_', // 缓存前缀
    'DATA_CACHE_TYPE'   => 'File', // 数据缓存类型

    /* 用户相关设置 */
    'USER_MAX_CACHE'     => 1000, //最大缓存用户数
    'USER_ADMINISTRATOR' => 1, //管理员用户ID

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => 'kd23()#20okifi4fj)(03JF!@#$%^&*', //默认数据加密KEY

    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => '', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Download/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）
    
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__ADDONS__' => __ROOT__ . '/Public/Cms/Addons',
        '__IMG__'    => __ROOT__ . '/Public/Cms/images',
        '__CSS__'    => __ROOT__ . '/Public/Cms/css',
        '__JS__'     => __ROOT__ . '/Public/Cms/js',
    ),

    /* SESSION配置 */
    'SESSION_PREFIX' => 'think_cms', //session前缀

    /* 默认插件定义 */
    'ADDONS_HOOKS_WIDGET' => array(
        'page_header'            => array('Attachment'),
        'document_edit_form'     => array('Attachment'),
        'document_detail_before' => array(),
        'document_detail_after'  => array('Attachment'),
        'page_footer'            => array('Attachment'),
    ),
    'ADDONS_HOOKS_CONTROLLER' => array(
        'document_save_complete' => array('Attachment'),
    ),

    /**
     * 附件相关配置
     * 附件是规划在插件中的，所以附件的配置暂时写到这里
     * 后期会移动到数据库进行管理
     */
    'ATTACHMENT_DEFAULT' => array( 
        'is_upload'     => true,
        'allow_type'    => '0,1,2', //允许的附件类型 (0-目录，1-外链，2-文件)
        'driver'        => 'Local', //上传驱动
        'driver_config' => null, //驱动配置
    ), //附件默认配置
    'ATTACHMENT_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => '', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Attachment/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //附件上传配置（文件上传类配置）

);