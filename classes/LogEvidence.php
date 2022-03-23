<?php

class LogEvidence extends Database
{
    protected function recordUserLogIn($email)
    {
        $recordLog = $this->connect()->prepare('call recordLog(?)');
        if (!$recordLog->execute(array($email))) {
            $recordLog = null;
            header("location: ..index.php?error=failed_log_recording");
            exit();
        }
    }
}
