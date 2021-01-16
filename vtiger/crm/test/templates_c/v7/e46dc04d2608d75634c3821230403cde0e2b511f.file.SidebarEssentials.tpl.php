<?php /* Smarty version Smarty-3.1.7, created on 2020-12-14 09:24:37
         compiled from "/var/www/html/crm/includes/runtime/../../layouts/v7/modules/Documents/partials/SidebarEssentials.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6559632345fd6fe1da494d4-38349190%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e46dc04d2608d75634c3821230403cde0e2b511f' => 
    array (
      0 => '/var/www/html/crm/includes/runtime/../../layouts/v7/modules/Documents/partials/SidebarEssentials.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6559632345fd6fe1da494d4-38349190',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'CUSTOM_VIEWS' => 0,
    'GROUP_LABEL' => 0,
    'GROUP_CUSTOM_VIEWS' => 0,
    'VIEWID' => 0,
    'CUSTOM_VIEW' => 0,
    'CURRENT_TAG' => 0,
    'FOLDER_VALUE' => 0,
    'VIEWNAME' => 0,
    'FOLDERS' => 0,
    'FOLDER' => 0,
    'FOLDERNAME' => 0,
    'ALL_CUSTOMVIEW_MODEL' => 0,
    'TAGS' => 0,
    'TAG_MODEL' => 0,
    'TAG_ID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5fd6fe1dc2b4f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd6fe1dc2b4f')) {function content_5fd6fe1dc2b4f($_smarty_tpl) {?>
<div class="sidebar-menu sidebar-menu-full">
    <div class="module-filters" id="module-filters">
        <div class="sidebar-container lists-menu-container">
            <div class="sidebar-header clearfix">
                <h5 class="pull-left">Lists </h5>
                <button id="createFilter" data-url="<?php echo CustomView_Record_Model::getCreateViewUrl($_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="btn btn-default pull-right sidebar-btn">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </button> 
            </div>
            <hr>
            <div>
                <input class="search-list" type="text" placeholder="Search for List">
            </div>
            <div class="menu-scroller mCustomScrollBox" data-mcs-theme="dark">
                <div class="mCustomScrollBox mCS-light-2 mCSB_inside" tabindex="0">
                    <div class="mCSB_container" style="position:relative; top:0; left:0;">
                        <div class="list-menu-content">
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
                                    <div class="list-group">   
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
                                        <?php  $_smarty_tpl->tpl_vars["CUSTOM_VIEW"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["customView"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->key => $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->value){
$_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["customView"]['iteration']++;
?>
                                            <li style="font-size:12px;" class='listViewFilter <?php if ($_smarty_tpl->tpl_vars['VIEWID']->value==$_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId()&&($_smarty_tpl->tpl_vars['CURRENT_TAG']->value=='')&&!$_smarty_tpl->tpl_vars['FOLDER_VALUE']->value){?> active<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['customView']['iteration']>5){?> filterHidden hide<?php }?> '>
                                                <?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['VIEWNAME'] = new Smarty_variable($_tmp1, null, 0);?> 
                                                <a class="filterName" href="javascript:;" data-filter-id="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId();?>
"><?php ob_start();?><?php echo strlen($_smarty_tpl->tpl_vars['VIEWNAME']->value)>40;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?> <?php echo htmlspecialchars(substr($_smarty_tpl->tpl_vars['VIEWNAME']->value,0,40), ENT_QUOTES, 'UTF-8', true);?>
..<?php }else{ ?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['VIEWNAME']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?></a> 
                                                    <div class=" pull-right">
                                                        <span class="js-popover-container">
                                                    <span class="fa fa-angle-down" rel="popover" data-toggle="popover" aria-expanded="true" 
                                                        <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isMine()&&$_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname')!='All'){?>
                                                            data-deletable="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDeletable()){?>true<?php }else{ ?>false<?php }?>" data-editable="<?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isEditable()){?>true<?php }else{ ?>false<?php }?>" 
                                                            <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isEditable()){?>  data-editurl="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getEditUrl();?>
<?php }?>" <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDeletable()){?> data-deleteurl="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getDeleteUrl();?>
"<?php }?>
                                                            <?php }?>
                                                          toggleClass="fa <?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDefault()){?>fa-check-square-o<?php }else{ ?>fa-square-o<?php }?>" data-filter-id="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getId();?>
" 
                                                          data-is-default="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->isDefault();?>
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
                                            <a class="toggleFilterSize" data-more-text="Show more" data-less-text="Show less"> 
                                                <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['customView']['iteration']>5){?>
                                                    <?php echo vtranslate('LBL_SHOW_MORE','Vtiger');?>

                                                <?php }?>
                                            </a>
                                        </div>
                                     </div>
                                    <?php } ?>
                                    <div id="filterActionPopoverHtml">
                                        <ul class="listmenu hide" role="menu">
                                            <li role="presentation" class="editFilter">
                                                <a role="menuitem"><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                            </li>
                                            <li role="presentation" class="deleteFilter ">
                                                <a role="menuitem"><i class="fa fa-trash"></i>&nbsp;<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                            </li>
                                            <li role="presentation" class="duplicateFilter">
                                                <a role="menuitem" ><i class="fa fa-files-o"></i>&nbsp;<?php echo vtranslate('LBL_DUPLICATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                                                </li>
                                            <li role="presentation" class="toggleDefault" >
                                                    <a role="menuitem" >
                                                    <i data-check-icon="fa-check-square-o" data-uncheck-icon="fa-square-o"></i>&nbsp;<?php echo vtranslate('LBL_DEFAULT',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                                    </a>
                                                </li>
                                            </ul>
                                    </div>
                                <?php }?>
                                <div class="list-group hide noLists">
                                    <h6 class="lists-header"><center> <?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate('Lists');?>
 <?php echo vtranslate('LBL_FOUND');?>
 ... </center></h6>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
                                
            <div class="list-menu-content">
                <div class="list-group">
                    <div class="sidebar-header clearfix">
                        <h5 class="pull-left"><?php echo vtranslate('LBL_FOLDERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5>
                        <button id="createFolder" class="btn btn-default pull-right sidebar-btn">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                    <hr>
                    <div>
                        <input class="search-folders" type="text" placeholder="Search for Folders">
                    </div>
                    <div class="menu-scroller mCustomScrollBox" data-mcs-theme="dark">
                        <div class="mCustomScrollBox mCS-light-2 mCSB_inside" tabindex="0">
                            <div class="mCSB_container" style="position:relative; top:0; left:0;">
                                <ul id="folders-list" class="lists-menu">
                                <?php  $_smarty_tpl->tpl_vars["FOLDER"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["FOLDER"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FOLDERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["FOLDER"]->key => $_smarty_tpl->tpl_vars["FOLDER"]->value){
$_smarty_tpl->tpl_vars["FOLDER"]->_loop = true;
?>
                                     <?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOLDER']->value->get('foldername'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['FOLDERNAME'] = new Smarty_variable($_tmp3, null, 0);?> 
                                    <li style="font-size:12px;" class='documentFolder <?php if ($_smarty_tpl->tpl_vars['FOLDER_VALUE']->value==$_smarty_tpl->tpl_vars['FOLDER']->value->getName()){?> active<?php }?>'>
                                        <a class="filterName" href="javascript:void(0);" data-filter-id="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->get('folderid');?>
" data-folder-name="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->get('foldername');?>
" title="<?php echo $_smarty_tpl->tpl_vars['FOLDERNAME']->value;?>
">
                                            <i class="fa <?php if ($_smarty_tpl->tpl_vars['FOLDER_VALUE']->value==$_smarty_tpl->tpl_vars['FOLDER']->value->getName()){?>fa-folder-open<?php }else{ ?>fa-folder<?php }?>"></i> 
                                            <span class="foldername"><?php ob_start();?><?php echo strlen($_smarty_tpl->tpl_vars['FOLDERNAME']->value)>40;?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4){?> <?php echo htmlspecialchars(substr($_smarty_tpl->tpl_vars['FOLDERNAME']->value,0,40), ENT_QUOTES, 'UTF-8', true);?>
..<?php }else{ ?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FOLDERNAME']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?></span>
                                        </a>
                                        <?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->getName()!='Default'&&$_smarty_tpl->tpl_vars['FOLDER']->value->getName()!='Google Drive'&&$_smarty_tpl->tpl_vars['FOLDER']->value->getName()!='Dropbox'){?>
                                            <div class="dropdown pull-right">
                                                <span class="fa fa-caret-down dropdown-toggle" data-toggle="dropdown" aria-expanded="true"></span>
                                                <ul class="dropdown-menu dropdown-menu-right vtDropDown" role="menu">
                                                    <li class="editFolder " data-folder-id="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->get('folderid');?>
">
                                                        <a role="menuitem" ><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>
                                                    </li>
                                                    <li class="deleteFolder " data-deletable="<?php echo !$_smarty_tpl->tpl_vars['FOLDER']->value->hasDocuments();?>
" data-folder-id="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->get('folderid');?>
">
                                                        <a role="menuitem" ><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php }?>
                                    </li>
                                <?php } ?>
                                <li class="noFolderText" style="display: none;">
                                    <h6 class="lists-header"><center> 
                                        <?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate('LBL_FOLDERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
 ... 
                                    </center></h6>    
                                </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            
        </div>
    </div>
    <div class="module-filters">
        <div class="sidebar-container lists-menu-container">
            <h4 class="lists-header">
                <?php echo vtranslate('LBL_TAGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

            </h4>
            <hr>
            <div class="menu-scroller mCustomScrollBox">
                <div class="mCustomScrollBox mCS-light-2 mCSB_inside" tabindex="0">
                    <div class="mCSB_container" style="position:relative; top:0; left:0;">
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
                        <div id="editTagContainer" class="hide">
                            <input type="hidden" name="id" value="" />
                            <div class="editTagContents">
                                <div>
                                    <input type="text" name="tagName" class="createtag" value="" style="width:100%" />
                                </div>
                                <div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" name="visibility" value="<?php echo Vtiger_Tag_Model::PRIVATE_TYPE;?>
"/>
                                            <input type="checkbox" name="visibility" value="<?php echo Vtiger_Tag_Model::PUBLIC_TYPE;?>
" />
                                            &nbsp; <?php echo vtranslate('LBL_MAKE_PUBLIC',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-mini btn-success saveTag" style="width:50%;float:left">
                                    <center> <i class="fa fa-check"></i> </center>
                                </button>
                                <button class="btn btn-mini btn-danger cancelSaveTag" style="width:50%">
                                    <center> <i class="fa fa-close"></i> </center>
                                </button>
                            </div>
                        </div>
                   </div>
               </div>
            </div>
        </div>
     </div>
</div><?php }} ?>