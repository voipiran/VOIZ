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
  $Id: paloSantoForm.class.php,v 1.4 2007/05/09 01:07:03 gcarrillo Exp $
  $Id: paloSantoForm.class.php,v 1.5 2007/11/04 17:01:03 fpereira  Exp $
  */

/* A continuacion se ilustra como luce un tipico elemento del arreglo $this->arrFormElements
"subject"  => array(
                "LABEL"                  => _tr("Fax Suject"),
                "DESCRIPTION"            => _tr("Subject sent in the mail"),
                "REQUIRED"               => "yes",
                "INPUT_TYPE"             => "TEXT",
                "INPUT_EXTRA_PARAM"      => array("style" => "width:240px"),
                "VALIDATION_TYPE"        => "text",
                "EDITABLE"               => "yes",
                "VALIDATION_EXTRA_PARAM" => "")

"content" => array(
                "LABEL"                  => _tr("Fax Content"),
                "DESCRIPTION"            => _tr("Subject sent in the mail"),
                "REQUIRED"               => "no",
                "INPUT_TYPE"             => "TEXTAREA",
                "INPUT_EXTRA_PARAM"      => "",
                "VALIDATION_TYPE"        => "text",
                "EDITABLE"               => "yes",
                "COLS"                   => "50",
                "ROWS"                   => "4",
                "VALIDATION_EXTRA_PARAM" => "")

"today"  => array(
                "LABEL"                  => "Today",
                "DESCRIPTION"            => "",
                "REQUIRED"               => "yes",
                "INPUT_TYPE"             => "DATE",
                "INPUT_EXTRA_PARAM"      => array("TIME" => true, "FORMAT" => "'%d %b %Y' %H:%M","TIMEFORMAT" => "12", "FIRSTDAY" => 1),
                "VALIDATION_TYPE"        => '',
                "EDITABLE"               => "yes",
                "VALIDATION_EXTRA_PARAM" => '')

'formulario'       => array(
                "LABEL"                  => _tr("Form"),
                "DESCRIPTION"            => "",
                "REQUIRED"               => "yes",
                "INPUT_TYPE"             => "SELECT",
                "INPUT_EXTRA_PARAM"      => $arrSelectForm,
                "VALIDATION_TYPE"        => "text",
                "VALIDATION_EXTRA_PARAM" => "",
                "EDITABLE"               => "yes",
                "MULTIPLE"               => true,
                "SIZE"                   => "5")


"checkbox"  => array(
                "LABEL"                  => "Habiltar",
                "DESCRIPTION"            => "",
                "REQUIRED"               => "no",
                "INPUT_TYPE"             => "CHECKBOX",
                "INPUT_EXTRA_PARAM"      => "",
                "VALIDATION_TYPE"        => "",
                "EDITABLE"               => "yes",
                "VALIDATION_EXTRA_PARAM" => "")

"rate"      => array(      
                "LABEL"                  => _tr("Rate"),
                "REQUIRED"               => "yes",
                "INPUT_TYPE"             => "RANGE",
                "INPUT_EXTRA_PARAM"      => array("class" => "form-control", "onchange" => "showRate()"),
                "EDITABLE"               => "si",
                "MIN"                    => "100",
                "MAX"                    => "250",
                "STEP"                   => "10",
                "VALIDATION_TYPE"        => "numeric",
                "VALIDATION_EXTRA_PARAM" => "",
                "DEBUG"                  => TRUE)

"voice"   => array(      
                "LABEL"                  => _tr("Voice"),
                "REQUIRED"               => "yes",
                "INPUT_TYPE"             => "CUSTOM_INPUT",
                "HTML_TAGS"              => "select",  //example1: select //example2: input type='text'
                "SUPPORT_VALUE"          => "no",   // yes/no  example support value <input type="submit" value="Submit"> // example <select id="test" name="test"></select> no support value.
                "INPUT_EXTRA_PARAM"      => array("class" => "js-example-data-array form-control"),
                "VALIDATION_TYPE"        => "text",
                "VALIDATION_EXTRA_PARAM" => "",
                "EDITABLE"               => "si",
                "DEBUG"                  => FALSE)
                
*/

