<?php

/**
Plugin Name: Contact Form
Description: Basic Plugin
*/

function ideapro_form()
{
	$content = '';

	$content .= '<form method = "post" action = "#">';
		$content .= '<input type = "text" name = "full_name" placeholder = "Your Full Name" />';
		$content .= '<br />';
		$content .= '<input type = "text" name = "email_address" placeholder = "Email Address" />';
		$content .= '<br />';
		$content .= '<input type = "text" name = "phone_number" placeholder = "Phone Number" />';
		$content .= '<br />';
		$content .= '<textarea name="comments" placeholder="Give us your comment" /></textarea>';
		$content .= '<br />';

		$content .= '<input type="submit" name="submit_form" value="send message" />';
	$content .= '</form>';

	return $content;
}

add_shortcode('ideapro_contact_form','ideapro_form');

function set_html_content_type()
{
	return 'text/html';
}

function ideapro_form_capture()
{
	global $post, $wpdb;

	if(array_key_exists('submit_form',$_POST))
	{
		$to = "araman666@gmail.com";
		$subject = "Test Admin Contact Form";
		$body = '';
		$headers[] = 'From: araman666@gmail.com';

		$body .= 'Name: '.$_POST['full_name'].'<br />';
		$body .= 'Email: '.$_POST['email_address'].'<br />';
		$body .= 'Phone: '.$_POST['phone_number'].'<br />';
		$body .= 'Comments: '.$_POST['comments'].'<br />';

		add_filter('wp_mail_content_type','set_html_content_type');

		wp_mail($to,$subject,$body,$headers);

		echo '<script language ="javascript">alert("Thanks for Contacting Us!")</script>';
		echo '<script language="javascript">window.location.href=""</script>';

		remove_filter('wp_mail_content_type','set_html_content_type');

		/* Insert the information into a comment */

		$time = current_time('mysql');

		$data = array(
					'comment_post_ID' => $post->ID,
					'comment_content' => $body,
					'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
					'comment_date' => $time,
					'comment_approved' => 1,

					);
		wp_insert_comment($data);


	}
}

add_action('wp_head','ideapro_form_capture');
?>