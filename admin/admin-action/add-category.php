<?php
    require_once "./includes/connection.php";

    // ADD CATEGORY
    $errCat = "";
    if(isset($_POST['addCategory'])) {
        $category = $_POST['category-title'];
        $status = 0;

        $conn->autocommit(FALSE);

        //check if category is empty
        if(empty($category)) {
            $errCat = "This field is required";
            return;
        }

        // check if the output of user is already exist
        $cat = $conn->prepare("SELECT category from tbl_drcategory where category = ?");
        $cat->bind_param("s", $category);
        $cat->execute();
        $resultCat = $cat->get_result();
        if($resultCat->num_rows > 0) {
            $errCat = "Category already exist.";
            $_SESSION['message'] = "<div class='alert alert-danger'>$errCat</div>";
            return;
        }
        $cat->close();

        $stmt = $conn->prepare("INSERT INTO tbl_drcategory (category, status) VALUES (?, ?)");
        $stmt->bind_param("si", $category, $status);
        $stmt->execute();

        if(!$conn->commit()) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to add category</div>";
            $conn->rollback();
            return;
        } else {
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully added category</div>";
            return;
        }
    } 
?>