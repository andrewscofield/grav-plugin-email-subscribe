<?php
namespace Grav\Plugin;

require_once __DIR__ . '/vendor/autoload.php';

use Grav\Common\Plugin;
use Grav\Common\Utils;
use Grav\Plugin\EmailSubscribe\MailchimpHelper;
use RocketTheme\Toolbox\Event\Event;
use \DrewM\MailChimp\MailChimp;

/**
 * Class EmailSubscribePlugin
 * @package Grav\Plugin
 */
class EmailSubscribePlugin extends Plugin{

  /**
   * @return array
   *
   * The getSubscribedEvents() gives the core a list of events
   *     that the plugin wants to listen to. The key of each
   *     array section is the event that the plugin listens to
   *     and the value (in the form of an array) contains the
   *     callable (or function) as well as the priority. The
   *     higher the number the higher the priority.
   */
  public static function getSubscribedEvents(){
    return [
      'onTask.subscribe.mailchimp'   => ['task_subscribe_mailchimp', 0],
      'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0]
    ];
  }

  public function onTwigTemplatePaths(){
      $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
  }


  public function task_subscribe_mailchimp(Event $event){
    $uri = $this->grav['uri'];
    $task = !empty($_POST['task']) ? $_POST['task'] : $uri->param('task');
    $post = !empty($_POST) ? $_POST : [];

    if (!isset($post['subscribe-form-nonce']) || !Utils::verifyNonce($post['subscribe-form-nonce'], 'subscribe-form')) {

      if (!empty($post['subscribe_email'])) {
        $helper = new MailchimpHelper();
        $key_list = $helper->getDefaultKeyList();

        //get the possible post variables and then build the mailchimp query array with them 
        $list_id = !empty($post['mailchimp_list']) ? $post['mailchimp_list'] : '';
        $source = !empty($post['mailchimp_source']) ? $post['mailchimp_source'] : '';
        $groups = !empty($post['mailchimp_groups']) ? $post['mailchimp_groups'] : '';
        $email_address = !empty($post['subscribe_email']) ? $post['subscribe_email'] : '';
        $key = $key_list["api_key"];

        //if list was in form assumed its not the default key, so lookup the API for that list
        if($list_id){
          $key = $helper->getKeyFromList($list_id);
        }
        else{
          $list_id = $key_list["list_id"];
        }

        if($key){

          $MailChimp = new MailChimp($key);

          $subscribe_array = $helper->buildArray($email_address, $groups, $source);
          $result = $MailChimp->post("lists/$list_id/members", $subscribe_array);

          if($result["status"] == "400" && $result["title"] == "Member Exists"){
            //email already exists, so update them and re-subscribe instead as well as add them to the right groups
            $subscriber_hash = $MailChimp->subscriberHash($email_address);

            unset($subscribe_array["email_address"]);
            $result = $MailChimp->put("lists/$list_id/members/$subscriber_hash", $subscribe_array);
          }

          if($result["status"] == "400" && $result["title"] == "Member In Compliance State"){
            //this email was listed as unsubscribed... to get them re-subscribed you have to to do a double opt-in
            $subscriber_hash = $MailChimp->subscriberHash($email_address);

            unset($subscribe_array["email_address"]);
            $subscribe_array["status"] = "pending";
            $result = $MailChimp->put("lists/$list_id/members/$subscriber_hash", $subscribe_array);
          }

          if($_SERVER['HTTP_ACCEPT'] == "application/json"){
            
            $output = '';
            if($result['status'] == 'subscribed' || $result['status'] = 'pending'){
              $output = json_encode(array('status' => 'subscribed'));
            }
            else{
              $output = json_encode(array('status' => 'failed'));
            }
            
            header('Content-Type: application/json');
            die($output);
          }
        }

        exit;

      }
    }
  }
}
