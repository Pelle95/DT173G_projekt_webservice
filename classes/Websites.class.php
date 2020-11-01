<?php
class Websites
{
    // Lagrar databasvariabel
    private $db;

    // Konstruerare
    public function __construct()
    {
        // Skapar databasanslutning
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }
    // Hämtar webbplatser
    public function getWebsites()
    {
        // Fråga till databasen
        $sql = "SELECT * FROM `dt173g_proj_websites`";
        // Svar från databasen
        $result = $this->db->query($sql);

        // Returnerar ett svar som en array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    // Skapar ny webbplats
    public function addWebsite($websitetitle, $websiteurl, $description)
    {
        $sql = "INSERT INTO `dt173g_proj_websites`(`websitetitle`,`websiteurl`,`description`) VALUES('$websitetitle', '$websiteurl', '$description')";
        $result = $this->db->query($sql);

        return $result;
    }
    // Tar bort webbplats
    public function deleteWebsite($websiteid)
    {
        $sql = "DELETE FROM `dt173g_proj_websites` WHERE `websiteid`=$websiteid";
        $result = $this->db->query($sql);

        return $result;
    }
    // Uppdaterar webbplats
    public function updateWebsite($websiteid, $websitetitle, $websiteurl, $description)
    {
        $sql = "UPDATE `dt173g_proj_websites` SET `websitetitle`='$websitetitle', `websiteurl`='$websiteurl', `description`='$description' WHERE `websiteid`=$websiteid";
        $result = $this->db->query($sql);

        return $result;
    }
}
