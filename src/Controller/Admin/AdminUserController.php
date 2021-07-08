<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Exception\InvalidUserRequestException;
use App\Service\UserService;
use App\Validator\UserValidator;
use Doctrine\DBAL\Types\ConversionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AdminUserController extends AbstractController
{
    private UserService $service;
    private UserValidator $validator;
    private SerializerInterface $serializer;

    public function __construct(UserService $service, UserValidator $validator, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    public function indexAction(): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $this->service->findAll(),
        ]);
    }

    public function addAction(Request $request): Response
    {
        if (!$request->getContent()) {
            return $this->render('user/add.html.twig');
        }

        try {
            $this->validator->validateRequest($request);

            $user = $this->serializer->deserialize(
                json_encode($request->request->all()),
                User::class,
                'json'
            );

            $this->service->insert($user);

            $this->addFlash('success', 'Um novo usuário foi criado.');
        } catch (InvalidUserRequestException $exception) {
            $this->addFlash('error', $exception->getMessage());

            return $this->redirectToRoute('admin_user_add');
        }

        return $this->redirectToRoute('admin_user_index');
    }

    public function removeAction(string $id): Response
    {
        try {
            $this->service->remove($id);
            $this->addFlash('success', 'O usuário foi removido.');
        } catch (ConversionException $exception) {
            $this->addFlash('error', 'O id do usuário que você tentou excluir está inválido.');
        } catch (UserNotFoundException $exception) {
            $this->addFlash('error', 'user_not_found');
        } catch (\Exception $exception) {
            $this->addFlash('error', 'Algum erro aconteceu. Tente novamente');
        }

        return $this->redirectToRoute('admin_user_index');
    }
}
