<?php
namespace app\misc;

use app\database\DBController;
class IPLogger
{

	static function logIP($data)
	{

		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

		if (isset($_SESSION['UserID'])) {
			$userid = $_SESSION['UserID'];
		} else {
			$userid = 0;
		}

		$ip = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

		$param = array(
			array(":IPAddress", $ip),
			array(":UserID", $userid),
			array(":DATA", json_encode($data["JSON"])),
			array(":URL", $actual_link)
		);

		$query = "INSERT INTO IPLogging(IPAddress, UserID, DATA, URL) VALUES (:IPAddress,:UserID,:DATA,:URL)";
		$val = DBController::ExecuteSQL($query, $param);

		return array("return_code" => true, "return_data" => $val);
	}
}
