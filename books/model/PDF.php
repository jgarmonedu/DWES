<?php
/* FPDF Table with MySQL
 * Author: Olivier
 * License: FPDF 
 * http://www.fpdf.org/en/script/script14.php

 */

require_once 'PdfTable.php';
require_once 'Database.php';

class PDF extends PdfTable
{
    function Header()
    {
        // Title
        $this->SetFont('Arial', '', 18);
        $this->Cell(0, 6, utf8_decode('Books'), 0, 1, 'C');
        $this->Ln(10);
        // Ensure table header is printed
        parent::Header();
    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function ShowTable($order, $type, $limit) {
        $pdo = Database::connect();
        $query = "SELECT isbn, Title, Author, Publisher FROM Books ORDER BY ". $order." " . $type. " LIMIT ". $limit;
        return $this->Table($pdo,$query);
       
    }
}


?>
