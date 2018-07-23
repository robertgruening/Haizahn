<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__."/../UserStory.php");
require_once(__DIR__."/../../models/user.php"); 
require_once(__DIR__."/../../factories/userFactory.php");


class loadUsers extends UserStory
{
    private $_users = array();
       
    public function getUsers()
    {
        return $this->_users;
    }

    private function setUsers($users)
    {
        $this->_users = $users;
    }

    protected function areParametersValid()
    {   
        return true;
    }
      
    protected function execute()
    {
        $users = array();          
        $userFactory = new UserFactory();
         
        try
        {
            $users = $userFactory->GetAll(); 
        }
        catch (Exception $e)
        { 
            $this->addMessage($e->getMessage());   

            return false;
        }

        $this->setUsers($users);
       
        return true;
    }
}