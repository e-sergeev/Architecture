<?php

namespace Framework\Command;

use Framework\RegisterConfigsCommand;
use Framework\RegisterRoutesCommand;

class RegisterUserHandler
{
    /**
     * @var RegisterCommand
     */
    private $command;

    public function __construct($command)
    {
        $this->command = $command;
    }

    /**
     * Выполнение команды.
     */
    public function execute(): void
    {
            $this->command->register();
    }
}