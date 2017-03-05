<?php

if(!function_exists('debug')){
    function debug($array){
        echo '<pre>';
        echo "Debugging Array/Objet:";
        print_r($array);
        echo '</pre>';
    }
}

if(!function_exists('remove_acentos')){
    function remove_acentos($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }
}

if(!function_exists('base_url')){
    function base_url($path = ''){
        return url($path);
    }
}

if(!function_exists('midia')){
    function midia($path = ''){
        return asset($path);
    }
}

if(!function_exists('clear_sessions')){
    function clear_sessions(){
        session()->forget('cart');
        session()->forget('total');
        session()->forget('cliente');
        session()->forget('vendas_ref');
        session()->forget('vendas_ref');
    }
}

if (!function_exists('start_cart')) {
    function start_cart() {
        if (empty(session('cart'))) {

            session('cart', []);
            session('total', 0.00);
        }

        return session('cart');
    }
}

if (!function_exists('sum_cart')) {
    function sum_cart($total) {
        $valorCarrinho = session('total');
        $valorTotal = $valorCarrinho + $total;
        session()->put('total', $valorTotal);
    }
}

if (!function_exists('del_cart')) {
    function del_cart($id_produto) {
        $items = session('cart');

        foreach ($items as $i => $v){
            if($v['id'] == $id_produto){
                unset($items[$i]);
            }
        }

        session()->put('cart', $items);
        recalc_cart('cart');
    }
}

if(!function_exists('filter_array')){
    function filter_array($array, $key, $value){

        foreach ($array as $i => $v) {
            if($v[$key] <> $value){
                unset($array[$i]);
            }
        }
        return $array;
    }
}


if (!function_exists('recalc_cart')) {
    function recalc_cart($key) {
        $totalCart = 0.00;

        foreach (session($key) as $item):
            $totalCart += $item['quantidade'] * $item['preco'];
        endforeach;

        session()->put('total', $totalCart);
    }
}

if (!function_exists('total_cart')) {
    function total_cart() {
        return session('total');
    }
}

if (!function_exists('date_to_mysql')) {
    function date_to_mysql($date) {
        $date = substr($date, 0, 10);

        $data_array = explode('/', $date);
        $ano = $data_array[2];
        $mes = $data_array[1];
        $dia = $data_array[0];
        return $ano . '-' . $mes . '-' . $dia;
    }
}

if (!function_exists('mysql_to_date')) {
    function mysql_to_date($date) {
        $date = substr($date, 0, 10);

        $data_array = explode('-', $date);
        $ano = $data_array[0];
        $mes = $data_array[1];
        $dia = $data_array[2];

        $data_formatada = $dia . '/' . $mes . '/' . $ano;

        return $data_formatada;
    }
}

if (!function_exists('moeda')) {
    function moeda($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}

if(!function_exists('moeda_mysql')){
    function moeda_mysql($valor){
        $valor_1 = str_replace(',', '#', $valor);
        $valor_2 = str_replace('.', ',', $valor_1);
        $valor_3 = str_replace('#', '', $valor_2);
        $valor_formatado = str_replace(',', '.', $valor_3);

        return $valor_formatado;
    }
}

if (!function_exists('add_dias')) {

    function add_dias($data_inicial = '', $duracao = '30') {
        if (empty($data_inicial)):
            $data_inicial = date('Y-m-d H:i:s');
        endif;

        $data_final = date('Y-m-d H:i:s', strtotime("+{$duracao} days", strtotime($data_inicial)));

        return $data_final;
    }

}

if (!function_exists('dias_restantes')) {
    function dias_restantes($data_inicial = null, $data_final = null) {

        $dias = 0;
        if ($data_inicial == 'integer' && $data_final == 'integer'):
            $dias = ($data_final - $data_inicial) / 86400;
            if ($dias < 0):
                $dias = $dias * -1;
            endif;
        else:
            $d1 = strtotime($data_inicial);
            $d2 = strtotime($data_final);
            $dias = ($d2 - $d1) / 86400;
            if ($dias < 0):
                $dias = $dias * -1;
            endif;
        endif;

        return $dias;
    }

}

if (!function_exists('mensagem')) {
    function mensagem($message = '') {
        print("<script type='text/javascript'>alert('" . $message . "');</script>");
    }
}

if (!function_exists('go_to')) {
    function go_to($location = '') {
        print("<script type='text/javascript'>window.location.href='" . url($location) . "'</script>");
    }
}

if (!function_exists('reload')) {
    function reload() {
        print("<script type='text/javascript'>window.location.reload();'</script>");
    }

}

if (!function_exists('back')) {
    function back() {
        print("<script type='text/javascript'>window.history.go(-1);</script>");
    }
}

if (!function_exists('back_one')) {
    function back_one() {
        print("<script type='text/javascript'>window.history.go(-1);</script>");
    }
}

if (!function_exists('excluir')) {
    function excluir($url, $id) {
        print("<script type='text/javascript'>
        if(confirm('Deseja realmente excluir o registro: $id ?')){
            window.location.href='" . url($url . '/' . $id) . "';
        }
        else{
            window.history.go(-1);
        }
        </script>");
    }
}

if (!function_exists('finalizar')) {
    function finalizar($url, $venda_ref) {
        print("<script type='text/javascript'>
        if(confirm('Deseja realmente finalizar a venda: $venda_ref ?')){
            window.location.href='" . url($url . '/' . $venda_ref) . "';
        }
        else{
            window.history.go(-1);
        }
        </script>");
    }
}

if(!function_exists('payments')){
    function payments($type = 'transaction', $notification_code = null){
        $CI =& get_instance();

        // Retorna URL do XML, referente ao NOTIFICATION CODE
        if($type == 'transaction' && $notification_code <> null):

            //return "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/{$notification_code}?email=".PAGSEGURO_EMAIL."&token=".PAGSEGURO_TOKEN;
            return env('WS_PAGSEGURO')."/v2/transactions/notifications/{$notification_code}?email=".env('PAGSEGURO_EMAIL')."&token=".env('PAGSEGURO_TOKEN');
        endif;

        // Retorna o STATUS do TRANSACTION CODE (1, 2, 3...etc)
        if($type == 'status' && $notification_code <> null):
            $return = '';
            switch ($notification_code) {
                case '1':
                $return = 'Aguardando pagamento';
                break;
                case '2':
                $return = 'Em análise';
                break;
                case '3':
                $return = 'Paga';
                break;
                case '4':
                $return = 'Disponível';
                break;
                case '5':
                $return = 'Em disputa';
                break;
                case '6':
                $return = 'Devolvida';
                break;
                case '7':
                $return = 'Cancelada';
                break;

                default:
                $return = 'Aguardando pagamento';
                break;
            }

            return $return;
        endif;

        // Retorna email do comprador, quando passado o XML por parametro
        if($type == 'email' && $notification_code <> null):
            //1. Recebe o XML


            //2. Retorna o Email
        endif;
    }
}
