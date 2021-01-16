<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 0.5                                                  |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2006 Palosanto Solutions S. A.                         |
  +----------------------------------------------------------------------+
  | The contents of this file are subject to the General Public License  |
  | (GPL) Version 2 (the "License"); you may not use this file except in |
  | compliance with the License. You may obtain a copy of the License at |
  | http://www.opensource.org/licenses/gpl-license.php                   |
  |                                                                      |
  | Software distributed under the License is distributed on an "AS IS"  |
  | basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See  |
  | the License for the specific language governing rights and           |
  | limitations under the License.                                       |
  +----------------------------------------------------------------------+
  | The Initial Developer of the Original Code is PaloSanto Solutions    |
  +----------------------------------------------------------------------+
  $Id: index.php,v 1.3 2007/07/17 00:03:42 gcarrillo Exp $ */

function themeSetup(&$smarty, $selectedMenu, $pdbACL, $pACL, $idUser)
{
    /* El tema elastixneo muestra hasta 7 items de menú de primer nivel, y
     * coloca el resto en una lista desplegable a la derecha del último item.
     * Se debe de garantizar que el item actualmente seleccionado aparezca en
     * un menú de primer nivel que esté entre los 7 primeros, reordenando los
     * items si es necesario. */
    $lang = get_language();
    $arrMainMenu = $smarty->get_template_vars('arrMainMenu');
    //var_dump($arrMainMenu['system']);

    foreach($arrMainMenu as $idMenu=>$arrMenuItem) {
        $arrMainMenu[$idMenu]['icon'] = setIcon($idMenu);
        /*foreach($arrMainMenu as $idSubMenu=>$arrMenuItem1){
            $arrMainMenu[$idMenu][$idSubMenu]['icon'] = setIcon1($idSubMenu);
        }*/
        /*foreach($arrMainMenu as $idSubMenu=>$arrMenuItem1){
            $arrMainMenu[$idSubMenu]['icon'] = setIcon1($idSubMenu);
        }*/
        /*foreach($arrMainMenu[$idMenu]['children'] as $idSubMenu=>$arrMenuItem1){
            $arrMainMenu[$idSubMenu]['icon'] = setIcon1($idSubMenu);
        }*/
    }
    //var_dump($arrMainMenu['addons']['children']);

    $idMainMenuSelected = $smarty->get_template_vars('idMainMenuSelected');
    $MAX_ITEMS_VISIBLES = 7;

    if (count($arrMainMenu) > $MAX_ITEMS_VISIBLES) {
        // Se transfiere a arreglo numérico para manipular orden de enumeración
        $tempMenulist = array();
        $idxMainMenu = NULL;
        foreach ($arrMainMenu as $key => $value) {
            if ($key == $idMainMenuSelected) $idxMainMenu = count($tempMenulist);
            $tempMenulist[] = array($key, $value);
        }
        if (!is_null($idxMainMenu) && $idxMainMenu >= $MAX_ITEMS_VISIBLES) {
            $menuitem = array_splice($tempMenulist, $idxMainMenu, 1);
            array_splice($tempMenulist, $MAX_ITEMS_VISIBLES - 1, 0, $menuitem);
            $arrMainMenu = array();
            foreach ($tempMenulist as $menuitem) $arrMainMenu[$menuitem[0]] = $menuitem[1];
        }
        unset($tempMenulist);

    }

    $smarty->assign('arrMainMenu', $arrMainMenu);
    $smarty->assign("LANG", $lang);
    $smarty->assign(array(
        "ABOUT_ISSABEL2"            =>  _tr('About Issabel'),
        "HELP"                      =>  _tr('HELP'),
        "USER_LOGIN"                =>  $_SESSION['issabel_user'],
        "USER_ID"                   =>  $idUser,
        "CHANGE_PASSWORD"           =>  _tr("Change Issabel Password"),
        "MODULES_SEARCH"            =>  _tr("Search modules"),
        "ADD_BOOKMARK"              =>  _tr("Add Bookmark"),
        "REMOVE_BOOKMARK"           =>  _tr("Remove Bookmark"),
        "ADDING_BOOKMARK"           =>  _tr("Adding Bookmark"),
        "REMOVING_BOOKMARK"         =>  _tr("Removing Bookmark"),
        "HIDING_IZQTAB"             =>  _tr("Hiding left panel"),
        "SHOWING_IZQTAB"            =>  _tr("Loading left panel"),
        "HIDE_IZQTAB"               =>  _tr("Hide left panel"),
        "SHOW_IZQTAB"               =>  _tr("Load left panel"),

        'viewMenuTab'               =>  getStatusNeoTabToggle($pdbACL, $idUser),
        'MENU_COLOR'                =>  getMenuColorByMenu($pdbACL, $idUser),
        'IMG_BOOKMARKS'             =>  menuIsBookmark($pdbACL, $idUser, $selectedMenu) ? 'bookmarkon.png' : 'bookmark.png',
        'SHORTCUT'                  =>  loadShortcut($pdbACL, $idUser, $smarty),
        'BREADCRUMB'                =>  setBreadcrumb($arrMainMenu,$selectedMenu),
        'NOTIFICATIONS'             =>  loadSystemNotifications($pdbACL, $idUser),
    ));
}
function setIcon($idMenu){
    switch ($idMenu) {
        case 'manager': return 'fa fa-cog';
        case 'system': return 'fa fa-laptop';
        case 'email_admin': return 'fa fa-envelope';
        case 'security': return 'fa fa-lock';
        case 'pbxconfig': return 'fa fa-phone';
        case 'fax': return 'fa fa-print';
        case 'reports': return 'fa fa-bar-chart-o';
        case 'im': return 'fa fa-comments';
        case 'agenda': return 'fa fa-book';
        case 'my_extension': return 'fa fa-fax';
        case 'addons': return 'fa fa-cubes';
        case 'extras': return 'fa fa-plus';
        //case 'sysdash': return 'fa fa-tachometer';

        default: return 'fa fa-caret-right';
    }
 }

