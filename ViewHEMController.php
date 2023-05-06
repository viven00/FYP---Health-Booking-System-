<?php
include_once("HEM.php"); 

class ViewHemController
{
    public function searchHem($title, $keyword, $author) 
    {
        $hem = new Hem();
        $result = $hem->searchHem($title, $keyword, $author);
        return $result;
    }

    public function getIndivHem($materialID)
    {
		$hem = new Hem();
		$result = $hem->getIndivHem($materialID);
        return $result;
    }
}
?>