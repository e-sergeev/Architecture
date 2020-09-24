<?php

use Model\Entity\User;
use Service\Social\FacebookApi;
use Service\Contract\SocialNetworkInterface;


class SocialNetwork implements SocialNetworkInterface {

    /**
     * @var FacebookApi $facebookApi
     */

    private $facebookApi;

    /**
     * @var User $user
     */

    private $user;

    /**
     * @param FacebookApi $facebook
     * @param User $user
     */

    public function __construct(FacebookApi $facebook, User $user)
    {
        $this->facebookApi = $facebook;
        $this->user = $user;
    }

    /**
     * @param string $message
     */

    public function send(string $message): void {
        $this->facebookApi->createConnection();
        $this->facebookApi->sendMessage($this->user->userLogin, $message);
    }
}