<?php

include_once(__DIR__ . "/../config.php");
include_once(__DIR__ . "/config.db.php");

abstract class Factory
{
    #region methods
    #region create
    public abstract function Create($id);
    #endregion
    
    #region get	
    public function GetById($id)
    {
        global $logger;
        $logger->debug("Getting element by Id = " . $id);

        return $this->SelectById($id);
    }
    #endregion
    
    #region set
    public function Set($object)
    {
        global $logger;
        $logger->debug("Setting element ".$user->GetId());
        
        if ($object->GetId() == -1)
        {
            $this->Insert($object);
        }
        else
        {
            $this->Update($object);
        }
    }
    #endregion
    
    #region delete
    public abstract function Delete($object);
    #endregion
    
    #region convert
    public abstract function ConvertToAssocArray($object);

    protected abstract function ConvertToObject($dataRow);
    #endregion
    #endregion

    protected abstract function Insert($object);

    protected abstract function Update($object);

    protected abstract function SelectById($id);
}

?>
