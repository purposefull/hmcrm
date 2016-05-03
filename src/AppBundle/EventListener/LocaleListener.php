<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class LocaleListener
 * @package SkyFlow\AppBundle\EventListener
 */
class LocaleListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * LocaleListener constructor.
     *
     * @param string $defaultLocale
     */
    public function __construct($defaultLocale = 'en', $availableLocales, Router $router)
    {
        $this->defaultLocale    = $defaultLocale;
        $this->availableLocales = $availableLocales;
        $this->router           = $router;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if (!$request->hasPreviousSession()) {
            return;
        }

        $localeFromSession = $request->getSession()->get('_locale');
        $localeFromRoute   = $request->query->get('_locale');
        $localeFromHeader  = $request->getPreferredLanguage($this->availableLocales);

        // при переключении языка в веб-интерфейсе (язык в роуте)
        if ($localeFromRoute) {

            $request->getSession()->set('_locale', $localeFromRoute);
            $request->setLocale($localeFromSession);

            $route = $event->getRequest()->get('_route');

            $params = $request->attributes->get('_route_params');
            $url    = $this->router->generate($route, $params);

            $response = new RedirectResponse($url);
            $event->setResponse($response);
            // при отсутствии языка в роуте
        } else {

            // берем локаль из сессии (дефолтное состояние при выбранной локали)
            if ($localeFromSession) {
                $request->setLocale($localeFromSession);
            } // или из http заголовка (пользователь первый раз зашел на сайт)
            else {
                if ($localeFromHeader) {
                    $request->setLocale($localeFromHeader);
                    $request->getSession()->set('_locale', $localeFromHeader);
                }
            }
        }
    }

    /**
     * @return []
     */
    public static function getSubscribedEvents()
    {
        return [
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => [
                [
                    'onKernelRequest', 17,
                ],
            ],
        ];
    }
}
