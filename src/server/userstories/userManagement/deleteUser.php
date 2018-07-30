<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__."/../UserStory.php");
require_once(__DIR__."/../../models/user.php"); 
require_once(__DIR__."/../../factories/userFactory.php");


class deleteUser extends UserStory
{
    private $_user = null; 
   
    private function getUser()
    {
        return $this->_user;
    }

    public function setUser($user)
    {
        $this->_user = $user;
    }

    protected function areParametersValid()
    { 
        $isValid = true;
        
        if ($this->getUser() == null || 
            $this->getUser() == "")
        {
            $this->addMessage("User ist nicht gesetzt!");  
            $isValid = false;
        }
  
        return $isValid;
    }
      
    protected function execute()
    {
        $user = null;          
        $userFactory = new UserFactory();
         
        try
        { 
            $userFactory->Delete($user);
        }
        catch (Exception $e)
        { 
            $this->addMessage($e->getMessage());   

            return false;
        }
  
        return true;
    }
}