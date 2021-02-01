<?php

class User
{
    private $params = array(
        'ip_address' => "",
        'user_agent' => "",
        'page_url' => "",
    );

    private $table_name = "users";

    public function __construct($ip_address, $user_agent, $url){
        $this->params['ip_address'] = $ip_address;
        $this->params['user_agent'] = $user_agent;
        $this->params['page_url'] = $url;
    }

    public function ping($db){
        if($user = $db->selectFirst($this->table_name, $this->params)){
            if (!$db->update($this->table_name, array(
                'views_count' => $user['views_count'] + 1,
            ), $user['id']))
                die('Update user item was failed!');
        } else if(!$db->insert($this->table_name, $this->params))
            die('Create user item was failed!');

    }
}