<?php

class NewGrocerieAdminControl extends NewGrocerieAdmin
{

    private string $grocerieName;
    private string $grocerieUnit;
    private string $groceriePicturePath;

    public function __construct($grocerieName, $grocerieUnit, $groceriePicturePath)
    {
        $this->grocerieName = $grocerieName;
        $this->grocerieUnit = $grocerieUnit;
        $this->groceriePicturePath = $groceriePicturePath;
    }

    public function setGrocPPPath($grocerieImage){
        $this->groceriePicturePath = $grocerieImage;
    }

    public function insertNewGrocerie(){

        $this->insertNewSuggestedGrocerie($this->grocerieName,$this->grocerieUnit,$this->groceriePicturePath);
    }


    public function uploadPictureLocation($fileName, $tempFileName, $fileError, $fileSize): string
    {
        if ($fileError === 4) {
            return NO_GROC_PIC_PIC;
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

        $newFileName = uniqid('', true) . "." . $actualExtension;

        $finalDestination = SHORT_PATH_GROC_PIC . $newFileName;
        move_uploaded_file($tempFileName, FULL_PATH_GROC_PIC . $newFileName);

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
        return strtolower(end($extension));
    }
}
