<?php

namespace App\Services;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class EmailServices
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($form, $template): void
    {
        $email = (new TemplatedEmail())
            ->from($form->get('email')->getData())
            ->to('no-reply@127.0.0.1.fr')
            ->subject($form->get('titre')->getData())
            ->htmlTemplate('email/'.$template.'.html.twig')
            ->context(compact('form'))
        ;
        $this->mailer->send($email);
    }
}