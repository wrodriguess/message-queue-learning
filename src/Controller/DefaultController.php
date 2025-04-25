<?php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new SmsNotification('Mensagem criada'));

        return new Response("ok");
    }
}