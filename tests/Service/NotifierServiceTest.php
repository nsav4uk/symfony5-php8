<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\NotifierService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Notifier\NotifierInterface;

class NotifierServiceTest extends TestCase
{
    private NotifierService $notifierService;

    protected function setUp(): void
    {
        $notifierMock = $this->createMock(NotifierInterface::class);
        $notifierMock->expects(self::once())->method('send');
        $this->notifierService = new NotifierService($notifierMock);
    }

    public function testNotify(): void
    {
        $this->notifierService->notify('test@test.com');
    }
}
