<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findFriendsToAdd($user);

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Add friend to current user.
     *
     * @Route("/{id}/friend/add", name="user_friend_add")
     * @Method({"GET", "POST"})
     */
    public function addfriendAction(User $friend)
    {
        $user = $this->getUser();
        $user->addFriend($friend);
        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * delete friend to current user.
     *
     * @Route("/{id}/friend/delete", name="user_friend_delete")
     * @Method({"GET", "POST"})
     */
    public function deletefriendAction(User $friend)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $user->removeFriend($friend);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }
}
