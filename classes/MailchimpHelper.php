<?php
namespace Grav\Plugin\EmailSubscribe;

use Grav\Common\Page\Pages;
use Grav\Common\Config\Config;
use Grav\Common\GravTrait;
use \DrewM\MailChimp\MailChimp;

class MailchimpHelper{
  use GravTrait;

  
  public function buildArray($email = "", $groups = "", $signup_source = ""){

    $return_array = [
      "status" => "subscribed",
      "email_address" => $email
    ];

    if($groups){
      $groups_array = explode(",", $groups);

      $all_groups = [];
      foreach($groups_array as $group){
        $all_groups[$group] = true;
      }

      $return_array["interests"] = $all_groups;
    }

    if($signup_source){
      $return_array["merge_fields"] = ["SIGNUP" => $signup_source];
    }

    return $return_array;
  }

  public function getDefaultKeyList(){
    $key_lists = self::getGrav()['config']->get("plugins.email-subscribe.mailchimp.key_lists");

    return $key_lists[0];
  }

  public function getKeyFromList($list_id){
    $key_lists = self::getGrav()['config']->get("plugins.email-subscribe.mailchimp.key_lists");

    foreach($key_lists as $key_list){
      if($key_list["list_id"] == $list_id){
        return $key_list["api_key"];
      }
    }
  }

}