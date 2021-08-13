<?php

$response = array(
    'status' => 0,
    'message' => 'Form submission Failed'
);
$uploadDir = "uploads/";
$errorEmpty = false;
$errorEmail = false;

 if(isset($_POST['firstName']) || isset($_POST['email']) || isset($_POST['lastName']) 
 || isset($_POST['middleName']) || isset($_POST['dateOfBirth']) || isset($_POST['citizenship']) || isset($_POST['countyOfBirth']) || isset($_POST['countryOfBirth']) || isset($_POST['ID']) || isset($_POST['formalEducation']) 
 || isset($_POST['passport']) || isset($_POST['languages']) || isset($_POST['postalCode']) || isset($_POST['address']) || isset($_POST['town']) || isset($_POST['country']) || isset($_POST['telephone']) || isset($_POST['mobileNumber'])){
     $response['message'] = "Success......";


 
 $firstName = $_POST['firstName'];
 $lastName = $_POST['lastName'];
 $email = $_POST['email'];
 $middleName = $_POST['middleName'];
 $dateOfBirth = $_POST['dateOfBirth'];
 $citizenship = $_POST['citizenship'];
 $countyOfBirth = $_POST['countyOfBirth'];
 $ID = $_POST['ID'];
 $formalEducation = $_POST['formalEducation'];
 $languages = $_POST['languages'];
 $postalCode = $_POST['postalCode'];
 $address = $_POST['address'];
 $town = $_POST['town'];
 $country = $_POST['country'];
 $telephone = $_POST['telephone'];
 $mobileNumber = $_POST['mobileNumber'];
 $textOne = $_POST['textOne']; 
 $textTwo = $_POST['textTwo'];
 $textThree = $_POST['textThree'];
 $countryOfBirth = $_POST['countryOfBirth'];
 $gender = $_POST['gender'];


 if(empty($firstName)){
    $response['message'] = "Fill in your First Name"; 
    $errorEmpty = true;    
}

elseif(empty($middleName)){
    $response['message'] = "Fill in your Middle Name "; 
    $errorEmpty = true;                           
    
}

elseif(empty($lastName)){
    $response['message'] = "Fill in your Last Name"; 
    $errorEmpty = true;                          
    
}

elseif(empty($dateOfBirth)){
    $response['message'] = "Fill in your Date of Birth "; 
    $errorEmpty = true;                           
     
}

elseif(empty($citizenship)){
    $response['message'] = "Fill in your Citizenship";
    $errorEmpty = true;                       
    
}

elseif(empty($countyOfBirth)){
    $response['message'] = "Fill in your County Of Birth"; 
    $errorEmpty = true;                           
    
}
elseif(empty($ID)){
    $response['message'] = "Fill in your Your ID/Passport Number "; 
    $errorEmpty = true;                          
}
elseif(empty($formalEducation)){
    $response['message'] = "Fill in Years of Your Formal Education in English "; 
    $errorEmpty = true;                           
     
}

elseif(empty($languages)){
    $response['message'] = "Fill in other Languages you speak "; 
    $errorEmpty = true; 
     
}
elseif(empty($address)){
    $response['message'] = "Fill in your Postal Address"; 
    $errorEmpty = true;                          
    
}
elseif(empty($postalCode)){
    $response['message'] = "Fill in your Postal Code ";
    $errorEmpty = true;                          
 
}
elseif(empty($town)){
    $response['message'] = "Fill in the Town you are from "; 
    $errorEmpty = true;                           
   
}
elseif(empty($country)){
    $response['message'] = "Fill in your Your Country"; 
    $errorEmpty = true;                           
    
}
elseif(empty($telephone)){
    $response['message'] = "Fill in your Telephone Number"; 
    $errorEmpty = true;                          
     
}
elseif(empty($mobileNumber)){
    $response['message'] = "Fill in your Mobile Number"; 
    $errorEmpty = true;                           
    
}
elseif(empty($email)){
    $response['message'] = "Fill in your Email";
     $errorEmail = true; 
    
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
    $response['message'] = "Fill in the correct Email type"; 
    $errorEmail = true;
}
else{
    $errorEmail = false;
    $errorEmpty = false;

    $response['message'] = "<p style='color:green;'>All fields are Filled</p>";
    
    if($errorEmail == false && $errorEmpty == false){
           
        $uploadStatus = 1;

        if($uploadStatus == 1){
            
            $conn = mysqli_connect('localhost', 'root','','form');
            if($conn->connect_error){
                die('connection Failed : '.$conn->connect_error);
            }else{
                $stmt = $conn->prepare("INSERT INTO user_info(id, firstName, middleName, lastName, dateOfBirth, citizenship,countryOfBirth, countyOfBirth, gender,languages, levelOfEducation, formalEducation, textOne, relegion, disability, textTwo, religion, text3, postalAddress, postalCode, town, country,telephone, mobile, email,passport)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? )");
                $stmt->bind_param("isssssssssssssssssssssisss",$ID, $firstName, $middleName, $lastName, $dateOfBirth, $citizenship, $countryOfBirth, $countyOfBirth
                $countyOfBirth, $gender, $languages, $_POST['levelOfEducation'], $formalEducation, $textOne, $_POST['religion'],$_POST['disability'}, $textTwo, $religion, $textThree, $address, $postalCode, $town, $country, $telephone, $mobileNumber, $email, $_POST['passport'];);
                $stmt->execute();
                $response['message'] = "<p style='color:green;'>Registration was Successful...</p>";
                $stmt->close();
                $conn->close();
            }

        }




    }
       
}
 }




echo json_encode($response);

?>