<?php
/*
Plugin Name: Ninja Forms Custom Functions
Description: Custom functions for Ninja Forms to expand its functionality
Version: 2.4.4
Author: Gareth bk
Note: Each form has its own function - comment before each function says what the title & form id is
To-do: Does global variable $ninja_forms_processing need to be declared each time?  Not sure.  There is a lot of old code for things that aren't used anymore in here, will clean out one day...

--Gareth Bromser-Kloeden
*/

/*  Test Form [id 17] */
function test_function() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 17) {
    $email_main = $ninja_forms_processing->get_field_value(367);
    $email_check = $ninja_forms_processing->get_field_value(368);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('test_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('test_email_check_367', 'Email addresses must match', 367);
      $ninja_forms_processing->add_error('test_email_check_368', 'Email addresses must match', 368);
    }
    $school_name = $ninja_forms_processing->get_field_value(398);
    if ($school_name == 1) {
      $ninja_forms_processing->add_error('test_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('test_school_check_398', 'Select a VCCS College/Agency', 398);
    }
    $list_one = $ninja_forms_processing->get_field_value(399);
    if ($list_one == 1) {
      $ninja_forms_processing->add_error('test_one_check', 'Please select from List 1');
      $ninja_forms_processing->add_error('test_one_check_399', 'Select from List 1', 399);
    }
    $list_two = $ninja_forms_processing->get_field_value(400);
    if ($list_two == 1) {
      $ninja_forms_processing->add_error('test_two_check', 'Please select from List 2');
      $ninja_forms_processing->add_error('test_two_check_400', 'Select from List 2', 400);
    }
    $list_three = $ninja_forms_processing->get_field_value(401);
    if ($list_three == 1) {
      $ninja_forms_processing->add_error('test_three_check', 'Please select from List 3');
      $ninja_forms_processing->add_error('test_three_check_401', 'Select from List 3', 401);
    }
    $value_one = $ninja_forms_processing->get_field_value(409);
    $value_two = $ninja_forms_processing->get_field_value(410);
    $total_value = $value_one + $value_two;
    if ($total_value !== 100) {
      $ninja_forms_processing->add_error('test_value_check', 'Total must equal 100%');
      $ninja_forms_processing->add_error('test_value_check_408', 'Total must equal 100%', 408);
    }
  }
}
add_action('ninja_forms_pre_process', 'test_function');

function test_sequential(){
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 17) {
    Ninja_Forms()->subs()->get(
      $args = array(
        'form_id' => $form_id,
        )
      );
    $subs = Ninja_Forms()->subs()->get( $args );
    foreach ( $subs as $sub ) {
      $seq_num = $sub->get_seq_num();
    }
    $subs_count = count($subs);
    $ninja_forms_processing->update_field_value( 1262, strval($seq_num) + $subs_count + 15000);
  }
}
add_action('ninja_forms_pre_process', 'test_sequential');

/*  Classified Staff Leadership Academy Form [id 13] */
function csla_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 13) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(365);
    if ($school_check == 1) {
      $ninja_forms_processing->add_error('csla_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('csla_school_check_365', 'Select a VCCS College/Agency', 365);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(248);
    $email_check = $ninja_forms_processing->get_field_value(370);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('csla_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('csla_email_check_248', 'Email addresses must match', 248);
      $ninja_forms_processing->add_error('csla_email_check_370', 'Email addresses must match', 370);
    }
  }
}
add_action('ninja_forms_pre_process', 'csla_functions');


/*  Faculty & Administrators Leadership Academy Form [id 13] */
function fala_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 19) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(518);
    if ($school_check == 1) {
      $ninja_forms_processing->add_error('csla_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('csla_school_check_518', 'Select a VCCS College/Agency', 518);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(519);
    $email_check = $ninja_forms_processing->get_field_value(520);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('csla_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('csla_email_check_519', 'Email addresses must match', 519);
      $ninja_forms_processing->add_error('csla_email_check_520', 'Email addresses must match', 520);
    }
  }
}
add_action('ninja_forms_pre_process', 'fala_functions');

