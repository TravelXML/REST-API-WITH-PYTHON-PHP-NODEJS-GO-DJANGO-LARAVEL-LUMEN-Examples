<?php
/**
 * @Desc       Book Store API ( CRUD )
 * @Date       25-06-2020
 * @Author     Sapan Mohanty
 * @Skype      sapan.mohannty
 * @github     https://github.com/travelxml
 */
	include_once('book.class.php');
	$postData = file_get_contents('php://input');
	$API = new BookStoreApi();
	$API->storeApi($postData);
?>
