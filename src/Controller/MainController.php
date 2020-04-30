<?php

namespace App\Controller;

use App\Form\AssuranceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
        ]);
    }

    /**
     * @Route("/secteur-particulier" , name="SecteurParticulier")
     */

    public function SecteurParticulier()
    {


        return $this->render('main/secteur-particulier.html.twig', [
        ]);
    }



    /**
     * @Route("/assurance-auto", name="AssuranceAuto")
     */
    public function AssuranceAuto(MailerInterface $mailer, Request $request)
    {
        $form = $this->createForm(AssuranceType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $firstname = $form->get('firstname')->getData();
            $lastname = $form->get('lastname')->getData();
            $email = $form->get('email')->getData();
            $phone = ($form->get('phone')) ? $form->get('phone')->getData() : null;
            $message = $form->get('message')->getData();

            $sendEmail = (new TemplatedEmail())
            ->from($email)
            ->to('contact@agence.fr')
            ->subject('Demande de devis: Assurance-auto')
            ->text('Ceci est un test')
            ->htmlTemplate('emails/assurance.html.twig')
            ->context([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
                'message' => $message
            ]);

            $mailer->send($sendEmail);
        }

        return $this->render('main/particuliers/assurance-auto.html.twig', [
            'assuranceForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/assurance-23roues", name="Assurance23Roues")
     */
    public function Assurance23Roues(MailerInterface $mailer, Request $request)
    {
        $form = $this->createForm(AssuranceType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $firstname = $form->get('firstname')->getData();
            $lastname = $form->get('lastname')->getData();
            $email = $form->get('email')->getData();
            $phone = ($form->get('phone')) ? $form->get('phone')->getData() : null;
            $message = $form->get('message')->getData();

            $sendEmail = (new TemplatedEmail())
            ->from($email)
            ->to('contact@agence.fr')
            ->subject('Demande de devis: Assurance-23Roues')
            ->text('Ceci est un test')
            ->htmlTemplate('emails/assurance.html.twig')
            ->context([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
                'message' => $message
            ]);

            $mailer->send($sendEmail);
        }

        return $this->render('main/particuliers/assurance-23roues.html.twig', [
            'assuranceForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/assurance-habitation", name="AssuranceHabitation")
     */
    public function AssuranceHabitation(MailerInterface $mailer, Request $request)
    {
        $form = $this->createForm(AssuranceType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $firstname = $form->get('firstname')->getData();
            $lastname = $form->get('lastname')->getData();
            $email = $form->get('email')->getData();
            $phone = ($form->get('phone')) ? $form->get('phone')->getData() : null;
            $message = $form->get('message')->getData();

            $sendEmail = (new TemplatedEmail())
            ->from($email)
            ->to('contact@agence.fr')
            ->subject('Demande de devis: Assurance-Habitation')
            ->text('Ceci est un test')
            ->htmlTemplate('emails/assurance.html.twig')
            ->context([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
                'message' => $message
            ]);

            $mailer->send($sendEmail);
        }

        return $this->render('main/particuliers/assurance-habitation.html.twig', [
            'assuranceForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/assurance-pretparticulier", name="AssurancePretParticulier")
     */
    public function AssurancePretParticulier(MailerInterface $mailer, Request $request)
    {
        $form = $this->createForm(AssuranceType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $firstname = $form->get('firstname')->getData();
            $lastname = $form->get('lastname')->getData();
            $email = $form->get('email')->getData();
            $phone = ($form->get('phone')) ? $form->get('phone')->getData() : null;
            $message = $form->get('message')->getData();

            $sendEmail = (new TemplatedEmail())
            ->from($email)
            ->to('contact@agence.fr')
            ->subject('Demande de devis: Assurance-PretParticulier')
            ->text('Ceci est un test')
            ->htmlTemplate('emails/assurance.html.twig')
            ->context([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
                'message' => $message
            ]);

            $mailer->send($sendEmail);
        }

        return $this->render('main/particuliers/assurance-pret-particulier.html.twig', [
            'assuranceForm' => $form->createView()
        ]);
    }

    
    /**
     * @Route("/assurance-sante-particuliers", name="AssuranceComplementaireSante")
     */
    public function AssuranceComplementaireSante(MailerInterface $mailer, Request $request)
    {
        $form = $this->createForm(AssuranceType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $firstname = $form->get('firstname')->getData();
            $lastname = $form->get('lastname')->getData();
            $email = $form->get('email')->getData();
            $phone = ($form->get('phone')) ? $form->get('phone')->getData() : null;
            $message = $form->get('message')->getData();

            $sendEmail = (new TemplatedEmail())
            ->from($email)
            ->to('contact@agence.fr')
            ->subject('Demande de devis: Assurance-ComplementaireSante')
            ->text('Ceci est un test')
            ->htmlTemplate('emails/assurance.html.twig')
            ->context([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
                'message' => $message
            ]);

            $mailer->send($sendEmail);
        }

        return $this->render('main/particuliers/assurance-complementaire-sante.html.twig', [
            'assuranceForm' => $form->createView()
        ]);
    }

}
