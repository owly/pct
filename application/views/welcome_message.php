<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

<BR>
<strong>  Get by marker: </strong>
<a href='/api/get_by_marker/5'>/api/get_by_marker/5</a>
<BR>
<BR>  <strong>Get by ID: </strong>
<a href='/api/get/5'>/api/get/5</a>
<BR>
  <BR> <strong>Get nearest with long/lat: </strong>
<a href='/api/get_nearest?long=22.32&lat=234134.55'>/api/get_nearest?long=22.32&lat=234134.55</a>
<BR>
  <BR> <strong>Delete by marker</strong>
<a href='/api/delete_marker/5.5'>/api/delete_marker/5.5</a>

<BR>
  <BR> <strong>Add a marker:</strong>
<BR><form action="/api/addmarker" method="post">
  <input name="id" value="11">
  <input name="mile_marker" value="5.0">
  <input name="longitude" value="23423.24324">
  <input name="latitude" value="23425.12">
  <button>add marker</button>
</form>


<BR>
  <BR> <strong>Update a marker:</strong>
  <BR>
<form action="/api/add_or_update_marker" method="post">
  <input name="id" value="11">
  <input name="mile_marker" value="5.0">
  <input name="longitude" value="23423.24324">
  <input name="latitude" value="23425.12">
  <button>update marker</button>
</form>
</body>
</html>