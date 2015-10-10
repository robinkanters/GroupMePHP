<?php

namespace GroupMePHP;

class AbstractClient
{
    private $token = '';
    protected $url = 'https://api.groupme.com/v3';

    /*
     * When creating a new groupmeClient object
     * send array with 'access_token'
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /*
     * Build query string from $args
     */
    public function buildQueryString($args = array())
    {
        $args = array_merge($args, array('token' => $this->token));

        $query = '';
        if (isset($args)) {
            while (list($key, $val) = each($args)) {
                if (strlen($query) > 0) {
                    $query .= '&';
                } else {
                    $query .= '?';
                }
                $query .= $key.'='.$val;
            }
        }

        return $query;
    }

    /*
     * Overhead function that all requests utilize
     */
    public function request($args)
    {
        $c = curl_init();

        curl_setopt($c, CURLOPT_TIMEOUT, 4);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_USERAGENT, 'groupmeClient/0.1');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, $args['method']);

        $curlurl = $this->url.$args['url'].$this->buildQueryString($args['query']);
        curl_setopt($c, CURLOPT_URL, $curlurl);

        if ($args['method'] == 'POST' && isset($args['payload'])) {
            if (isset($args['payload']['file'])) {
                $payload = $args['payload'];
            } else {
                $payload = json_encode($args['payload']);
                curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            }

            curl_setopt($c, CURLOPT_POSTFIELDS, $payload);
        }

        $response = curl_exec($c);
        curl_close($c);

        return $response;
    }
}
