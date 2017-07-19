<?php
namespace ExternalModules;
require_once __DIR__ . '/../../external_modules/classes/ExternalModules.php';

$prefix = ExternalModules::getPrefixForID($_GET['id']);
$pid = $_GET['pid'];
$index =  $_REQUEST['index_modal_delete'];


#get data from the DB
$form_name = empty(ExternalModules::getProjectSetting($prefix, $pid, 'form-name'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'form-name');
$email_to = empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-to'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-to');
$email_cc =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-cc'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-cc');
$email_subject =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-subject'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-subject');
$email_text =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-text'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-text');
$email_attachment_variable =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment-variable'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment-variable');
$email_attachment1 =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment1'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment1');
$email_attachment2 =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment2'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment2');
$email_attachment3 =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment3'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment3');
$email_attachment4 =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment4'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment4');
$email_attachment5 =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment5'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-attachment5');
$email_repetitive =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-repetitive'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-repetitive');
$email_condition =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-condition'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-condition');
$email_sent =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-sent'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-sent');
$email_timestamp_sent =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-timestamp-sent'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-timestamp-sent');
$email_deactivate =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-deactivate'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-deactivate');


#Delete email repetitive sent from JSON before deleting all data
$email_repetitive_sent =  empty(ExternalModules::getProjectSetting($prefix, $pid, 'email-repetitive-sent'))?array():ExternalModules::getProjectSetting($prefix, $pid, 'email-repetitive-sent');
$email_repetitive_sent = json_decode($email_repetitive_sent);

if(!empty($email_repetitive_sent)){
    if(array_key_exists($form_name[$index],$email_repetitive_sent)){
        $form = $email_repetitive_sent->$form_name[$index];
        foreach ($form as $alert =>$value){
            if($alert == $index){
                unset($form->$alert);
                ExternalModules::setProjectSetting($prefix,$pid, 'email-repetitive-sent', $form);
            }
        }
    }
}


#Delete one element in array
unset($form_name[$index]);
unset($email_to[$index]);
unset($email_cc[$index]);
unset($email_subject[$index]);
unset($email_text[$index]);
unset($email_attachment_variable[$index]);
unset($email_attachment1[$index]);
unset($email_attachment2[$index]);
unset($email_attachment3[$index]);
unset($email_attachment4[$index]);
unset($email_attachment5[$index]);
unset($email_repetitive[$index]);
unset($email_condition[$index]);
unset($email_sent[$index]);
unset($email_timestamp_sent[$index]);
unset($email_deactivate[$index]);

#Rearrange the indexes
array_values($form_name);
array_values($email_to);
array_values($email_cc);
array_values($email_subject);
array_values($email_text);
array_values($email_attachment_variable);
array_values($email_attachment1);
array_values($email_attachment2);
array_values($email_attachment3);
array_values($email_attachment4);
array_values($email_attachment5);
array_values($email_repetitive);
array_values($email_condition);
array_values($email_sent);
array_values($email_timestamp_sent);
array_values($email_deactivate);

#Save data
ExternalModules::setProjectSetting($prefix,$pid, 'form-name', $form_name);
ExternalModules::setProjectSetting($prefix,$pid, 'email-to', $email_to);
ExternalModules::setProjectSetting($prefix,$pid, 'email-cc', $email_cc);
ExternalModules::setProjectSetting($prefix,$pid, 'email-subject', $email_subject);
ExternalModules::setProjectSetting($prefix,$pid, 'email-text', $email_text);
ExternalModules::setProjectSetting($prefix,$pid, 'email-attachment-variable', $email_attachment_variable);
ExternalModules::setProjectSetting($prefix,$pid, 'email-attachment1', $email_attachment1);
ExternalModules::setProjectSetting($prefix,$pid, 'email-attachment2', $email_attachment2);
ExternalModules::setProjectSetting($prefix,$pid, 'email-attachment3', $email_attachment3);
ExternalModules::setProjectSetting($prefix,$pid, 'email-attachment4', $email_attachment4);
ExternalModules::setProjectSetting($prefix,$pid, 'email-attachment5', $email_attachment5);
ExternalModules::setProjectSetting($prefix,$pid, 'email-repetitive', $email_repetitive);
ExternalModules::setProjectSetting($prefix,$pid, 'email-condition', $email_condition);
ExternalModules::setProjectSetting($prefix,$pid, 'email-sent', $email_sent);
ExternalModules::setProjectSetting($prefix,$pid, 'email-timestamp-sent', $email_timestamp_sent);
ExternalModules::setProjectSetting($prefix,$pid, 'email-deactivate', $email_deactivate);


echo json_encode(array(
    'status' => 'success',
    'message' => ''
));

?>