/*  CFP 2014 Form [id 15] */
function cfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 15) {
    /*  Confirms session type is selected */
    $session_check = $ninja_forms_processing->get_field_value(294);
    if ($session_check == 1) {
      $ninja_forms_processing->add_error('cfp_session_check', 'Please select a session type');
      $ninja_forms_processing->add_error('cfp_session_check_294', 'Select a session type', 294);
    }
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(375);
    if ($school_check == 1) {
      $ninja_forms_processing->add_error('cfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('cfp_school_check_365', 'Select a VCCS College/Agency', 375);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(278);
    $email_check = $ninja_forms_processing->get_field_value(366);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('cfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('cfp_email_check_248', 'Email addresses must match', 278);
      $ninja_forms_processing->add_error('cfp_email_check_370', 'Email addresses must match', 366);
    }
    /*  Confirms intended audience level selected */
    $select_audience = $ninja_forms_processing->get_field_value(304);
    if ($select_audience == 1) {
      $ninja_forms_processing->add_error('cfp_audience_check', 'Please select an intended audience level');
      $ninja_forms_processing->add_error('cfp_audience_check_304', 'Select an intended audience level', 304);
    }
    /*  Confirm that technical support/laptop is selected */
    $select_tech = $ninja_forms_processing->get_field_value(308);
    if ($select_tech == 1) {
      $ninja_forms_processing->add_error('cfp_tech_check', 'Please select technical support needed');
      $ninja_forms_processing->add_error('cfp_tech_check_308', 'Select technical support needed', 308);
    }
  }
}
add_action('ninja_forms_pre_process', 'cfp_functions');

/*  Generic Peer Group Call for Proposals Form [22] */
function pgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 22) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(697);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('pgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('pgcfp_school_check_697', 'Select a VCCS College/Agency', 697);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(698);
    $email_check = $ninja_forms_processing->get_field_value(699);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('pgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('pgcfp_email_check_698', 'Email addresses must match', 698);
      $ninja_forms_processing->add_error('pgcfp_email_check_699', 'Email addresses must match', 699);
    }
  }
}
add_action('ninja_forms_pre_process', 'pgcfp_functions');

/*  Generic Peer Group Participant Registration Form [23] */
function pgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 23) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(756);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('pgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('pgr_school_check_756', 'Select a VCCS College/Agency', 756);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(758);
    $email_check = $ninja_forms_processing->get_field_value(759);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('pgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('pgr_email_check_758', 'Email addresses must match', 758);
      $ninja_forms_processing->add_error('pgr_email_check_759', 'Email addresses must match', 759);
    }
  }
}
add_action('ninja_forms_pre_process', 'pgr_functions');

/*  Information Systems Technologies Peer Group Call for Proposals Form [25] */
function istpgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 25) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(805);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('istpgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('istpgcfp_school_check_805', 'Select a VCCS College/Agency', 805);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(806);
    $email_check = $ninja_forms_processing->get_field_value(807);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('istpgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('istpgcfp_email_check_806', 'Email addresses must match', 806);
      $ninja_forms_processing->add_error('istpgcfp_email_check_807', 'Email addresses must match', 807);
    }
  }
}
add_action('ninja_forms_pre_process', 'istpgcfp_functions');

/*  Information Systems Technologies Peer Group Participant Registration Form [24] */
function istpgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 24) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(780);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('istpgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('istpgr_school_check_780', 'Select a VCCS College/Agency', 780);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(853);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('istpgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('istpgr_job_check_853', 'Select a Job Type', 853);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(782);
    $email_check = $ninja_forms_processing->get_field_value(783);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('istpgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('istpgr_email_check_782', 'Email addresses must match', 782);
      $ninja_forms_processing->add_error('istpgr_email_check_783', 'Email addresses must match', 783);
    }
  }
}
add_action('ninja_forms_pre_process', 'istpgr_functions');

/*  Science Peer Group Participant Registration Form [26] */
function scipgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 26) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(867);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('scipgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('scipgr_school_check_867', 'Select a VCCS College/Agency', 867);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(865);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('scipgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('scipgr_job_check_865', 'Select a Job Type', 865);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(869);
    $email_check = $ninja_forms_processing->get_field_value(870);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('scipgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('scipgr_email_check_869', 'Email addresses must match', 869);
      $ninja_forms_processing->add_error('scipgr_email_check_870', 'Email addresses must match', 870);
    }
  }
}
add_action('ninja_forms_pre_process', 'scipgr_functions');