require_once("misc.lib.php");
global $arrConf;

class paloForm
{
    var $smarty;
    var $arrFormElements;
    var $arrErroresValidacion;
    var $modo;

    function paloForm(&$smarty, $arrFormElements)
    {
        $this->smarty = &$smarty;
        $this->arrFormElements = $arrFormElements;
        $this->arrErroresValidacion = "";
        $this->modo = 'input'; // Modo puede ser 0 (Modo normal de formulario) o 1 (modo de vista o preview
                               // de datos donde no se puede modificar.
    }

    /**
     * Esta función genera una cadena que contiene un formulario HTML. Para hacer
     * esto, toma una plantilla de formulario e inserta en ella los elementos de
     * formulario.
     *
     * @param   string  $templateName   Ruta al archivo de plantilla Smarty a usar.
     * @param   string  $title          Texto a usar como título del formulario
     * @param   array   $arrPreFilledValues Arreglo para asignar variables a mostrar
     *                                  en el formulario. Este arreglo es idéntico
     *                                  en formato al arreglo $_POST que se genera
     *                                  al enviar el formulario lleno, de forma que
     *                                  se puede usar $_POST directamente para
     *                                  llenar con valores en caso de que la
     *                                  validación falle.
     *
     * @return  string  Texto HTML del formulario con valores asignados
     */
    function fetchForm($templateName, $title, $arrPreFilledValues = array())
    {
        /* Función interna para convertir un arreglo especificado en
           INPUT_EXTRA_PARAM en una cadena de atributos clave=valor adecuada
           para incluir al final de un widget HTML. Si no existe
           INPUT_EXTRA_PARAM, o no es un arreglo, se devuelve una cadena vacía
         */
        if (!function_exists('_inputExtraParam_a_atributos')) {
            function _inputExtraParam_a_atributos(&$arrVars)
            {
                if (!isset($arrVars['INPUT_EXTRA_PARAM']) ||
                    !is_array($arrVars['INPUT_EXTRA_PARAM']) ||
                    count($arrVars['INPUT_EXTRA_PARAM']) <= 0)
                    return '';
                $listaAttr = array();
                foreach($arrVars['INPUT_EXTRA_PARAM'] as $key => $value) {
                    $listaAttr[] = sprintf(
                        '%s="%s"',
                        htmlentities($key, ENT_COMPAT, 'UTF-8'),
                        htmlentities($value, ENT_COMPAT, 'UTF-8'));
                }

                return implode(' ', $listaAttr);
            }
        }

        // Función para usar con array_map
        if (!function_exists('_map_htmlentities')) {
            function _map_htmlentities($s)
            {
                return htmlentities($s, ENT_COMPAT, 'UTF-8');
            }
        }

        if (!function_exists('_labelName')) {
            function _labelName($varName,&$arrVars)
            {
                $tooltip="";
                if(isset($arrVars['DESCRIPTION'])){
                    if($arrVars['DESCRIPTION']!=false && $arrVars['DESCRIPTION']!=""){
                        $tooltip='data-tooltip="'.htmlentities($arrVars['DESCRIPTION'], ENT_COMPAT, 'UTF-8').'"';
                    }
                }
                if($tooltip!=""){
                    return sprintf('<label for="%s" %s>%s</label>',
                            htmlentities($varName, ENT_COMPAT, 'UTF-8'),
                            $tooltip,
                            htmlentities($arrVars['LABEL'], ENT_COMPAT, 'UTF-8')
                        );
                }else{
                    return htmlentities($arrVars['LABEL'], ENT_COMPAT, 'UTF-8');
                }
            }
        }

        foreach($this->arrFormElements as $varName=>$arrVars) {
            if(!isset($arrPreFilledValues[$varName]))
                $arrPreFilledValues[$varName] = "";
            $arrMacro = array();
            $strInput = "";
            $arrVars['EDITABLE'] = isset($arrVars['EDITABLE'])?$arrVars['EDITABLE']:'';

            // Verificar si se debe mostrar un widget activo para ingreso de valor
            $bIngresoActivo = ($this->modo == 'input' || ($this->modo == 'edit' && $arrVars['EDITABLE']!='no'));

            /* El indicar ENT_COMPAT escapa las comillas dobles y deja intactas
               las comillas simples. Por lo tanto, se asume que todos los usos
               de $varXXX_escaped serán dentro de comillas dobles, o en texto
               libre. */
            $varValue = $arrPreFilledValues[$varName];
            $varName_escaped = htmlentities($varName, ENT_COMPAT, 'UTF-8');
            $varValue_escaped = is_array($varValue)
                ? NULL : htmlentities($varValue, ENT_COMPAT, 'UTF-8');

            $widget_method = '_form_widget_'.$arrVars['INPUT_TYPE'];
            $attrstring = _inputExtraParam_a_atributos($arrVars);
            if (method_exists($this, $widget_method)) {
                $strInput = call_user_func_array(array($this, $widget_method),
                    array(
                        $bIngresoActivo,
                        $varName,
                        $varValue,
                        $arrVars,
                        $varName_escaped,
                        $varValue_escaped,
                        $attrstring
                    )
                );
            }
			
			
            $arrMacro['LABEL'] = _labelName($varName, $arrVars);
            $arrMacro['INPUT'] = $strInput;
            $this->smarty->assign($varName, $arrMacro);
        }
        $this->smarty->assign("title", htmlentities($title, ENT_COMPAT, 'UTF-8'));
        $this->smarty->assign("mode", $this->modo);
        return $this->smarty->fetch("file:$templateName");
    }