function setIcon1($idSubMenu){
    switch ($idSubMenu) {
        case 'sysdash': return 'fa fa-tachometer';
        case 'addons_availables': return 'fa fa-cube';
        //default: return 'fa fa-caret-right';
        default: return 'fa fa-cog';
    }
 }

 function setBreadcrumb($arrMainMenu,$currentMenu){

      foreach ($arrMainMenu as $key => $value) {
            $breadcrumb = array();
            //array_push($breadcrumb, $value["description"]);
            array_push($breadcrumb, $value["Name"]);
            if($key == $currentMenu)
               return $breadcrumb;

            foreach ($arrMainMenu[$key]["children"] as $akey ) {
                 if(count($breadcrumb)>1)
                    array_pop($breadcrumb);

                //array_push($breadcrumb, $akey["description"]);
                array_push($breadcrumb, $akey["Name"]);
                 if($akey["id"] == $currentMenu)
                    return $breadcrumb;

                 if($akey["HasChild"]) {
                   foreach ($akey["children"] as $bkey => $bvalue) {
                       if($bkey == $currentMenu){
                          //array_push($breadcrumb, $bvalue["description"]);
                          array_push($breadcrumb, $bvalue["Name"]);
                          return $breadcrumb;
                       }
                   }
                 }
            }
      }
}

function loadSystemNotifications($pdbACL, $idUser)
{
    require_once 'libs/paloSantoNotification.class.php';

    $pNot = new paloNotification($pdbACL);
    $a = array(
        'LBL_NOTIFICATION_SYSTEM'   =>  _tr('System'),
        'LBL_NOTIFICATION_USER'     =>  _tr('User'),
        'NOTIFICATIONS_PUBLIC'      =>  $pNot->listPublicNotifications(3),
        'NOTIFICATIONS_PRIVATE'     =>  $pNot->listUserNotifications($idUser, 3),
        'TXT_NO_NOTIFICATIONS'      =>  _tr('No notifications'),
    );
    return $a;
}
?>
