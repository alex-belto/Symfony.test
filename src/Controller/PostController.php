<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route ("/", name="home_page")
     */
    public function show(Request $request)
    {

//        if(!empty($request -> get('text'))){
//            $entityManager = $this -> getDoctrine() -> getManager();
//            $post = new Post;
//            $post -> setText('First Post');
//
//            $entityManager -> persist($post);
//            $entityManager-> flush();
//        }
        $posts = $this -> getDoctrine() -> getRepository(Post::class) ->findAll();

        return $this->render('post/index.html.twig', ['posts'=>$posts]);

    }

    /**
     * @Route ("/add/", name="add")
     */
    public function add()
    {
         $entityManager = $this -> getDoctrine() -> getManager();
        $post = new Post;
        $post -> setText('First Post');

        $entityManager -> persist($post);
        $entityManager-> flush();

        return $this -> render('post/add.html.twig');
    }

//    public function addPostAction()
//    {
//        $entityManager = $this -> getDoctrine() -> getManager();
//        $post = new Post;
//        $post -> setText('First Post');
//
//        $entityManager -> persist($post);
//        $entityManager-> flush();
//
//        return $this -> render('post/add.html.twig');
//    }
}