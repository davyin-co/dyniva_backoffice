# 介绍
Drupal后台管理优化。

# 功能
* 提供开箱即用的Drupal后台配置管理，默认支持dyniva_admin主题；其他主题暂未适配与测试。
* 提供统一的/manage入口，如果需要加入新的菜单条目，建议地址以/manage开始。
* 对常规操作，如内容管理，用户管理，媒体管理，站点信息，翻译等后台操作整合。
* 兼容admin_audit_trail模块。
* 默认提供views: manage_content，对在该views下创建的page,会自动添加到"Content"菜单下。

# 开发说明
添加新的菜单，有如下三种方式：
1. 手工编辑manage菜单添加
2. 在自定义的模块执行MY_MODULE.links.menu.yml添加。[参考](https://github.com/davyin-co/dyniva_backoffice/blob/1.x/dyniva_backoffice.links.menu.yml)
3. 在自定义的模块执行hook_menu_links_discovered_alter()添加，[参考](https://github.com/davyin-co/dyniva_backoffice/blob/1.x/dyniva_backoffice.module)



