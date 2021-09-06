<?php
include "header.php";
session_start();

$name = isset($_SESSION['name'])?$_SESSION['name']:'';
$email = isset($_SESSION['email'])?$_SESSION['email']:'';
$username = isset($_SESSION['username'])?$_SESSION['username']:'';
$pswd = isset($_SESSION['pswd'])?$_SESSION['pswd']:'';
$confirmPswd = isset($_SESSION['confirmPswd'])?$_SESSION['confirmPswd']:'';
$dob = isset($_SESSION['dob'])?$_SESSION['dob']:'';
$gender = isset($_SESSION['gender'])?$_SESSION['gender']:'';
$maritalStatus = isset($_SESSION['maritalStatus'])?$_SESSION['maritalStatus']:'';
$city = isset($_SESSION['city'])?$_SESSION['city']:'';
$address = isset($_SESSION['address'])?$_SESSION['address']:'';
$postalCode = isset($_SESSION['postalCode'])?$_SESSION['postalCode']:'';
$phone = isset($_SESSION['phone'])?$_SESSION['phone']:'';
$mobile = isset($_SESSION['mobile'])?$_SESSION['mobile']:'';
$card = isset($_SESSION['card'])?$_SESSION['card']:'';
$expiryDate = isset($_SESSION['expiryDate'])?$_SESSION['expiryDate']:'';
$salary = isset($_SESSION['salary'])?$_SESSION['salary']:'';
$url = isset($_SESSION['url'])?$_SESSION['url']:'';
$gpa = isset($_SESSION['gpa'])?$_SESSION['gpa']:'';



