<?php
   require_once "./includes/connection.php";
   $category_id = $_GET['id'];
   $status = 1;
   
   $stmt = $conn->prepare("UPDATE tbl_drcategory SET status = ? WHERE catid = ? LIMIT 1");
   $stmt->bind_param("ii", $status, $category_id);
   $stmt->execute();
   $stmt->close();

   header("Location: ".$_SERVER['HTTP_REFERER']);
?>