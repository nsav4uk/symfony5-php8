<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;

class NotifierService
{
    private NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function notify(string $email): void
    {
        $recipient = new Recipient($email);

        $notification = (new Notification('Test Notifier', ['email']))
            ->content('Test');

        $this->notifier->send($notification, $recipient);
    }
}
