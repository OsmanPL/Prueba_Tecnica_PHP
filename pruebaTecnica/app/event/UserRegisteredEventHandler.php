<?php

namespace app\event;

class UserRegisteredEventHandler
{
    public function handle(UserRegisteredEvent $event): void
    {
        // Acción simulada, como enviar un email de bienvenida
        $user = $event->getUser();
        echo "Welcome email sent to " . $user->email() . PHP_EOL;
    }
}