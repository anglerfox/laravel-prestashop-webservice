<?php

namespace Protechstudio\PrestashopWebService\Exceptions;

class PrestashopWebServiceRequestException extends PrestashopWebServiceException
{
    protected $response;
    protected $baseUrl;

    public function __construct($message = null, $code = null, $response = null, $baseUrl = null)
    {
        if ($response instanceof \SimpleXMLElement && isset($response->errors->error->message)) {
            $message = (string) $response->errors->error->message;
        }

        $finalMessage = $message ?? sprintf("This call to PrestaShop Web Services failed with HTTP status %d.", $code);

        parent::__construct($finalMessage, $code);

        $this->response = $response;
        $this->baseUrl = $baseUrl; // Store base URL
    }

    /**
     * Check if the response exists and is not empty
     */
    public function hasResponse()
    {
        return !empty($this->response);
    }

    /**
     * Get the response data
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get the Base URL
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
