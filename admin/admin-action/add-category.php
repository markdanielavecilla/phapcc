<?php
    require_once "./includes/connection.php";

    // ADD CATEGORY
    if(isset($_POST['addCategory'])) {
        $category = $_POST['category-title'];
        $status = 0;

        $conn->autocommit(FALSE);

        $stmt = $conn->prepare("INSERT INTO tbl_drcategory (category) VALUES (?)");
        $stmt->bind_param("s", $category);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "Failed to add category";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "Successfully added category";
        }
    } 
?>