/*  Science Peer Group Call for Proposals Form [27] */
function scipgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 27) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(893);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('scipgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('scipgcfp_school_check_893', 'Select a VCCS College/Agency', 893);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(894);
    $email_check = $ninja_forms_processing->get_field_value(895);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('scipgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('scipgcfp_email_check_894', 'Email addresses must match', 894);
      $ninja_forms_processing->add_error('scipgcfp_email_check_895', 'Email addresses must match', 895);
    }
  }
}
add_action('ninja_forms_pre_process', 'scipgcfp_functions');

/*  Nursing & Allied Health Peer Group Participant Registration Form [28] */
function nahpgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 28) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(950);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('nahpgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('nahpgr_school_check_950', 'Select a VCCS College/Agency', 950);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(948);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('nahpgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('nahpgr_job_check_948', 'Select a Job Type', 948);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(952);
    $email_check = $ninja_forms_processing->get_field_value(953);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('nahpgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('nahpgr_email_check_952', 'Email addresses must match', 952);
      $ninja_forms_processing->add_error('nahpgr_email_check_953', 'Email addresses must match', 953);
    }
  }
}
add_action('ninja_forms_pre_process', 'nahpgr_functions');

/*  Nursing & Allied Health Peer Group Call for Proposals Form [29] */
function nahpgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 29) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(976);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('nahpgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('nahpgcfp_school_check_893', 'Select a VCCS College/Agency', 976);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(977);
    $email_check = $ninja_forms_processing->get_field_value(978);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('nahpgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('nahpgcfp_email_check_977', 'Email addresses must match', 977);
      $ninja_forms_processing->add_error('nahpgcfp_email_check_978', 'Email addresses must match', 978);
    }
  }
}
add_action('ninja_forms_pre_process', 'nahpgcfp_functions');

/*  Physical Education Peer Group Participant Registration Form [30] */
function pepgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 30) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1033);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('pepgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('pepgr_school_check_1033', 'Select a VCCS College/Agency', 1033);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(1031);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('pepgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('pepgr_job_check_1031', 'Select a Job Type', 1031);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1035);
    $email_check = $ninja_forms_processing->get_field_value(1036);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('pepgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('pepgr_email_check_1035', 'Email addresses must match', 1035);
      $ninja_forms_processing->add_error('pepgr_email_check_1036', 'Email addresses must match', 1036);
    }
  }
}
add_action('ninja_forms_pre_process', 'pepgr_functions');

/*  Physical Education Peer Group Call for Proposals Form [31] */
function pepgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 31) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1059);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('pepgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('pepgcfp_school_check_1059', 'Select a VCCS College/Agency', 1059);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1060);
    $email_check = $ninja_forms_processing->get_field_value(1061);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('pepgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('pepgcfp_email_check_1060', 'Email addresses must match', 1060);
      $ninja_forms_processing->add_error('pepgcfp_email_check_1061', 'Email addresses must match', 1061);
    }
  }
}
add_action('ninja_forms_pre_process', 'pepgcfp_functions');

/*  English Peer Group Participant Registration Form [32] */
function engpgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 32) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1117);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('engpgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('engpgr_school_check_1117', 'Select a VCCS College/Agency', 1117);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(1115);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('engpgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('engpgr_job_check_1115', 'Select a Job Type', 1115);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1119);
    $email_check = $ninja_forms_processing->get_field_value(1120);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('engpgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('engpgr_email_check_1119', 'Email addresses must match', 1119);
      $ninja_forms_processing->add_error('engpgr_email_check_1120', 'Email addresses must match', 1120);
    }
  }
}
add_action('ninja_forms_pre_process', 'engpgr_functions');

/*  English Peer Group Call for Proposals Form [33] */
function engpgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 33) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1143);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('engpgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('engpgcfp_school_check_1143', 'Select a VCCS College/Agency', 1143);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1144);
    $email_check = $ninja_forms_processing->get_field_value(1145);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('engpgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('engpgcfp_email_check_1144', 'Email addresses must match', 1144);
      $ninja_forms_processing->add_error('engpgcfp_email_check_1145', 'Email addresses must match', 1145);
    }
  }
}
add_action('ninja_forms_pre_process', 'engpgcfp_functions');

/*  Global Studies Peer Group Participant Registration Form [39] */
function gspgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 39) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1455);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('gspgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('gspgr_school_check_1455', 'Select a VCCS College/Agency', 1455);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(1453);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('gspgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('gspgr_job_check_1453', 'Select a Job Type', 1453);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1457);
    $email_check = $ninja_forms_processing->get_field_value(1458);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('gspgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('gspgr_email_check_1457', 'Email addresses must match', 1457);
      $ninja_forms_processing->add_error('gspgr_email_check_1458', 'Email addresses must match', 1458);
    }
  }
}
add_action('ninja_forms_pre_process', 'gspgr_functions');

