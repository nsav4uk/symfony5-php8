<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Event\UserCreatedEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

final class UserCreatedListener
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(UserCreatedEvent $event): void
    {
        $message = (new TemplatedEmail())
            ->to(new Address($event->getEmail()))
            ->subject('Greeting!')
            ->htmlTemplate('');

        $this->mailer->send($message);
    }
}
