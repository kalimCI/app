<?php
/*
~~ Developed by Muhammad Kalim -- Creative ideator ~~

Global Class use cases - set & get the small functions & features

*/
class GlobalClass{

  public function __construct(){
    //constructor
  }

  public function __get($property) {
  if (property_exists($this, $property)) {
    return $this->$property;
    }
  }

  public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }
    return $this;
  }

  //Encode md5 string
  public function encodeMD5String($string){
      return md5($string)
  }




  public function getTotalSubscribedUser($subscriptionID){

      $results = $this->db->getRows("select * from userSubscription where subscriptionID = $subscriptionID");
      return $results;
      //select count(userProfile.userProfile_id) from userProfile where userProfile.userProfile_id = (select userSubscription.userProfileID from userSubscription where userSubscription.subscriptionID = 2 )

  }

  public function getServerLoad($index){
      return sys_getloadavg()[$index];
  }

  public function getAllUsersProfiles($subsID){

    $resultSets = $this->db->select("select * from userProfile up, userSubscription us, subscription sub where up.userProfile_id = us.userProfileID and sub.subscription_id = us.subscriptionID and sub.subscription_id = $subsID");
    return $resultSets;

  }

  public function getUserInfoByID($userID){

    $resultSets = $this->db->select("select * from userProfile up, userSubscription us, subscription sub where up.userProfile_id = us.userProfileID and sub.subscription_id = us.subscriptionID and up.userProfile_id = $userID");
    return $resultSets;

  }

  public function deleteUserProfileByAdmin($userProfileID){


    $result = $this->db->query("delete from userSubscription where userProfileID = $userProfileID");
    if ($result == 1){
        $result = $this->db->query("delete from userProfile where userProfile_id = $userProfileID");
    }
    return $result;
  }

  /* Category Start */

  public function addCategory($categoryName){

    $categoryName = $this->db->quote($categoryName);

    $result = $this->db->query("INSERT INTO `category`(`category_name`) VALUES ($categoryName)");

    //echo "INSERT INTO `category`(`category_name`) VALUES ('$categoryName')";

    echo $this->db->error();


    return $result;
  }

  public function getAllCategories(){

    $resultSets = $this->db->select("select * from category");
    return $resultSets;

  }

  public function deleteCategory($category_id){

    $resultSets = $this->db->query("delete from category where category_id = $category_id");

    echo $this->db->error();

    return $resultSets;

  }

  /* Category End */

  /* Type Start */

  public function addType($param){

    $param = $this->db->quote($param);

    $result = $this->db->query("INSERT INTO `type`(`type_name`) VALUES ($param)");

    //echo "INSERT INTO `category`(`category_name`) VALUES ('$categoryName')";

    echo $this->db->error();


    return $result;
  }

  public function getAllTypes(){

    $resultSets = $this->db->select("select * from type");
    return $resultSets;

  }

  public function deleteType($param){

    $resultSets = $this->db->query("delete from type where type_id = $param");

    echo $this->db->error();

    return $resultSets;

  }


  /* Type End */

  /* Area Start */

  public function addArea($param){

    $param = $this->db->quote($param);

    $result = $this->db->query("INSERT INTO `area`(`area_name`) VALUES ($param)");

    //echo "INSERT INTO `category`(`category_name`) VALUES ('$categoryName')";

    echo $this->db->error();


    return $result;
  }

  public function getAllArea(){

    $resultSets = $this->db->select("select * from area");
    return $resultSets;

  }

  public function deleteArea($param){

    $resultSets = $this->db->query("delete from area where area_id = $param");

    echo $this->db->error();

    return $resultSets;

  }


  /* Area End */

  /* Bed Start */

  public function addBed($param){

    $param = $this->db->quote($param);

    $result = $this->db->query("INSERT INTO `bed`(`bed_name`) VALUES ($param)");

    echo $this->db->error();

    return $result;
  }

  public function getAllBeds(){

    $resultSets = $this->db->select("select * from bed");
    return $resultSets;

  }

  public function deleteBed($param){

    $resultSets = $this->db->query("delete from bed where bed_id = $param");

    echo $this->db->error();

    return $resultSets;

  }

  /* furnishing Start */
  public function addFurnishing($param){

    $param = $this->db->quote($param);

    $result = $this->db->query("INSERT INTO `furnishing`(`furnishing_name`) VALUES ($param)");

    echo $this->db->error();

    return $result;
  }

  public function getAllFurnishing(){

    $resultSets = $this->db->select("select * from furnishing");
    return $resultSets;

  }

  public function deleteFurnishing($param){

    $resultSets = $this->db->query("delete from furnishing where furnishing_id = $param");

    echo $this->db->error();

    return $resultSets;

  }


  /* furnishing End */


  /* Price Start */
  public function addPrice($param){

    $param = $this->db->quote($param);

    $result = $this->db->query("INSERT INTO `price`(`price`) VALUES ($param)");

    echo $this->db->error();

    return $result;
  }

  public function getAllPrice(){

    $resultSets = $this->db->select("select * from price");
    return $resultSets;

  }

  public function deletePrice($param){

    $resultSets = $this->db->query("delete from price where price_id = $param");

    echo $this->db->error();

    return $resultSets;

  }


  /* Price End */

  /* timeperiod Start */
  public function addTimeperiod($param){

    $param = $this->db->quote($param);

    $result = $this->db->query("INSERT INTO `timeperiod`(`timeperiod_name`) VALUES ($param)");

    echo $this->db->error();

    return $result;
  }

  public function getAllTimeperiod(){

    $resultSets = $this->db->select("select * from timeperiod");
    return $resultSets;

  }

  public function deleteTimeperiod($param){

    $resultSets = $this->db->query("delete from timeperiod where timeperiod_id = $param");

    echo $this->db->error();

    return $resultSets;

  }




  /* timeperiod End */


  /* Total Properties */

  public function getTotalProperties($vendorID){

      $results = $this->db->getRows("select * from property where vendorID_ref = $vendorID");
      return $results;

  }

  public function getTotalPublishedProperties($vendorID){

      $results = $this->db->getRows("select * from property where vendorID_ref = $vendorID and property_status = 1");

      return $results;

  }

  public function getAllVideo(){

      $results = $this->db->select("select * from video v, property p, userProfile up where p.property_status = 1 and p.property_id = v.property_id_ref and p.vendorID_ref = up.userProfile_id AND p.property_status = 1 ");


      //      $results = $this->db->getRows("select * from video v , property p where v.property_id_ref = $param and p.property_status = 1");

      echo $this->db->error();

      return $results;

  }


  // Favourite
  public function insert_favourite($fav_video_id,$fav_user_id){

    $fav_video_id = $this->db->quote($fav_video_id);
    $fav_user_id = $this->db->quote($fav_user_id);

    $results = $this->db->getRows("SELECT * from fav where fav_video_id = $fav_video_id and fav_user_id = $fav_user_id");



    if ($results == 0)
    {
      $result = $this->db->query("INSERT INTO `fav`(`fav_video_id`, `fav_user_id`) VALUES ($fav_video_id, $fav_user_id)");
    }
    else if ($results > 0){
      $result = $this->db->query("DELETE FROM `fav` where fav_video_id = $fav_video_id and fav_user_id = $fav_user_id");
    }
    echo $this->db->error();
    return $result;

  }

  public function getFavByRows($fav_video_id,$fav_user_id){
    $result = $this->db->getRows("select * from fav where fav_user_id = $fav_user_id and fav_video_id = $fav_video_id");
    echo $this->db->error();
    return $result;

  }

  public function getAllFavByUserID($fav_user_id){

    $result = $this->db->select("select * from fav f, video v,property p, userProfile up where f.fav_user_id = $fav_user_id and f.fav_video_id = v.video_id and v.property_id_ref = p.property_id and p.vendorID_ref = up.userProfile_id and p.property_status = 1");
    echo $this->db->error();
    return $result;
  }

  public function getVideoByID($video_id){

    $result = $this->db->select("select * from video v, property p where video_id = $video_id and v.property_id_ref = p.property_id AND p.property_status = 1 limit 1");
    echo $this->db->error();
    return $result;
  }

  public function setInquiry($vid,$userid, $vendorID){

    $result = $this->db->query("INSERT INTO `inquirys`(`inquiry_video_id`, `inquiry_video_user_id`,`inquiry_video_vendor_id`) VALUES ($vid,$userid,$vendorID)");
    echo $this->db->error();
    return $result;
  }

  public function getInquiryRows($vid, $userid, $vendorID){

    $result = $this->db->getRows("select * from inquirys where inquiry_video_id = $vid and inquiry_video_user_id = $userid and inquiry_video_vendor_id = $vendorID ");

    echo $this->db->error();
    return $result;

  }
  //Get all inquires by user Id only published property resultset show
  public function getAllInquiriesBy($userID){

    $result = $this->db->select("SELECT * FROM `inquirys` i, video v, property p  where inquiry_video_user_id = $userID and i.inquiry_video_id = v.video_id and p.property_id = v.property_id_ref and p.property_status = 1");
    echo $this->db->error();
    return $result;

  }

  // get the category name

  public function getCategorySearchResult($catID){

    $result = $this->db->select("select category_name from category where category_id = $catID");

    $tmpVal = $result[0]['category_name'];

    $result = $this->db->select("select * from video v, property p, userProfile up where p.property_status = 1 and p.property_id = v.property_id_ref and p.vendorID_ref = up.userProfile_id AND p.property_status = 1 and p.property_category = '$tmpVal'");


    echo $this->db->error();
    return $result;

  }

  public function getTypeSearchResult($typeID){

    $result = $this->db->select("select type_name from type where type_id = $typeID");

    $tmpVal = $result[0]['type_name'];

    $result = $this->db->select("select * from video v, property p, userProfile up where p.property_status = 1 and p.property_id = v.property_id_ref and p.vendorID_ref = up.userProfile_id AND p.property_status = 1 and p.property_type = '$tmpVal'");


    echo $this->db->error();
    return $result;

  }


}


?>
