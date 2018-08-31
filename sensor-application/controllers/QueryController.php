<?php


include_once  $current_location."controllers/DatabaseController.php";

class QueryController extends DatabaseController{

	public function getAllUsers(){
		$query = "SELECT email FROM `users`";
		$this->query($query);
		$this->execute();
		$users = $this->result();
		return $users;
	}

	public function getSensors(){
		$query = "SELECT *
			FROM sensordetails
			LEFT JOIN threshold ON sensordetails.SensorID = threshold.SensorID";
		$this->query($query);
		$this->execute();
		$sensors = $this->result();
		if($sensors){
			return $sensors;
		}
		return false;
	}

	public function getSensorNameFromID($sensorId){
		$query = "SELECT SensorName
			FROM sensordetails
			WHERE SensorID = ?";
		$this->query($query);
		$this->addParameters([$sensorId]);
		$this->execute();
		$sensor = $this->result();
		if($sensor){
			return $sensor[0]['SensorName'];
		}
		return false;
	}

	public function getAllReadingsForSensor($sensorId){
		$query = "SELECT * FROM sensorreading where SensorID=?";
		$this->query($query);
		$this->addParameters([$sensorId]);
		$this->execute();
		$readings = $this->result();
		if($readings){
			return $readings;
		}
		return false;
	}

	public function getLatestReadingForSensor($sensorId){
		$query = "SELECT *
			FROM sensorreading
			WHERE SensorID = ?
			ORDER BY TimeStamp DESC
			LIMIT 0, 1";
		$this->query($query);
		$this->addParameters([$sensorId]);
		$this->execute();
		$reading = $this->result();
		if($reading){
			return $reading[0];
		}
		return false;
	}

	public function verifyUser($username, $password){
		$query = "SELECT * FROM users WHERE (user_uid=? OR email=?)";
		$this->query($query);
		$this->addParameters([$username, $username]);
		$this->execute();
		$user = $this->result();
		if(!$user){
			return false;
		}
		return password_verify($password, $user[0]["user_password"]);
	}

	public function getUser($username){
		$query = "SELECT * FROM users WHERE user_uid=?";
		$this->query($query);
		$this->addParameters([$username]);
		$this->execute();
		$user = $this->result();
		if($user){
			return $user[0];
		}
		return false;
	}

	public function updateThreshold($threshold, $sensorID){
		$query = "UPDATE threshold SET threshold = ? WHERE SensorID = ? ;";
		$this->query($query);
		$this->addParameters([$threshold, $sensorID]);
		$this->execute();
	}

	public function emailExists($email){
		$query = "SELECT * FROM users WHERE email=?";
		$this->query($query);
		$this->addParameters([$email]);
		$this->execute();
		return $this->count();
	}

	public function userExists($username){
		$query = "SELECT * FROM users WHERE user_uid=?";
		$this->query($query);
		$this->addParameters([$username]);
		$this->execute();
		return $this->count();
	}

	public function createUser($user){
		$query = "INSERT INTO users (first_name, last_name, email, user_uid, user_password)
		 VALUES (?, ?, ?, ?, ?);";
		$this->query($query);
		$options = ['cost' => 12];
		$this->addParameters([
			$user->first_name,
			$user->last_name,
			$user->email,
			$user->uid,
			password_hash($user->password, PASSWORD_DEFAULT, $options)
		]);
		$this->execute();
		return $this->count();
	}

	public function thresholdBreached(){
		$sensors = $this->getSensors();
		foreach ($sensors as $sensor) {
			$reading = $this->getLatestReadingForSensor($sensor['SensorID']);
			if($sensor['threshold'] < $reading['Reading']){
				return true;
			}
		}
		return false;
	}

	public function sensorData(){
		$query = "SELECT sensorID, Reading FROM sensorreading";
		$this->query($query);
		$this->execute();
		return $this->result();
	}
}

$query = new QueryController;
