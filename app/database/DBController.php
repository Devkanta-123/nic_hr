<?php

namespace app\database;

use Exception;
use \PDO;

class DBController
{
	static $servername = "localhost:3306";
	static $conn = false;

	/*
	*	@return Connection
	*/
	static function init()
	{
		require_once('DBcredentials.php');
		if (self::$conn === false) {
			self::$conn = new PDO("mysql:host=" . self::$servername . ";dbname=" . $database, $username, $password);
			self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}


	/*
	*	@param Machine Session Code 
	*	@param query/SQL Query
	*	@param Parameters to be passed(Can be an empty array)
	*	@return Boolean Value/DataSet as Array
	*/
	static function getDataSet($query, $params = array())
	{
		try {
			self::init();
			$stmt = self::$conn->prepare($query);

			foreach ($params as $v) {

				$paramType = PDO::PARAM_STR;

				if (is_bool($v[1])) {
					$paramType = PDO::PARAM_BOOL;
				} elseif (is_null($v[1])) {
					$paramType = PDO::PARAM_NULL;
				} elseif (is_int($v[1])) {
					$paramType = PDO::PARAM_INT;
				}

				$stmt->bindParam($v[0], $v[1], $paramType);
			}

			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

			if ($result)
				return $stmt->fetchAll();
			else
				return false;
		} catch (exception $e) {
			self::logs($query . " \n " . json_encode($params) . " \n " . $e->getMessage());
			return false;
		}
	}

	/*
	*	@param Machine Session Code 
	*	@param query/SQL Query
	*	@param Parameters to be passed(Can be an empty array)
	*	@return Boolean Value as Array
	*/
	static function sendData($query, $params = array())
	{
		try {
			self::init();
			$stmt = self::$conn->prepare($query);

			foreach ($params as $v) {

				$paramType = PDO::PARAM_STR;

				if (is_bool($v[1])) {
					$paramType = PDO::PARAM_BOOL;
				} elseif (is_null($v[1])) {
					$paramType = PDO::PARAM_NULL;
				} elseif (is_int($v[1])) {
					$paramType = PDO::PARAM_INT;
				}

				$stmt->bindParam($v[0], $v[1], $paramType);
			}

			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


			if ($result)
				return $stmt->fetch();
			else
				return false;
		} catch (exception $e) {
			self::logs($query . " \n " . json_encode($params) . " \n " . $e->getMessage());
			return false;
		}
	}


	/*
	*	@param Machine Session Code 
	*	@param query/SQL Query
	*	@param Parameters to be passed(Can be an empty array)
	*	@return Boolean Value 
	*/
	static function ExecuteSQL($query, $params = array())
	{
		try {
			self::init();
			$stmt = self::$conn->prepare($query);

			foreach ($params as $v) {

				$paramType = PDO::PARAM_STR;

				if (is_bool($v[1])) {
					$paramType = PDO::PARAM_BOOL;
				} elseif (is_null($v[1])) {
					$paramType = PDO::PARAM_NULL;
				} elseif (is_int($v[1])) {
					$paramType = PDO::PARAM_INT;
				}

				$stmt->bindParam($v[0], $v[1], $paramType);
			}

			return $stmt->execute();
		} catch (exception $e) {
			self::logs($query . " \n " . json_encode($params) . " \n " . $e->getMessage());
			return false;
		}
	}

	static function ExecuteSQLID($query, $params = array())
	{
		try {
			self::init();
			$stmt = self::$conn->prepare($query);

			foreach ($params as $v) {

				$paramType = PDO::PARAM_STR;

				if (is_bool($v[1])) {
					$paramType = PDO::PARAM_BOOL;
				} elseif (is_null($v[1])) {
					$paramType = PDO::PARAM_NULL;
				} elseif (is_int($v[1])) {
					$paramType = PDO::PARAM_INT;
				}

				$stmt->bindParam($v[0], $v[1], $paramType);
			}

			$stmt->execute();
			$result = self::$conn->lastInsertId();
			return $result;
		} catch (exception $e) {
			self::logs($query . " \n " . json_encode($params) . " \n " . $e->getMessage());
			return false;
		}
	}

	/*
	*	@param Table Name 
	*	@param Column Name
	*	@param Prefix
	*	@param Code Length
	*	@return RESULT CODE
	*/
	static function GenerateCode($tablename, $columnname, $prefix, $CodeLength)
	{
		$params = array(
			array(":TableName", $tablename),
			array(":ColumnName", $columnname),
			array(":Prefix", $prefix),
			array(":CodeLength", $CodeLength)
		);

		$query = 'call p_GenerateCode(:TableName, :ColumnName, :Prefix, :CodeLength)';
		$res = DBController::sendData($query, $params);
		if ($res) {
			return $res["RESULTCODE"];
		}
		return $res;
	}


	static function logs($log)
	{
		$fp = fopen('../log.txt', 'a'); //opens file in append mode  
		fwrite($fp, "\r\n\r\n" . date('d-m-y h:i:s') . " : " . $log);
		fclose($fp);
	}


	static function CloseDB()
	{
		if (self::$conn != false)
			self::$conn = null;
	}
}

class Helper
{
	static function generate_string($length = 5)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
}
