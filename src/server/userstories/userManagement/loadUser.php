<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__."/../UserStory.php");
require_once(__DIR__."/../../models/user.php"); 
require_once(__DIR__."/../../factories/userFactory.php");


class loadUser extends UserStory
{
    private $_user = null;
    private $_id = null;
      
    private function getId()
    {
        return $this->_id;
    } 

    public function setId($id)
    {
        $this->_id = $id;
    } 
  
    public function getUser()
    {
        return $this->_user;
    }

    private function setUser($user)
    {
        $this->_user = $user;
    }

    protected function areParametersValid()
    { 
        $isValid = true;
        
        if ($this->getId() == null || 
            $this->getId() == "")
        {
            $this->addMessage("Id ist nicht gesetzt!");  
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
            $user = $userFactory->GetById($this->getId()); 
        }
        catch (Exception $e)
        { 
            $this->addMessage($e->getMessage());   

            return false;
        }

        $this->setUser($user);
       
        return true;
    }
}