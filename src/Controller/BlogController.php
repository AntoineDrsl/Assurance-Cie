<?php

namespace App\Controller;
use App\Entity\Article;
use App\Form\ArticleType;

use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;

class BlogController extends AbstractController
{

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/blogs", name="blogs")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/blog/assurance", name="assurance_articles")
     */
    public function AssuranceList()
    {
        $articles = $this->articleRepository->findBlogAssurance();

        return $this->render('blog/liste.html.twig', [
            'blog' => 'assurance',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/blog/moto", name="moto_articles")
     */
    public function MotoList()
    {
        $articles = $this->articleRepository->findBlogMoto();

        return $this->render('blog/liste.html.twig', [
            'blog' => 'moto',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/blog/article/{id}", name="article")
     */
    public function article($id)
    {
        $article = new Article();
        $article = $this->articleRepository->findOneById($id);

        $articles = $this->articleRepository->findLastThree();

        return $this->render('blog/article.html.twig', [
            'article' => $article,
            'articles' => $articles,
        ]);


    }

    /**
     * @Route("/blog/assurance/new", name="assurance_newArticle", methods={"GET","POST"})
     */
    public function newAssurance(Request $request, EntityManagerInterface $entityManager)
    {
        $newArticle = new Article();
        $form = $this->createForm(ArticleType::class, $newArticle, ['validation_groups' => ['creation']]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newArticle = $form->getData();

            $image = $form->get('image')->getData();
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('upload_directory'), $imageName);
            $newArticle->setImage($imageName);

            $newArticle->setBlog(1);
            $newArticle->setCreatedAt(new \DateTime());

            $entityManager->persist($newArticle);
            $entityManager->flush();

            return $this->redirectToRoute('assurance_articles');

        }

        return $this->render('blog/new.html.twig', [
            'blog' => 'assurance',
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/moto/new", name="moto_newArticle", methods={"GET","POST"})
     */
    public function newMoto(Request $request, EntityManagerInterface $entityManager)
    {
        $newArticle = new Article();
        $form = $this->createForm(ArticleType::class, $newArticle, ['validation_groups' => ['creation']]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newArticle = $form->getData();

            $image = $form->get('image')->getData();
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('upload_directory'), $imageName);
            $newArticle->setImage($imageName);

            $newArticle->setBlog(2);
            $newArticle->setCreatedAt(new \DateTime());

            $entityManager->persist($newArticle);
            $entityManager->flush();

            return $this->redirectToRoute('moto_articles');

        }

        return $this->render('blog/new.html.twig', [
            'blog' => 'moto',
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/remove/{id}", name="removeArticle")
     */
    public function removeArticle($id, EntityManagerInterface $entityManager)
    {
        $article = $this->articleRepository->find($id);

        if($article) {

            $article->deleteFile();

            $entityManager->remove($article);
            $entityManager->flush();

            $this->addFlash('success', "L'article a bien été supprimé !");
            return $this->redirectToRoute('blogs');

        } else {
            $this->addFlash('error', "L'article n'a pas été trouvé");
            return $this->redirectToRoute('blogs');
        }
    }

    /**
     * @Route("/blog/update/{id}", name="updateArticle")
     */
    public function updateArticle($id, Request $request, EntityManagerInterface $entityManager)
    {
        $article = $this->articleRepository->find($id);

        if($article) {

            $previousImageName = $article->getImage();

            $article->setImage(new File($this->getParameter('upload_directory').'/'.$article->getImage()));
            dump($article->getImage());
            $form = $this->createForm(ArticleType::class, $article);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $article = $form->getData();

                if($form->get('image')->getData() !== null) {
                    if($previousImageName) {
                        $article->deleteFileOnUpdate($previousImageName);
                    }

                    $image = $article->getImage();
                    $imageName = md5(uniqid()).'.'.$image->guessExtension();
                    $image->move($this->getParameter('upload_directory'), $imageName);
                    $article->setImage($imageName);
                } else {
                    $article->setImage($previousImageName);
                }

                $entityManager->persist($article);
                $entityManager->flush();

                $this->addFlash('success', "L'article a bien été modifié");
                return $this->redirectToRoute('blogs', ['id', $article->getId()]);
            }

            return $this->render('blog/new.html.twig', [
                'articleForm' => $form->createView(),
                'article' => $article
            ]);

        } else {
            return $this->redirectToRoute('blogs');
        }
    }
    
}
