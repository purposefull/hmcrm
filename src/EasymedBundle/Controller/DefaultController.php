<?php

namespace EasymedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EasymedBundle:Default:index.html.twig', array('name' => $name));
    }

    public function registerAction(Request $request)
    {
        $email = $request->get('email');
        $phone = $request->get('phone');
        $password = uniqid();
        $yaml = new Parser();
        $dumper = new Dumper();

//        // Send email
//        $message = \Swift_Message::newInstance()
//            ->setSubject('Регистрация на YogaCRM')
//            ->setFrom('yogacrmru@gmail.com')
//            ->setTo($email)
//            ->setBody(
//            'dwadwadwa'
////                $this->renderView(
////                    'AndreyboloninYogaCrmBundle:Default:email.txt.twig',
////                    array(
////                        'username' => $email,
////                        'password' => $password
////                    )
////                )
//            )
//        ;
//        var_dump($this->get('mailer')->send($message));
//        exit;

        if ($email && $password && $phone) {

            // Define params
            $username = str_replace(array('@', '.'), '', $email);
            $dbname = 'yogacrm_' . $username;
            $dir = $this->get('kernel')->getRootDir() . '/config';
            $fileconfig = $dir . '/config_' . $username . '.yml';
            $pdo = $this->getDoctrine()->getConnection();

            // Create database
            $query = 'CREATE DATABASE IF NOT EXISTS ' . $dbname;
            $pdo->exec($query);

            // Import default schema data
            $pdo->query('USE ' . $dbname);
            $query = file_get_contents($dir . '/yogacrm.sql');
            $pdo->exec($query);

            // Create configs
            $value = $yaml->parse(file_get_contents($dir . '/config_andreybolonin.yml'));
            $value['parameters']['database_name'] = $dbname;
            $yaml = $dumper->dump($value);
            file_put_contents($fileconfig, $yaml);

            // Create user
            $process = new Process('php '.$this->get('kernel')->getRootDir().'/console oro:user:update admin --env='.$username.' --user-name='.$username.' --user-email='.$email.' --user-password='.$password.' --user-firstname='.$username.' --user-lastname='.$username);
            $process->setTimeout(null);
//            $process->start();
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > '.$buffer;
                } else {
                    echo 'OUT > '.$buffer;
                }
            });

            // TODO Save email and phone

            // Send email
            $message = \Swift_Message::newInstance()
                ->setSubject('Регистрация на YogaCRM')
                ->setFrom('yogacrmru@gmail.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'AndreyboloninYogaCrmBundle:Default:email.txt.twig',
                        array(
                            'username' => $username,
                            'password' => $password
                        )
                    )
                )
            ;
            $this->get('mailer')->send($message);

            return $this->render('AndreyboloninYogaCrmBundle:Default:register.html.twig', array(
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
