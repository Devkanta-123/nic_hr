<?php

namespace app\modules\auth\classes;

use app\database\DBController;
use DateTime;

class Session
{
	public static function isValidSession($jsonarray)
	{
		// $MSC = $jsonarray["MSC"];
		// $today = date("d");
		// $mk = md5($today);
		// if ($mk != $MSC) {
		// 	return false;
		// }

		// if (!isset($_SESSION["UserID"]) || !isset($_SESSION["SessionKey"])) {
		// 	if ($jsonarray["Page_key"] == "login" || $jsonarray["Page_key"] == "revoke" || $jsonarray["Page_key"] == "signup") {
		// 		session_destroy();
		// 		session_start();
		// 	}
		// 	return false;
		// }

		$params = array(
			array(":userid", $_SESSION["adminuserid"]),
			array(":sessionkey", $_SESSION["sessionkey"])
		);

		$query = "SELECT * FROM LoginDetails WHERE UserID = :userid AND SessionKey = :sessionkey AND isActive = 1";

		$array = DBController::sendData($query, $params);

		if ($array) {
			if (new DateTime($array['SessionExpiryDateTime']) > new DateTime()) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public static function isSessionValid()
	{
		 
		$params = array(
			array(":userid", $_SESSION["adminuserid"]),
			array(":sessionkey", $_SESSION["sessionkey"])
		);

		$query = "SELECT SessionExpiryDateTime FROM LoginDetails WHERE UserID = :userid AND SessionKey = :sessionkey AND IFNULL(isActive,0) = 1";

		$isValid = DBController::sendData($query, $params);

		if ($isValid) {
			if (new DateTime($isValid['SessionExpiryDateTime']) > new DateTime()) {
				return array("return_code" => true, "return_data" => true);  
			} else {
				return array("return_code" => false, "return_data" => false);  
			}
		} else {
			return array("return_code" => false, "return_data" => false);  
		}
	}
	//not using
    public static function isAdmin($jsonarray)
    {
        $MSC = $jsonarray["MSC"];


        if (isset($_SESSION["adminuserid"])) {
            $params = array(
                array(":UserID", (int)$_SESSION["adminuserid"])
            );

            $query = "SELECT UserID FROM users WHERE isInstituteAdmin=1 AND UserID=:UserID";

            $array = DBController::sendData($MSC, $query, $params);
            if ($array && $array['UserID']) {
                return true;
            } else {
                return false;
            }
        } else {
            session_destroy();
            return false;
        }
    }

    function revoke($data) {

        $params = array(
            array(":UserID", $_SESSION['UserID']),
            array(":SessionKey", $_SESSION['SessionKey'])
        );

        $query = "UPDATE LoginDetails SET isActive=0 WHERE UserID = :UserID AND SessionKey = :SessionKey;";

        if (DBController::ExecuteSQL($query, $params)) {
			session_destroy();
            return array("return_code" => true, "return_data" => "Logged out successfully.");
        }
        return array("return_code" => false, "return_data" =>  "Unable to logout user at this moment");
    }
}
