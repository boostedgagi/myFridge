<?php
include "../includes/constants.php";

class RegisterControl extends Register
{
    private string $firstName;
    private string $lastName;
    private string $phone;
    private string $email;
    private string $password;
    private string $passwordRepeat;
    private string $country;
    private string $city;
    private string $profilePicturePath;
    private int $nineDigitVerificationCode;

    public function __construct($firstName, $lastName, $phone, $email, $password, $passwordRepeat, $country, $city, $profilePicturePath, $tenDigitVerifyingCode)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
        $this->country = $country;
        $this->city = $city;
        $this->profilePicturePath = $profilePicturePath;
        $this->nineDigitVerificationCode = $tenDigitVerifyingCode;
    }

    public function registerNewUser()
    {
        if ($this->emptyEntries() === false) {
            header("location: ../register.php?error=empty_entries");
            exit();
        }
        if ($this->invalidEmail() === false) {
            header("location: ../register.php?error=username_failed");
            exit();
        }
        if ($this->differentPasswords() === false) {
            header("location: ../register.php?error=passwords_are_different");
            exit();
        }
        if ($this->checkUserExistence($this->email) === false) {
            header("location: ../register.php?error=this_email_is_already_taken");
            exit();
        }
        if ($this->checkFNameLength() === false) {
            header("location: ../register.php?error=first_name_is_too_long");
            exit();
        }
        if ($this->checkLNameLength() === false) {
            header("location: ../register.php?error=last_name_is_too_long");
            exit();
        }
        if ($this->checkCityLength() === false) {
            header("location: ../register.php?error=city_name_is_too_long");
            exit();
        }
        if ($this->checkCountryLength() === false) {
            header("location: ../register.php?error=country_name_is_too_long");
            exit();
        }

        $this->registerUserWithQuery(
            $this->firstName,
            $this->lastName,
            $this->phone,
            $this->email,
            $this->password,
            $this->country,
            $this->city,
            $this->profilePicturePath,
            $this->nineDigitVerificationCode
        );
    }

//echo '<script type="text/javascript">alert("Username and password incorrect!");     window.location="login.php";</script>'; //trebace

    public function setProfilePicturePath($path)
    {
        $this->profilePicturePath = $path;
    }


    public function setVerifyingCode($code)
    {
        $this->nineDigitVerificationCode = $code;
    }


    private function emptyEntries(): bool
    {

        if (empty($this->firstName) || empty($this->lastName) || empty($this->phone) || empty($this->email) || empty($this->password) || empty($this->passwordRepeat)) {
            return false;
        }
        return true;
    }

    private function invalidEmail(): bool
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    private function differentPasswords(): bool
    {
        if ($this->password !== $this->passwordRepeat) {
            return false;
        }
        return true;
    }

    public function uploadPictureLocation($fileName, $tempFileName, $fileError, $fileSize, $path): string
    {
        if ($fileError === 4) {
            if($path===1){
            return NO_PROF_PIC_PIC;}
            else if($path===2){
                return NO_PROF_PIC_PIC;
            }
        }

        if ($this->checkForAllowedFormats($this->makeExtensionUsable($fileName)) === false) {
            header("location: ../index.php?error=these_files_are_not_allowed");
            exit();
        }
        if ($fileError !== 0) {
            header("location: ../index.php?error=upload_failed");
            exit();
        }
        if ($fileSize > 5000000) {
            header("location: ../index.php?error=picture_is_too_big");
            exit();
        }

        $actualExtension = $this->makeExtensionUsable($fileName);
        $finalDestination = "";
//ovaj deo mora da se menja zbog uploada slika namirnica

        $newFileName = uniqid('', true) . "." . $actualExtension;
        if ($path === 1) {
            $finalDestination = SHORT_PATH_PROF_PIC . $newFileName;//FULL_PATH, SHORT_PATH su konstante iz fajla constants, vazi za oba bloka
            move_uploaded_file($tempFileName, FULL_PATH_PROF_PIC . $newFileName);
        } else if ($path === 2) {
            $finalDestination = SHORT_PATH_GROC_PIC . $newFileName;
            move_uploaded_file($tempFileName, FULL_PATH_GROC_PIC . $newFileName);
        }
        return $finalDestination;
    }

    private function checkForAllowedFormats($ext): bool
    {
        require_once "../includes/constants.php";
        if (in_array($ext, ALLOWEDFORMATS)) {
            return true;
        }
        return false;
    }

    private function makeExtensionUsable($fileName): string
    {
        $extension = explode('.', $fileName);
        $actualExtension = strtolower(end($extension));
        return $actualExtension;
    }

    private function checkFNameLength(): bool
    {
        if (strlen($this->firstName) < FNAME_LENGTH) {
            return true;
        }
        return false;
    }

    private function checkLNameLength(): bool
    {
        if (strlen($this->lastName) < LNAME_LENGTH) {
            return true;
        }
        return false;
    }

    private function checkCityLength(): bool
    {
        if (strlen($this->city) < CITY_LENGTH) {
            return true;
        }
        return false;
    }

    private function checkCountryLength(): bool
    {
        if (strlen($this->country) < COUNTRY_LENGTH) {
            return true;
        }
        return false;
    }

    private function validPhoneNumber(): bool
    {
        if (in_array(strlen($this->phone), PHONE_NUMBER - LENGTHS)) {
            return true;
        }
        return false;
    }

    private function checkUser(): bool
    {
        if ($this->checkUserExistence($this->email) === false) {
            return false;
        }
        return true;
    }
}
