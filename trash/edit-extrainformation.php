<?php
    include('../actions/extrainformation-action.php');
    include('connection.php');
    $id = $_GET['id'];
    $dr_id = $_GET['drId'];
    $_SESSION['id'] = $id;
    $_SESSION['drID'] = $dr_id;
    $stmt = $conn->prepare("SELECT * FROM tbl_extrainformation WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    // $page = $_GET['page'];
    // $sql = "SELECT * FROM tbl_extrainformation WHERE id = $id";
    // $result = $conn->query($sql) or die($conn->error);
    // $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>
    <link rel="stylesheet" href="../index.css">
    <title>Document</title>
</head>
<body>
    
    <nav>
        <a href="#"><img src="../images/phalogohd.png" alt="PHA Logo"></a>
        <div class="navi-links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="view.php?id=<?= $dr_id ?>">Go back</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-3 mb-2">
            <div class="col">
                
            </div>
        </div>
        <form method="POST" autocomplete="off">
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            id="editHospitalAff" 
                            name="editHospitalAff" 
                            placeholder="Hospital Affiliation" 
                            class="form-control"
                            value="<?= $row['hospital_aff'] ?>"
                        >

                        <label for="Hospital Affiliation" class="form-label">Hospital Affiliation</label>
                        <span class="invalid-feedback"><?= $errAddHospital?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input 
                            type="number" 
                            name="editContactNumber" 
                            class="form-control" 
                            placeholder="ContactNumber"
                            value="<?= $row['contact'] ?>"
                        >

                        <label for="Contact Number" class="form-label">Contact Number</label>
                        <span class="invalid-feedback"><?= $errAddContact ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            name="editLandlineNumber" 
                            placeholder="Landline number" 
                            class="form-control"
                            value="<?= $row['landline'] ?>"
                        >
                        
                        <label for="Landline number" class="form-label">Landline number</label>
                        <span class="invalid-feedback"><?= $errAddLandline ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            name="editEmail" 
                            id="editEmail" 
                            class="form-control"
                            value="<?= $row['email'] ?>"
                        >
                        <label for="email" class="form-label">Email</label>
                        <span class="invalid-feedback"><?= $errAddEmail ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button 
                        type="submit" 
                        name="editMoreInfo" 
                        class="body-btn"
                    >Save</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
</body>
</html>