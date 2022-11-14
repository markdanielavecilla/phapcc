<?php
    include_once './connection.php';
    $msg = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="./index.css">
    <title>Project</title>
</head>
<body>
    <nav>
        <a href="#"><img src="../images/phalogohd.png" alt="PHA Logo"></a>
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="add.php">New Member</a></li>
                <li>
                    <form method="GET" action="search-result.php" class="d-flex">
                        <input class="form-control me-1" type="text" name="searchInfo" placeholder="Search" value="<?= isset($_GET['searchInfo']) ? $_GET['searchInfo'] : '' ?>">
                        <button class="real-btn" type="submit">Search</button>
                        
                    </form>
                </li>
                <li>
                    <button 
                        class="real-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#filterModal"
                    >Filter</button>
                </li>
            </ul>
        </div>
    </nav>
    
    <section>
        <div class="container-fluid">
            <div class="row justify-content-md-start">
                <div class="modal fade modal-dialog-scrollable" id="filterModal" tabindex="-1" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Filter</h5>
                                <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formFilter" method="GET">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-2">
                                                <select name="selectCategory" id="selectCategory" class="form-select">
                                                    <option value="0">All</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tbl_drcategory";
                                                    $result = $conn->query($sql);
                                                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                                                    foreach($rows as $row) :
                                                        $selected = '';
                                                        if($_GET['selectCategory'] == $row['catid']) $selected = 'selected';
                                                    ?>
                                                    <option value="<?= $row['catid']; ?>" <?= $selected ?> ><?= $row['category']; ?></option>
                                                    <?php
                                                        endforeach; 
                                                    ?>
                                                </select>
                                                <label for="category" class="form-label">Category</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-2">
                                                <select name="isdeceased" id="isdeceased" class="form-select">
                                                    <option value="no" <?= (isset($_GET['isdeceased']) && $_GET['isdeceased'] == 'no')? 'selected': '' ?> >Alive</option>
                                                    <option value="yes" <?= (isset($_GET['isdeceased']) && $_GET['isdeceased'] == 'yes')? 'selected': '' ?> >Deceased</option>
                                                </select>
                                                    <label for="deceased" class="form-label">Deceased</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button 
                                            type="button" 
                                            class="body-btn" 
                                            data-bs-dismiss="modal"
                                        >Cancel
                                        </button>
                                        <button 
                                            type="button" 
                                            id="applyFilter" 
                                            class="body-btn"
                                        >Apply
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
        
    <!-- display drs via cards -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php
                //PAGE
                $limit = 10;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page - 1) * $limit;

                if(isset($_GET['selectCategory'])) {
                    $selectCategory = $_GET['selectCategory'];
                    $deceased = isset($_GET['isdeceased']) ? $_GET['isdeceased'] : 'No';
                    if($selectCategory == 0){ 
                        $sql = "SELECT *,
                        GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') AS category_list,
                        GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') AS chapter_list,
                        GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') AS practice_list,
                        GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') AS sub_list,
                        GROUP_CONCAT(DISTINCT tbl_special_training.special_training SEPARATOR ', ') as special_training_list
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
                        INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id
                        INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id
                        WHERE deceased = '$deceased'
                        GROUP BY tbl_information.id 
                        ORDER BY tbl_information.id DESC 
                        LIMIT $start, $limit";
                        $result = $conn->query($sql);
                        $count = $result->num_rows;
                        if($count <= 0) $msg = "<div class='alert alert-danger'>No result found.</div>";
                        else $msg = "<div class='alert alert-success'>Found $count result.</div>";
                        echo $msg;

                    } else {
                        $sql = "SELECT *,
                        GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') AS category_list,
                        GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') AS chapter_list,
                        GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') AS practice_list,
                        GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') AS sub_list,
                        GROUP_CONCAT(DISTINCT tbl_special_training.special_training SEPARATOR ', ') as special_training_list
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
                        INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id
                        INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id
                        WHERE deceased = '$deceased' AND catid LIKE '%$selectCategory%'
                        GROUP BY tbl_information.id
                        ORDER BY tbl_information.id DESC 
                        LIMIT $start, $limit";
                        $result = $conn->query($sql) or die($conn->error);
                        $count = $result->num_rows;
                        if($count <= 0) $msg = "<div class='alert alert-danger'>No result found.</div>";
                        else $msg = "<div class='alert alert-success'>Found $count result.</div>";
                        echo $msg;
                    }
                }
                else if(isset($_GET['isdeceased'])) {
                    $deceased = $_GET['isdeceased'];
                    if($deceased == 'no'){
                        $sql = "SELECT *,
                        GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') AS category_list,
                        GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') AS chapter_list,
                        GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') AS practice_list,
                        GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') AS sub_list,
                        GROUP_CONCAT(DISTINCT tbl_special_training.special_training SEPARATOR ', ') as special_training_list
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
                        INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id
                        INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id
                        WHERE deceased = '$deceased' 
                        GROUP BY tbl_information.id
                        ORDER BY tbl_information.id DESC 
                        LIMIT $start, $limit";

                        $result = $conn->query($sql);
                        $count = $result->num_rows;
                        if($count <= 0) $msg = "<div class='alert alert-danger'>No result found.</div>";
                        else $msg = "<div class='alert alert-success'>Found $count result.</div>";
                        echo $msg;
                    }
                    else {
                        $sql = "SELECT *,
                        GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') AS category_list,
                        GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') AS chapter_list,
                        GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') AS practice_list,
                        GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') AS sub_list,
                        GROUP_CONCAT(DISTINCT tbl_special_training.special_training SEPARATOR ', ') as special_training_list
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
                        INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id
                        INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id
                        WHERE deceased = '$deceased' 
                        GROUP BY tbl_information.id
                        ORDER BY tbl_information.id DESC 
                        LIMIT $start, $limit";

                        $result = $conn->query($sql);
                        $count = $result->num_rows;
                        if($count <= 0) $msg = "<div class='alert alert-danger'>No result found.</div>";
                        else $msg = "<div class='alert alert-success'>Found $count result.</div>";
                        echo $msg;
                    }
                }
                else {
                    $sql = "SELECT *, 
                    GROUP_CONCAT(DISTINCT tbl_drcategory.category SEPARATOR ', ') as category_list,
                    GROUP_CONCAT(DISTINCT tbl_chapter.chapter SEPARATOR ', ') as chapter_list, 
                    GROUP_CONCAT(DISTINCT tbl_practice.practice SEPARATOR ', ') as practice_list,
                    GROUP_CONCAT(DISTINCT tbl_subspecialty.subspecialty SEPARATOR ', ') as sub_list,
                    GROUP_CONCAT(DISTINCT tbl_special_training.special_training SEPARATOR ', ') as special_training_list
                    FROM tbl_information 
                    INNER JOIN tbl_school ON tbl_information.id = tbl_school.docid
                    INNER JOIN tbl_uid ON tbl_information.id = tbl_uid.userid
                    INNER JOIN tbl_hospital_drcategory ON tbl_information.id = tbl_hospital_drcategory.information_id 
                    INNER JOIN tbl_drcategory ON tbl_hospital_drcategory.category_id = tbl_drcategory.catid 
                    INNER JOIN tbl_hospital_chapter ON tbl_information.id = tbl_hospital_chapter.information_id 
                    INNER JOIN tbl_chapter ON tbl_hospital_chapter.chapter_id = tbl_chapter.chapid 
                    INNER JOIN tbl_hospital_practice ON tbl_information.id = tbl_hospital_practice.information_id INNER JOIN tbl_practice ON tbl_hospital_practice.practice_id = tbl_practice.practice_id 
                    INNER JOIN tbl_hospital_subspecialty ON tbl_information.id = tbl_hospital_subspecialty.information_id 
                    INNER JOIN tbl_subspecialty ON tbl_hospital_subspecialty.subspecialty_id = tbl_subspecialty.sub_id
                    INNER JOIN tbl_hospital_special_training ON tbl_information.id = tbl_hospital_special_training.information_id
                    INNER JOIN tbl_special_training ON tbl_hospital_special_training.special_training_id = tbl_special_training.st_id
                    GROUP BY tbl_information.id ORDER BY tbl_information.id DESC LIMIT $start, $limit";
                    $result = $conn->query($sql) or die($conn->error);
                    $count = $result->num_rows;
                    // echo "Found $count result.";
                }
                while($rows = $result->fetch_assoc()): 
            ?>
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img 
                                src="../images/uploads/<?= $rows['image_url'] ? $rows['image_url'] : 'phalogohd.png' ?>" 
                                alt="<?= $rows['first_name'] ?>"
                            >
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">
                                    <?= $rows['first_name'] ?>
                                    <?= $rows['middle_name'] ?>
                                    <?= $rows['last_name'] ?>
                                    <?= $rows['suffix'] ? $rows['suffix'].'.':'' ?>
                                </h5>
                                <p class="card-text">
                                    <strong>Unique ID:</strong> <?= "PHA".$rows['user_uid'] ?> <br/>
                                    <strong>PRC #:</strong> <?= $rows['prcno'] ?>
                                </p>
                            </div>
                            <ul class="list-group list-group-flush mt-1">
                                <li class="list-group-item"><strong>Special Training:</strong> <?= $rows['special_training_list'] ?></li>
                                <li class="list-group-item text-capitalize"><strong>chapter:</strong> <?= $rows['chapter_list'] ?></li>
                                <li class="list-group-item text-capitalize"><strong>category:</strong> <?= $rows['category_list'] ?></li>
                                <li class="list-group-item text-capitalize"><strong>practice:</strong> <?= $rows['practice_list'] ?></li>
                                <li class="list-group-item text-capitalize"><strong>subspecialty:</strong> <?= $rows['sub_list'] ?></li>
                            </ul>

                            <div class="mt-4 card-footer">
                                <a href="view.php?id=<?= $rows['id'] ?>" class="btn-card" >View info</a>
                                <a href="update.php?id=<?= $rows['id'] ?>" class="btn-card" >Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile ?>
        </div>
    </div>
     
    <?php
        $sql1 = "SELECT COUNT(id) AS id FROM tbl_information";
        $res = $conn->query($sql1);
        $counter = $res->fetch_all(MYSQLI_ASSOC);
            
        $totalPage = $counter[0]['id'];
            
        $pages = ceil($totalPage / $limit);

        $previous = $page - 1;
        $next = $page + 1;
    ?>

    <div class="row">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a 
                    class="page-link" 
                    style="<?= ($page <= 1) ? 'pointer-events: none':'' ?>" 
                    href="members.php?page=<?= $previous?>"
                >Previous</a>
            </li>

            <?php  for($i = 1; $i <= $pages; $i++) : ?>
                <li class="page-item <?= ($_GET['page'] == $i)? 'active':'' ?>">
                    <a class="page-link active" href="members.php?page=<?= $i?>"><?= $i?></a>
                </li>
            <?php  endfor ?>

            <li class="page-item">
                <a 
                    class="page-link" 
                    style="<?= ($page > $pages - 1) ? 'pointer-events: none':'' ?>" 
                    href="members.php?page=<?= $next?>"
                >Next</a>
            </li>
        </ul>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <script>
        const formFilter = document.querySelector('#formFilter')
        const applyFilter = document.querySelector('#applyFilter')

        applyFilter.addEventListener('click', () => {
            formFilter.submit()
        })
    </script>
</body>
</html>

<?php
    function dotSub($str) {
        strip_tags($str);
        if(strlen($str) > 30) {
            $cutStr = substr($str, 0, 30);
            $endPoint = strrpos($cutStr, ' ');

            $string = ($endPoint) ? substr($cutStr, 0, $endPoint) : substr($cutStr, 0);
            $string .= '...';
            return $string;        
        }
        else {
            return $str;
        }
    }
?>
