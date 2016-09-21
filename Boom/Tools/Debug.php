<?php
function d()
{
    if (ENV != 'dev') {
        return;
    }
    $args = func_get_args();
    if ( empty($args) ) {
        $args = array(null);
    }

    $color      = '#ffffff';
    $background = '#2d8ac7';

    // Params
    $label  = '';
    $value  = array_shift($args);
    $params = array(
        'print'      => true,
        'brut'       => false,
        'var_dump'   => false,
        'var_export' => false,
        'serialize'  => false,
        'trace_jump' => 1,
        'trace'      => 1,
        'style_css'  => '
			text-align: left;
			background: '.$background.';
			color: '.$color.';
			font-weight: bold;
			padding: 10px;
			text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
			border: 2px solid #7b1c17;
			overflow: auto;
			border-radius: 4px;
			-moz-border-radius: 4px;
			-webkit-border-radius: 4px;'
    );

    foreach ($args as $i => $a) {
        if ( is_bool($a) ) {
            // Booléen : définition du paramètre print
            $params['print'] = $a;
        } elseif ( is_int($a) ) {
            // Nombre de ligne de trace
            $params['trace'] = $a;
        } elseif ( is_string($a) ) {
            // Chaîne : on découpe sur un éventuel signe "="
            $strparam = explode('=', $a, 2);
            if ( count($strparam) == 1 ) { // si pas de signe "="
                if ( isset($params[$a]) ) {
                    $params[$a] = true;
                } else {
                    $label = $a;
                }
            } else { // si signe "=" trouvé
                $params[$strparam[0]] = $strparam[1]; // définition du paramètre correspondant
            }
        } elseif ( is_array($args[$i]) ) {
            $params = array_merge($params, $a);
        }
    }

    // Génération des informations sur la variable
    if ( $params['var_dump'] ) {
        ob_start();
        var_dump($value);
        $output = ob_get_clean();
    } elseif ( $params['var_export'] ) {
        ob_start();
        var_export($value);
        $output = ob_get_clean();
    } elseif ( $params['serialize'] ) {
        $output = serialize($value);
    } elseif ( is_bool($value) ) {
        $output = $value ? 'true' : 'false';
    } elseif ( !isset($value) ) {
        $output = 'null';
    } else {
        $output = print_r($value, true);
    }

    // Affichage trace ?


    // Label ?
    if ( !empty($label) ) {
        $label = htmlspecialchars($label) . ' = ';
    }

    // Génération du résultat
    if ( empty($params['brut']) ) {
        $output = htmlspecialchars($output);
        $output = '<pre class="debug" style="' . str_replace("\n", '', $params['style_css']) . '">' . $label . $output . '</pre>';
    }

    if ( $params['print'] ) {
        echo $output;
    }
    return $output;
}

function dd()
{
    if (ENV != 'dev') {
        return;
    }
    $args = func_get_args();
    $args[] = array(
        'trace_jump'    => 3,
    );
    call_user_func_array('d', $args);
    exit;
}

function error($string) {
    if (ENV != 'dev') {
        return;
    }
    echo '<div class="warning" style="border: 1px solid red; padding: 10px; color: red">'. $string .'</div>';
}