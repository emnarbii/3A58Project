<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthorController extends AbstractController
{
    //   private $authors;
    //     public function __construct() {
    //         $this->authors = array(
    //             array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' =>
    //             'victor.hugo@gmail.com ', 'nb_books' => 100),
    //             array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg', 'username' => ' William Shakespeare', 'email' =>
    //             ' william.shakespeare@gmail.com', 'nb_books' => 200),
    //             array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' =>
    //             'taha.hussein@gmail.com', 'nb_books' => 300),
    //         );
    //     }
    //     //afficher le nom de l'auteur
    //     #[Route('/showAuthor/{name}', name: 'author_name')]
    //     public function showAuthor($name): Response
    //     {
    //         return $this->render('author/show.html.twig', [
    //             'author_name' => $name,
    //         ]);
    //     }


    //     //afficher la liste des auteurs
    //     #[Route('/authorsList', name: 'author_list')]
    //     public function listAuthors(): Response
    //     {

    //         return $this->render('author/list.html.twig', [
    //            'authorsList' => $this->authors,
    //         ]);
    //     }

    //     //search author by id
    //     public function searchById($id){
    //         foreach($this->authors as $author){
    //             if($author['id']==$id){
    //                 return $author;
    //             }
    //         }
    //         return null;
    //     }
    //     //afficher le nom de l'auteur
    //     #[Route('/authorDetails /{id}', name: 'author_details')]
    //     public function authorDetails ($id): Response
    //     {   
    //         $auth=$this->searchById($id);

    //         return $this->render('author/showAuthor.html.twig', [
    //            // 'author'=>$this->authors[$id-1]
    //            'author'=>$auth

    //         ]);
    // }

    //gestion des auteurs avec data base

    //afficher la liste des auteurs
    #[Route('/authors', name: 'author_list')]
    public function getAuthorList(AuthorRepository $authRepo): Response
    {
        //$authors=$authRepo->findAll();
        return $this->render('author/list.html.twig', [
            'authorsList' => $authRepo->findAll(),
        ]);
    }


    //add statique
    #[Route('/add', name: 'author_add')]
    public function addAuthor(EntityManagerInterface $em): Response
    {

        // $form= $this->createFormBuilder()
        $author = new Author();
        $author->setUsername("elmes3di");
        $author->setEmail("mes@gmail.com");
        $author->setNbBook(20);
        $em->persist($author);
        $em->flush();

        return $this->redirectToRoute('author_list');
    }

    //add statique
    #[Route('/insert', name: 'author_insert')]
    public function insertAuthor(EntityManagerInterface $em, Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('author_list');
        }
         return $this->render('author/form.html.twig', [
            'authorForm' =>$form,
        ]);
    
    }


     //add statique
    #[Route('/update/{id}', name: 'author_update')]
    public function updateAuthor(EntityManagerInterface $em, Request $request, $id): Response
    {
        $author = new Author();
        $author=$em->getRepository(Author::class)->find($id);
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($author);
            $em->flush();
            return $this->redirectToRoute('author_list');
        }
         return $this->render('author/form.html.twig', [
            'authorForm' =>$form,
        ]);
    
    }
}
