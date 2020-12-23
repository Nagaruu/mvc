<?php

namespace mvc\Models; 

use mvc\Core\Model;

class TaskModel extends Model
{
	protected $id;
	protected $title;
	protected $description;
	protected $created_at;
	protected $updated_at;

	function setId($id)
	{
		$this->id = $id; 
	}

	function getId()
	{
		return $this->id;
	}

	function setTitle($title)
	{
		$this->title = $title; 
	}

	function getTitle()
	{
		return $this->title;
	}

	function setDescription($description)
	{
		$this->description = $description; 
	}

	function getDescription()
	{
		return $this->description;
	}

	function setCreated_at($created_at)
	{
		$this->created_at = $created_at; 
	}

	function getCreated_at()
	{
		return $this->created_at;
	}

	function setUpdated_at($updated)
	{
		$this->updated = $updated; 
	}
	
	function getUpdated_at()
	{
		return $this->updated;
	}
}
