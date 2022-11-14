<?php
    require_once "./includes/connection.php";
    $categoryId = $_GET['id'];

    // GET CATEGORY BY ID
    $stmt = $conn->prepare("SELECT category FROM tbl_drcategory WHERE catid = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // UPDATE CATEGORY
    $errCategory = "";
    if(isset($_POST['editCategory'])) {
        $flag = true;
        $newCategory = $_POST['category'];
        $error = array();

        if(!preg_match("/^[a-zA-Z\s\-]*$/", $newCategory)) {
            $flag = false;
            $errCategory = "Category must not contain numbers.";
            $error[] = $newCategory;
        }

        if($flag === false && count($error) > 0) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed to update category</div>";
        } else {
            $category = $conn->prepare("UPDATE tbl_drcategory SET category = ? WHERE catid = ?");
            $category->bind_param("si", $newCategory, $categoryId);
            $category->execute();
            $category->close();
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully updated category.</div>";
        }
    }
?>

