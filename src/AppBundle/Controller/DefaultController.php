<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/register", name="register")
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
            $dbname = 'hmcrm_' . $username;
            $dir = $this->get('kernel')->getRootDir() . '/config';
            $fileconfig = $dir . '/config_' . $username . '.yml';

            $pdo = $this->getDoctrine()->getConnection();

            $kernel = $this->get('kernel');
            $application = new Application($kernel);
            $application->setAutoExit(false);

            // Create database
            $input = new ArrayInput(array(
                'command' => 'doctrine:database:create',
                '--env' => $username,
            ));
            // You can use NullOutput() if you don't need the output
            $output = new BufferedOutput();
            $application->run($input, $output);

            // Create configs
            $value = $yaml->parse(file_get_contents($dir . '/config_andreybolonin.yml'));
            $value['parameters']['database_name'] = $dbname;
            $yaml = $dumper->dump($value);
            file_put_contents($fileconfig, $yaml);

            // Create user in db

            // TODO Save email and phone in db

            // Send email
            $message = \Swift_Message::newInstance()
                ->setSubject('Регистрация в HealthMarketing CRM')
                ->setFrom('info@healthmarketing.me')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'AppBundle:Default:email.txt.twig',
                        array(
                            'username' => $username,
                            'password' => $password
                        )
                    )
                )
            ;
            $this->get('mailer')->send($message);

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