/*  Global Studies Peer Group Call for Proposals Form [40] */
function gspgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 40) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1481);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('gspgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('gspgcfp_school_check_1481', 'Select a VCCS College/Agency', 1481);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1482);
    $email_check = $ninja_forms_processing->get_field_value(1483);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('gspgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('gspgcfp_email_check_1482', 'Email addresses must match', 1482);
      $ninja_forms_processing->add_error('gspgcfp_email_check_1483', 'Email addresses must match', 1483);
    }
  }
}
add_action('ninja_forms_pre_process', 'gspgcfp_functions');

/*  Sociology Peer Group Participant Registration Form [41] */
function socpgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 41) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1538);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('socpgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('socpgr_school_check_1538', 'Select a VCCS College/Agency', 1538);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(1536);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('socpgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('socpgr_job_check_1536', 'Select a Job Type', 1536);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1540);
    $email_check = $ninja_forms_processing->get_field_value(1541);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('socpgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('socpgr_email_check_1540', 'Email addresses must match', 1540);
      $ninja_forms_processing->add_error('socpgr_email_check_1541', 'Email addresses must match', 1541);
    }
  }
}
add_action('ninja_forms_pre_process', 'socpgr_functions');

/*  Sociology Peer Group Call for Proposals Form [42] */
function socpgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 42) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1564);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('socpgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('socpgcfp_school_check_1564', 'Select a VCCS College/Agency', 1564);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1565);
    $email_check = $ninja_forms_processing->get_field_value(1566);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('socpgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('socpgcfp_email_check_1565', 'Email addresses must match', 1565);
      $ninja_forms_processing->add_error('socpgcfp_email_check_1566', 'Email addresses must match', 1566);
    }
  }
}
add_action('ninja_forms_pre_process', 'socpgcfp_functions');

/*  Accounting/Business/Economics Peer Group Participant Registration Form [46] */
function abepgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 46) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1734);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('abepgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('abepgr_school_check_1734', 'Select a VCCS College/Agency', 1734);
    }
    /*  Confirms Discipline is selected  */
    $dis_check = $ninja_forms_processing->get_field_value(1806);
    if ($dis_check == 1 ) {
      $ninja_forms_processing->add_error('abepgr_dis_check', 'Please select a Discipline');
      $ninja_forms_processing->add_error('abepgr_dis_check_1806', 'Select a Discipline', 1806);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(1732);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('abepgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('abepgr_job_check_1732', 'Select a Job Type', 1732);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1736);
    $email_check = $ninja_forms_processing->get_field_value(1737);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('abepgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('abepgr_email_check_1736', 'Email addresses must match', 1736);
      $ninja_forms_processing->add_error('abepgr_email_check_1737', 'Email addresses must match', 1737);
    }
  }
}
add_action('ninja_forms_pre_process', 'abepgr_functions');

/*  Accounting/Business/Economics Peer Group Call for Proposals Form [47] */
function abepgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 47) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1760);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('abepgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('abepgcfp_school_check_1760', 'Select a VCCS College/Agency', 1760);
    }
     /*  Confirms Discipline is selected  */
    $dis_check = $ninja_forms_processing->get_field_value(1807);
    if ($dis_check == 1 ) {
      $ninja_forms_processing->add_error('abepgr_dis_check', 'Please select a Discipline');
      $ninja_forms_processing->add_error('abepgr_dis_check_1807', 'Select a Discipline', 1807);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1761);
    $email_check = $ninja_forms_processing->get_field_value(1762);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('abepgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('abepgcfp_email_check_1565', 'Email addresses must match', 1761);
      $ninja_forms_processing->add_error('abepgcfp_email_check_1566', 'Email addresses must match', 1762);
    }
  }
}
add_action('ninja_forms_pre_process', 'abepgcfp_functions');

/*  New Faculty Seminar Participant Registration Form [37] */
function nfs_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 37) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1376);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('nfs_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('nfs_school_check_1376', 'Select a VCCS College/Agency', 1376);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1377);
    $email_check = $ninja_forms_processing->get_field_value(1378);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('nfs_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('nfs_email_check_1377', 'Email addresses must match', 1377);
      $ninja_forms_processing->add_error('nfs_email_check_1378', 'Email addresses must match', 1378);
    }
  }
}
add_action('ninja_forms_pre_process', 'nfs_functions');

