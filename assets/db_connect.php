<?php

 //Database connection

 $conn = mysqli_connect("localhost", "root", "","cresh_db"); //host, user, password, database
 if(!$conn) {
     die("Connection failed:". mysqli_connect_error()); // die is best preferable, dont use exit
 } 
