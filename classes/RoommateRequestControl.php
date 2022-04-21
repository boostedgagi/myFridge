<?php

class RoommateRequestControl extends RoommateRequest{
    private int $requestID;
    private string $operation;

    public function __construct($requestID,$operation)
    {
        $this->requestID=$requestID;
        $this->operation=$operation;
    }

    public function acceptOrDenyRequest():void{
        if($this->operation==="accept"){
            $this->acceptRequestBase($this->requestID);
        }
        else if($this->operation==="deny"){
            $this->denyRequestBase($this->requestID);
        }
    }


}