/*  New Horizons CFP 2015 Form [id 34] */
function nhcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 34) {
    /*  Confirms session type is selected */
    $session_check = $ninja_forms_processing->get_field_value(1196);
    if ($session_check == 1) {
      $ninja_forms_processing->add_error('nhcfp_session_check', 'Please select a session type');
      $ninja_forms_processing->add_error('nhcfp_session_check_1196', 'Select a session type', 1196);
    }
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1203);
    if ($school_check == 1) {
      $ninja_forms_processing->add_error('nhcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('nhcfp_school_check_1203', 'Select a VCCS College/Agency', 1203);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1204);
    $email_check = $ninja_forms_processing->get_field_value(1205);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('nhcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('nhcfp_email_check_1204', 'Email addresses must match', 1204);
      $ninja_forms_processing->add_error('nhcfp_email_check_1205', 'Email addresses must match', 1205);
    }
    /*  Confirms intended audience level selected */
    $select_audience = $ninja_forms_processing->get_field_value(1233);
    if ($select_audience == 1) {
      $ninja_forms_processing->add_error('nhcfp_audience_check', 'Please select an intended audience level');
      $ninja_forms_processing->add_error('nhcfp_audience_check_1233', 'Select an intended audience level', 1233);
    }
    /*  Confirms that selected Categories are not the same */
    $first_choice = $ninja_forms_processing->get_field_value(1364);
    $second_choice = $ninja_forms_processing->get_field_value(1365);
    $third_choice = $ninja_forms_processing->get_field_value(1366);
    if ($first_choice == 1 or $second_choice == 1 or $third_choice == 1) {
      $ninja_forms_processing->add_error('nhcfp_category_select', 'Please select all three category choices');
      $ninja_forms_processing->add_error('nhcfp_category_select_1366', 'Please select all three category choices', 1366);
    }
    if ($first_choice == $second_choice or $first_choice == $third_choice or $second_choice == $third_choice) {
      $ninja_forms_processing->add_error('nhcfp_category_check', 'Please make sure your category choices are different');
      $ninja_forms_processing->add_error('nhcfp_category_check_1366', 'Select different category choices', 1366);
    }
  }
}
add_action('ninja_forms_pre_process', 'nhcfp_functions');

/*  New Horizons CFP 2015 Tracking Number [id 34] */
function nhcfp_sequential(){
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 34) {
    Ninja_Forms()->subs()->get(
      $args = array(
        'form_id' => $form_id,
        )
      );
    $subs = Ninja_Forms()->subs()->get( $args );
    foreach ( $subs as $sub ) {
      $seq_num = $sub->get_seq_num();
    }
    $subs_count = count($subs);
    $ninja_forms_processing->update_field_value( 1263, strval($seq_num) + $subs_count + 14980);
  }
}
add_action('ninja_forms_pre_process', 'nhcfp_sequential');

/*  New Horizons CFP 2015 Form TESTING [id 35] */
function nhcfpt_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 35) {
    /*  Confirms session type is selected */
    $session_check = $ninja_forms_processing->get_field_value(1273);
    if ($session_check == 1) {
      $ninja_forms_processing->add_error('nhcfpt_session_check', 'Please select a session type');
      $ninja_forms_processing->add_error('nhcfpt_session_check_1196', 'Select a session type', 1273);
    }
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1280);
    if ($school_check == 1) {
      $ninja_forms_processing->add_error('nhcfpt_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('nhcfpt_school_check_1280', 'Select a VCCS College/Agency', 1280);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1281);
    $email_check = $ninja_forms_processing->get_field_value(1282);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('nhcfpt_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('nhcfpt_email_check_1281', 'Email addresses must match', 1281);
      $ninja_forms_processing->add_error('nhcfpt_email_check_1282', 'Email addresses must match', 1282);
    }
    /*  Confirms intended audience level selected */
    $select_audience = $ninja_forms_processing->get_field_value(1314);
    if ($select_audience == 1) {
      $ninja_forms_processing->add_error('nhcfpt_audience_check', 'Please select an intended audience level');
      $ninja_forms_processing->add_error('nhcfpt_audience_check_1314', 'Select an intended audience level', 1314);
    }
    /*  Confirms that selected Categories are not the same */
    $first_choice = $ninja_forms_processing->get_field_value(1354);
    $second_choice = $ninja_forms_processing->get_field_value(1356);
    $third_choice = $ninja_forms_processing->get_field_value(1357);
    if ($first_choice == 1 or $second_choice == 1 or $third_choice == 1) {
      $ninja_forms_processing->add_error('nhcfpt_category_select', 'Please select all three category choices');
      $ninja_forms_processing->add_error('nhcfpt_category_select_1357', 'Please select all three category choices', 1357);
    }
    if ($first_choice == $second_choice or $first_choice == $third_choice or $second_choice == $third_choice) {
      $ninja_forms_processing->add_error('nhcfpt_category_check', 'Please make sure your category choices are different');
      $ninja_forms_processing->add_error('nhcfpt_category_check_1357', 'Select different category choices', 1357);
    }
  }
}
add_action('ninja_forms_pre_process', 'nhcfpt_functions');

