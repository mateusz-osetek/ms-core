<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Controller;

use App\Core\Application\Dto\UserDto;
use App\Core\Domain\Model\Errors;
use App\Core\Domain\Model\User;
use App\Core\Domain\Repository\DoctrineUserRepository;
use App\Core\Domain\ValueObject\Foundation\DateTime;
use App\Core\Domain\ValueObject\Foundation\Identifier;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class UserAuthorizationController extends ApiController
{
    private DoctrineUserRepository $userRepository;
    private Errors $errors;
    private JWTTokenManagerInterface $jwtTokenManager;

    public function __construct(
        DoctrineUserRepository $userRepository,
        Errors $errors,
        JWTTokenManagerInterface $jwtTokenManager
    ) {
        $this->userRepository = $userRepository;
        $this->errors = $errors;
        $this->jwtTokenManager = $jwtTokenManager;
    }

    public function register(Request $request): JsonResponse
    {
        $json = $this->requestToJson($request);
        if (null === $json) {
            return $this->throwValidationError();
        }

        $userDto = UserDto::fromArray($json->toArray());
        $userModel = new User(
            Identifier::fromString($userDto->getUuid()),
            $userDto->getUsername(),
            $userDto->getEmail(),
            $userDto->getPassword(),
            DateTime::fromTimestamp($userDto->getCreatedAt())
        );

        $this->userRepository->save($userModel);

        return $this->throwSuccessResponse();
    }

    public function getUserToken(Request $request): JsonResponse
    {
        $json = $this->requestToJson($request);
        $userDto = UserDto::fromArray($json->toArray());
        $user = new User(
            Identifier::fromString($userDto->getUuid()),
            $userDto->getUsername(),
            $userDto->getEmail(),
            $userDto->getPassword(),
            DateTime::fromTimestamp($userDto->getCreatedAt())
        );

        return JsonResponse::create([
            'token' => $this->jwtTokenManager->create($user),
        ]);
    }
}
