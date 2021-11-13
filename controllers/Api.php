<?php

class ApiController {

    public function get_posts ($page = 0) {
        //change content-type of the output
        header('Content-Type: application/json; charset=utf-8');

        $posts =  Post::getAll();

        //echo json to the output
        echo json_encode($posts);
        exit;
    }
}