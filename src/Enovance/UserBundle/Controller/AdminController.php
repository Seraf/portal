<?php

namespace Enovance\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Enovance\UserBundle\Form\AdminUserType;
use Enovance\UserBundle\Entity\User;

class AdminController extends Controller
{
    public function usersAction()
    {
        $query = $this->getDoctrine()->getRepository('EnovanceUserBundle:User')->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.lastname')
            ->getQuery();

        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate($query, $this->get('request')->query->get('page', 1), 10);

        return $this->render('EnovanceUserBundle:Admin:users.html.twig', array('users' => $users));
    }

   public function newUserAction()
    {
        $request = $this->get('request');
        $tr = $this->get('translator');
        $user = new User();
        $userGroup = $this->getDoctrine()->getRepository('EnovanceUserBundle:Group')->findOneBy(array('roles' => 'ROLE_USER'));

        $form = $this->createForm(new AdminUserType($user), $user);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $factory = $this->container->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $message = \Swift_Message::newInstance()
                    ->setSubject('New user has beed created')
                    ->setFrom(array('enovanceportal@gmail.com' => 'Portail Enovance'))
                    ->setTo($user->getEmail())
                    ->setContentType('text/html')
                    ->setBody($this->renderView('EnovanceUserBundle:Email:newUser.html.twig', array('user' => $user)));

                $this->get('mailer')->send($message);
                $this->get('session')->setFlash('notice', $tr->trans('New user has been added'));

                return $this->redirect($this->generateUrl('enovance_admin_users'));
            }
        }

        return $this->render('EnovanceUserBundle:Admin:user.html.twig', array(
              'user' => $user,
              'form' => $form->createView(),
              'userGroup' => $userGroup,
            ));
    }

    public function editUserAction($id)
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $tr = $this->get('translator');
        $user = $em->find('EnovanceUserBundle:User', $id);

        if (!$user)
            throw new NoResultException();

        $form = $this->createForm(new AdminUserType($user), $user);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if ($form->isValid())
            {
                if ($form["password"]->getData())
                {
                    $factory = $this->container->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                    $user->setPassword($password);
                }
                if (!$form["enabled"]->getData()) {
		    $user->setEnabled(1);
		}
		$em->persist($user);
                $em->flush();

                $message = \Swift_Message::newInstance()
                    ->setSubject($tr->trans('Your account has beed updated'))
                    ->setFrom(array('enovanceportal@gmail.com' => 'Portail Enovance'))
                    ->setTo($user->getEmail())
                    ->setContentType('text/html')
                    ->setBody($this->renderView('EnovanceUserBundle:Email:updatedUser.html.twig', array('user' => $user)));

                //$this->get('mailer')->send($message);
                //$this->get('session')->setFlash('notice', $tr->trans('User has been updated'));
            }
        }

        return $this->render('EnovanceUserBundle:Admin:user.html.twig', array(
              'user' => $user,
              'form' => $form->createView(),
            ));
    }

    public function deleteUserAction($id)
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $user = $em->find('EnovanceUserBundle:User', $id);
        $loggedUser = $this->get('security.context')->getToken()->getUser();

        if (!$user)
            throw new NoResultException();

        if ($user->getId() != $loggedUser->getId())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            $message = $this->get('translator')->trans('User has been deleted');
        }
        else
        {
            $message = $this->get('translator')->trans('You can\'t delete yourself');
        }

        $this->get('session')->setFlash('notice', $message);
        return $this->redirect($this->generateUrl('enovance_admin_users'));
    }

    public function groupsAction()
    {
        $query = $this->getDoctrine()->getRepository('EnovanceUserBundle:Group')->createQueryBuilder('g')
            ->select('g')
            ->orderBy('g.name')
            ->getQuery();

        $paginator = $this->get('knp_paginator');
        $groups = $paginator->paginate($query, $this->get('request')->query->get('page', 1), 10);

        return $this->render('EnovanceUserBundle:Admin:groups.html.twig', array('groups' => $groups));
    }

    public function companiesAction()
    {
        $query = $this->getDoctrine()->getRepository('EnovanceUserBundle:Company')->createQueryBuilder('c')
            ->select('c')
            ->orderBy('c.name')
            ->getQuery();

        $paginator = $this->get('knp_paginator');
        $companies = $paginator->paginate($query, $this->get('request')->query->get('page', 1), 10);

        return $this->render('EnovanceUserBundle:Admin:companies.html.twig', array('companies' => $companies));
    }

}

