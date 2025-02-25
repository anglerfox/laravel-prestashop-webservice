<?php

namespace Protechstudio\PrestashopWebService\Exceptions;

class PrestashopWebServiceRequestException extends PrestashopWebServiceException
{
    protected $response;

    public function __construct($message = null, $code = null, $response = null)
    {
       if ($response instanceof \SimpleXMLElement && isset($response->errors->error->message)) {
            $message = (string) $response->errors->error->message;
        }

        $finalMessage = $message ?? sprintf("This call to PrestaShop Web Services failed with HTTP status %d.", $code);

        parent::__construct($finalMessage, $code);

        $this->response = $response;
    }

    public function hasResponse()
    {
        return isset($this->response) && !empty($this->response);
    }

    public function getResponse()
    {
        return $this->response;
    }
}
