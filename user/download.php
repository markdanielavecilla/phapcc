<?php
    require_once '../vendor/autoload.php';
    require_once "../connection/connection.php";
    
    $user_id = $_GET['id'];
    $output = '';

    // USER INFORMATION
    $information = $conn->prepare("SELECT * FROM tbl_information WHERE id = ?");
    $information->bind_param("i", $user_id);
    $information->execute();
    $infoResult = $information->get_result();
    if($infoResult->num_rows > 0) {
        $informationRow = $infoResult->fetch_assoc();
        $image = $informationRow['image_url'];
        $fname = $informationRow['first_name'];
    }
    $information->close();

    // PDF instance
    // $mpdf = new \Mpdf\Mpdf();
    
    // Create our PDF
    // $output = '
    
    // ';

    // Write PDF
    // $mpdf->WriteHTML($output);

    // Output to browser
    // $mpdf->Output('test.pdf', 'D');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="downloadpdf.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="top">
            <div class="imgBx">
                <div class="box">
                    <img src="../images/steto.jpg" alt="asd">
                </div>
            </div>
            <div class="profileText">
                <h3>First name <br> Middle name <br> Last name <br> Suffix <br> <span>Special Training</span> </h3>
            </div>
        </div>
        <div class="contentBox">
            <div class="leftSide">
                <h3>Personal Info</h3>
                <ul>
                    <li>
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <span class="text">Mobile number</span>
                    </li>
                    <li>
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <span class="text">Email</span>
                    </li>
                    <li>
                        <span class="icon"><ion-icon name="calendar-number-outline"></ion-icon></span>
                        <span class="text">Birth Date</span>
                    </li>
                    <li>
                        <span class="icon"><ion-icon name="calendar-number-outline"></ion-icon></span>
                        <span class="text">Age</span>
                    </li>
                    <li>
                        <span class="icon"><ion-icon name="transgender-outline"></ion-icon></span>
                        <span class="text">Gender</span>
                    </li>
                    <li>
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <span class="text">Mobile number</span>
                    </li>
                    <li>
                        <span class="icon"><ion-icon name="card-outline"></ion-icon></span>
                        <span class="text">Prc</span>
                    </li>
                    <li>
                        <span class="icon"><ion-icon name="card-outline"></ion-icon></span>
                        <span class="text">PMA</span>
                    </li>
                </ul>
                <h3>Education</h3>
                <ul class="education">
                    <li>
                        <h4>Medical year</h4>
                        <h5>Year Graduated</h5>
                    </li>
                    <li>
                        <h4>Training Institution</h4>
                        <h5>Year Graduated</h5>
                    </li>
                </ul>
                <h3>Beneficiaries</h3>
                <ul class="beneficiaries">
                    <li>
                        <h4>Name</h4>
                    </li>
                </ul>
                <h3>Contact Person in Case of Emergency</h3>
                <ul class="contactPerson">
                    <li>
                        <h4>Name</h4>
                        <h5>Contact number</h5>
                    </li>
                </ul>
            </div>
            <div class="rightSide">
                <h3>Affiliation</h3>
                <div class="box">
                    <ul class="affiliationLeft">
                        <li>
                            <h4>Hospital affiliation</h4>
                            <h5>name of hospital affiliation</h5>
                        </li>
                        <li>
                            <h4>Contact number</h4>
                            <h5>Mobile number</h5>
                        </li>
                        <li>
                            <h4>Landline number</h4>
                            <h5>Telephone number</h5>
                        </li>
                        <li>
                            <h4>Main City or Province of practice</h4>
                            <h5>Practice Address</h5>
                        </li>
                        <li>
                            <h4>Home Address</h4>
                            <h5>Delivery Address</h5>
                        </li>
                        <li>
                            <h4>Address of Principal Clinic</h4>
                            <h5>Principal Clinic</h5>
                        </li>
                    </ul>
                    <ul class="affiliationMid">
                        <li>
                            <h4>categories</h4>
                            <h5>subspecialty</h5>
                        </li>
                        <li>
                            <h4>categories</h4>
                            <h5>Special Training</h5>
                        </li>
                        <li>
                            <h4>categories</h4>
                            <h5>Practice</h5>
                        </li>
                        <li>
                            <h4>categories</h4>
                            <h5>Category</h5>
                        </li>
                        <li>
                            <h4>categories</h4>
                            <h5>Council</h5>
                        </li>
                        <li>
                            <h4>categories</h4>
                            <h5>Committee</h5>
                        </li>
                        <li>
                            <h4>International Affiliation</h4>
                            <h5>Overseas Hospital</h5>
                        </li>
                        <li>
                            <h4>categories</h4>
                            <h5>Chapter</h5>
                        </li>
                    </ul>
                    <ul class="affiliationRight">
                        <li>
                            <h4>Others</h4>
                            <h5>Other subspecialty</h5>
                        </li>
                        <li>
                            <h4>Others</h4>
                            <h5>Other special training</h5>
                        </li>
                        <li>
                            <h4>Others</h4>
                            <h5>Other practice</h5>
                        </li>
                        <li>
                            <h4>Others</h4>
                            <h5>Other category</h5>
                        </li>
                        <li>
                            <h4>Others</h4>
                            <h5>Other council</h5>
                        </li>
                        <li>
                            <h4>Others</h4>
                            <h5>Other committee</h5>
                        </li>
                        <li>
                            <h4>Others</h4>
                            <h5>Other chapter</h5>
                        </li>
                    </ul>
                </div>
                <h3>Other Affiliation</h3>
                <ul class="otherAffiliation">
                    <li>
                        <h4>Hospital Affiliation</h4>
                        <h5>Mobile</h5>
                        <h5>Telephone</h5>
                    </li>
                </ul>
                <h3>Year as</h3>
                <ul class="yearAs">
                    <li>
                        <h4>Fellow</h4>
                        <h5>9999</h5>
                    </li>
                    <li>
                        <h4>Life Fellow</h4>
                        <h5>9999</h5>
                    </li>
                    <li>
                        <h4>Diplomate</h4>
                        <h5>9999</h5>
                    </li>
                    <li>
                        <h4>Life member</h4>
                        <h5>9999</h5>
                    </li>
                    <li>
                        <h4>Associate fellow</h4>
                        <h5>9999</h5>
                    </li>
                    <li>
                        <h4>Associate</h4>
                        <h5>9999</h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>