/*  New Horizons CFP 2015 Tracking Number TESTING [id 35] */
function nhcfpt_sequential(){
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 35) {
    Ninja_Forms()->subs()->get(
      $args = array(
        'form_id' => $form_id,
        )
      );
    $subs = Ninja_Forms()->subs()->get( $args );
    foreach ( $subs as $sub ) {
      $seq_num = $sub->get_seq_num();
    }
    $subs_count = count($subs);
    $ninja_forms_processing->update_field_value( 1334, strval($seq_num) + $subs_count + 15000);
  }
}
add_action('ninja_forms_pre_process', 'nhcfpt_sequential');

/*  Excellence in Education Awards Nomination Form [43] */
function eie_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 43) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1621);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('eie_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('eie_school_check_1621', 'Select a VCCS College/Agency', 1621);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1617);
    $email_check = $ninja_forms_processing->get_field_value(1618);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('eie_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('eie_email_check_1377', 'Email addresses must match', 1617);
      $ninja_forms_processing->add_error('eie_email_check_1378', 'Email addresses must match', 1618);
    }
  }
}
add_action('ninja_forms_pre_process', 'eie_functions');

/*  New Horizons Hotel Lottery Form [48] */
function nhh_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 48) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(1851);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('nhh_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('nhh_school_check_1851', 'Select a VCCS College/Agency', 1851);

    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(1852);
    $email_check = $ninja_forms_processing->get_field_value(1853);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('nhh_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('nhh_email_check_1852', 'Email addresses must match', 1852);
      $ninja_forms_processing->add_error('nhh_email_check_1853', 'Email addresses must match', 1853);
    }
  }
}
}
add_action('ninja_forms_pre_process', 'nhh_functions');

/*  New Horizons Hotel Lottery Tracking Number [48] */
function nhhl_sequential(){
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 48) {
    Ninja_Forms()->subs()->get(
      $args = array(
        'form_id' => $form_id,
        )
      );
    $subs = Ninja_Forms()->subs()->get( $args );
    foreach ( $subs as $sub ) {
      $seq_num = $sub->get_seq_num();
    }
    $subs_count = count($subs);
    $ninja_forms_processing->update_field_value( 1857, strval($seq_num) + $subs_count + 154000);
  }
}
add_action('ninja_forms_pre_process', 'nhhl_sequential');

/*  Paul Lee Grants ID Number [id 5] */
function plg_sequential(){
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 5) {
    Ninja_Forms()->subs()->get(
      $args = array(
        'form_id' => $form_id,
        )
      );
    $subs = Ninja_Forms()->subs()->get( $args );
    foreach ( $subs as $sub ) {
      $seq_num = $sub->get_seq_num();
    }
    $subs_count = count($subs);
    $ninja_forms_processing->update_field_value( 1920, strval($seq_num) + $subs_count + 1199);
  }
}
add_action('ninja_forms_pre_process', 'plg_sequential');

/*  CVPA Peer Group Participant Registration Form [194] */
function cvpapgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 194) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(2964);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('cvpapgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('cvpapgr_school_check_2964', 'Select a VCCS College/Agency', 2964);
    }
    /*  Confirms Discipline is selected  */
    $dis_check = $ninja_forms_processing->get_field_value(2960);
    if ($dis_check == 1 ) {
      $ninja_forms_processing->add_error('cvpapgr_dis_check', 'Please select a Discipline');
      $ninja_forms_processing->add_error('cvpapgr_dis_check_2960', 'Select a Discipline', 2960);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(2962);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('cvpapgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('cvpapgr_job_check_2962', 'Select a Job Type', 2962);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(2966);
    $email_check = $ninja_forms_processing->get_field_value(2967);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('cvpapgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('cvpapgr_email_check_2966', 'Email addresses must match', 2966);
      $ninja_forms_processing->add_error('cvpapgr_email_check_2967', 'Email addresses must match', 2967);
    }
  }
}
add_action('ninja_forms_pre_process', 'cvpapgr_functions');

