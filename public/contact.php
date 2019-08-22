<?php

/**
 * voir [Envoyer des e-mails depuis une imprimante, un scanner ou une application - Aide Administrateur G Suite](https://support.google.com/a/answer/176600?hl=fr) pour configurer gmail pour pouvoir envoyer des email depuis une application
 */

use Symfony\Component\Yaml\Yaml;

require __DIR__.'/../vendor/autoload.php';

// @dev
// dump($_POST);

// @dev check enabled transports
// dump(stream_get_transports());

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader, [
    // @todo désactiver en prod
    'debug' => true,
    'strict_variables' => true,
    // @todo activer en prod
    // 'cache' => __DIR__.'/../var/cache',
]);

$parameters = Yaml::parseFile(__DIR__.'/../config/parameters.yaml');

$sendTo = $parameters['email']['sendTo'];
$password = $parameters['email']['password'];
$subjectPrefix = $parameters['email']['subjectPrefix'];
$messagePrefix = $parameters['email']['messagePrefix'];

$title = 'Formulaire de contact';

$data = [
    'email' => '',
    'subject' => '',
    'message' => '',
];

$errors = [];
$messageSent = false;

if ($_POST) {
    if (empty($_POST['email']) || empty(trim($_POST['email']))) {
        $errors['email'] = 'Vous devez renseigner ce champ';
    } else {
        $data['email'] = $_POST['email'];
    }

    if (empty($_POST['subject']) || empty(trim($_POST['subject']))) {
        $errors['subject'] = 'Vous devez renseigner ce champ';
    } else {
        $data['subject'] = $_POST['subject'];
    }

    if (empty($_POST['message']) || empty(trim($_POST['message']))) {
        $errors['message'] = 'Vous devez renseigner ce champ';
    } else {
        $data['message'] = $_POST['message'];
    }

    if (!$errors) {
        // Create the Transport
        $transport = (new Swift_SmtpTransport($parameters['email']['server'], $parameters['email']['port'], $parameters['email']['transport']))
            ->setUsername($sendTo)
            ->setPassword($password)
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($subjectPrefix.$_POST['subject'].' ('.$_POST['email'].')'))
            ->setFrom([$_POST['email']])
            ->setReplyTo([$_POST['email']])
            ->setTo([$sendTo])
            ->setBody($messagePrefix.$_POST['email']."\n\n".$_POST['message'])
        ;

        // Send the message
        $result = $mailer->send($message);

        if ($result) {
            $messageSent = true;
        }
    }
}

echo $twig->render('contact.html.twig', [
    'title' => $title,
    'data' => $data,
    'errors' => $errors,
    'messageSent' => $messageSent,
]);

