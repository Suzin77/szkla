<?php

namespace App\Service;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactMailService
{
    /**
     * @param Contact $contact
     * @param MailerInterface $mailer
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function mailAfterNewContact(Contact $contact, MailerInterface $mailer): void
    {
        $email = (new TemplatedEmail())
            ->from('contact@example.com')
            ->to($contact->getEmail())
            ->subject('Created new contact')
            ->htmlTemplate('email/welcome.html.twig')
            ->context([
                'contact' => $contact,
            ]);

        $mailer->send($email);
    }

}