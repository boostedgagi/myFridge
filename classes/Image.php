<?php

class Image{

    private string $fileName;
    private string $tempFileName;
    private string $fileError;
    private int $fileSize;
    private string $path;

    public function __construct(string $fileName, string $tempFileName, string $fileError, int $fileSize,string $path)
    {
        $this->fileName = $fileName;
        $this->tempFileName = $tempFileName;
        $this->fileError = $fileError;
        $this->fileSize = $fileSize;
        $this->path = $path;
    }


    public function handlePictureAndItsLocation(): string
    {
        if ($this->fileError == 4) {
            return $this->operationHandler()[0];
        }
        if ($this->checkForAllowedFormats($this->makeExtensionUsable()) === false) {
            header("location: ../index.php?error=these_files_are_not_allowed");
            exit();
        }
        if ($this->fileError != 0) {
            header("location: ../index.php?error=upload_failed");
            exit();
        }
        if ($this->fileSize > 5000000) {
            header("location: ../index.php?error=picture_is_too_big");
            exit();
        }

        $actualExtension = $this->makeExtensionUsable();
        //$finalDestination = "";

        $newFileName = uniqid('', true) . "." . $this->makeExtensionUsable();
//        $newFileName = uniqid('', true) . "." . $actualExtension;

        //$finalDestination = SHORT_PATH_PROF_PIC . $newFileName;//FULL_PATH, SHORT_PATH su konstante iz fajla constants, vazi za oba bloka
        move_uploaded_file($this->tempFileName, $this->operationHandler()[1] . $newFileName);
        return $this->operationHandler()[2] . $newFileName;//FULL_PATH, SHORT_PATH su konstante iz fajla constants, vazi za oba bloka

        //return $finalDestination;
    }

    private function checkForAllowedFormats($ext): bool
    {
        require_once "../includes/constants.php";
        if (in_array($ext, ALLOWEDFORMATS)) {
            return true;
        }
        return false;
    }

    private function makeExtensionUsable(): string
    {
        $extension = explode('.', $this->fileName);
        return strtolower(end($extension));
    }

    private function operationHandler():array{
        require_once "../includes/constants.php";
        switch ($this->path) {
            case "registerUser":
                return [NO_PROF_PIC_PIC,FULL_PATH_PROF_PIC,SHORT_PATH_PROF_PIC,''];
                break;
            case "updateUser":
                return [NO_PROF_PIC_PIC,FULL_PATH_PROF_PIC,SHORT_PATH_PROF_PIC,'unlink'];
                break;
            case "adminGrocerie":
                return [NO_GROC_PIC_PIC,FULL_PATH_GROC_PIC,SHORT_PATH_GROC_PIC,''];
                break;
            case "updateGrocerie":
                //return [NO_GROC_PIC_PIC,FULL_PATH_PROF_PIC,SHORT_PATH_PROF_PIC,''];
                break;
            case "newRecipe":
                return [NO_RECIPE_PIC,FULL_PATH_RECIPE_PIC,SHORT_PATH_RECIPE_PIC,''];
                break;
        }
    }

    public function unlink($path): void
    {
        if($path!==NO_PROF_PIC_PIC || $path!==NO_RECIPE_PIC || $path!==NO_GROC_PIC_PIC) {
            unlink('../' . $path);
        }
    }






}