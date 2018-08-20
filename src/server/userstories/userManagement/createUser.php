<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__."/../UserStory.php");
require_once(__DIR__."/../../models/user.php"); 
require_once(__DIR__."/../../factories/userFactory.php");


class createUser extends UserStory
{ 

    private $_user = null;

    private $_name = null;
    private $_email = null;
    private $_password = null;
    private $_passwordConfirmation = null;
    

    private function getName()
    {
        return $this->_name;
    } 

    public function setName($name)
    {
        $this->_name = $name;
    } 
    

    private function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }
    

    private function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }


    private function getPasswordConfirmation()
    {
        return $this->_passwordConfirmation;
    }

    public function setPasswordConfirmation($passwordConfirmation)
    {
        $this->_passwordConfirmation = $passwordConfirmation;
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
        
        if ($this->getName() == null)
        {
            $this->addMessage("Name ist nicht gesetzt!");  
            $isValid = false;
        }

        if ($this->getEmail() == null)
        {
            $this->addMessage("E-Mail ist nicht gesetzt!");   
            $isValid = false;
        }

        if ($this->getPassword() == null)
        {
            $this->addMessage("Password ist nicht gesetzt!");   
            $isValid = false;
        }

        if ($this->getPasswordConfirmation() == null)
        {
            $this->addMessage("PasswordConfirmation ist nicht gesetzt!");    
            $isValid = false;
        }

        if ($this->getPassword() != null && 
            $this->getPasswordConfirmation() != null &&
            $this->getPassword() != $this->getPasswordConfirmation()
            )
        {
            $this->addMessage("Password entspricht nicht der PasswordConfirmation!");   
            $isValid = false;
        }
 
        return $isValid;
    }
      
    protected function execute()
    {
        $user = new User();
         
        $user->SetName($this->getName());
        $user->SetEmail($this->getEmail());
        $user->SetPassword($this->getPassword());
        
        $userFactory = new UserFactory();
        
        try
        {
            $userFactory->Set($user);
        }
        catch (Exception $e)
        { 
            $this->addMessage($e->getMessage());   

            return false;
        }

        $this->setUser($userFactory->GetByName($user->GetName()));
       
        return true;
    }
}