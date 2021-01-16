<?php /* Smarty version Smarty-3.1.7, created on 2018-04-16 11:49:39
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/partials/SidebarEssentials.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16413051925ad44e8ba6b728-15336830%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb1bd40c58b183897431656e8561acb19f7b18ff' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/partials/SidebarEssentials.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16413051925ad44e8ba6b728-15336830',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'CUSTOM_VIEWS' => 0,
    'GROUP_LABEL' => 0,
    'GROUP_CUSTOM_VIEWS' => 0,
    'MODULE_MODEL' => 0,
    'CUSTOM_VIEW' => 0,
    'CUSTOME_VIEW_RECORD_MODEL' => 0,
    'MEMBERS' => 0,
    'MEMBER_LIST' => 0,
    'VIEWID' => 0,
    'CURRENT_TAG' => 0,
    'VIEWNAME' => 0,
    'LISTVIEW_URL' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'SHARED_MEMBER_COUNT' => 0,
    'LIST_STATUS' => 0,
    'IS_DEFAULT' => 0,
    'count' => 0,
    'CUSTOM_VIEWS_NAMES' => 0,
    'EXTENSION_LINKS' => 0,
    'LINK' => 0,
    'EXTENSION_MODULE' => 0,
    'ALL_CUSTOMVIEW_MODEL' => 0,
    'TAGS' => 0,
    'TAG_MODEL' => 0,
    'TAG_ID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ad44e8bda080',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad44e8bda080')) {function content_5ad44e8bda080($_smarty_tpl) {?>
<div class="sidebar-menu">
    <div class="module-filters" id="module-filters">
        <div class="sidebar-container lists-menu-container">
            <div class="sidebar-header clearfix">
                <h5 class="pull-left"><?php echo vtranslate('LBL_LISTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5>
                <button id="createFilter" data-url="<?php echo CustomView_Record_Model::getCreateViewUrl($_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="btn btn-sm btn-default pull-right sidebar-btn" title="<?php echo vtranslate('LBL_CREATE_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
                    <div class="fa fa-plus" aria-hidden="true"></div>
                </button> 
            </div>
            <hr>
            <div>
                <input class="search-list" type="text" placeholder="<?php echo vtranslate('LBL_SEARCH_FOR_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
            </div>
            <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
				<div class="list-menu-content">
						<?php $_smarty_tpl->tpl_vars["CUSTOM_VIEW_NAMES"] = new Smarty_variable(array(), null, 0);?>
                        <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value&&count($_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value)>0){?>
                            <?php  $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->_loop = false;
 $_smarty_tpl->tpl_vars['GROUP_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->key => $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value){
$_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->_loop = true;
 $_smarty_tpl->tpl_vars['GROUP_LABEL']->value = $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->key;
?>
                            <?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value!='Mine'&&$_smarty_tpl->tpl_vars['GROUP_LABEL']->value!='Shared'){?>
                                <?php continue 1?>
                             <?php }?>
                            <div class="list-group" id="<?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value=='Mine'){?>myList<?php }else{ ?>sharedList<?php }?>">   
                                <h6 class="lists-header <?php if (count($_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value)<=0){?> hide <?php }?>" >
                                    <?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value=='Mine'){?>
                                        <?php echo vtranslate('LBL_MY_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                    <?php }else{ ?>
                                        <?php echo vtranslate('LBL_SHARED_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                    <?php }?>
                                </h6>
                                <input type="hidden" name="allCvId" value="<?php echo CustomView_Record_Model::getAllFilterByModule($_smarty_tpl->tpl_vars['MODULE']->value)->get('cvid');?>
" />
                                <ul class="lists-menu">
								<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(0, null, 0);?>
								<?php $_smarty_tpl->tpl_vars['LISTVIEW_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl(), null, 0);?>
                                <?php  $_smarty_tpl->tpl_vars["CUSTOM_VIEW"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["customView"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->key => $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->value){
$_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["customView"]['iteration']++;
?>
                                    <?php $_smarty_tpl->tpl_vars['IS_DEFAULT'] = new Smarty_variable($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDefault(), null, 0);?>
									<?php $_smarty_tpl->tpl_vars["CUSTOME_VIEW_RECORD_MODEL"] = new Smarty_variable(CustomView_Record_Model::getInstanceById($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId()), null, 0);?>
									<?php $_smarty_tpl->tpl_vars["MEMBERS"] = new Smarty_variable($_smarty_tpl->tpl_vars['CUSTOME_VIEW_RECORD_MODEL']->value->getMembers(), null, 0);?>
									<?php $_smarty_tpl->tpl_vars["LIST_STATUS"] = new Smarty_variable($_smarty_tpl->tpl_vars['CUSTOME_VIEW_RECORD_MODEL']->value->get('status'), null, 0);?>
									<?php  $_smarty_tpl->tpl_vars["MEMBER_LIST"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["MEMBER_LIST"]->_loop = false;
 $_smarty_tpl->tpl_vars['GROUP_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MEMBERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["MEMBER_LIST"]->key => $_smarty_tpl->tpl_vars["MEMBER_LIST"]->value){
$_smarty_tpl->tpl_vars["MEMBER_LIST"]->_loop = true;
 $_smarty_tpl->tpl_vars['GROUP_LABEL']->value = $_smarty_tpl->tpl_vars["MEMBER_LIST"]->key;
?>
										<?php if (count($_smarty_tpl->tpl_vars['MEMBER_LIST']->value)>0){?>
										<?php $_smarty_tpl->tpl_vars["SHARED_MEMBER_COUNT"] = new Smarty_variable(1, null, 0);?>
										<?php }?>
									<?php } ?>
									<li style="font-size:12px;" class='listViewFilter <?php if ($_smarty_tpl->tpl_vars['VIEWID']->value==$_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId()&&($_smarty_tpl->tpl_vars['CURRENT_TAG']->value=='')){?> active <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['customView']['iteration']>10){?> <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(1, null, 0);?> <?php }?> <?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['customView']['iteration']>10){?> filterHidden hide<?php }?> '> 
                                        <?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['VIEWNAME'] = new Smarty_variable($_tmp1, null, 0);?>
										<?php $_smarty_tpl->createLocalArrayVariable("CUSTOM_VIEW_NAMES", null, 0);
$_smarty_tpl->tpl_vars["CUSTOM_VIEW_NAMES"]->value[] = $_smarty_tpl->tpl_vars['VIEWNAME']->value;?>
                                         <a class="filterName listViewFilterElipsis" href="<?php echo (((($_smarty_tpl->tpl_vars['LISTVIEW_URL']->value).('&viewname=')).($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId())).('&app=')).($_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value);?>
" oncontextmenu="return false;" data-filter-id="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId();?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['VIEWNAME']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['VIEWNAME']->value, ENT_QUOTES, 'UTF-8', true);?>
</a> 
                                            <div class="pull-right">
                                                <span class="js-popover-container" style="cursor:pointer;">
                                                    <span  class="fa fa-angle-down" rel="popover" data-toggle="popover" aria-expanded="true" 
                                                <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isMine()&&$_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname')!='All'){?>
                                                            data-deletable="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDeletable()){?>true<?php }else{ ?>false<?php }?>" data-editable="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isEditable()){?>true<?php }else{ ?>false<?php }?>" 
                                                            <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isEditable()){?> data-editurl="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getEditUrl();?>
<?php }?>" <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDeletable()){?> <?php if ($_smarty_tpl->tpl_vars['SHARED_MEMBER_COUNT']->value==1||$_smarty_tpl->tpl_vars['LIST_STATUS']->value==3){?> data-shared="1"<?php }?> data-deleteurl="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getDeleteUrl();?>
"<?php }?>
                                                           <?php }?>
                                                          toggleClass="fa <?php if ($_smarty_tpl->tpl_vars['IS_DEFAULT']->value){?>fa-check-square-o<?php }else{ ?>fa-square-o<?php }?>" data-filter-id="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId();?>
" 
                                                          data-is-default="<?php echo $_smarty_tpl->tpl_vars['IS_DEFAULT']->value;?>
" data-defaulttoggle="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getToggleDefaultUrl();?>
" data-default="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getDuplicateUrl();?>
" data-isMine="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isMine()){?>true<?php }else{ ?>false<?php }?>">
                                                    </span>
                                                     </span>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
								<div class='clearfix'> 
									<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['customView']['iteration']-10-$_smarty_tpl->tpl_vars['count']->value){?> 
										<a class="toggleFilterSize" data-more-text=" <?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['customView']['iteration']-10-$_smarty_tpl->tpl_vars['count']->value;?>
 <?php echo strtolower(vtranslate('LBL_MORE','Vtiger'));?>
" data-less-text="Show less">
											<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['customView']['iteration']>10){?> 
												<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['customView']['iteration']-10-$_smarty_tpl->tpl_vars['count']->value;?>
 <?php echo strtolower(vtranslate('LBL_MORE','Vtiger'));?>
 
											<?php }?> 
										</a><?php }?> 
									</div>
                             </div>
					<?php } ?>
								
							<input type="hidden" id='allFilterNames'  value='<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($_smarty_tpl->tpl_vars['CUSTOM_VIEWS_NAMES']->value));?>
'/>
                            <div id="filterActionPopoverHtml">
                                <ul class="listmenu hide" role="menu">
                                    <li role="presentation" class="editFilter">
                                            <a role="menuitem"><i class="fa fa-pencil"></i>&nbsp;<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                        </li>
                                    <li role="presentation" class="deleteFilter">
                                            <a role="menuitem"><i class="fa fa-trash"></i>&nbsp;<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                    </li>
                                    <li role="presentation" class="duplicateFilter">
                                                <a role="menuitem" ><i class="fa fa-files-o"></i>&nbsp;<?php echo vtranslate('LBL_DUPLICATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                            </li>
                                    <li role="presentation" class="toggleDefault">
                                                <a role="menuitem" >
                                            <i data-check-icon="fa-check-square-o" data-uncheck-icon="fa-square-o"></i>&nbsp;<?php echo vtranslate('LBL_DEFAULT',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                </a>
                                            </li>
                                        </ul>
                            </div>

                        <?php }?>
                        <div class="list-group hide noLists">
                            <h6 class="lists-header"><center> <?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate('LBL_LISTS');?>
 <?php echo vtranslate('LBL_FOUND');?>
 ... </center></h6>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php $_smarty_tpl->tpl_vars['EXTENSION_LINKS'] = new Smarty_variable(Vtiger_Extension_View::getExtensionLinks($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?>
    <?php if (!empty($_smarty_tpl->tpl_vars['EXTENSION_LINKS']->value)){?>
        <div class="module-filters module-extensions">
            <div class="sidebar-container lists-menu-container">
                <h5 class="sidebar-header"><?php echo vtranslate('LBL_EXTENSIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5>
                <hr>
                <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
                    <div class="list-menu-content">
                        <ul class="lists-menu"> 
                            <?php  $_smarty_tpl->tpl_vars['LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['EXTENSION_LINKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LINK']->key => $_smarty_tpl->tpl_vars['LINK']->value){
$_smarty_tpl->tpl_vars['LINK']->_loop = true;
?>
                                <?php if ($_smarty_tpl->tpl_vars['LINK']->value->isExtensionAccessible()){?>
                                    <li style="font-size:12px;" class="listViewFilter <?php if ($_smarty_tpl->tpl_vars['EXTENSION_MODULE']->value==$_smarty_tpl->tpl_vars['LINK']->value->get('linklabel')){?> active <?php }?>">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['LINK']->value->get('linkurl');?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['LINK']->value->get('linklabel'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                    </li>
                                <?php }?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    <div class="module-filters">
        <div class="sidebar-container lists-menu-container">
            <h5 class="lists-header">
                <?php echo vtranslate('LBL_TAGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

            </h5>
            <hr>
            <div class="menu-scroller scrollContainer" style="position:relative; top:0; left:0;">
                <div class="list-menu-content">
                    <div id="listViewTagContainer" class="multiLevelTagList" 
                    <?php if ($_smarty_tpl->tpl_vars['ALL_CUSTOMVIEW_MODEL']->value){?> data-view-id="<?php echo $_smarty_tpl->tpl_vars['ALL_CUSTOMVIEW_MODEL']->value->getId();?>
" <?php }?>
                    data-list-tag-count="<?php echo Vtiger_Tag_Model::NUM_OF_TAGS_LIST;?>
">
                        <?php  $_smarty_tpl->tpl_vars['TAG_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['TAG_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TAGS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tagCounter']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['TAG_MODEL']->key => $_smarty_tpl->tpl_vars['TAG_MODEL']->value){
$_smarty_tpl->tpl_vars['TAG_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tagCounter']['iteration']++;
?>
                            <?php $_smarty_tpl->tpl_vars['TAG_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName(), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['TAG_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['TAG_MODEL']->value->getId(), null, 0);?>
                            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tagCounter']['iteration']>Vtiger_Tag_Model::NUM_OF_TAGS_LIST){?>
                                <?php break 1?>
                            <?php }?>
                            <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NO_DELETE'=>true,'ACTIVE'=>$_smarty_tpl->tpl_vars['CURRENT_TAG']->value==$_smarty_tpl->tpl_vars['TAG_ID']->value), 0);?>

                        <?php } ?>
                        <div> 
                            <a class="moreTags <?php if ((count($_smarty_tpl->tpl_vars['TAGS']->value)-Vtiger_Tag_Model::NUM_OF_TAGS_LIST)<=0){?> hide <?php }?>">
                                <span class="moreTagCount"><?php echo count($_smarty_tpl->tpl_vars['TAGS']->value)-Vtiger_Tag_Model::NUM_OF_TAGS_LIST;?>
</span>
                                &nbsp;<?php echo strtolower(vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value));?>

                            </a>
                            <div class="moreListTags hide">
                        <?php  $_smarty_tpl->tpl_vars['TAG_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['TAG_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TAGS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tagCounter']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['TAG_MODEL']->key => $_smarty_tpl->tpl_vars['TAG_MODEL']->value){
$_smarty_tpl->tpl_vars['TAG_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tagCounter']['iteration']++;
?>
                            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tagCounter']['iteration']<=Vtiger_Tag_Model::NUM_OF_TAGS_LIST){?>
                                <?php continue 1?>
                            <?php }?>
                            <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NO_DELETE'=>true,'ACTIVE'=>$_smarty_tpl->tpl_vars['CURRENT_TAG']->value==$_smarty_tpl->tpl_vars['TAG_ID']->value), 0);?>

                        <?php } ?>
                             </div>
                        </div>
                    </div>
                    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("AddTagUI.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_NAME'=>'','TAGS_LIST'=>array()), 0);?>

                </div>
                <div id="dummyTagElement" class="hide">
                    <?php $_smarty_tpl->tpl_vars['TAG_MODEL'] = new Smarty_variable(Vtiger_Tag_Model::getCleanInstance(), null, 0);?>
                    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NO_DELETE'=>true), 0);?>

                </div>
                <div>
                    <div class="editTagContainer hide">
                        <input type="hidden" name="id" value="" />
                        <div class="editTagContents">
                            <div>
                                <input type="text" name="tagName" value="" style="width:100%" maxlength="25"/>
                            </div>
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" name="visibility" value="<?php echo Vtiger_Tag_Model::PRIVATE_TYPE;?>
"/>
                                        <input type="checkbox" name="visibility" value="<?php echo Vtiger_Tag_Model::PUBLIC_TYPE;?>
" />
                                        &nbsp; <?php echo vtranslate('LBL_SHARE_TAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-mini btn-success saveTag" type="button" style="width:50%;float:left">
                                <center> <i class="fa fa-check"></i> </center>
                            </button>
                            <button class="btn btn-mini btn-danger cancelSaveTag" type="button" style="width:50%">
                                <center> <i class="fa fa-close"></i> </center>
                            </button>
                        </div>
                    </div>
                </div>
           </div>
        </div>
     </div>
</div>
<?php }} ?>