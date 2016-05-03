<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('lp'));
        }

        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/lp", name="lp")
     */
    public function lpAction(Request $request)
    {
        return $this->render('lp.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/lp/ru", name="lp_ru")
     */
    public function lpRuAction(Request $request)
    {
        return $this->render('lp_ru.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     */
    public function registerAction(Request $request)
    {
        //        var_dump($request->get('name'));exit;
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $password = $request->get('password');

        $password = uniqid();
        $yaml = new Parser();
        $dumper = new Dumper();

        if ($email && $password && $phone) {

            // Define params
            $username = str_replace(array('@', '.'), '', $email);
            $dbname = ''.$username;
            $dir = $this->get('kernel')->getRootDir().'/config';
            $fileconfig = $dir.'/config_'.$username.'.yml';

            // Create configs
            $value = $yaml->parse(file_get_contents($dir.'/config_andreybolonin.yml'));
            $value['parameters']['database_name'] = $dbname;
            $yaml = $dumper->dump($value);
            file_put_contents($fileconfig, $yaml);

            // Create database
            $pdo = $this->getDoctrine()->getConnection();
            $query = 'CREATE DATABASE '.$username;
            $pdo->exec($query);

//            $process = new Process('cd .. && php app/console doctrine:database:create --connection=default --env='.$username, null, [$username]);
//            $process->run();
//            if (!$process->isSuccessful()) {
//                throw new ProcessFailedException($process);
//            }

            // Schema update
            $process = new Process('cd .. && php app/console doctrine:schema:update --force --env='.$username);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // Create user in db

            // TODO Save email and phone in db

            // Send email
//            $message = \Swift_Message::newInstance()
//                ->setSubject('Регистрация в HealthMarketing CRM')
//                ->setFrom('info@healthmarketing.me')
//                ->setTo($email)
//                ->setBody(
//                    $this->renderView(
//                        'AppBundle:Default:email.txt.twig',
//                        array(
//                            'username' => $username,
//                            'password' => $password
//                        )
//                    )
//                )
//            ;
//            $this->get('mailer')->send($message);

            return $this->render('AppBundle:Default:register.html.twig', array(
                'username' => $username,
//                'command' => $process->getOutput()
            ));

//            // Redirect to user environment
//            $url = $this->generateUrl(
//                'register_continue',
//                array(
//                    'email' => $email,
//                    'password' => $password
//                ),
//                true
//            );
////            $url = str_replace('http://', 'http://' . $username.'.', $url);
//
//            return $this->redirect($url);
        }

        return new RedirectResponse('/landing');
    }
}
