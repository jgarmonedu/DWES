<?php
// How to Create a SOAP Client/Server in PHP (Added Authentification) - Part 02
// https://www.youtube.com/watch?v=6V_myufS89A

class ManageAutomobilesAuth {
    private $con;
    private $IsAuthenticated;

    public function __construct() {
        $this->con = (is_null($this->con)) ? self::connect() : $this->con;
        $this->IsAuthenticated = false;
    }

    // singleton
    static function connect() {
        try {
            $user = "coches";
            $pass = "coches";
            $dbname = "coches";
            $host = "localhost";

            $con = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            print "<p>Error: " . $e->getMessage() . "</p>\n";
            return null;
            //exit();
        }
    }

    public function authenticate($header_params) {
        if ($header_params->username == 'ies' && $header_params->password == 'daw') {
            $this->IsAuthenticated = true;
            return true;
        } else {
            throw new SoapFault('Wrong user/pass combination', 401);
        }
    }

    public function getBrandById($id) {
        if (is_null($this->con)) return "ERROR";
        if (!$this->IsAuthenticated) return "Not Authenticated";

        $sql = "SELECT * FROM marcas WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        return $res;
    }
    public function getBrandsUrl() {
        if (is_null($this->con)) return "ERROR";
        if (!$this->IsAuthenticated) return "Not Authenticated";

        $sql = "SELECT * FROM marcas";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $res;
    }
    public function getModelsByBrand($brand) {
        if (is_null($this->con)) return "ERROR";
        if (!$this->IsAuthenticated) return "Not Authenticated";
        if (!is_string($brand)) return "Brand must be a string";

        $sql = "SELECT modelo FROM modelos WHERE marca = :marca";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':marca' => $brand]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $res;
    }

} // end class

$params = array('uri' => 'http://localhost/automobiles/soap-automobiles/server-automobiles-auth.php',
                'encoding' => 'UTF-8' );
$server = new SoapServer(null, $params);
$server->setClass('ManageAutomobilesAuth');
$server->handle();

