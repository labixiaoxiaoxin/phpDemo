<?php
	namespace Admin\Model;
	use Think\Model;
	class SettingModel extends Model {
		function getAll(){
			$data=$this->select();
			//var_dump($data);
			$result=array();
			foreach ($data as $row) {
				$result[$row['skey']]=$row['sval'];
			}
			//var_dump($result);
			return $result;
		}
	}