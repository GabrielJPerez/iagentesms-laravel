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
    /** @var string */
    protected $user;

    /** @var string */
    protected $pass;

    /**
     * IagenteSms constructor.
     */
    public function __construct()
    {
        $this->user = $this->getUser();
        $this->pass = $this->getPass();
    }

    /**
     * Get the IagenteSms login user
     * 
     * @return string
     */
    private function getUser()
    {
        return config('services.iagentesms.user');
    }

    /**
     * Get the IagenteSms login password
     * 
     * @return string
     */
    private function _getPass()
    {
        return config('services.iagentesms.pass');
    }

    /**
     * Send the sms message to the number informed using the Iagente get api
     * 
     * @param string $phone 
     * @param string $message 
     * 
     * @return array
     */
    public function sendMessage($phone,$message)
    {
        // codifica os dados no formato de um formulário www
        $mensagem = urlencode($message.'  é o seu código de verificação da WedClub');
        // concatena a url da api com a variável carregando o conteúdo da mensagem
        $url_api = "https://www.iagentesms.com.br/webservices/http.php?metodo=envio&usuario={$this->user}&senha={$this->pass}&celular={$phone}&mensagem={$mensagem}";

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
