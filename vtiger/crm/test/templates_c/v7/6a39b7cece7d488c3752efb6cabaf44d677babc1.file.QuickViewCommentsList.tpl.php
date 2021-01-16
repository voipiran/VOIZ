<?php /* Smarty version Smarty-3.1.7, created on 2018-12-08 14:41:50
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/QuickViewCommentsList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12853290475c0ba6f69ceec4-45857666%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a39b7cece7d488c3752efb6cabaf44d677babc1' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/QuickViewCommentsList.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12853290475c0ba6f69ceec4-45857666',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COMMENTS' => 0,
    'COMMENT' => 0,
    'IMAGE_PATH' => 0,
    'CREATOR_NAME' => 0,
    'FILE_DETAILS' => 0,
    'FILE_DETAIL' => 0,
    'FILE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c0ba6f6a8e0b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c0ba6f6a8e0b')) {function content_5c0ba6f6a8e0b($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["COMMENT_TEXTAREA_DEFAULT_ROWS"] = new Smarty_variable("2", null, 0);?>
<div class = "summaryWidgetContainer">
    <div class="recentComments">
        <div class="commentsBody container-fluid" style = "height:100%">
            <?php if (!empty($_smarty_tpl->tpl_vars['COMMENTS']->value)){?>
                <div class="recentCommentsBody row">
                    <br>
                    <?php  $_smarty_tpl->tpl_vars['COMMENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['COMMENT']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['COMMENTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['COMMENT']->key => $_smarty_tpl->tpl_vars['COMMENT']->value){
$_smarty_tpl->tpl_vars['COMMENT']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['COMMENT']->key;
?>
                        <?php $_smarty_tpl->tpl_vars['CREATOR_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedByName(), null, 0);?>
                        <div class="commentDetails">
                            <div class="singleComment">
                                <?php $_smarty_tpl->tpl_vars['PARENT_COMMENT_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getParentCommentModel(), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['CHILD_COMMENTS_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getChildComments(), null, 0);?>
                                <div class="container-fluid">
                                    <div class="row">
                                         <div class="col-lg-2 recordImage commentInfoHeader" data-commentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->getId();?>
" data-parentcommentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('parent_comments');?>
" data-relatedto = "<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to');?>
">
                                            <?php $_smarty_tpl->tpl_vars['IMAGE_PATH'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getImagePath(), null, 0);?>
                                                <?php if (!empty($_smarty_tpl->tpl_vars['IMAGE_PATH']->value)){?>
                                                    <img src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_PATH']->value;?>
" width="100%" height="100%" align="left">
                                                <?php }else{ ?>
                                                    <div class="name"><span><strong> <?php echo substr($_smarty_tpl->tpl_vars['CREATOR_NAME']->value,0,2);?>
 </strong></span></div>
                                                <?php }?>
                                        </div>
                                        <div class="comment col-lg-10">
                                            <span class="creatorName">
                                                <?php echo $_smarty_tpl->tpl_vars['CREATOR_NAME']->value;?>

                                            </span>&nbsp;&nbsp;
                                            <div class="">
                                                <span class="commentInfoContent">
                                                    <?php echo nl2br($_smarty_tpl->tpl_vars['COMMENT']->value->get('commentcontent'));?>

                                                </span>
                                            </div>
                                            <br>
                                            <div class="commentActionsContainer">      
                                                <span class="commentTime pull-right">
                                                    <p class="muted"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedTime());?>
"><?php echo Vtiger_Util_Helper::formatDateAndDateDiffInString($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedTime());?>
</small></p>
                                                </span>
                                            </div>
                                            <div style="margin-top:5px;">
												<?php $_smarty_tpl->tpl_vars["FILE_DETAILS"] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getFileNameAndDownloadURL(), null, 0);?>
                                                <?php  $_smarty_tpl->tpl_vars['FILE_DETAIL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILE_DETAIL']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FILE_DETAILS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILE_DETAIL']->key => $_smarty_tpl->tpl_vars['FILE_DETAIL']->value){
$_smarty_tpl->tpl_vars['FILE_DETAIL']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['FILE_DETAIL']->key;
?>
                                                    <?php $_smarty_tpl->tpl_vars["FILE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['FILE_DETAIL']->value['trimmedFileName'], null, 0);?>
                                                    <?php if (!empty($_smarty_tpl->tpl_vars['FILE_NAME']->value)){?>
                                                        <a onclick="Vtiger_List_Js.previewFile(event,<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('id');?>
,<?php echo $_smarty_tpl->tpl_vars['FILE_DETAIL']->value['attachmentId'];?>
);" data-filename="<?php echo $_smarty_tpl->tpl_vars['FILE_NAME']->value;?>
" href="javascript:void(0)" name="viewfile">
                                                            <span title="<?php echo $_smarty_tpl->tpl_vars['FILE_DETAILS']->value['rawFileName'];?>
" style="line-height:1.5em;"><?php echo $_smarty_tpl->tpl_vars['FILE_NAME']->value;?>
</span>&nbsp
                                                        </a>
                                                        <br>
                                                    <?php }?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    <?php } ?>
                </div>
            <?php }else{ ?>
                <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("NoComments.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            <?php }?>
        </div>
    </div>
</div>
<?php }} ?>