<?php

/**
 * Description of DashboardMenu
 *
 * @author fragote
 */
namespace Dashboard\Navigation;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;
use Zend\Authentication\AuthenticationService;

class DashboardMenu extends DefaultNavigationFactory
{
    protected function getPages(ServiceLocatorInterface $serviceLocator) 
    {
        $menu = array();
        //if (null == $this->pages) {
            $auth = new AuthenticationService();
            $mvcEvent = $serviceLocator->get('Application')->getMvcEvent();
            $privilegeMenu = $serviceLocator->get('Dashboard\Model\PrivilegeTable');
            
            $identity = $auth->getIdentity();
            $dataMenu = $privilegeMenu->getMenuByUser($identity->id);
            $menu = $this->menuFormat($dataMenu);
            
            $routeMatch = $mvcEvent->getRouteMatch();
            $router = $mvcEvent->getRouter();
            $pages = $this->getPagesFromConfig($menu);
            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        //}
        
        return $this->pages;
    }
    
    public function menuFormat($dataMenu) {
//          echo $dataMenu->getQueryString(); exit;
       
        foreach ($dataMenu as $menxsu) {
             var_Dump($menxsu);
            Exit;
        }
         $menu = array(
               array(
                   'label' => 'fgt website',
                   'uri' => 'http://www.google.com',
                   'pages' => array(
                        array(
                            'label' => 'Child #1',
                            'uri' => 'http://www.icpna.edu.pe',
                        ),
                   ),
               ),
               array(
                   'label' => 'internal',
                   'uri' => 'http://www.francis-gonzales.info'
               ),
            );
         return $menu;
    }
}
