<?php
/**
 * @Desc       BookStoreApi Class for all CURD operations
 * @Date       25-06-2020
 * @Author     Sapan Mohanty
 * @Skype      sapan.mohannty
 * @github     https://github.com/travelxml
 */

ini_set('display_errors', false);
//error_reporting(E_ALL);

require 'config/Database.php';
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;


class BookStoreApi
{

    function __construct()
    {
        $headers = $_SERVER; //apache_request_headers();
        $this->token = isset($headers['HTTP_AUTH']) ? $headers['HTTP_AUTH'] : '';
        $this->key = "BookStoreAPI64#$%%^&*@@HS256";
        $this->actionArray = array(
            'create_book',
            'read_book',
            'update_book',
            'delete_book'
        );

        $this->database = new Database();
        $this->db = $this->database->connect();
        $this->response = "";
    }
    
    function ResponseJson($jsonString = NULL)
    {
        $this->cors();
        echo json_encode($jsonString);
        exit;
    }

    /* Regular json_encode would return NULL due to memory issues.
     * @param $arr
     * @return string
    */
    private function jsonEncode($arr)
    {
        $str = '{';
        $count = count($arr);
        $current = 0;

        foreach ($arr as $key => $value)
        {
            $str .= sprintf('"%s":', $this->sanitizeForJSON($key));

            if (is_array($value))
            {
                $str .= '[';
                foreach ($value as & $val)
                {
                    $val = $this->sanitizeForJSON($val);
                }
                $str .= '"' . implode('","', $value) . '"';
                $str .= ']';
            }
            else
            {
                $str .= sprintf('"%s"', $this->sanitizeForJSON($value));
            }

            $current++;
            if ($current < $count)
            {
                $str .= ',';
            }
        }

        $str .= '}';

        echo $str;
        exit;
    }

    /**
     * @param string $str
     * @return string
     */
    private function sanitizeForJSON($str)
    {
        // Strip all slashes:
        $str = stripslashes($str);

        // Only escape backslashes:
        $str = str_replace('"', '\"', $str);

        return $str;
    }

