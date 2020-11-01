<?php
class Courses
{
    // Lagrar databasvariabel
    private $db;
    // Konstrurerare
    public function __construct()
    {
        // Ansluter till databas
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }
    // Hämtar kurser
    public function getCourses()
    {
        // Fråga till databasen
        $sql = "SELECT * FROM `dt173g_proj_courses`";
        // Svar från databasen
        $result = $this->db->query($sql);
        
        // Returnerar svar som en array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    // Lägger till kurser
    public function addCourse($coursename, $schoolname, $date_start, $date_end)
    {
        $sql = "INSERT INTO `dt173g_proj_courses`(`coursename`,`schoolname`,`date_start`,`date_end`) VALUES('$coursename', '$schoolname', '$date_start', '$date_end')";
        $result = $this->db->query($sql);

        return $result;
    }
    // Tar bort kurser
    public function deleteCourse($courseid)
    {
        $sql = "DELETE FROM `dt173g_proj_courses` WHERE `courseid`=$courseid";
        $result = $this->db->query($sql);

        return $result;
    }
    // Uppdatera kurser
    public function updateCourse($courseid, $coursename, $schoolname, $date_start, $date_end)
    {
        $sql = "UPDATE `dt173g_proj_courses` SET `coursename`='$coursename', `schoolname`='$schoolname', `date_start`='$date_start', `date_end`='$date_end' WHERE `courseid`=$courseid";
        $result = $this->db->query($sql);

        return $result;
    }
}