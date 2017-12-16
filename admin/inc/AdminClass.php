<?php require_once("GlobalClass.php") ?>
<?php require_once("db.php") ?>

<?php
/*
~~ Developed by Muhammad Kalim -- Creative ideator ~~

1) Admin Class Where you can easily get and set the admin features
2) Add the db quotes for safe sql injection

*/


Class AdminClass{

  public $id;
  public $ad_username;
  public $ad_password;
  public $ad_email;
  public $datetime;
  public $ad_status;

  //DB Class Connection Object
  public $dbObj;
  //Global Class object
  public $gcObj;

  public function __construct(){
      $this->$dbObj = new DB();
      $this->$gcObj = new GlobalClass();
  }

  // Getter
  public function __get($property) {
  if (property_exists($this, $property)) {
    return $this->$property;
    }
  }

  // Setter
  public function __set($property, $value) {

    if (property_exists($this, $property)) {
      $this->$property = $value;
    }
    return $this;
  }

  // Check Admin login username, password and status
  public function checkAdminLogin(){

    $this->username = $this->$dbObj->quote($this->username);
    //first encode the md5 password
    $this->password = $this->$dbObj->quote($this->$gcObj->encodeMD5String($this->password));

    echo $this->ad_username;
    echo $this->ad_password;

    $result = $this->$dbObj->select("select * from admin where username = $this->$ad_username and password = $this->$ad_password and status = 1");
    echo $result;
    return $result;
  }

  //Insert



}




 ?>
