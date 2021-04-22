<?php

namespace gabrieljperez\IagenteSms;

use Log;
/**
 * Class IagenteSms
 *
 * @package gabrieljperez\IagenteSms
 * @author  Gabriel Perez <gabriel.perez@soulrocket.com.br>
 */
class IagenteSms
{
    /**
     * Get the IagenteSms login user
     * Private static function
     * 
     * @return string
     */
    private static function _getUser()
    {
        return config('services.iagentesms.user');
    }

    /**
     * Get the IagenteSms login password
     * Private static function
     * 
     * @return string
     */
    private static function _getPass()
    {
        return  config('services.iagentesms.pass');
    }

    /**
     * Send the sms message to the number informed using the Iagente get api
     * public static function
     * 
     * @param string $phone 
     * @param string $message 
     * 
     * @return array
     */
    public static function sendMessage($phone,$message)
    {
        // get user and password of IagenteSms
        $user = Self::_getUser();
        $pass = Self::_getPass();

        // codifica os dados no formato de um formulário www
        $mensagem = urlencode($message.'  é o seu código de verificação da WedClub');
        // concatena a url da api com a variável carregando o conteúdo da mensagem
        $url_api = "https://www.iagentesms.com.br/webservices/http.php?metodo=envio&usuario={$user}&senha={$pass}&celular={$phone}&mensagem={$mensagem}";

        if (app()->environment('local')) {
            $api_http = Log::debug("[{$phone}] {$mensagem}");
        } else {
            // realiza a requisição http passando os parâmetros informados
            $api_http = file_get_contents($url_api);
        }

        // imprime o resultado da requisição
        return $api_http;

    }
}