    /**
     * @Desc Validate Authentication
     */
    function validAuth()
    {
        if ($this->token != "") // Auth Token
        {
            //echo "token id".$this->token.", token key: ".$this->key;
            $decodedv = JWT::decode($this->token, $this->key, array(
                'HS256'
            ));
            //print_r($decodedv);
            $existUserId = $decodedv->id;
            $existUsserEmail = isset($decodedv->email) ? $decodedv->email : '';
            $existUserName = isset($decodedv->user_name) ? $decodedv->user_name : '';
            $query = 'SELECT user_id FROM users WHERE user_id = :user_id AND email = :email AND user_name = :user_name LIMIT 0,1';   
            $getBooks = $this->db->prepare( $query );
            $getBooks->bindParam( ':user_id', $existUserId );
            $getBooks->bindParam( ':email', $existUsserEmail );
            $getBooks->bindParam( ':user_name', $existUserName );
            $getBooks->execute();
            $noOfRecords = $getBooks->fetch();

            if (!$noOfRecords) {
                return 0;

            } else {
                return $existUserId;
            }            
        }
        else
        {
            return 0;
        }
    }
    /**
     * @Desc Validate API Request parameters
     * @Return Json Error
     */
    function validateApiP($apiRequests = NULL)
    {
        $apiP = explode(",", $apiRequests);
        $cnt = 1;
        foreach ($apiP as $key => $value)
        {
            $explodeIndividual = explode("@|@", $value);
            $requestValue = isset($_POST[trim($explodeIndividual[0]) ]) ? $_POST[trim($explodeIndividual[0]) ] : $this->{trim($explodeIndividual[0]) };
            $typeOfVariable = $explodeIndividual[1];
            switch ($typeOfVariable)
            {
                case 'not_blank':
                    if (trim($requestValue) == '') $this->displayError($explodeIndividual[0] . ' can\'t be blank', $this->WhatToDo . ':' . $cnt, __LINE__);
                    break;
                case 'int':
                    if (isset($requestValue) && is_numeric($requestValue)){}
                    else
                    {
                        $this->displayError($explodeIndividual[0]. ' should be numeric', $this->WhatToDo . ':' . $cnt, __LINE__);
                    }
                    break;
                case 'date':
                    if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $requestValue)) {
                    } else {
                        $this->displayError($explodeIndividual[0] . ' date should be YYYY-MM-DD format', $this->WhatToDo . ':' . $requestValue, __LINE__);
                    }
                    break;   

                case 'isbn_10':
                    $check = 0;
                    for ($i = 0; $i < 10; $i++) {
                        if ('x' === strtolower($requestValue[$i])) {
                            $check += 10 * (10 - $i);
                        } elseif (is_numeric($requestValue[$i])) {
                            $check += (int)$requestValue[$i] * (10 - $i);
                        } else {
                            return false;
                        }
                    }
                    if( (0 === ($check % 11)) ){ }else {

                        $this->displayError($explodeIndividual[0] . ' should be valid isbn10 no.' , $this->WhatToDo . ':' . $cnt, __LINE__);

                     }
 
                 break;   
                }
                $cnt++;
            }
        }
        /**
         * @Desc Format JSON Error
         */
        function displayError($error = NULL, $error_no = NULL, $line_no = NULL)
        {
            $error = ($error != "") ? $error : 'Wrong Parameters';
            $error_no = ($error_no > 0) ? $error_no : 103;
            $result['error'] = $error;
            $result['error_no'] = intval($error_no);
            $this->cors();
            echo json_encode($result);
            exit;
        }

        function jwtEncode(){

            $userArray =['id' => 1, 'user_name'=> 'sapan', 'email' => 'ctoattraveltech@gmail.com']; // just hardcoded for now .. it can be pull from users table as well
            return JWT::encode($userArray, $this->key);
        }

        /**
         * @Desc it takes request & build JSON response
         */
        function storeApi($APIRequest)
        {

            $this->requestDetails = json_decode(trim($APIRequest), true);

            if (json_last_error() > 0)
            {
                $this->displayError('Invalid JSON input', '999', __LINE__);
            } 
            $this->WhatToDo = $this->requestDetails['action'];
            $this->userId = $this->validAuth();
            if ( $this->userId < 1) {

                $this->displayError('Invalid Auth Token', '112', __LINE__);

            }
            foreach ($this->requestDetails as $key => $value) {
                $this->requestDetails[trim($key) ] = $value;
                $specialChar = array("%0D%0A", "%C2%A0");
                $specialCharWith = array("", "");
                $$key = isset($$key) ? str_replace($specialChar, $specialCharWith, $$key) : '';
                if (get_magic_quotes_gpc()) { //echo "MQ enabled.<br />";
                    if (!is_array($$key)) { //echo "Not an array, going to stripslashes.<br />";
                        $$key = stripslashes(trim(urldecode($value)));
                    } else { //echo "Is an array, NOT going to stripslashes.<br />";
                        $$key = trim(urldecode($value));
                    }
                } else {
                    $$key = trim(urldecode($value));
                }
                $$key = utf8_decode($$key); //necessary for $$key =str_replace("%C2%A0","",$$key); condition does not work and many other characters
                 //echo "\$$key = ".$$key."<br />";
                
            }
            $results = array( );
            switch ($this->WhatToDo)
            {
                case 'create_book':  // create a book              

                    $this->author = isset( $this->requestDetails['author_name'] ) ?$this->requestDetails['author_name']:'';
                    $this->title = isset( $this->requestDetails['title'] ) ?$this->requestDetails['title']:'';
                    $this->isbn = isset( $this->requestDetails['isbn'] ) ?$this->requestDetails['isbn']:'';
                    $this->releaseDate = isset( $this->requestDetails['release_date'] ) ?$this->requestDetails['release_date']:'';
                    $this->validateApiP('author@|@not_blank,title@|@not_blank,isbn@|@isbn_10');
                    $query = 'INSERT INTO books SET  author_name = :author_name, title = :title, isbn = :isbn, user_id = :user_id';
                    if($this->releaseDate != "") {
                        $this->validateApiP('release_date@|@date');
                        $query .= ', release_date = :release_date';
                    } 
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':author_name', $this->author);
                    $stmt->bindParam(':title', $this->title);
                    $stmt->bindParam(':isbn', $this->isbn);
                    $stmt->bindParam(':user_id', $this->userId);
                    
                    if($this->releaseDate != "") { 
                        $stmt->bindParam(':release_date', $this->release_date);
                    }

                    try {
                        $stmt->execute();
                        $success = 1;
                        $displayMessage = ['message' => 'book created successfully'];

                    } catch (PDOException $e) {
                        $success = 0;
                        if ($e->errorInfo[1] == 1062) {                            
                            $displayMessage = ['message' => 'duplicate entry'];
                        } else {
                            $displayMessage = ['message' => 'db error'];

                        }
                    } 
                    $results['success'] = $success;
                    $results['data'] = $displayMessage;
                    $this->ResponseJson( $results );

                break;
                case 'update_book':  // update a book

                    $this->author = isset( $this->requestDetails['author_name'] ) ?$this->requestDetails['author_name']:'';
                    $this->title = isset( $this->requestDetails['title'] ) ?$this->requestDetails['title']:'';
                    $this->isbn = isset( $this->requestDetails['isbn'] ) ?$this->requestDetails['isbn']:'';
                    $this->releaseDate = isset( $this->requestDetails['release_date'] ) ?$this->requestDetails['release_date']:'';
                    $this->id = isset( $this->requestDetails['id'] ) ?$this->requestDetails['id']:'';

                    $this->validateApiP('id@|@int,author@|@not_blank,title@|@not_blank,isbn@|@isbn_10');
                    $query = 'UPDATE books SET  author_name = :author_name, title = :title, isbn = :isbn, user_id = :user_id';
                    if($this->releaseDate != "") {
                        $this->validateApiP('release_date@|@date');
                        $query .= ', release_date = :release_date';
                    } 
                    $query .= ' WHERE book_id =:id ';
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':author_name', $this->author);
                    $stmt->bindParam(':title', $this->title);
                    $stmt->bindParam(':isbn', $this->isbn);
                    $stmt->bindParam(':id', $this->id);
                    $stmt->bindParam(':user_id', $this->userId);

                    if($this->releaseDate != "") { 
                        $stmt->bindParam(':release_date', $this->release_date);
                    }

                    try {
                        $stmt->execute();
                        $success = 1;
                        $displayMessage = ['message' => 'book details are updated successfully'];

                    } catch (PDOException $e) {
                        $success = 0;
                        if ($e->errorInfo[1] == 1062) {                            
                            $displayMessage = ['message' => 'duplicate entry'];
                        } else {
                            $displayMessage = ['message' => 'db error'];

                        }
                    } 
                    $results['success'] = $success;
                    $results['data'] = $displayMessage;
                    $this->ResponseJson( $results );


                break;
                case 'read_book':   // read  books // or a book
                    $this->id = isset( $this->requestDetails['id'] ) ?$this->requestDetails['id']:'';
                    $query = 'SELECT book_id, title, author_name, isbn, release_date,last_update FROM books WHERE user_id = :user_id';   

                    if($this->id != ''){
                        $this->validateApiP('id@|@int');
                        $query .=" AND book_id = :book_id LIMIT 0,1";
                        $getBooks = $this->db->prepare($query);
                        $getBooks->bindParam(':book_id', $this->id);
                    } else {
                        $getBooks = $this->db->prepare($query);
                    }
                    $getBooks->bindParam(':user_id', $this->userId);
                    $booksArr = array();
                    $getBooks->execute();
                    $success = 1;
                    while($row = $getBooks->fetch(PDO::FETCH_ASSOC)){
                            extract($row);
                            $bookItem = array(
                                'id' => $book_id,
                                'title' => $title,
                                'author' => $author_name,
                                'isbn' => $isbn,
                                'release_date' => $release_date,
                                'last_update' => $last_update
                            );
                    array_push($booksArr, $bookItem);
                }
                    $results['success'] = $success;

                    $results['data'] = (count($booksArr)>0)?$booksArr:['message' => 'invalid id'];
                    $this->ResponseJson( $results );
                break;

                case 'delete_book': // delete a book
                    $this->id = isset( $this->requestDetails['id'] ) ?$this->requestDetails['id']:'';
                    $this->validateApiP('id@|@int');
                    $query = 'DELETE FROM books WHERE book_id = :id AND user_id = :user_id';
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':id', $this->id);
                    $stmt->bindParam(':user_id', $this->userId);
                    try {
                        $stmt->execute();
                        if ($stmt->rowCount()) {
                            $success = 1;
                            $displayMessage = ['message' => 'book deleted successfully'];
                       } else{
                            $success = 0;
                            $displayMessage = ['message' => 'invalid id'];                

                       }

                    } catch (PDOException $e) {
                        //var_dump($e);
                        $success = 0;
                        $displayMessage = ['message' => 'invalid id'];                        
                    } 
                    $results['success'] = $success;
                    $results['data'] = $displayMessage;
                    $this->ResponseJson( $results );


                break;

            }

        }

    function cors() {

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        
    }

    header('Content-Type: application/json; charset=utf-8');

}


    } // class end
    
?>
