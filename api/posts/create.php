<?php 
// headers
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// Create post

if($post->create()){
    echo json_encode(
        array('message' => 'Post Successfully Created')
    );
}else{
    echo json_encode(
        array('message' => 'Post NOT Created')
    );
}