    protected function _form_widget_TEXTAREA($bIngresoActivo, $varName, $varValue,
        $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
                return $bIngresoActivo
                ? sprintf('<textarea id="%s" name="%s" rows="%s" cols="%s" %s>%s</textarea>',
                        $varName_escaped,
                        $varName_escaped,
                        isset($arrVars['ROWS']) ? (int)$arrVars['ROWS'] : 3,
                        isset($arrVars['COLS']) ? (int)$arrVars['COLS'] : 20,
                        $attrstring,
                        $varValue_escaped)
                : sprintf('<textarea id="%s" name="%s" rows="%s" cols="%s" %s disabled >%s</textarea>',
                        $varName_escaped,
                        $varName_escaped,
                        isset($arrVars['ROWS']) ? (int)$arrVars['ROWS'] : 3,
                        isset($arrVars['COLS']) ? (int)$arrVars['COLS'] : 20,
                        $attrstring,
                        $varValue_escaped);
    }

    protected function _form_widget_TEXT($bIngresoActivo, $varName, $varValue,
        $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
                return $bIngresoActivo
                 ? sprintf('<input type="text" id="%s" name="%s" value="%s" %s />',
                        $varName_escaped, $varName_escaped, $varValue_escaped, $attrstring)
                : sprintf('<input type="text" id="%s" name="%s" value="%s" %s disabled />',
                        $varName_escaped, $varName_escaped, $varValue_escaped, $attrstring);
    }


    protected function _form_widget_CHECKBOX($bIngresoActivo, $varName, $varValue,
        $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
        //Funcion definida en misc.lib.php
        return checkbox($varName, ($varValue=='on') ? 'on' : 'off', $bIngresoActivo ? 'off' : 'on');
    }

    protected function _form_widget_HIDDEN($bIngresoActivo, $varName, $varValue,
        $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
        return sprintf('<input type="hidden" name="%s" value="%s" %s />',
            $varName_escaped, $varValue_escaped, $attrstring);
    }

    protected function _form_widget_PASSWORD($bIngresoActivo, $varName, $varValue,
        $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
        return $bIngresoActivo
            ? sprintf('<input type="password" name="%s" value="%s" %s />',
                $varName_escaped,
                $varValue_escaped,
                $attrstring)
            : $varValue_escaped;
    }

    protected function _form_widget_FILE($bIngresoActivo, $varName, $varValue,
            $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
        return $bIngresoActivo
            ? sprintf('<input type="file" name="%s" %s />',
                $varName_escaped, $attrstring)
            : $varValue_escaped;
    }

