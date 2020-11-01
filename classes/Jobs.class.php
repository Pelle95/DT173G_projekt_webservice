<?php
class Jobs
{
    // Lagrar databasvariabel
    private $db;
    // Konstruerare
    public function __construct()
    {
        // Ansluter till databas
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if($this->db->connect_errno > 0)
        {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }
    // Hämtar jobb
    public function getJobs()
    {
        // Fråga till databasen
        $sql = "SELECT * FROM `dt173g_proj_jobs`";
        // Svar från databasen
        $result = $this->db->query($sql);
        
        // Returnerar ett svar som en array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    // Lägger till nytt jobb
    public function addJob($jobtitle, $workplace, $date_start, $date_end)
    {
        $sql = "INSERT INTO `dt173g_proj_jobs`(`jobtitle`,`workplace`,`date_start`,`date_end`) VALUES('$jobtitle', '$workplace', '$date_start', '$date_end')";
        $result = $this->db->query($sql);

        return $result;
    }
    // Tar bort jobb
    public function deleteJob($jobid)
    {
        $sql = "DELETE FROM `dt173g_proj_jobs` WHERE `jobid`=$jobid";
        $result = $this->db->query($sql);

        return $result;
    }
    // Uppdaterar jobb
    public function updateJob($jobid, $jobtitle, $workplace, $date_start, $date_end)
    {
        $sql = "UPDATE `dt173g_proj_jobs` SET `jobtitle`='$jobtitle', `workplace`='$workplace', `date_start`='$date_start', `date_end`='$date_end' WHERE `jobid`=$jobid";
        $result = $this->db->query($sql);

        return $result;
    }
}