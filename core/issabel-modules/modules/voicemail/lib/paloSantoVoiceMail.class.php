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
*/

define('ASTERISK_VOICEMAIL_CONF', '/etc/asterisk/voicemail.conf');
define('DEFAULT_ASTERISK_VOICEMAIL_BASEDIR', '/var/spool/asterisk/voicemail/default');

class paloSantoVoiceMail
{
    var $errMsg;

    private static $_listaExtensiones = array(
        'wav'   =>  'audio/wav',
        'gsm'   =>  'audio/gsm',
        'mp3'   =>  'audio/mpeg',
        'WAV'   =>  'audio/wav',    // audio gsm en envoltura RIFF
    );

    function listVoicemail($param)
    {
        if (isset($param['extension'])) {
            if (ctype_digit($param['extension']))
                $directorios[] = $param['extension'];
        } else {
            $directorios = array_filter(scandir(DEFAULT_ASTERISK_VOICEMAIL_BASEDIR), 'ctype_digit');
        }
        $ts_inicio = isset($param['date_start']) ? strtotime($param['date_start']) : NULL;
        $ts_final = isset($param['date_end']) ? strtotime($param['date_end']) : NULL;

        $arrData = array();
        $ts = array();
        foreach ($directorios as $directorio) {
            $voicemailPath = DEFAULT_ASTERISK_VOICEMAIL_BASEDIR."/$directorio/INBOX";
            if (!is_dir($voicemailPath)) continue;
            foreach (scandir($voicemailPath) as $file) {
                if (strtolower(substr($file, -4)) == '.txt') {
                    $pConfig = new paloConfig($voicemailPath, $file, "=", "[[:space:]]*=[[:space:]]*");
                    $arrVoiceMailDes = $pConfig->leer_configuracion(FALSE);

                    if (is_array($arrVoiceMailDes) && count($arrVoiceMailDes) > 0 &&
                        isset($arrVoiceMailDes['origtime']['valor'])) {

                        if (!is_null($ts_inicio) && $arrVoiceMailDes['origtime']['valor'] < $ts_inicio)
                            continue;
                        if (!is_null($ts_final) && $arrVoiceMailDes['origtime']['valor'] > $ts_final)
                            continue;

                        $tupla = array(
                            'origtime'      =>  $arrVoiceMailDes['origtime']['valor'],
                            'callerid'      =>  $arrVoiceMailDes['callerid']['valor'],
                            'extension'     =>  $arrVoiceMailDes['origmailbox']['valor'],
                            'duration'      =>  $arrVoiceMailDes['duration']['valor'],
                            'file'          =>  $file,
                            'mailbox'       =>  $directorio,
                            'recordingfile' =>  NULL,
                        );
                        foreach (array_keys(self::$_listaExtensiones) as $ext) {
                            $testfile = substr($file, 0, -4).".$ext";
                            if (file_exists("$voicemailPath/$testfile")) {
                                $tupla['recordingfile'] = $testfile;
                                break;
                            }
                        }
                        $arrData[] = $tupla;
                        $ts[] = $arrVoiceMailDes['origtime']['valor'];
                    }
                }
            }
        }

        // Ordenar por origtime DESC
        array_multisort($ts, SORT_DESC, $arrData);
        return $arrData;
    }

    /**
     * Procedimiento para resolver las rutas absolutas de los archivos asociados
     * al mensaje indicado en $msgbase dentro del mailbox de la extensión
     * $extension. Las rutas están canonicalizadas y se garantizan que existen.
     *
     * @param string $extension Extensión del correo de voz
     * @param string $msgbase   Nombre base del mensaje: "msg0001"
     *
     * @return mixed NULL en error, o estructura en éxito
     */
    function resolveVoiceMailFiles($extension, $msgbase)
    {
        if (!ctype_digit($extension)) {
            $this->errMsg = '(internal) Invalid extension';
            return NULL;
        }
        if (!preg_match('/^[[:alpha:]]+[[:digit:]]+$/', $msgbase)) {
            $this->errMsg = '(internal) Invalid message name';
            return NULL;
        }
        $voicemailPath = DEFAULT_ASTERISK_VOICEMAIL_BASEDIR."/$extension/INBOX";
        if (!is_dir($voicemailPath)) {
            $this->errMsg = 'No mailbox for extension';
            return NULL;
        }
        $pathbase = $voicemailPath.'/'.$msgbase;
        if (!file_exists("{$pathbase}.txt")) {
            $this->errMsg = 'Voicemail message not found';
            return NULL;
        }
        $result = array(
            'txt'           =>  "{$pathbase}.txt",
            'recordings'    =>  array(),
        );
        foreach (array_keys(self::$_listaExtensiones) as $ext) {
            if (file_exists("{$pathbase}.{$ext}")) {
                $result['recordings'][] = array(
                    'fullpath'  =>  "{$pathbase}.{$ext}",
                    'mimetype'  =>  self::$_listaExtensiones[$ext],
                );
            }
        }
        return $result;
    }

