<?php

namespace Enovance\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Enovance\UserBundle\Form\AdminUserType;
use Enovance\UserBundle\Entity\User;
use Enovance\UserBundle\Form\AdminGroupType;
use Enovance\UserBundle\Entity\Group;
use Enovance\UserBundle\Form\AdminCompanyType;
use Enovance\UserBundle\Entity\Company;

class AdminController extends Controller
{

    private function saveObject($form, $em, $object)
    {
        $request = $this->get('request');
        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $em->persist($object);
                $em->flush();

                return $object;
            }
        }

        return FALSE;
    }
/*
 *  Users
 */


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


/*
 *  Groups
 */



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


    public function newGroupAction()
    {
        $group = new Group();
        $em = $this->getDoctrine()->getManager();
        $tr = $this->get('translator');
        $form = $this->createForm(new AdminGroupType($group), $group);

        $result = $this->saveObject($form, $em, $group);
        if ($result)
        {
            $this->get('session')->setFlash('notice', $tr->trans('New group has been added'));
            return $this->redirect($this->generateUrl('admin_admin_groups'));
        }

        return $this->render('EnovanceUserBundle:Admin:group.html.twig', array(
              'group' => $group,
              'form' => $form->createView(),
            ));
    }

    public function editGroupAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tr = $this->get('translator');
        $group = $em->find('EnovanceUserBundle:Group', $id);

        if (!$group)
            throw new NoResultException();

        $form = $this->createForm(new AdminGroupType($group), $group);

        $result = $this->saveObject($form, $em, $group);
        if ($result)
            $this->get('session')->setFlash('notice', $tr->trans('Group has been updated'));

        return $this->render('EnovanceUserBundle:Admin:group.html.twig', array(
              'group' => $group,
              'form' => $form->createView(),
            ));
    }

    public function deleteGroupAction($id)
    {
        $group = $this->getDoctrine()->getRepository('EnovanceUserBundle:Group')->find($id);

        if (!$group)
            throw new NoResultException();

        if ($group->getDeletable())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($group);
            $em->flush();

            $message = $this->get('translator')->trans('Group has been deleted');
        }
        else
        {
            $message = $this->get('translator')->trans('This group can\'t be deleted');
        }

        $this->get('session')->setFlash('notice', $message);
        return $this->redirect($this->generateUrl('enovance_admin_groups'));
    }


/*
 *  Companies
 */







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


public function newCompanyAction()
    {
        $company = new Company();
        $em = $this->getDoctrine()->getManager();
        $tr = $this->get('translator');

        $form = $this->createForm(new AdminCompanyType(), $company);

        $result = $this->saveObject($form, $em, $company);
        if ($result)
        {
            $this->get('session')->setFlash('notice', $tr->trans('New company has been added'));
            return $this->redirect($this->generateUrl('enovance_admin_companies'));
        }

        return $this->render('EnovanceUserBundle:Admin:company.html.twig', array(
              'company' => $company,
              'form' => $form->createView(),
            ));
    }

    public function editCompanyAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->find('EnovanceUserBundle:Company', $id);

        if (!$company)
            throw new NoResultException();

        $tr = $this->get('translator');
        $form = $this->createForm(new AdminCompanyType(), $company);

        $result = $this->saveObject($form, $em, $company);
        if ($result)
            $this->get('session')->setFlash('notice', $tr->trans('Company has been updated'));

        return $this->render('EnovanceUserBundle:Admin:company.html.twig', array(
              'company' => $company,
              'form' => $form->createView(),
            ));
    }

    public function deleteCompanyAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->find('EnovanceUserBundle:Company', $id);

        $em->remove($company);
        $em->flush();

        $message = $this->get('translator')->trans('Company has been deleted');

        $this->get('session')->setFlash('notice', $message);
        return $this->redirect($this->generateUrl('enovance_admin_companies'));
    }

}
