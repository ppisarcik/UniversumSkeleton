<?php
namespace App\Security;

use App\Repositories\UserRepository;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\Security\Passwords;

class UserAuthenticator implements IAuthenticator
{
    /** @var UserRepository */
    private $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /** {@inheritdoc} */
    function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;

        $user = $this->userRepository->get(['username' => $username]);

        if(!$user || !Passwords::verify($password, $user->password)) {
            throw new AuthenticationException('Nespravne meno alebo heslo');
        }

        return new Identity($user->id, $user->role, [
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'image' => $user->image
        ]);
    }
}