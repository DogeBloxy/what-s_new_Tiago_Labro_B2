<?php

namespace App\Controller;

use App\Entity\Timetable;
use Doctrine\ORM\EntityManagerInterface;
use Dom\XPath;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entity_manager): Response
    {
        $rss = simplexml_load_file('https://www.amiens.fr/flux-rss/actus');
        $result = $rss->xpath('channel/item');

        foreach ($result as $item) {
            $enclosure = $item->enclosure;
            if ($enclosure) {
                $item->enclosureUrl = (string) $enclosure['url'];
            } else {
                $item->enclosureUrl = null;
            }
        }

        $repository = $entity_manager->getRepository(Timetable::class);

        $timetables = $repository->findAll();

        $instagram = simplexml_load_file('https://rss.app/feeds/2Y3ixwJPbkuqKG9L.xml');
        $instagramResult = $instagram->xpath('channel/item');

        // foreach ($instagramResult as $item) {
        //     $enclosure = $item->enclosure;
        //     if ($enclosure) {
        //         $item->enclosureUrl = (string) $enclosure['url'];
        //     } else {
        //         $item->enclosureUrl = null;
        //     }
        // }

        $funfact = simplexml_load_file(__DIR__. '/../../assets/xml/funfact.xml');

        return $this->render('home/index.html.twig', [
            'rss' => $result,
            'timetables' => $timetables,
            'instagram' => $instagramResult,
            'funfact' => $funfact,
        ]);
    }
}

