<?php
/*
  vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 1.0                                                  |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2021 Issabel Foundation                                |
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
  | Autores: Alex Villacís Lasso <a_villacis@palosanto.com>              |
  +----------------------------------------------------------------------+
  $Id: paloSantoApplets.class.php, Thu 20 May 2021 09:03:40 AM EDT, nicolas@issabel.com
*/

/** 
 * Esta clase contiene las rutinas que manipulan los applets en general, 
 * incluyendo la lista de applets autorizados, y la modificación del orden de 
 * los applets. 
 */
class paloSantoApplets
{
    private $_db = NULL;
    var $errMsg = NULL;

    function __construct()
    {
        global $arrConf;
        
        $this->_db = new paloDB("sqlite3:///{$arrConf['issabel_dbdir']}/dashboard.db");
    }

    /**
     * Procedimiento para leer la lista de los applets activados para el usuario.
     * Para compatibilidad con la implementación anterior, y como efecto 
     * secundario, si el usuario indicado no tiene applets activados, se crea una
     * nueva lista de activaciones por omisión y se guarda esta lista durante la
     * consulta.
     * 
     * @param   string  $user   Usuario de sistema para el cual se consulta
     * 
     * @return  mixed   NULL en caso de error, o lista de applets activados.
     */
    function leerAppletsActivados($user)
    {
        global $arrConf;
        
    	// Leer rol del usuario: admin o no_admin
        $pDB2 = new paloDB($arrConf['issabel_dsn']['acl']);
        $pACL = new paloACL($pDB2);
        $rol = ($pACL->isUserAdministratorGroup($user)) ? 'admin' : 'no_admin';
        
        // Verificar si hay applets activados para este usuario
        $tupla = $this->_db->getFirstRowQuery(
            'SELECT COUNT(*) AS n FROM activated_applet_by_user WHERE username = ?',
            TRUE, array($user));
        if (!is_array($tupla)) {
            $this->errMsg = $this->_db->errMsg;
        	return NULL;
        }
        if ($tupla['n'] <= 0) {
        	/* No hay applets activados. Se consulta el mapeo de applets por 
             * omisión.
             * FIXME: esto es esencialmente un grupo de applets disponibles por
             * rol, el cual debería estar representado en una tabla separada. No
             * hay manera de cambiar desde la interfaz web si es que se requiere
             * un número distinto de applets por omisión, o un orden distinto.
             * La implementación actual requiere que hayan al menos 5 applets
             * en el mapeo de la base de datos, empezando desde el mínimo ID 
             * con el rol requerido. Por lo menos ya no está quemado el ID 
             * inicial como en la implementación anterior.
             */
            $num_applets_omision = 5;
            $recordset = $this->_db->fetchTable(
                'SELECT id FROM default_applet_by_user WHERE username = ? ORDER BY id LIMIT ?',
                TRUE, array($rol, $num_applets_omision));
            if (!is_array($recordset)) {
                $this->errMsg = $this->_db->errMsg;
                return NULL;
            }
            for ($i = 0; $i < count($recordset); $i++) {
            	$r = $this->_db->genQuery(
                    'INSERT INTO activated_applet_by_user (id_dabu, order_no, username) VALUES (?, ?, ?)',
                    array($recordset[$i]['id'], $i + 1, $user));
                if (!$r) {
                    $this->errMsg = $this->_db->errMsg;
                    return NULL;
                }
            }
        }
        
        // Consultar el mapeo de applets para el usuario actual
        $sql = <<<SQL_APPLETS_BY_USER
SELECT a.code, a.name, aau.id AS aau_id, a.icon
FROM activated_applet_by_user aau, default_applet_by_user dau, applet a
WHERE aau.id_dabu = dau.id AND dau.id_applet = a.id AND dau.username = ?
    AND aau.username = ?
ORDER BY aau.order_no
SQL_APPLETS_BY_USER;
        $recordset = $this->_db->fetchTable($sql, TRUE, array($rol, $user));
        if (!is_array($recordset)) {
            $this->errMsg = $this->_db->errMsg;
            return NULL;
        }
        $listaApplets = array();
        foreach ($recordset as $tupla) {
        	$code = $tupla['code'];
            if (substr($code, 0, 7) == 'Applet_') $code = substr($code, 7);
            $tupla['applet'] = $code;
            $listaApplets[] = $tupla;
        }
        return $listaApplets;
    }
    
    /**
     * Procedimiento para actualizar el orden de los applets para el usuario
     * indicado. Este procedimiento NO AGREGA NI QUITA APPLETS. Todos los applets
     * mencionados en el nuevo orden deben estar listados en la base de datos, y
     * viceversa.
     * 
     * @param   string  $user           Usuario para el cual se actualiza el orden
     * @param   array   $nuevo_orden    Lista de applets en el orden deseado
     * 
     * @return  bool    VERDADERO en éxito, FALSO en error
     */
    function actualizarOrdenApplets($user, $nuevo_orden)
    {
        if (!is_array($nuevo_orden)) {
            $this->errMsg = _tr('(internal) Invalid order, must be array');
        	return FALSE;
        }
        
    	$listaApplets = $this->leerAppletsActivados($user);
        if (!is_array($listaApplets)) return FALSE;
        if (count($nuevo_orden) != count($listaApplets)) {
            $this->errMsg = _tr('(internal) Active applet count mismatch');
        	return FALSE;
        }
        foreach ($listaApplets as $applet) {
        	if (!in_array($applet['code'], $nuevo_orden)) {
                $this->errMsg = _tr('(internal) Cannot reference inactive applet');
        		return FALSE;
        	}
        }
        
        $nuevo_orden = array_flip($nuevo_orden);
        foreach ($listaApplets as $applet) {
        	$r = $this->_db->genQuery(
                'UPDATE activated_applet_by_user SET order_no = ? WHERE id = ?',
                array($nuevo_orden[$applet['code']] + 1, $applet['aau_id']));
            if (!$r) {
                $this->errMsg = $this->_db->errMsg;
                return FALSE;
            }
        }
        return TRUE;
    }
}
?>
