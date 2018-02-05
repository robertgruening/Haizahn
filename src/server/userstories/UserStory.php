<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


abstract class UserStory
{ 
    public abstract function Run($jsonBlob)
    {
        if ($this->HasPermissions($jsonBlob))
        {
            
        }
        
        //rechte prüfen  allg. speziell
        //ausführung simulieren
        //us ausführen
        
    }
}