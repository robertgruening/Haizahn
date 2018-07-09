<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


abstract class UserStory
{  
    private $_messages = array();
    
 
    public function getMessages()
    {
        return $this->_messages;
    }

    protected function clearMessages()
    {
        $this->_messages = array();
    }

    protected function addMessages($messages)
    {
        array_merge($this->_messages, $messages);
    }

    protected function addMessage($message)
    {
        array_push($this->_messages, $message);
    } 


    public function run()
    {
        $this->clearMessages();
        if ($this->areParametersValid())
        {
            return $this->execute();
        }
    
        return false;
    }
    
    abstract protected function areParametersValid();
    abstract protected function execute();
    
}