/*  CVPA Peer Group Call for Proposals Form [190] */
function cvpapgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 190) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(2906);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('cvpapgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('cvpapgcfp_school_check_2906', 'Select a VCCS College/Agency', 2906);
    }
     /*  Confirms Discipline is selected  */
    $dis_check = $ninja_forms_processing->get_field_value(2896);
    if ($dis_check == 1 ) {
      $ninja_forms_processing->add_error('cvpapgr_dis_check', 'Please select a Discipline');
      $ninja_forms_processing->add_error('cvpapgr_dis_check_2896', 'Select a Discipline', 2896);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(2907);
    $email_check = $ninja_forms_processing->get_field_value(2908);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('cvpapgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('cvpapgcfp_email_check_2907', 'Email addresses must match', 2907);
      $ninja_forms_processing->add_error('cvpapgcfp_email_check_2908', 'Email addresses must match', 2908);
    }
  }
}
add_action('ninja_forms_pre_process', 'cvpapgcfp_functions');

/*  Distance Ed Peer Group Participant Registration Form [216] */
function depgr_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 216) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(3180);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('depgr_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('depgr_school_check_3180', 'Select a VCCS College/Agency', 3180);
    }
    /*  Confirms Discipline is selected  */
    $dis_check = $ninja_forms_processing->get_field_value(3176);
    if ($dis_check == 1 ) {
      $ninja_forms_processing->add_error('depgr_dis_check', 'Please select a Discipline');
      $ninja_forms_processing->add_error('depgr_dis_check_3176', 'Select a Discipline', 3176);
    }
    /*  Confirms Job Type is selected */
    $job_check = $ninja_forms_processing->get_field_value(3178);
    if ($job_check == 1) {
      $ninja_forms_processing->add_error('depgr_job_check', 'Please select a Job Type');
      $ninja_forms_processing->add_error('depgr_job_check_3178', 'Select a Job Type', 3178);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(3182);
    $email_check = $ninja_forms_processing->get_field_value(3183);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('depgr_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('depgr_email_check_3182', 'Email addresses must match', 3182);
      $ninja_forms_processing->add_error('depgr_email_check_3183', 'Email addresses must match', 3183);
    }
  }
}
add_action('ninja_forms_pre_process', 'depgr_functions');

/*  Distance Ed Peer Group Call for Proposals Form [212] */
function depgcfp_functions() {
  global $ninja_forms_processing;
  $form_id = $ninja_forms_processing->get_form_ID();
  if ($form_id == 212) {
    /*  Confirms VCCS College/Agency is selected  */
    $school_check = $ninja_forms_processing->get_field_value(3122);
    if ($school_check == 1 ) {
      $ninja_forms_processing->add_error('depgcfp_school_check', 'Please select a VCCS College/Agency');
      $ninja_forms_processing->add_error('depgcfp_school_check_3122', 'Select a VCCS College/Agency', 3122);
    }
     /*  Confirms Category is selected  */
    $dis_check = $ninja_forms_processing->get_field_value(3111);
    if ($dis_check == 1 ) {
      $ninja_forms_processing->add_error('depgr_dis_check', 'Please select a Category');
      $ninja_forms_processing->add_error('depgr_dis_check_3111', 'Select a Category', 3111);
    }
    /*  Confirms email addresses entered match  */
    $email_main = $ninja_forms_processing->get_field_value(3123);
    $email_check = $ninja_forms_processing->get_field_value(3124);
    if ($email_main !== $email_check) {
      $ninja_forms_processing->add_error('depgcfp_email_check', 'Email addresses do not match');
      $ninja_forms_processing->add_error('depgcfp_email_check_3123', 'Email addresses must match', 3123);
      $ninja_forms_processing->add_error('depgcfp_email_check_3124', 'Email addresses must match', 3124);
    }
  }
}
add_action('ninja_forms_pre_process', 'depgcfp_functions');