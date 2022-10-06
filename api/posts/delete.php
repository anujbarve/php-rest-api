<?php 
// headers
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authrization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Posts.php';

// instantiate db and connect
$database = new Database();
$db = $database->connect();

// instantiate blog post object
$post = new Post($db);

// Get raw posted data

$data = json_decode(file_get_contents("php://input"));

// Set ID to update 
$post->id = $data->id;

// Delete Post
if($post->delete()){
    echo json_encode(
        array('message' => 'Post Successfully Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Post NOT Deleted')
    );
}