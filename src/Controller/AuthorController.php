<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthorController extends AbstractController
{
  private $authors;
    public function __construct() {
        $this->authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg', 'username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
        );
    }
    //afficher le nom de l'auteur
    #[Route('/showAuthor/{name}', name: 'author_name')]
    public function showAuthor($name): Response
    {
        return $this->render('author/show.html.twig', [
            'author_name' => $name,
        ]);
    }


    //afficher la liste des auteurs
    #[Route('/authorsList', name: 'author_list')]
    public function listAuthors(): Response
    {
      
        return $this->render('author/list.html.twig', [
           'authorsList' => $this->authors,
        ]);
    }

    //search author by id
    public function searchById($id){
        foreach($this->authors as $author){
            if($author['id']==$id){
                return $author;
            }
        }
        return null;
    }
    //afficher le nom de l'auteur
    #[Route('/authorDetails /{id}', name: 'author_details')]
    public function authorDetails ($id): Response
    {   
        $auth=$this->searchById($id);

        return $this->render('author/showAuthor.html.twig', [
           // 'author'=>$this->authors[$id-1]
           'author'=>$auth
            
        ]);
    }
}
