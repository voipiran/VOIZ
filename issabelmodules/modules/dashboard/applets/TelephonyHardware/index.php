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
require_once "libs/paloSantoForm.class.php";

define('WEBSERVICE_CARD_REGISTRATION',
    'http://cloud.issabel.org/modules/serial_hardware_telephony/webservice/telephonyHardware.wsdl');

class Applet_TelephonyHardware
{
    function handleJSON_getContent($smarty, $module_name, $appletlist)
    {
        /* Se cierra la sesión para quitar el candado sobre la sesión y permitir
         * que otras operaciones ajax puedan funcionar. */
        session_commit();
        
        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );

        $smarty->assign(array(
            'LABEL_CARD_NOT_FOUND'  =>  _tr('Cards no found'),
            'LABEL_REGISTERED'      =>  _tr('Registered'),
            'LABEL_UNREGISTERED'    =>  _tr('No Registered'),
        ));

        // Listar las tarjetas visibles por el sistema (sólo DAHDI)
        $output = $retval = NULL;
        exec('/usr/sbin/dahdi_hardware', $output, $retval);
        //$retval = 0; $output = array("pci:0000:05:00.0     opvxa1200+   e159:0001 OpenVox A1200P/A1200E/A800P/A800E\n");
        $tarjetas = array();
        $db = $this->_getdb();
        foreach ($output as $s) {
            $regs = NULL;
            if (preg_match('/([a-z0-9\:\.\-\_]*)\s+([a-z0-9\:\.\-\_\+]*)\s+([a-z0-9\:\.\-\_]*) (.*)/', $s, $regs)) {
                $cardinfo = array(
                    'index'     => count($tarjetas) + 1,
                    'hwd'       => $regs[1],
                    'module'    => $regs[2],
                    'vendor'    => $regs[3],
                    'card'      => $regs[4],
                    'num_serie' => '',
                );
                
                $tupla = $db->getFirstRowQuery(
                    'SELECT num_serie FROM car_system WHERE hwd = ? AND data = ?',
                    TRUE, array($cardinfo['hwd'], $cardinfo['card']));
                if (count($tupla) > 0) {
                	$cardinfo['num_serie'] = $tupla['num_serie'];
                } else {
                	$db->genQuery(
                        'INSERT INTO car_system (hwd, module, vendor, num_serie, data) '.
                        'VALUES (?, ?, ?, "", ?)',
                        array($cardinfo['hwd'], $cardinfo['module'], $cardinfo['vendor'], $cardinfo['card']));
                }
                $tarjetas[] = $cardinfo;
            }            
        }
        $smarty->assign('telephonycards', $tarjetas);

        $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/TelephonyHardware/tpl";
        $respuesta['html'] = $smarty->fetch("$local_templates_dir/telephonyhardware.tpl");
    
        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }
    
    function handleJSON_registerform($smarty, $module_name, $appletlist)
    {
        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );

        $smarty->assign(array(
            "SAVE"              =>  _tr("Save"),
            "CANCEL"            =>  _tr("Cancel"),
            "Card_Register"     =>  _tr("Card Register"),
            'MSG_UNREGISTERED'  =>  _tr('Card has not been Registered'),
        ));

        $oForm = new paloForm($smarty, $this->_getFormFields());

        if (isset($_REQUEST['hwd'])) {
            $db = $this->_getdb();
            $tupla = $db->getFirstRowQuery(
                'SELECT * FROM car_system WHERE hwd = ?',
                TRUE, array($_REQUEST['hwd']));
            if (is_array($tupla) && count($tupla) > 0) {
            	$_REQUEST['vendor'] = $tupla['vendor'];
                $_REQUEST['num_serie'] = $tupla['num_serie'];
                if (!empty($tupla['num_serie'])) {
                	// Tarjeta ya ha sido registrada
                    $oForm->setViewMode();
                }
            }
        }

        $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/TelephonyHardware/tpl";
        $respuesta['title'] = _tr('Card Register');
        $respuesta['html']  = $oForm->fetchForm(
            "$local_templates_dir/_register.tpl",
            $respuesta['title'],
            $_REQUEST);
    
        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }

    function handleJSON_registersave($smarty, $module_name, $appletlist)
    {
        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );

        $oForm = new paloForm($smarty, $this->_getFormFields());
        if (!$oForm->validateForm($_REQUEST)) {
            $arrErrores = $oForm->arrErroresValidacion;
            $strErrorMsg = _tr('The following fields contain errors').': ';
            if(is_array($arrErrores) && count($arrErrores) > 0){
                foreach($arrErrores as $k=>$v) {
                    $strErrorMsg .= "$k, ";
                }
            }

        	$respuesta['status'] = 'error';
            $respuesta['message'] = $strErrorMsg;
        } else {
            /* La presencia de xdebug activo interfiere con las excepciones de
             * SOAP arrojadas por SoapClient, convirtiéndolas en errores 
             * fatales. Por lo tanto se desactiva la extensión. */
            if (function_exists("xdebug_disable")) xdebug_disable(); 
            
            ini_set('soap.wsdl_cache_enabled', 0);
            try {
                $client = @new SoapClient(
                    WEBSERVICE_CARD_REGISTRATION,
                    array(
                        'compression'           =>  SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
                        'exceptions'            =>  TRUE,
                        'connection_timeout'    =>  20,
                    )
                );
    
                $r = $client->registerHardware($_REQUEST['vendor'], $_REQUEST['num_serie']);
                
                // En serio, el webservice devuelve esta cadena.
                if ($r == 'card ha sido registrada...') {
                	$db = $this->_getdb();
                    $r = $db->genQuery(
                        'UPDATE car_system SET num_serie = ?, vendor = ? WHERE hwd = ?',
                        array($_REQUEST['num_serie'], $_REQUEST['vendor'], $_REQUEST['hwd']));
                    if (!$r) {
                        $respuesta['status'] = 'error';
                        $respuesta['message'] = $db->errMsg;
                    } else {
                    	$respuesta['message'] = _tr('Card has been Registered');
                    }
                } else {
                    $respuesta['status'] = 'error';
                    $respuesta['message'] = _tr('Webservice failed to register card').': '.$r;
                }
            } catch (SoapFault $e) {
            	$respuesta['status'] = 'error';
                $respuesta['message'] = $e->getMessage();
            }
        }

    
        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }

    private function _getFormFields()
    {
        return array(
            'hwd'       =>  array(
                'LABEL'                     =>  'PCI ID',
                "REQUIRED"                  => "yes",
                "INPUT_TYPE"                => "HIDDEN",
                "VALIDATION_TYPE"           => "text",
                "VALIDATION_EXTRA_PARAM"    => ""
            ),
            'vendor'    =>  array(
                'LABEL'                     => _tr('Vendor (ex. digium)'),
                "REQUIRED"                  => "yes",
                "INPUT_TYPE"                => "TEXT",
                "VALIDATION_TYPE"           => "text",
                "VALIDATION_EXTRA_PARAM"    => ""
            ),
            'num_serie' =>  array(
                'LABEL'                     => _tr('Serial Number'),
                "REQUIRED"                  => "yes",
                "INPUT_TYPE"                => "TEXT",
                "VALIDATION_TYPE"           => "text",
                "VALIDATION_EXTRA_PARAM"    => ""
            ),
        );    	
    }

    private function _getdb()
    {
    	global $arrConf;
        return new paloDB("sqlite3:///{$arrConf['issabel_dbdir']}/hardware_detector.db");
    }
}
?>
