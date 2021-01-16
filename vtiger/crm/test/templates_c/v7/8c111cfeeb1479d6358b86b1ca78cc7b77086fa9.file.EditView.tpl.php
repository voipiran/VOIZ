<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 09:26:22
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Roles/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6349152215c592586c36f79-40031553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c111cfeeb1479d6358b86b1ca78cc7b77086fa9' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Roles/EditView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6349152215c592586c36f79-40031553',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD_MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
    'RECORD_ID' => 0,
    'MODE' => 0,
    'PROFILE_ID' => 0,
    'HAS_PARENT' => 0,
    'PROFILE_DIRECTLY_RELATED_TO_ROLE' => 0,
    'ALL_PROFILES' => 0,
    'PROFILE' => 0,
    'ROLE_PROFILES' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c592586d70f4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c592586d70f4')) {function content_5c592586d70f4($_smarty_tpl) {?>



<div class="editViewPageDiv viewContent">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="editViewHeader">
                <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId()){?>
                    <h4>
                        <?php echo vtranslate('LBL_EDIT_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                    </h4>
                <?php }else{ ?>
                    <h4>
                        <?php echo vtranslate('LBL_CREATE_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

                    </h4>
                <?php }?>
            </div>
            <hr>
        <form class="form-horizontal" id="EditView" name="EditRole" method="post" action="index.php" enctype="multipart/form-data">
            <div class="editViewBody">
                <div class="editViewContents">
                    <input type="hidden" name="module" value="Roles">
                    <input type="hidden" name="action" value="Save">
                    <input type="hidden" name="parent" value="Settings">
                    <?php $_smarty_tpl->tpl_vars['RECORD_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId(), null, 0);?>
                    <input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" />
                    <input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
">
                    <input type="hidden" name="profile_directly_related_to_role_id" value="<?php echo $_smarty_tpl->tpl_vars['PROFILE_ID']->value;?>
" />
                    <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getParent()){?><?php echo "true";?><?php }?><?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HAS_PARENT'] = new Smarty_variable($_tmp1, null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['HAS_PARENT']->value){?>
                        <input type="hidden" name="parent_roleid" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getParent()->getId();?>
">
                    <?php }?>
                    <div name='editContent'>
                        <div class="form-group">
                            <label class="control-label fieldLabel col-lg-3 col-md-3 col-sm-3">
                                <strong><?php echo vtranslate('LBL_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></strong>
                            </label>
                            <div class="controls fieldValue col-lg-4 col-md-4 col-sm-4" >
                                <div class=""> <input type="text" class="inputElement" name="rolename" id="profilename" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" data-rule-required='true'  />
                                </div> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label fieldLabel col-lg-3 col-md-3 col-sm-3">
                                <strong><?php echo vtranslate('LBL_REPORTS_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
                            </label>
                            <div class="controls fieldValue col-lg-4 col-md-4 col-sm-4" >
                                <input type="hidden" name="parent_roleid" <?php if ($_smarty_tpl->tpl_vars['HAS_PARENT']->value){?>value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getParent()->getId();?>
"<?php }?>>
                                <div class=""> <input type="text" class="inputElement" name="parent_roleid_display" <?php if ($_smarty_tpl->tpl_vars['HAS_PARENT']->value){?>value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getParent()->getName();?>
"<?php }?> readonly>
                                </div></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label fieldLabel col-lg-3 col-md-3 col-sm-3">
                                <strong><?php echo vtranslate('LBL_CAN_ASSIGN_RECORDS_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
                            </label>
                            <div class="controls fieldValue col-lg-9 col-md-9 col-sm-9">
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="1"<?php if (!$_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto')){?> checked=""<?php }?> <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto')=='1'){?> checked="" <?php }?> name="allowassignedrecordsto" data-handler="new" class="alignTop"/>
                                    &nbsp;<?php echo vtranslate('LBL_ALL_USERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="2" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto')=='2'){?> checked="" <?php }?> name="allowassignedrecordsto" data-handler="new" class="alignTop"/>
                                    &nbsp;<?php echo vtranslate('LBL_USERS_WITH_SAME_OR_LOWER_LEVEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="3" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('allowassignedrecordsto')=='3'){?> checked="" <?php }?> name="allowassignedrecordsto" data-handler="new" class="alignTop"/>
                                    &nbsp;<?php echo vtranslate('LBL_USERS_WITH_LOWER_LEVEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label fieldLabel col-lg-3 col-md-3 col-sm-3">
                                <strong><?php echo vtranslate('LBL_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
                            </label>
                            <div class="controls fieldValue col-lg-9 col-md-9 col-sm-9">
                                <div  class="radio">
                                    <label>
                                    <input type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['PROFILE_DIRECTLY_RELATED_TO_ROLE']->value){?> checked="" <?php }?> name="profile_directly_related_to_role" data-handler="new" class="alignTop"/>&nbsp;
                                    <?php echo vtranslate('LBL_ASSIGN_NEW_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" value="0" <?php if ($_smarty_tpl->tpl_vars['PROFILE_DIRECTLY_RELATED_TO_ROLE']->value==false){?> checked="" <?php }?> name="profile_directly_related_to_role" data-handler="existing" class="alignTop"/>&nbsp;
                                    <?php echo vtranslate('LBL_ASSIGN_EXISTING_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group " data-content="new" >
                            <div class="profileData col-sm-12">
                            </div>
                        </div>
                        <div class="form-group " data-content="existing">
                            <div class="fieldLabel control-label col-lg-3 col-md-3 col-sm-3"></div>
                            <div class="fieldValue controls col-lg-9 col-md-9 col-sm-9">
                                <?php $_smarty_tpl->tpl_vars["ROLE_PROFILES"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getProfiles(), null, 0);?>
                                <select class="select2 inputElement col-lg-12 hide" multiple="true" id="profilesList" name="profiles[]" data-placeholder="<?php echo vtranslate('LBL_CHOOSE_PROFILES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="width: 460px" data-rule-required="true">
                                    <?php  $_smarty_tpl->tpl_vars['PROFILE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PROFILE']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_PROFILES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PROFILE']->key => $_smarty_tpl->tpl_vars['PROFILE']->value){
$_smarty_tpl->tpl_vars['PROFILE']->_loop = true;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['PROFILE']->value->isDirectlyRelated()==false){?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['PROFILE']->value->getId();?>
" <?php if (isset($_smarty_tpl->tpl_vars['ROLE_PROFILES']->value[$_smarty_tpl->tpl_vars['PROFILE']->value->getId()])){?>selected="true"<?php }?>><?php echo $_smarty_tpl->tpl_vars['PROFILE']->value->getName();?>
</option>
                                        <?php }?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <div class='modal-overlay-footer  clearfix'>
                <div class="row clearfix">
                    <div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                        <button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;
                        <a class='cancelLink'  href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</div>
</div>
</div>
<?php }} ?>