<?php
class User
{
	#region
	private $_id = -1;
	private $_name = "";
	private $_email = "";		
	#endregion
	
	#region properties
	public function GetId()
	{
		return $this->_id;
	}
	
	public function SetId($id)
	{
		$this->_id = $id;
	}
	
	public function GetName()
	{
		return $this->_name;
	}
	
	public function SetName($name)
	{
		$this->_name = $name;
	}
	
	public function GetEmail()
	{
		return $this->_email;
	}
	
	public function SetEmail($email)
	{
		$this->_email = $email;
	}
	#endregion
}
?>
