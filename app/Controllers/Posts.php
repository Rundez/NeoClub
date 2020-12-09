<?php

namespace App\Controllers;

use App\Models\PostsModel;
use CodeIgniter\Controller;
use App\Models\CommentModel;

/**
 * This class controls the flow of posts to the system. 
 */
class Posts extends Controller
{
    /**
     * Fetches all the posts and returns the view to the user. 
     */
    public function index()
    {
        $model = new PostsModel();
        $comments = new CommentModel();

        // fetch data from DB. Reverse the array.
        $data = [
            'posts' => array_reverse($model->getPosts(), true),
            'title' => 'The wall',
        ];

        // Load the comments for each post in the data array and add it to a corresponding array.
        for ($i = 0; $i < count($data['posts']); $i++) {
            $data['posts'][$i]['comments'] = $comments->getCommentsForPost($data['posts'][$i]['postID']);
        }

        echo view('templates/header', $data);
        echo view('posts/wall');
        echo view('templates/footer');
    }

    /**
     * Fetches one user with information. 
     * @param string $slug 
     */
    public function view($slug = null)
    {
        $model = new PostsModel();

        $data = [
            'user' => $model->getUsers($slug),
            'title' => 'User'
        ];

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the user ' . $slug);
        }

        echo view('templates/header', $data);
        echo view('users/selectedUser');
        echo view('templates/footer');
    }

    /**
     * Creates a new post and inserts it to the db
     */
    public function newPost()
    {
        $data = [
            'title' => $this->request->getVar('title'),
            'body' => $this->request->getVar('body'),
            'creator' => session()->get('id')
        ];

        // Authenticate if user is logged in
        if (session()->get('isLoggedIn') != 1) {
            session()->setflashdata('error', 'You have to be logged in to use this feature!');
            return redirect()->to('/posts');
        }

        $model = new PostsModel();
        if ($model->insert($data)) {
            return redirect()->to('/posts');
        }
    }

    /**
     * Adds a comment to a post, then ruturns the user to the wall.
     */
    public function addComment()
    {
        $model = new CommentModel();
        $data = [
            'postID' => $this->request->getVar('postid'),
            'message' => $this->request->getVar('message'),
            'senderID' => session()->get('id')
        ];

        $model->insert($data);
        session()->setflashdata('success', 'Succesfully posted a comment');
        return redirect()->to('/posts');
    }
}
