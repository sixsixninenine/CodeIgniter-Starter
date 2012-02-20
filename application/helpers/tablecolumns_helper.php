<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



    function getTableColumns($tName, $empty=FALSE) 
	{
		$data = array();
		$conn = ActiveRecord\ConnectionManager::get_connection("development");
		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tName'";
		$result = (object)$conn->query($sql);
		if ( Category::count() > 0) 
		{

			foreach ($result as $row)
			{
	           // if $empty is true, return associative array with empty values
	           // else return array containing column names
				if ($empty) 
				{
		         	$data[$row['column_name']] = '';
				} 
				else 
				{
					$data[] = $row['column_name'];
				} 	
	        }
		}	
		
		return array_to_object($data);	
	}


	function array_to_object(array $array){
            # Iterate through our array looking for array values.
            # If found recurvisely call itself.
            foreach($array as $key => $value){
                if(is_array($value)){
                    $array[$key] = self::array_to_object($value);
                }
            }
           
            # Typecast to (object) will automatically convert array -> stdClass
            return (object)$array;
        }

