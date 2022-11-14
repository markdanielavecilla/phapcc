<?php
    include_once("./connection.php");
    $searchInfo = $_GET['searchInfo'];
    if(empty($searchInfo)) {
        header("Location: members.php");
        exit();
    }
    $msgRes = '';

    $limit = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $sql = "SELECT *,
            GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') AS category_list,
            GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') AS chapter_list,
            GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') AS practice_list,
            GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') AS sub_list 
            FROM tbl_information
            INNER JOIN tbl_school ON tbl_information.id = tbl_school.docid
            INNER JOIN tbl_uid ON tbl_information.id = tbl_uid.userid
            INNER JOIN tbl_hospital_drcategory ON tbl_information.id = tbl_hospital_drcategory.information_id
            INNER JOIN tbl_drcategory ON tbl_hospital_drcategory.category_id = tbl_drcategory.catid
            INNER JOIN tbl_hospital_chapter ON tbl_information.id = tbl_hospital_chapter.information_id
            INNER JOIN tbl_chapter ON tbl_hospital_chapter.chapter_id = tbl_chapter.chapid
            INNER JOIN tbl_hospital_practice ON tbl_information.id = tbl_hospital_practice.information_id
            INNER JOIN tbl_practice ON tbl_hospital_practice.practice_id = tbl_practice.practice_id
            INNER JOIN tbl_hospital_subspecialty ON tbl_information.id = tbl_hospital_subspecialty.information_id
            INNER JOIN tbl_subspecialty ON tbl_hospital_subspecialty.subspecialty_id = tbl_subspecialty.sub_id
            WHERE UPPER(CONCAT_WS(' ', first_name, last_name, prcno, user_uid)) LIKE UPPER('%$searchInfo%')
            GROUP BY tbl_information.id
            ORDER BY tbl_information.id DESC
            
    ";
    $result = $conn->query($sql) or die($conn->error);
    $count = $result->num_rows;
    if($count <= 0) {
        $msgRes = "<div class='alert alert-danger'>No result found</div>";
    } else {
        $msgRes = "<div class='alert alert-success'>Found $count result.</div>";
    }


    //pagination
    $sql = "SELECT COUNT(*) as id FROM tbl_information WHERE last_name LIKE '%$searchInfo%'";
    $res = $conn->query($sql) or die($conn->error);
    $counter = $res->fetch_all(MYSQLI_ASSOC);

    $totalPage = $counter[0]['id'];

    $pages = ceil($totalPage / $limit);

    $previous = $page - 1;
    $next = $page + 1;
?>