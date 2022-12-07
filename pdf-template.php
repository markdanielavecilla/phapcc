<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./generatePdf.css">
</head>
<body>
    <table>
        <table border="1" class="table_1">
            <tr>
                <th></th>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th>
                <th>Suffix</th>
            </tr>
            <tr>
                <td>
                    <div class="profilePicture">
                        <img src="images/uploads/{{ picture }}" alt="{{ firstname }}">
                    </div>
                </td>
                <td>
                    <div class="name">
                        <h3>{{ firstname }}</h3>
                    </div>
                </td>
                <td>
                    <div class="name">
                        <h3>{{ middlename }}</h3>
                    </div>
                </td>
                <td>
                    <div class="name">
                        <h3>{{ lastname }}</h3>
                    </div>
                </td>
                <td>
                    <div class="name">
                        <h3>{{ suffix }}</h3>
                    </div>
                </td>
            </tr>
        </table>
        <br>
        <h2>Basic Information</h2>
        <table border="1" class="table_2">
            <tr>
                <th>Email</th>
                <th>Mobile number</th>
                <th>Second mobile number</th>
                <th>Birth date</th>
                <th>Age</th>
                <th>Gender</th>
                <th>PRC #</th>
                <th>PMA #</th>
            </tr>
            <tr>    
                <td>{{ email }}</td>
                <td>{{ mobilenumber }}</td>
                <td>{{ smobilenumber }}</td>
                <td>{{ birthdate }}</td>
                <td>{{ age }}</td>
                <td>{{ gender }}</td>
                <td>{{ prc }}</td>
                <td>{{ pma }}</td>
            </tr>
        </table>
        <br>
        <h2>Medical School and Training Institution</h2>
        <table border="1" class="table_3">
            <tr>
                <th>Medical School</th>
                <th>Year Graduated</th>
                <th>Training Institution</th>
                <th>Year finished</th>
            </tr>
            <tr>
                <td>{{ medschool }}</td>
                <td>{{ yeargrad }}</td>
                <td>{{ training }}</td>
                <td>{{ yearfin }}</td>
            </tr>
        </table>
        <br>
        <h2>Beneficiaries</h2>
        <table border="1" class="table_4">
            <tr>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th>
                <th>Suffix</th>
            </tr>
            {{ beneficiary }}
        </table>
        <br>
        <h2>Contact person in case of emergency</h2>
        <table border="1" class="table_5">
            <tr>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th>
                <th>Mobile number</th>
            </tr>
            {{ contact }}
        </table>
        <br>
        <h2>Affiliation</h2>
        <table border="1" class="table_6">
            <tr>
                <th>Hospital Affiliation</th>
                <th>Contact number</th>
                <th>Landline number</th>
                <th>Main City or province of practice</th>
                <th>Home address</th>
                <th>Address of principal clinic</th>
                <th>International Affiliation</th>
            </tr>
            {{ affiliation }}         
        </table>
        <br/>
        <table border="1" class="table_7">
            <tr>
                <th>Subspecialty</th>
                <th>Other Subspecialty</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        {{ sublist }}
                    </ul>
                </td>
                <td>{{ othersublist }}</td>
            </tr>
            <br/>
            <tr>
                <th>Special training</th>
                <th>Other Special training</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        {{ specialtraining }}
                    </ul>
                </td>
                <td>{{ ost }}</td>
            </tr>
            <br/>
            <tr>
                <th>Practice</th>
                <th>Other Practice</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        {{ practicelist }}
                    </ul>
                </td>
                <td>{{ optherpractice }}</td>
            </tr>
            <br/>
            <tr>
                <th>Category</th>
                <th>Other Category</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        {{ categories }}
                    </ul>
                </td>
                <td>{{ othercategory }}</td>
            </tr>
            <br/>
            <tr>
                <th>Council</th>
                <th>Other Council</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        {{ council }}
                    </ul>
                </td>
                <td>{{ othercouncil }}</td>
            </tr>
            <br/>
            <tr>
                <th>Committee</th>
                <th>Other Committee</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        {{ committee }}
                    </ul>
                </td>
                <td>{{ othercommittee }}</td>
            </tr>
            <br/>
            <tr>
                <th>Chapter</th>
                <th>Other Chapter</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        {{ chapter }}
                    </ul>
                </td>
                <td>{{ otherchapter }}</td>
            </tr>
        </table>
        <br/>
        <h2>Other Affiliation</h2>
        <table border="1" class="table_8">
            <tr>
                <th>Hospital Affiliation</th>
                <th>Contact number</th>
                <th>Landline number</th>
            </tr>
            {{ otheraff }}
        </table>
        <br/>
        <h2>Year as</h2>
        <table class="table_9">
            <tr>
                <th>Fellow</th>
                <th>Life Fellow</th>
                <th>Diplomate</th>
                <th>Life Member</th>
                <th>Associate Fellow</th>
                <th>Associate</th>
            </tr>
            <tr>
                <td>{{ fellow }}</td>
                <td>{{ lifefellow }}</td>
                <td>{{ diplomate }}</td>
                <td>{{ lifemember }}</td>
                <td>{{ associatefellow }}</td>
                <td>{{ associate }}</td>
            </tr>
        </table>
    </table>
</body>
</html>