<?php

namespace GroupMePHP;

class Users extends AbstractClient
{
    /**
     * me: Get details about the authenticated user.
     * 
     * @return string $return
     */
    public function index()
    {
        $params = array(
            'url' => '/users/me',
            'method' => 'GET',
            'query' => array(),
        );

        return $this->request($params);
    }
}
