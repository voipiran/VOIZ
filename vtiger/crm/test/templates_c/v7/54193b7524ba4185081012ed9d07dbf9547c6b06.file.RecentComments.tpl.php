<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 11:14:26
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/RecentComments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15578029585c46c9dadabc26-53163234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54193b7524ba4185081012ed9d07dbf9547c6b06' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/RecentComments.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15578029585c46c9dadabc26-53163234',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COMMENTS_MODULE_MODEL' => 0,
    'IS_CREATABLE' => 0,
    'MODULE_NAME' => 0,
    'COMMENT_TEXTAREA_DEFAULT_ROWS' => 0,
    'PRIVATE_COMMENT_MODULES' => 0,
    'FIELD_MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
    'STARTINDEX' => 0,
    'ROLLUPID' => 0,
    'ROLLUP_STATUS' => 0,
    'PARENT_RECORD' => 0,
    'COMMENTS' => 0,
    'COMMENT' => 0,
    'IMAGE_PATH' => 0,
    'CREATOR_NAME' => 0,
    'SINGULR_MODULE' => 0,
    'ENTITY_NAME' => 0,
    'COMMENT_CONTENT' => 0,
    'MAX_LENGTH' => 0,
    'DISPLAYNAME' => 0,
    'MODULE' => 0,
    'FILE_DETAILS' => 0,
    'FILE_DETAIL' => 0,
    'FILE_NAME' => 0,
    'PARENT_COMMENT_MODEL' => 0,
    'CHILD_COMMENTS_MODEL' => 0,
    'CURRENTUSER' => 0,
    'IS_EDITABLE' => 0,
    'REASON_TO_EDIT' => 0,
    'index' => 0,
    'COMMENTS_COUNT' => 0,
    'PAGING_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46c9db10e4f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46c9db10e4f')) {function content_5c46c9db10e4f($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["COMMENT_TEXTAREA_DEFAULT_ROWS"] = new Smarty_variable("2", null, 0);?><?php $_smarty_tpl->tpl_vars["PRIVATE_COMMENT_MODULES"] = new Smarty_variable(Vtiger_Functions::getPrivateCommentModules(), null, 0);?><?php $_smarty_tpl->tpl_vars['IS_CREATABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value->isPermitted('CreateView'), null, 0);?><?php $_smarty_tpl->tpl_vars['IS_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENTS_MODULE_MODEL']->value->isPermitted('EditView'), null, 0);?><div class="commentContainer recentComments"><div class="commentTitle"><?php if ($_smarty_tpl->tpl_vars['IS_CREATABLE']->value){?><div class="addCommentBlock"><div class="row"><div class=" col-lg-12"><div class="commentTextArea "><textarea name="commentcontent" class="commentcontent form-control col-lg-12" placeholder="<?php echo vtranslate('LBL_POST_YOUR_COMMENT_HERE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" rows="<?php echo $_smarty_tpl->tpl_vars['COMMENT_TEXTAREA_DEFAULT_ROWS']->value;?>
"></textarea></div></div></div><div class='row'><div class="col-xs-6 pull-right paddingTop5 paddingLeft0"><div style="text-align: right;"><?php if (in_array($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['PRIVATE_COMMENT_MODULES']->value)){?><div class="" style="margin: 7px 0;"><label><input type="checkbox" id="is_private" style="margin:2px 0px -2px 0px">&nbsp;&nbsp;<?php echo vtranslate('LBL_INTERNAL_COMMENT');?>
</label>&nbsp;&nbsp;<i class="fa fa-question-circle cursorPointer" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo vtranslate('LBL_INTERNAL_COMMENT_INFO');?>
"></i>&nbsp;&nbsp;</div><?php }?><button class="btn btn-success btn-sm detailViewSaveComment" type="button" data-mode="add"><?php echo vtranslate('LBL_POST',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button></div></div><div class="col-xs-6 pull-left"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('MODULE'=>"ModComments"), 0);?>
</div></div></div><?php }?></div><hr><div class="recentCommentsHeader row"><h4 class="display-inline-block col-lg-7 textOverflowEllipsis" title="<?php echo vtranslate('LBL_RECENT_COMMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"><?php echo vtranslate('LBL_RECENT_COMMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value!='Leads'){?><div class="col-lg-5 commentHeader pull-right" style="margin-top:5px;text-align:right;padding-right:20px;"><div class="display-inline-block"><span class=""><?php echo vtranslate('LBL_ROLL_UP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 &nbsp;</span><span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="<?php echo vtranslate('LBL_ROLLUP_COMMENTS_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></span>&nbsp;&nbsp;</div><input type="checkbox" class="bootstrap-switch pull-right" id="rollupcomments" hascomments="1" startindex="<?php echo $_smarty_tpl->tpl_vars['STARTINDEX']->value;?>
" data-view="summary" rollupid="<?php echo $_smarty_tpl->tpl_vars['ROLLUPID']->value;?>
"rollup-status="<?php echo $_smarty_tpl->tpl_vars['ROLLUP_STATUS']->value;?>
" module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" record="<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value;?>
" checked data-on-color="success"/></div><?php }?></div><div class="commentsBody"><?php if (!empty($_smarty_tpl->tpl_vars['COMMENTS']->value)){?><div class="recentCommentsBody container-fluid"><?php $_smarty_tpl->tpl_vars['COMMENTS_COUNT'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['COMMENTS']->value), null, 0);?><?php  $_smarty_tpl->tpl_vars['COMMENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['COMMENT']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['COMMENTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['COMMENT']->key => $_smarty_tpl->tpl_vars['COMMENT']->value){
$_smarty_tpl->tpl_vars['COMMENT']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['COMMENT']->key;
?><?php ob_start();?><?php echo decode_html($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedByName());?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['CREATOR_NAME'] = new Smarty_variable($_tmp1, null, 0);?><div class="commentDetails"><div class="singleComment" <?php if ($_smarty_tpl->tpl_vars['COMMENT']->value->get('is_private')){?>style="background: #fff9ea;"<?php }?>><input type="hidden" name='is_private' value="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('is_private');?>
"><?php $_smarty_tpl->tpl_vars['PARENT_COMMENT_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getParentCommentModel(), null, 0);?><?php $_smarty_tpl->tpl_vars['CHILD_COMMENTS_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getChildComments(), null, 0);?><div class="row"><div class="col-lg-12"><div class="media"><div class="media-left title"><div class="col-lg-2 recordImage commentInfoHeader" data-commentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->getId();?>
" data-parentcommentid="<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('parent_comments');?>
" data-relatedto = "<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to');?>
"><?php $_smarty_tpl->tpl_vars['IMAGE_PATH'] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getImagePath(), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['IMAGE_PATH']->value)){?><img src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_PATH']->value;?>
" width="40px" height="40px" align="left"><?php }else{ ?><div class="name"><span><strong> <?php echo htmlspecialchars(mb_substr($_smarty_tpl->tpl_vars['CREATOR_NAME']->value,0,2), ENT_QUOTES, 'UTF-8', true);?>
 </strong></span></div><?php }?></div></div><div class="media-body" style="width:100%"><div class="comment" style="line-height:1;"><span class="creatorName"><?php echo $_smarty_tpl->tpl_vars['CREATOR_NAME']->value;?>
</span>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['ROLLUP_STATUS']->value&&($_smarty_tpl->tpl_vars['COMMENT']->value->get('module')!=$_smarty_tpl->tpl_vars['MODULE_NAME']->value||$_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to')!=$_smarty_tpl->tpl_vars['PARENT_RECORD']->value)){?><?php $_smarty_tpl->tpl_vars['SINGULR_MODULE'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['COMMENT']->value->get('module')), null, 0);?><?php $_smarty_tpl->tpl_vars['ENTITY_NAME'] = new Smarty_variable(getEntityName($_smarty_tpl->tpl_vars['COMMENT']->value->get('module'),array($_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to'))), null, 0);?><span class="text-muted wordbreak display-inline-block"><?php echo vtranslate('LBL_ON','Vtiger');?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGULR_MODULE']->value,$_smarty_tpl->tpl_vars['COMMENT']->value->get('module'));?>
&nbsp;<a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('module');?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to');?>
" style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['ENTITY_NAME']->value[$_smarty_tpl->tpl_vars['COMMENT']->value->get('related_to')];?>
</a></span>&nbsp;&nbsp;<?php }?><span class="commentTime text-muted cursorDefault"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedTime());?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedTime());?>
</small></span><div class="commentInfoContentBlock"><?php ob_start();?><?php echo nl2br($_smarty_tpl->tpl_vars['COMMENT']->value->get('commentcontent'));?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['COMMENT_CONTENT'] = new Smarty_variable($_tmp2, null, 0);?><?php if ($_smarty_tpl->tpl_vars['COMMENT_CONTENT']->value){?><?php ob_start();?><?php echo decode_html($_smarty_tpl->tpl_vars['COMMENT_CONTENT']->value);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['DISPLAYNAME'] = new Smarty_variable($_tmp3, null, 0);?><?php $_smarty_tpl->tpl_vars['MAX_LENGTH'] = new Smarty_variable(200, null, 0);?><span class="commentInfoContent" data-maxlength="<?php echo $_smarty_tpl->tpl_vars['MAX_LENGTH']->value;?>
" style="display: block" data-fullComment="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['COMMENT_CONTENT']->value, ENT_QUOTES, 'UTF-8', true);?>
" data-shortComment="<?php echo htmlspecialchars(mb_substr($_smarty_tpl->tpl_vars['DISPLAYNAME']->value,0,200), ENT_QUOTES, 'UTF-8', true);?>
..." data-more='<?php echo vtranslate('LBL_SHOW_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
' data-less='<?php echo vtranslate('LBL_SHOW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_LESS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
'><?php if (mb_strlen($_smarty_tpl->tpl_vars['DISPLAYNAME']->value, 'UTF-8')>$_smarty_tpl->tpl_vars['MAX_LENGTH']->value){?><?php echo mb_substr(trim($_smarty_tpl->tpl_vars['DISPLAYNAME']->value),0,$_smarty_tpl->tpl_vars['MAX_LENGTH']->value);?>
...<a class="pull-right toggleComment showMore" style="color: blue;"><small><?php echo vtranslate('LBL_SHOW_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</small></a><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['COMMENT_CONTENT']->value;?>
<?php }?></span><?php }?></div><?php $_smarty_tpl->tpl_vars["FILE_DETAILS"] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->getFileNameAndDownloadURL(), null, 0);?><?php  $_smarty_tpl->tpl_vars['FILE_DETAIL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILE_DETAIL']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FILE_DETAILS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILE_DETAIL']->key => $_smarty_tpl->tpl_vars['FILE_DETAIL']->value){
$_smarty_tpl->tpl_vars['FILE_DETAIL']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['FILE_DETAIL']->key;
?><?php $_smarty_tpl->tpl_vars["FILE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['FILE_DETAIL']->value['trimmedFileName'], null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['FILE_NAME']->value)){?><div class="commentAttachmentName"><div class="filePreview clearfix"><span class="fa fa-paperclip cursorPointer" ></span>&nbsp;&nbsp;<a class="previewfile" onclick="Vtiger_Detail_Js.previewFile(event,<?php echo $_smarty_tpl->tpl_vars['COMMENT']->value->get('id');?>
,<?php echo $_smarty_tpl->tpl_vars['FILE_DETAIL']->value['attachmentId'];?>
);" data-filename="<?php echo $_smarty_tpl->tpl_vars['FILE_NAME']->value;?>
" href="javascript:void(0)" name="viewfile" style="color: blue;"><span title="<?php echo $_smarty_tpl->tpl_vars['FILE_DETAIL']->value['rawFileName'];?>
" style="line-height:1.5em;"><?php echo $_smarty_tpl->tpl_vars['FILE_NAME']->value;?>
</span>&nbsp</a>&nbsp;<a name="downloadfile" href="<?php echo $_smarty_tpl->tpl_vars['FILE_DETAIL']->value['url'];?>
" style="color: blue;"><i title="<?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" class="hide fa fa-download alignMiddle" ></i></a></div></div><?php }?><?php } ?>&nbsp;<div class="commentActionsContainer" style="margin-top: 2px;"><span><?php if ($_smarty_tpl->tpl_vars['PARENT_COMMENT_MODEL']->value!=false||$_smarty_tpl->tpl_vars['CHILD_COMMENTS_MODEL']->value!=null){?><a href="javascript:void(0);" class="cursorPointer detailViewThread" style="color: blue;"><?php echo vtranslate('LBL_VIEW_THREAD',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a>&nbsp;<?php }?></span><span class="summarycommemntActionblock" ><?php if ($_smarty_tpl->tpl_vars['IS_CREATABLE']->value){?><?php if ($_smarty_tpl->tpl_vars['PARENT_COMMENT_MODEL']->value!=false||$_smarty_tpl->tpl_vars['CHILD_COMMENTS_MODEL']->value!=null){?><span>&nbsp;|&nbsp;</span><?php }?><a href="javascript:void(0);" class="cursorPointer replyComment feedback" style="color: blue;"><?php echo vtranslate('LBL_REPLY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a><?php }?><?php if ($_smarty_tpl->tpl_vars['CURRENTUSER']->value->getId()==$_smarty_tpl->tpl_vars['COMMENT']->value->get('userid')&&$_smarty_tpl->tpl_vars['IS_EDITABLE']->value){?><?php if ($_smarty_tpl->tpl_vars['IS_CREATABLE']->value){?>&nbsp;&nbsp;&nbsp;<?php }?><a href="javascript:void(0);" class="cursorPointer editComment feedback" style="color: blue;"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a><?php }?></span></div><?php if ($_smarty_tpl->tpl_vars['COMMENT']->value->getCommentedTime()!=$_smarty_tpl->tpl_vars['COMMENT']->value->getModifiedTime()){?><br><div class="row commentEditStatus" name="editStatus"><?php $_smarty_tpl->tpl_vars["REASON_TO_EDIT"] = new Smarty_variable($_smarty_tpl->tpl_vars['COMMENT']->value->get('reasontoedit'), null, 0);?><?php if ($_smarty_tpl->tpl_vars['REASON_TO_EDIT']->value){?><span class="text-muted col-lg-5 col-md-5 col-sm-5"><small><?php echo vtranslate('LBL_EDIT_REASON',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <span name="editReason" class="textOverflowEllipsis"><?php echo nl2br($_smarty_tpl->tpl_vars['REASON_TO_EDIT']->value);?>
</span></small></span><?php }?><span <?php if ($_smarty_tpl->tpl_vars['REASON_TO_EDIT']->value){?>class="col-lg-7 col-md-7 col-sm-7"<?php }?>><p class="text-muted pull-right" <?php if (!$_smarty_tpl->tpl_vars['REASON_TO_EDIT']->value){?>style="margin-right: 15px;"<?php }?>><small><?php echo vtranslate('LBL_COMMENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo strtolower(vtranslate('LBL_MODIFIED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</small>&nbsp;<small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['COMMENT']->value->getModifiedTime());?>
" class="commentModifiedTime"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['COMMENT']->value->getModifiedTime());?>
</small></p></span></div><?php }?><br></div></div></div></div></div></div></div><?php if ($_smarty_tpl->tpl_vars['index']->value+1!=$_smarty_tpl->tpl_vars['COMMENTS_COUNT']->value){?><hr style="margin-top:0; margin-bottom: 10px;"><?php }?><?php } ?></div><?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("NoComments.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()){?><div class="row"><div class="textAlignCenter"><a href="javascript:void(0)" class="moreRecentComments" style="color: blue;"><?php echo vtranslate('LBL_SHOW_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div><?php }?></div><div class="hide basicAddCommentBlock container-fluid" style="min-height: 110px;"><div class="commentTextArea row"><textarea name="commentcontent" class="commentcontent col-lg-12" placeholder="<?php echo vtranslate('LBL_ADD_YOUR_COMMENT_HERE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" rows="<?php echo $_smarty_tpl->tpl_vars['COMMENT_TEXTAREA_DEFAULT_ROWS']->value;?>
"></textarea></div><div class="pull-right row"><?php if (in_array($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['PRIVATE_COMMENT_MODULES']->value)){?><div class="checkbox"><label><input type="checkbox" id="is_private">&nbsp;&nbsp;<?php echo vtranslate('LBL_INTERNAL_COMMENT');?>
&nbsp;&nbsp;</label></div><?php }?><button class="btn btn-success btn-sm detailViewSaveComment" type="button" data-mode="add"><?php echo vtranslate('LBL_POST',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button><a href="javascript:void(0);" class="cursorPointer closeCommentBlock cancelLink" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div><div class="hide basicEditCommentBlock container-fluid" style="min-height: 150px;"><div class="row commentArea" ><input style="width:100%;height:30px;" type="text" name="reasonToEdit" placeholder="<?php echo vtranslate('LBL_REASON_FOR_CHANGING_COMMENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" class="input-block-level"/></div><div class="row" style="padding-bottom: 10px;"><div class="commentTextArea"><textarea name="commentcontent" class="commentcontenthidden col-lg-12" placeholder="<?php echo vtranslate('LBL_ADD_YOUR_COMMENT_HERE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" rows="<?php echo $_smarty_tpl->tpl_vars['COMMENT_TEXTAREA_DEFAULT_ROWS']->value;?>
"></textarea></div></div><input type="hidden" name="is_private"><div class="pull-right row"><button class="btn btn-success btn-sm detailViewSaveComment" type="button" data-mode="edit"><?php echo vtranslate('LBL_POST',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button><a href="javascript:void(0);" class="cursorPointer closeCommentBlock cancelLink" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div></div>
<?php }} ?>