    protected function _form_widget_RADIO($bIngresoActivo, $varName, $varValue,
            $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
        if (!$bIngresoActivo) return $varValue_escaped;
        if (!is_array($arrVars['INPUT_EXTRA_PARAM'])) return '';

        $listaRadio = array();
        $cntRadio = 1;
        foreach($arrVars['INPUT_EXTRA_PARAM'] as $radioValue => $radioLabel) {
            $listaRadio[] = sprintf(
                '<input type="radio" id="%s" name="%s" value="%s" %s /><label for="%s">%s</label>',
                $varName_escaped.$cntRadio,
                $varName_escaped,
                htmlentities($radioValue, ENT_COMPAT, 'UTF-8'),
                ($radioValue == $varValue) ? 'checked="checked"' : '',
                $varName_escaped.$cntRadio,
                htmlentities($radioLabel, ENT_COMPAT, 'UTF-8'));
            $cntRadio++;
        }
        return "<div class='radio_buttonset_elx'>".implode("\n", $listaRadio)."</div>";
    }

    /*
      START
      Support for input type range
      https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/range
      Mod: Federico Pereira <fpereira@iperfex.com>
    */
    protected function _form_widget_RANGE($bIngresoActivo, $varName, $varValue,
        $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {

        return $bIngresoActivo
            ? sprintf('<input type="range" id="%s" name="%s" min="%s" max="%s" step="%s" value="%s" %s %s />',
                        $varName_escaped,
                        $varName_escaped,
                        isset($arrVars['MIN']) ? (int)$arrVars['MIN'] : 1,
                        isset($arrVars['MAX']) ? (int)$arrVars['MAX'] : 10,
                        isset($arrVars['STEP']) ? (int)$arrVars['STEP'] : 1,
                        $varValue_escaped,
                        $attrstring,
                        $varValue_escaped)
            : sprintf('<input type="range" id="%s" name="%s" min="%s" max="%s" step="%s" value="%s" %s %s disabled />',
                        $varName_escaped,
                        $varName_escaped,
                        isset($arrVars['MIN']) ? (int)$arrVars['MIN'] : 1,
                        isset($arrVars['MAX']) ? (int)$arrVars['MAX'] : 10,
                        isset($arrVars['STEP']) ? (int)$arrVars['STEP'] : 1,
                        $varValue_escaped,
                        $attrstring,
                        $varValue_escaped);
    }
    /*
      END
    */

    /*
      START
      CUSTOM_INPUT
      https://www.w3schools.com/tags/
      Create: Federico Pereira <fpereira@iperfex.com>
    */
    protected function _form_widget_CUSTOM_INPUT($bIngresoActivo, $varName, $varValue,
        $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {

        return $bIngresoActivo
        //1 - tipe tag  - HTML_TAGS
        //2 - id -
        //3 - name
        //4 - value (if it is supported. For more information visit: https://www.w3schools.com/tags )
        //5 - attributes (which attribute type class, style, etc ...)
        //6 - $varValue_escaped  (  select + '<option value="'.$varValue_escaped.'">'.$varValue_escaped.'</option>' )
        //7 - end tag.
            ? sprintf('<%s id="%s" name="%s" %s %s> %s %s',
                        $arrVars['HTML_TAGS'],
                        $varName_escaped,
                        $varName_escaped,
                        ($arrVars['SUPPORT_VALUE'] == 'yes') ? 'value="'.$varValue_escaped.'"' : '',
                        $attrstring,
                        ($arrVars['HTML_TAGS'] == 'select') ? '<option value="'.$varValue_escaped.'">'.$varValue_escaped.'</option>' : '',
                        ($arrVars['HTML_TAGS'] == 'select') ? '</'.$arrVars['HTML_TAGS'].'>' : '')
            : sprintf('<%s id="%s" name="%s" %s %s disabled > %s %s',
                        $arrVars['HTML_TAGS'],
                        $varName_escaped,
                        $varName_escaped,
                        ($arrVars['SUPPORT_VALUE'] == 'yes') ? 'value="'.$varValue_escaped.'"' : '',
                        $attrstring,
                        ($arrVars['HTML_TAGS'] == 'select') ? '<option value="'.$varValue_escaped.'">'.$varValue_escaped.'</option>' : '',
                        ($arrVars['HTML_TAGS'] == 'select') ? '</'.$arrVars['HTML_TAGS'].'>' : '');
    }
    /*
      END
    */

    protected function _form_widget_SELECT($bIngresoActivo, $varName, $varValue,
            $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
        if ($bIngresoActivo) {

            $listaOpts = array();
            $keyVals = is_array($varValue) ? $varValue : array($varValue);

            if (is_array($arrVars['INPUT_EXTRA_PARAM'])) {

                foreach($arrVars['INPUT_EXTRA_PARAM'] as $idSeleccion => $nombreSeleccion) {
                    if(is_array($nombreSeleccion)) {
                        $optgroup = $idSeleccion;
                        foreach($nombreSeleccion as $idSeleccion => $nombreSeleccion) {
                            $listaOpts[$optgroup][] = sprintf(
                                '<option value="%s" %s>%s</option>',
                                htmlentities($idSeleccion, ENT_COMPAT, 'UTF-8'),
                                in_array((string)$idSeleccion, $keyVals) ? 'selected="selected"' : '',
                                htmlentities($nombreSeleccion, ENT_COMPAT, 'UTF-8'));
                        }
                    } else {
                        $listaOpts[] = sprintf(
                            '<option value="%s" %s>%s</option>',
                            htmlentities($idSeleccion, ENT_COMPAT, 'UTF-8'),
                            in_array((string)$idSeleccion, $keyVals) ? 'selected="selected"' : '',
                            htmlentities($nombreSeleccion, ENT_COMPAT, 'UTF-8'));
                    }
                }
            }
            $sNombreSelect = $varName_escaped;
            $sAttrMultiple = '';
            if (isset($arrVars['MULTIPLE']) && $arrVars['MULTIPLE'] != '' && $arrVars['MULTIPLE']) {
                $sAttrMultiple = 'multiple="multiple"';
                $sNombreSelect .= '[]';
            }

            if (count($listaOpts) <> count($listaOpts, COUNT_RECURSIVE)) {
                $opciones="";
                foreach($listaOpts as $group=>$opt) {
                      $opciones.="<optgroup label='$group'>";
                      $opciones.= implode("\n",$opt);
                      $opciones.="</optgroup>";
                }
            } else {
                $opciones = implode("\n",$listaOpts);
            }

            $strInput = sprintf(
                '<select name="%s" id="%s" %s %s %s>%s</select>',
                $sNombreSelect,
                $sNombreSelect,
                $sAttrMultiple,
                (isset($arrVars['SIZE']) && $arrVars['SIZE'] != '')
                    ? sprintf('size="%s"', htmlentities($arrVars['SIZE'], ENT_COMPAT, 'UTF-8'))
                    : '',
                (isset($arrVars['ONCHANGE']) && $arrVars['ONCHANGE'] != '')
                    ? "onchange='{$arrVars['ONCHANGE']}'"
                    : '',
                $opciones);
        } else {
            $strInput = is_array($varValue)
                ? '| '.implode(' | ',
                    array_map('_map_htmlentities',
                        array_intersect_key(
                            $arrVars['INPUT_EXTRA_PARAM'],
                            array_flip($varValue)
                        )))
                : (isset($arrVars['INPUT_EXTRA_PARAM'][$varValue])
                    ? htmlentities($arrVars['INPUT_EXTRA_PARAM'][$varValue], ENT_COMPAT, 'UTF-8')
                    : '');
        }
        return $strInput;
    }

    protected function _form_widget_DATE($bIngresoActivo, $varName, $varValue,
            $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
        if (!$bIngresoActivo) return $varValue_escaped;

        require_once 'libs/JSON.php';

        // Mapa para traducir de formato jsCalendar a DateTimePicker
        $dateFormatMap = array(
                        '%Y'    =>  'yy',
                        '%m'    =>  'mm',
                        '%b'    =>  'M',
                        '%d'    =>  'dd',
        );
        $timeFormatMap = array(
                        '%H'    =>  'HH',
                        '%M'    =>  'mm',
        );
        $defaultValues = array(
                        'showOn'            =>  'button',
                        'firstDay'          =>  1,
                        'buttonImage'       =>  'images/calendar.gif',
                        'buttonImageOnly'   =>  TRUE,
                        'dateFormat'        =>  'dd M yy',
                        'timeFormat'        =>  'HH:mm',
                        'changeMonth'       =>  TRUE,
                        'changeYear'        =>  TRUE,
                        'showWeek'          =>  TRUE,
                        'constrainInput'    =>  TRUE,
        );

        // Evaluación de los valores para formulario
        $useTimePicker = FALSE;
        $datewidget = 'datepicker';
        $formValues = array();

        if (is_array($arrVars['INPUT_EXTRA_PARAM'])) {
            $useTimePicker = (isset($arrVars['INPUT_EXTRA_PARAM']['TIME'])
                    && $arrVars['INPUT_EXTRA_PARAM']['TIME']);
            $datewidget = $useTimePicker ? 'datetimepicker' : 'datepicker';
            if (isset($arrVars['INPUT_EXTRA_PARAM']['FIRSTDAY']))
                $formValues['firstDay'] = (int)$arrVars['INPUT_EXTRA_PARAM']['FIRSTDAY'];
            if (!isset($arrVars['INPUT_EXTRA_PARAM']['FORMAT']))
                $arrVars['INPUT_EXTRA_PARAM']['FORMAT'] = '%d %b %Y';
            if (!isset($arrVars['INPUT_EXTRA_PARAM']['TIMEFORMAT']))
                $arrVars['INPUT_EXTRA_PARAM']['TIMEFORMAT'] = '%H:%M';

            // El siguiente código asume que el formato de hora siempre
            // se especifica luego del formato de fecha
            $timepos = FALSE;
            foreach (array_keys($timeFormatMap) as $tf) {
                $tp = strpos($arrVars['INPUT_EXTRA_PARAM']['FORMAT'], $tf);
                if ($timepos === FALSE || ($tp !== FALSE && $timepos > $tp))
                    $timepos = $tp;
            }
            if ($timepos !== FALSE) {
                $arrVars['INPUT_EXTRA_PARAM']['TIMEFORMAT'] = trim(substr($arrVars['INPUT_EXTRA_PARAM']['FORMAT'], $timepos));
                $arrVars['INPUT_EXTRA_PARAM']['FORMAT'] = trim(substr($arrVars['INPUT_EXTRA_PARAM']['FORMAT'], 0, $timepos));
            }
            if ($arrVars['INPUT_EXTRA_PARAM']['FORMAT'] != '%d %b %Y') {
                $formValues['dateFormat'] = str_replace(
                        array_keys($dateFormatMap),
                        array_values($dateFormatMap),
                        $arrVars['INPUT_EXTRA_PARAM']['FORMAT']);
            }
            if ($arrVars['INPUT_EXTRA_PARAM']['TIMEFORMAT'] != '%H:%M') {
                $formValues['timeFormat'] = str_replace(
                        array_keys($timeFormatMap),
                        array_values($timeFormatMap),
                        $arrVars['INPUT_EXTRA_PARAM']['FORMAT']);
            }
        }

        $json = new Services_JSON();
        $params = $json->encode(array_merge($defaultValues, $formValues));
        if ($datewidget == 'datetimepicker' && isset($arrVars['INPUT_EXTRA_PARAM']['TIMELIB']) &&
            $arrVars['INPUT_EXTRA_PARAM']['TIMELIB'] == 'bootstrap-datetimepicker') {
            $strInput = <<<DATETIME_PICKER_FIELD
<div class="input-append date form_datetime" nowrap>
    <input size="16" type="text" name="{$varName_escaped}" value="{$varValue_escaped}" class="datepicker-input" readonly>
    <span class="add-on datepicker-button"><i class="fa fa-calendar"></i></span>
</div>
<script type="text/javascript">
$(function() {
    $("input[name={$varName}]").{$datewidget}({$params});
});
</script>
DATETIME_PICKER_FIELD;
        } else {
            $strInput = <<<DATETIME_PICKER_FIELD
<input type="text" name="{$varName_escaped}" value="{$varValue_escaped}"
    style="width: 10em; color: #840; background-color: #fafafa; border: 1px solid #999999; text-align: center" />
<script type="text/javascript">
$(function() {
   $("input[name={$varName}]").{$datewidget}({$params});
    
});
</script>
DATETIME_PICKER_FIELD;
        }
        return $strInput;
    }
	
	
	
	//------------------------------------ ATK.CO -----------------------------------------
	protected function _form_widget_DATE_SHAMSI($bIngresoActivo, $varName, $varValue,
            $arrVars, $varName_escaped, $varValue_escaped, $attrstring)
    {
        //if (!$bIngresoActivo) return $varValue_escaped;
		$strInput = <<<DATETIME_PICKER_FIELD
			
			<link rel="stylesheet" href="libs/mylib/dpik/css/persianDatepicker-default.css" />
			<script src="libs/mylib/dpik/js/jquery.min.js" ></script>
			<script src="libs/mylib/dpik/js/persianDatepicker.min.js"></script>
			


		
			<div>
				<input size="16" type="text" name="{$varName_escaped}" value="{$varValue_escaped}" id="{$varName_escaped}" style = "text-align:left;" readonly>
				<img src="images/calendar.gif" id="{$varName_escaped}pic">&nbsp;&nbsp;
			</div>

			<script type="text/javascript">
				
				$("#{$varName_escaped}pic").persianDatepicker({
					//cellWidth: 14,
					//cellHeight: 12,
					//fontSize: 8,
					persianNumbers: !0,
					//formatDate: "YYYY/0M/0D",
					formatDate: "0D NM YYYY",
	  
					onSelect: function () {
						$("#{$varName_escaped}").val($("#{$varName_escaped}pic").attr("data-jdate").toPersinaDigit());
						$("#{$varName_escaped}pic").empty();
					}
				});	
				
			
				
				
				String.prototype.toPersinaDigit= function(){ 
				var id= ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
				return this.replace(/[0-9]/g, function(w){ return id[+w] });
				}				
			</script>
DATETIME_PICKER_FIELD;
    return $strInput;
    }
	
//------------------------------------ ATK.CO -----------------------------------------

    function setViewMode()
    {
        $this->modo = 'view';
    }

    function setEditMode()
    {
        $this->modo = 'edit';
    }

    // TODO: No se que hacer en caso de que el $arrCollectedVars sea un arreglo vacio
    //       puesto que en ese caso la funcion devolvera true. Es ese el comportamiento esperado?
    function validateForm($arrCollectedVars)
    {
        $arrCollectedVars = array_merge($arrCollectedVars,$_FILES);
        include_once("libs/paloSantoValidar.class.php");
        $oVal = new PaloValidar();
        foreach($arrCollectedVars as $varName=>$varValue) {
            // Valido si la variable colectada esta en $this->arrFormElements
            if(@array_key_exists($varName, $this->arrFormElements)) {
                if($this->arrFormElements[$varName]['INPUT_TYPE']=='FILE')
                    $varValue = $_FILES[$varName]['name'];

                if($this->arrFormElements[$varName]['REQUIRED']=='yes' or ($this->arrFormElements[$varName]['REQUIRED']!='yes' AND !empty($varValue))) {
                    $editable = isset($this->arrFormElements[$varName]['EDITABLE'])?$this->arrFormElements[$varName]['EDITABLE']:"yes";
                    if($this->modo=='input' || ($this->modo=='edit' AND $editable != 'no')) {
                        $oVal->validar($this->arrFormElements[$varName]['LABEL'], $varValue, $this->arrFormElements[$varName]['VALIDATION_TYPE'],
                                       $this->arrFormElements[$varName]['VALIDATION_EXTRA_PARAM']);
                    }
                }
            }
        }
        if($oVal->existenErroresPrevios()) {
            $this->arrErroresValidacion = $oVal->obtenerArregloErrores();
            return false;
        } else {
            return true;
        }
    }
}
?>
