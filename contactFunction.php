<?php

// 直接このファイルを実行しようとしたら４０４
if(!$noindexaccess){
    header("HTTP/1.0 404 Not Found");
    exit();
}

//response generation function

$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){
  global $response;
  if($type == "success") $response = "<div class='success'>{$message}</div>";
  else $response = "<div class='error'>{$message}</div>";
}

//response messages
$not_human       = "あなたがロボットでないことの証明してください。";
$invalid_nonce   = "不正な遷移です。";
$missing_content = "全て埋めてください。";
$email_invalid   = "メールアドレスが不正です。";
$message_unsent  = "申し訳ございません。メッセージの送信に失敗しました。もう一度ご送信ください。";
$message_sent    = "メッセージを送信しました。ありがとうございます。";

//user posted variables
@$name = $_POST['message_name'];
@$email = $_POST['message_email'];
@$message = $_POST['message_text'];
@$human = $_POST['message_human'];
if(isset($_POST['myform_nonce'])){ $myform_nonce = $_POST['myform_nonce']; }

//php mailer variables
$to = get_option('admin_email');
$subject = "問い合わせ有 ".get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" .
  'Reply-To: ' . $email . "\r\n";

if(!$human == 0){
  if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
  else {
    if ( ! wp_verify_nonce( $myform_nonce, 'my-form') ) {
            my_contact_form_generate_response("error", $invalid_nonce);
        }
    else {
      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name and message
        if(empty($name) || empty($message)){
          my_contact_form_generate_response("error", $missing_content);
        }
        else //ready to go!
        {
          $sent = wp_mail($to, $subject, strip_tags($message), $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
        }
      }
    }
  }
}
else if (@$_POST['submitted']) my_contact_form_generate_response("error", $missing_content);
