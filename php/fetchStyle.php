<?php
namespace Classes;

//include error handling
ini_set('display_errors', 1);

//include init

require_once __DIR__ . '/connectToDatabase.php';

use Classes\Connection;

class FetchStyle {
    private $dbConnection;

    public function __construct() {
        $connection = new Connection();
        $this->dbConnection = $connection->get_connection();
    }

    public function fetch_style() {
        $sql = "SELECT * FROM style";
        $result = $this->dbConnection->query($sql);

        if ($result->num_rows > 0) {
            $styles = array();
            while ($row = $result->fetch_assoc()) {
                $styles[] = $row;
            }
            return $styles;
        } else {
            return null;
        }
    }

    public function fetch_style_by_id($id) {
        $sql = "SELECT * FROM style WHERE id = ?";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

}
?>