    function deleteVoiceMail($extension, $msgbase)
    {
        $recinfo = $this->resolveVoiceMailFiles($extension, $msgbase);
        if (!is_array($recinfo)) return FALSE;
        $listaArchivos = array($recinfo['txt']);
        foreach ($recinfo['recordings'] as $rec) $listaArchivos[] = $rec['fullpath'];
        array_map('unlink', $listaArchivos);
        return TRUE;
    }

    function writeFileVoiceMail($new_vmext, $new_vmparam = NULL)
    {
        if (!file_exists(ASTERISK_VOICEMAIL_CONF)) {
            $this->errMsg = "File ".ASTERISK_VOICEMAIL_CONF." does not exist";
            return FALSE;
        }

        $k_vm_parameters = array('voicemail_password', 'user_name',
            'user_email_address', 'pager_email_address');
        $k_user_options = array('attach', 'saycid', 'envelope', 'delete',
            'attachfmt', 'serveremail', 'tz', 'imapuser', 'imappasswd',
            'sendvoicemail', 'review', 'tempgreetwarn', 'sayduration',
            'saydurationm', 'forcename', 'forcegreetings', 'maxmsg', 'volgain',
            'operator', 'callback', 'dialout', 'exitcontext',
        );

        $new_content = array();
        foreach (file(ASTERISK_VOICEMAIL_CONF) as $l) {
            list($old_vmext, $old_vmparam) = $this->_parseVoicemailContext(trim($l));
            if (!is_null($old_vmext) && $new_vmext == $old_vmext) {
                if (!is_null($new_vmparam)) {
                    foreach ($k_vm_parameters as $k)
                        if (isset($new_vmparam[$k])) $old_vmparam[$k] = $new_vmparam[$k];
                    if (isset($new_vmparam['user_options']) && is_array($new_vmparam['user_options'])) {
                        foreach ($new_vmparam['user_options'] as $k => $v) {
                            if (in_array($k, $k_user_options)) $old_vmparam['user_options'][$k] = $v;
                        }
                    }
                    $new_content[] = $this->_formatVoicemailContext($old_vmext, $old_vmparam);
                }
                $new_vmparam = NULL;
            } else {
                $new_content[] = $l;
            }
        }
        if (!is_null($new_vmparam))
            $new_content[] = $this->_formatVoicemailContext($new_vmext, $new_vmparam);
        return (file_put_contents(ASTERISK_VOICEMAIL_CONF, $new_content) !== FALSE);
    }

    function loadConfiguration($extension)
    {
        foreach (file(ASTERISK_VOICEMAIL_CONF) as $l) {
            list($vmext, $vmparam) = $this->_parseVoicemailContext(trim($l));
            if (!is_null($vmext) && $extension == $vmext)
                return $vmparam;
        }
        return NULL;
    }

    private function _parseVoicemailContext($l)
    {
        $regs = NULL;
        if (!preg_match('/^(\d+)\s*=>\s*(.+)/', $l, $regs)) return array(NULL, NULL);

        $vmext = $regs[1];
        $vmparam = $regs[2];
        $regs = NULL;
        $param = explode(',', $vmparam, 5);
        if (count($param) < 5) return array(NULL, NULL);

        $vmparam = array(
            'voicemail_password'    =>  $param[0],
            'user_name'             =>  $param[1],
            'user_email_address'    =>  $param[2],
            'pager_email_address'   =>  $param[3],
            'user_options'          =>  array(),
        );
        $param = array_map('trim', explode('|', $param[4]));
        foreach ($param as $keyval) {
            $regs = NULL;
            if (preg_match('/^(.+?)=(.*)/', $keyval, $regs)) {
                $vmparam['user_options'][trim($regs[1])] = trim($regs[2]);
            }
        }

        return array($vmext, $vmparam);
    }

    private function _formatVoicemailContext($vmext, $vmparam)
    {
        $param = array(
            isset($vmparam['voicemail_password']) ? $vmparam['voicemail_password'] : '',
            isset($vmparam['user_name']) ? $vmparam['user_name'] : '',
            isset($vmparam['user_email_address']) ? $vmparam['user_email_address'] : '',
            isset($vmparam['pager_email_address']) ? $vmparam['pager_email_address'] : '',
        );
        $o = array();
        foreach ($vmparam['user_options'] as $k => $v) $o[] = "$k=$v";
        $param[] = implode('|', $o);
        return "$vmext => ".implode(',', $param)."\n";
    }
}
