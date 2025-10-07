<?php
abstract class User
{
    protected $username;
    protected $role;
    
    public function __construct($username)
    {
        $this->username = $username;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    abstract public function getRole();
}
?>