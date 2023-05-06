<?php

class HEM
{
    private $imageurl;
	private $title;
    private $keyword;
    private $descriptions;
    private $publishDate;
    private $lastUpdate;
    private $author;
    
    function __construct()
    {
        include("config.php");

        $this->conn = $conn;
    }
	
	public function CreateHEM($imageurl, $title, $keyword, $descriptions, $publishDate, $lastUpdate, $author) {
        $sql = "INSERT INTO hem(hemImageURL,hemTitle, hemKeyword, hemDesc, hemPublishedDate, hemLastUpdate, author)
        VALUES ('$imageurl', '$title', '$keyword', '$descriptions', '$publishDate', '$publishDate', '$author')";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function getAllHem() {
        $sql = "SELECT * FROM hem";

        $result = @$this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $materialArr[] = $row;
        }

        return $materialArr;
    } 

    public function searchHem($title, $keyword, $author) {
        $sql = "SELECT * FROM hem WHERE hemTitle IS NOT NULL ";

        if ($title != null) {
            $sql .= "AND hemTitle LIKE '%$title%' ";
        }

        if ($keyword != null) {
            $sql .= "AND hemKeyword LIKE '%$keyword%' ";
        }

        if ($author != null) {
            $sql .= "AND author LIKE '%$author%' ";
        }

        $result = @$this->conn->query($sql);
        return $result;
    }

    public function getIndivHem($materialID) 
    {
        $sql = "SELECT * FROM hem WHERE hemID = '$materialID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function deleteHem($materialID) {
        $sql = "DELETE FROM hem WHERE hemID = '$materialID'";
        $result = @$this->conn->query($sql);
        return $result;
    }

    public function updateHem($img, $materialID, $title, $descriptions, $lastUpdate) {
        $sql = "UPDATE hem SET ";

        if (!empty($img)) {
            $sql .= "hemImageURL = '$img',";
        }

        if (!empty($title)) {
            $sql .= "hemTitle = '$title',";
        }

        if (!empty($descriptions)) {
            $sql .= "hemDesc = '$descriptions',";
        }

        if (!empty($lastUpdate)) {
            $sql .= "hemLastUpdate = '$lastUpdate',";
        }

        // Take away the comma at the back of string
        $sql = substr($sql, 0, -1);

        $sql .= "WHERE hemID = '$materialID'";

        $result = @$this->conn->query($sql);

        if ($result === TRUE) {
            return $validation = TRUE;
        }
        else {
            return $validation = FALSE;
        }
    }

    public function getHem() 
    {
        $hemArr = array();

        $sql = "SELECT * FROM hem ";
        $result = @$this->conn->query($sql);

        while($row= $result->fetch_assoc()){
            $hemArr[]=$row;
        }
        return $result;
    }


}
?>