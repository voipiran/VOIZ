<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @todo comment
 */

class Application_Lib_Params {

    function __construct() {
        
    }

    function get($name, $escape = true, $strip = false) {
        $output = $_GET[$name];

        if ($escape) {
            $output = mysql_real_escape_string($_GET[$name]);
        }

        if ($strip) {
            $output = strip_tags($output);
        }

        return $output;
    }

    function post($name, $escape = true, $strip = false) {


        if (is_array($_POST[$name])) {

            foreach ($_POST[$name] as $key => $pval) {


                if (is_array($pval)) {
                    foreach ($pval as $pkey => $xpval) {


                        if (is_array($xpval)) {
                            foreach ($xpval as $xkey => $zpval) {
                                     if ($escape)
                                $_POST[$name][$key][$pkey][$xkey] = mysql_real_escape_string($zpval);

                            if ($strip)
                                $_POST[$name][$key][$pkey][$xkey] = strip_tags($_POST[$name][$key][$pkey]);
                                
                            }
                        } else {


                            if ($escape)
                                $_POST[$name][$key][$pkey] = mysql_real_escape_string($xpval);

                            if ($strip)
                                $_POST[$name][$key][$pkey] = strip_tags($_POST[$name][$key][$pkey]);
                        }
                    }
                } else {
                    if ($escape)
                        $_POST[$name][$key] = mysql_real_escape_string($_POST[$name][$key]);

                    if ($strip)
                        $_POST[$name][$key] = strip_tags($_POST[$name][$key]);
                }
            }

            $output = $_POST[$name];
        }else {

            if ($escape) {
                $output = mysql_real_escape_string($_POST[$name]);
            }
            if ($strip) {
                $output = strip_tags($output);
            }
        }
        return $output;
    }

    public function uget() {

        $var = $this->get(app_sec_uvar, true, true);

        //spliting the uvars
        $output = explode(uvar_spliter, $var);

        if (is_array($output)) {

            //Filtering
            $fsps = explode(",", app_filter_url_pattern);
            $fsrs = explode(",", app_filter_url_rout);



            foreach ($fsps as $fsp) {


                if ($fsp !== key($fsps) and ( $fsp == $output[key($fsps)] )) {
                    $output[key($fsps)] = $fsrs[key($fsps)];
                }
            }


            return $output;
        } else {
            return false;
        }
    }

}

?>
