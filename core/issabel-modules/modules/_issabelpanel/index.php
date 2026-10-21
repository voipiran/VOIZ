<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 1.0-16                                               |
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
  $Id: index.php,v 1.1 2007/01/09 23:49:36 alex Exp $
*/
require_once "libs/paloSantoJSON.class.php";

function _moduleContent(&$smarty, $module_name)
{
    load_language_module($module_name);

    Header('Content-Type: application/json');

    if (isset($_REQUEST['issabelpanel']) &&
        preg_match('/^([\w_]+)$/', $_REQUEST['issabelpanel']) &&
        file_exists("panels/{$_REQUEST['issabelpanel']}/index.php") &&
        isset($_REQUEST['action'])) {

        $panelname = $_REQUEST['issabelpanel'];
        if (file_exists("panels/$panelname/lang/en.lang"))
            load_language_module("../panels/$panelname");
        require_once "panels/$panelname/index.php";

        // No hay soporte de namespace en PHP 5.1, se simula con una clase
        $classname = 'Panel_'.ucfirst($panelname);
        $methodname = 'handleJSON_'.$_REQUEST['action'];
        if (class_exists($classname) && method_exists($classname, $methodname)) {
            return call_user_func(array($classname, $methodname),
                $smarty, $panelname);
        }
    }

    $jsonObject = new PaloSantoJSON();
    $jsonObject->set_status('false');
    $jsonObject->set_error(_tr('Undefined panel action'));
    return $jsonObject->createJSON();
}
