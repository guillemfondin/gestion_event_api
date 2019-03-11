<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AgendaController extends AbstractController
{
    /**
     * Affiche la page d'accueil et la liste des évènements
     * 
     * @Route("/", name="events")
     *
     * @param EventRepository $repo
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function index(EventRepository $repo, Request $request, ObjectManager $manager): Response
    {
        $events = $repo->findAll();

        $newEvent = new Event();
        $form = $this->createForm(EventType::class, $newEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($newEvent);
            $manager->flush();
            $this->addFlash(
                'success',
                "L'énèvement a bien été ajouté"
            );
        }

        return $this->render('agenda/index.html.twig', [
            'events' => $events,
            'form' => $form->createView()
        ]);
    }

    /**
     * Affiche un évènement
     * 
     * @Route("/event/{id}", name="event_single")
     *
     * @param Event $event
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function show(Event $event, Request $request, ObjectManager $manager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($event);
            $manager->flush();
            $this->addFlash(
                'success',
                "L'énèvement a bien été mis à jour"
            );
        }

        return $this->render('agenda/show.html.twig', [
            'event' => $event,
            'form' => $form->createView()
        ]);
    }

    /**
     * Supprime un évènement
     * 
     * @Route("/event/delete/{id}", name="event_delete")
     *
     * @param Event $event
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Event $event, ObjectManager $manager): Response
    {
        $manager->remove($event);
        $manager->flush();
        $this->addFlash(
            'success',
            "La page <strong>{$event->getName()}</strong> a bien été supprimée"
        );

        return $this->redirectToRoute("events");
    }
}