$isNameValid = true;
$isEmailValid = true;
$isUsernameValid = true;
$isPswdValid = true;
$isConfirmPswdValid = true;
$isDobValid = true;
$isGenderValid = true;
$isMaritalValid = true;
$isCityValid = true;
$isAddressValid = true;
$isPostalCodeValid = true;
$isPhoneValid = true;
$isMobileValid = true;
$isCardValid = true;
$isExpiryDateValid = true;
$isSalaryValid = true;
$isURLValid = true;
$isGPAValid = true;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $username = $_REQUEST['username'];
    $pswd = $_REQUEST['pswd'];
    $confirmPswd = $_REQUEST['confirmPswd'];
    $dob = $_REQUEST['dob'];
    $gender = $_REQUEST['gender'];
    $maritalStatus = $_REQUEST['maritalStatus'];
    $city = $_REQUEST['city'];
    $address = $_REQUEST['address'];
    $postalCode = $_REQUEST['postalCode'];
    $phone = $_REQUEST['phone'];
    $mobile = $_REQUEST['mobile'];
    $card = $_REQUEST['card'];
    $expiryDate = $_REQUEST['expiryDate'];
    $salary = $_REQUEST['salary'];
    $url = $_REQUEST['url'];
    $gpa = $_REQUEST['gpa'];

    $isNameValid = preg_match('/^[a-z \-]*[a-z]$/i', $name);
    $isEmailValid = preg_match('/^[a-zA-Z0-9\.\-_]+[@]\w+[\.a-z]+$/', $email);
    $isUsernameValid = preg_match('/[a-zA-Z0-9_\+\-\.]{5,}/', $username);
    $isPswdValid = preg_match('/(?=\w{6,10})(?=[^a-z]*[a-z])(?=(?:[^A-Z]*[A-Z]){3})\D*\d.*/', $pswd);
    $isDobValid = preg_match('/\d{2}[\.]\d{2}[\.]\d{4}/', $dob);
    $isGenderValid = preg_match('/(Male)|(Female)/i', $gender);
    $isMaritalValid = preg_match('/(Single)|(Married)|(Divorced)|(Widowed)/', $maritalStatus);
    $isCityValid = preg_match('/^[a-z][a-z \-]*[a-z]$/i', $city);
    $isAddressValid = preg_match('/([0-9A-Za-z ]+),([0-9A-Za-z ]+), \w+/', $address);
    $isPostalCodeValid = preg_match('/^\d{6}$/', $postalCode);
    $isPhoneValid = preg_match('/^\d{9}$/', $phone);
    $isMobileValid = preg_match('/^\d{9}$/', $mobile);
    $isCardValid = preg_match('/^\d{16}$/', $card);
    $isExpiryDateValid = preg_match('/\d{2}[\.]\d{2}[\.]\d{4}/', $expiryDate);
    $isSalaryValid = preg_match('/(UZS)[0-9 \,]+[0-9\.]+/', $salary);
    $isURLValid = preg_match('/^(http)?:\/\/(github.com).+/', $url);
    $isGPAValid = preg_match('/^(([0-3]\.[0-9]{1,2})|([4]\.[4][0-9]))$/', $gpa);



    list($day, $month, $year)=explode(".",$dob);
    if(checkdate($month,$day,$year)){
        $isDobValid = true;
    }
    else{
        $isDobValid = false;
    }

    list($day, $month, $year)=explode(".",$expiryDate);
    if(checkdate($month,$day,$year)){
        $isExpiryDateValid = true;
    }
    else{
        $isExpiryDateValid = false;
    }

    if ($_POST["pswd"] === $_POST["confirmPswd"]) {
        $isConfirmPswdValid = true;
    }
    else {
        $isConfirmPswdValid = false;
    }

    $isValid = $isUsernameValid && $isNameValid && $isEmailValid && $isPswdValid &&$isConfirmPswdValid && $isDobValid && $isDobValid && $isCityValid && $isAddressValid && $isPostalCodeValid && $isPhoneValid && $isMobileValid && $isCardValid && $isExpiryDateValid && $isSalaryValid && $isURLValid && $isGPAValid;

    if ($isValid) {

        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['pswd'] = $pswd;
        $_SESSION['dob'] = $dob;
        $_SESSION['gender'] = $gender;
        $_SESSION['maritalStatus'] = $maritalStatus;
        $_SESSION['city'] = $city;
        $_SESSION['address'] = $address;
        $_SESSION['postalCode'] = $postalCode;
        $_SESSION['phone'] = $phone;
        $_SESSION['mobile'] = $mobile;
        $_SESSION['card'] = $card;
        $_SESSION['expiryDate'] = $expiryDate;
        $_SESSION['salary'] = $salary;
        $_SESSION['url'] = $url;
        $_SESSION['gpa'] = $gpa;


        header('Location: thanks.php', TRUE, 301);
    }
}
?>

        <h1>Registration Form</h1>

		<p>
			This form validates user input and then displays "Thank You" page.
		</p>

		<hr />

		<h2>Please, fill below fields correctly</h2>

        <form action="index.php" method="post">

            <dl>
                <dt>Name</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isNameValid ? '' : 'is-invalid' ?>" id="name"
                               name="name" value="<?= $name ?>" placeholder="Enter Name">
                        <div class="invalid-feedback">
                            Please, enter name
                        </div>
                    </div>
                </dd>

                <dt>Email</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isEmailValid ? '' : 'is-invalid' ?>" id="email"
                               name="email" value="<?= $email ?>" placeholder="Enter Email Address">
                        <div class="invalid-feedback">
                            Please, valid email address
                        </div>
                    </div>
                </dd>

                <dt>Username</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isUsernameValid ? '' : 'is-invalid' ?>" id="username"
                               name="username" value="<?= $username ?>" placeholder="Enter Username">
                        <div class="invalid-feedback">
                            Please, enter username which is at least 5 char long
                        </div>
                    </div>
                </dd>

                <dt>Password</dt>
                <dd>
                    <div class="mb-3">
                        <input type="password" class="form-control <?= $isPswdValid ? '' : 'is-invalid' ?>" id="pswd"
                               name="pswd" value="<?= $pswd ?>" placeholder="Enter Password">
                        <div class="invalid-feedback">
                            Password contains at least 1 digit, 1 lowercase and 3 uppercase, 6-10 word characters
                        </div>
                    </div>
                </dd>

                <dt>Confirm Password</dt>
                <dd>
                    <div class="mb-3">
                        <input type="password" class="form-control <?= $isConfirmPswdValid ? '' : 'is-invalid' ?>" id="confirmPswd"
                               name="confirmPswd" value="<?= $confirmPswd ?>" placeholder="Confirm Password">
                        <div class="invalid-feedback">
                            Please, retype your password correctly
                        </div>
                    </div>
                </dd>

                <dt>Date Of Birth</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isDobValid ? '' : 'is-invalid' ?>" id="dob"
                               name="dob" value="<?= $dob ?>" placeholder="Enter Birthday">
                        <div class="invalid-feedback">
                            Please, enter birthday in format dd.mm.yyyy
                        </div>
                    </div>
                </dd>

                <dt>Gender</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isGenderValid ? '' : 'is-invalid' ?>" id="gender"
                               name="gender" value="<?= $gender ?>" placeholder="Enter Gender">
                        <div class="invalid-feedback">
                            Please, enter Male or Female
                        </div>
                    </div>
                </dd>

                <dt>Marital Status</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isMaritalValid ? '' : 'is-invalid' ?>" id="maritalStatus"
                               name="maritalStatus" value="<?= $maritalStatus ?>" placeholder="Enter Marital Status">
                        <div class="invalid-feedback">
                            Please, enter one of Single, Married, Divorced, Widowed
                        </div>
                    </div>
                </dd>

                <dt>City</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isCityValid ? '' : 'is-invalid' ?>" id="city"
                               name="city" value="<?= $city ?>" placeholder="Enter City">
                        <div class="invalid-feedback">
                            Please, enter city
                        </div>
                    </div>
                </dd>

                <dt>Address</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isAddressValid ? '' : 'is-invalid' ?>" id="address"
                               name="address" value="<?= $address ?>" placeholder="Enter Address">
                        <div class="invalid-feedback">
                            Please, enter address in 15 Gordon St, 3121 Cremorne, Australia format
                        </div>
                    </div>
                </dd>

                <dt>Postal Code</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isPostalCodeValid ? '' : 'is-invalid' ?>" id="postalCode"
                               name="postalCode" value="<?= $postalCode ?>" placeholder="Enter postal code"
                               maxlength="6">
                        <div class="invalid-feedback">
                            Please, enter postal code which is 6 digits long
                        </div>
                    </div>
                </dd>

                <dt>Home Phone</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isPhoneValid ? '' : 'is-invalid' ?>" id="phone"
                               name="phone" value="<?= $phone ?>" placeholder="Enter Home Phone">
                        <div class="invalid-feedback">
                            Please, enter home phone like 97 1234567
                        </div>
                    </div>
                </dd>

                <dt>Mobile Phone</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isMobileValid ? '' : 'is-invalid' ?>" id="mobile"
                               name="mobile" value="<?= $mobile ?>" placeholder="Enter Home Phone">
                        <div class="invalid-feedback">
                            Please, enter mobile phone like 97 1234567
                        </div>
                    </div>
                </dd>

                <dt>Credit Card Number</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isCardValid ? '' : 'is-invalid' ?>" id="card"
                               name="card" value="<?= $card ?>" placeholder="Enter Card Number">
                        <div class="invalid-feedback">
                            Please, enter credit card number
                        </div>
                    </div>
                </dd>


                <dt>Credit Card Expiry Date</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isExpiryDateValid ? '' : 'is-invalid' ?>" id="expiryDate"
                               name="expiryDate" value="<?= $expiryDate ?>" placeholder="Enter Birthday">
                        <div class="invalid-feedback">
                            Please, enter Expiry Date in format dd.mm.yyyy
                        </div>
                    </div>
                </dd>

                <dt>Monthly Salary</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isSalaryValid ? '' : 'is-invalid' ?>" id="salary"
                               name="salary" value="<?= $salary ?>" placeholder="Enter Monthly Salary">
                        <div class="invalid-feedback">
                            Please, enter monthly salary
                        </div>
                    </div>
                </dd>

                <dt>Web Site URL</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isURLValid ? '' : 'is-invalid' ?>" id="url"
                               name="url" value="<?= $url ?>" placeholder="Enter Web Site URL">
                        <div class="invalid-feedback">
                            Please, enter web site URL
                        </div>
                    </div>
                </dd>

                <dt>Overall GPA</dt>
                <dd>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= $isGPAValid ? '' : 'is-invalid' ?>" id="gpa"
                               name="gpa" value="<?= $gpa ?>" placeholder="Enter Overall GPA">
                        <div class="invalid-feedback">
                            Please, enter overall GPA
                        </div>
                    </div>
                </dd>

            </dl>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>
        </form>
<?php
include "footer.php";
?>