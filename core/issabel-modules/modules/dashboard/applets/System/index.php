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
  $Id: index.php,v 1.1 2007/01/09 23:49:36 alex Exp $
*/

// NOTA: a este applet se saca una subclase en Applet_Emails
class Applet_System
{
    function handleJSON_getContent($smarty, $module_name, $appletlist)
    {
        /* Se cierra la sesión para quitar el candado sobre la sesión y permitir
         * que otras operaciones ajax puedan funcionar. */
        $issabeluser = $_SESSION['issabel_user'];
        session_commit();
        
        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );
        
        // Leer credenciales a partir del usuario y el perfil asociado
        global $arrConf;
        $dbAcl = new paloDB($arrConf["issabel_dsn"]["acl"]);
        $pACL  = new paloACL($dbAcl);
        $userId  = $pACL->getIdUser($issabeluser);
        $mailCred = $this->leerPropiedadesWebmail($dbAcl, $userId);
        if (count($mailCred) <= 0) {
        	$respuesta['status'] = 'error';
            $respuesta['message'] = _tr("You don't have a webmail account");
        } elseif (!$this->_checkEmailPassword(
            "{$mailCred['login']}@{$mailCred['domain']}",
            isset($mailCred['password']) ? $mailCred['password'] : '')) {
            $respuesta['status'] = 'error';
            $respuesta['message'] = "{$mailCred['login']}@{$mailCred['domain']} "._tr("does not exist locally or password is incorrect");
        } else {
        	$imap = @imap_open(
                "{localhost:143/notls}",
                "{$mailCred['login']}@{$mailCred['domain']}",
                isset($mailCred['password']) ? $mailCred['password'] : '');
            if (!$imap) {
                $respuesta['status'] = 'error';
                $respuesta['message'] = _tr('Imap: Connection error');
            } else {
                $this->leerInformacionImap($smarty, $module_name, $imap, $respuesta);
                imap_close($imap);
            }
        }
        
        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }

    protected function leerInformacionImap($smarty, $module_name, $imap, &$respuesta)
    {
        $quotainfo = imap_get_quotaroot($imap, 'INBOX');
        $respuesta['html'] =
            _tr('Quota asigned')." $quotainfo[limit] KB<br/>\n".
            _tr('Quota Used')." $quotainfo[usage] KB<br/>\n".
            _tr('Quota free space')." ".(string)($quotainfo['limit'] - $quotainfo['usage']) . " KB";
    }

    private function leerPropiedadesWebmail($pDB, $idUser)
    {
        // Obtener la información del usuario con respecto al perfil "default" del módulo "webmail"
        $sPeticionPropiedades = 
            'SELECT pp.property, pp.value '.
            'FROM acl_profile_properties pp, acl_user_profile up, acl_resource r '.
            'WHERE up.id_user = ? '.
                'AND up.profile = "default" '.
                'AND up.id_profile = pp.id_profile '.
                'AND up.id_resource = r.id '.
                'AND r.name = "webmail"';
        $listaPropiedades = array();
        $tabla = $pDB->fetchTable($sPeticionPropiedades, FALSE, array($idUser));
        if ($tabla === FALSE) {
            return NULL;
        } else {
            foreach ($tabla as $tupla) {
                $listaPropiedades[$tupla[0]] = $tupla[1];
            }
        }
        return $listaPropiedades;
    }
   
    private function _checkEmailPassword($email, $password)
    {
        global $arrConf;
        
        $pDB = new paloDB("sqlite3:///{$arrConf['issabel_dbdir']}/email.db");

        $tupla = $pDB->getFirstRowQuery(
            'SELECT password FROM accountuser WHERE username = ?',
            TRUE, array($email));
        if (!is_array($tupla)) {
            $this->errMsg = $this->_DB->errMsg;
            return FALSE;
        }
        if (count($tupla) <= 0) return FALSE;
        return ($password == $tupla['password']);
    }
}
?>