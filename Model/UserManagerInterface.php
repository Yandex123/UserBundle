<?php
/**
 * Created by PhpStorm.
 * User: banhvinh
 * Date: 4/15/18
 * Time: 23:31
 */

namespace Cottect\Bundle\COTUserBundle\Model;

use FOS\UserBundle\Model\UserInterface;

/**
 * Interface to be implemented by user managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * @author Vinh Banh <apacheservices68@gmail.com>
 */
interface UserManagerInterface
{
    /**
     * Creates an empty user instance.
     *
     * @return UserInterface
     */
    public function createUser();

    /**
     * Deletes a user.
     *
     * @param UserInterface $user
     */
    public function deleteUser(UserInterface $user);

    /**
     * Finds one user by the given criteria.
     *
     * @param array $criteria
     *
     * @return UserInterface|null
     */
    public function findUserBy(array $criteria);

    /**
     * Find a user by its username.
     *
     * @param string $username
     *
     * @return UserInterface|null
     */
    public function findUserByUsername($username);

    /**
     * Finds a user by its email.
     *
     * @param string $email
     *
     * @return UserInterface|null
     */
    public function findUserByEmail($email);

    /**
     * Finds a user by its username or email.
     *
     * @param string $usernameOrEmail
     *
     * @return UserInterface|null
     */
    public function findUserByUsernameOrEmail($usernameOrEmail);

    /**
     * @param $emailOrPhone
     * @return mixed
     */
    public function findUserByEmailOrPhone($emailOrPhone);

    /**
     * Finds a user by its confirmationToken.
     *
     * @param string $token
     *
     * @return UserInterface|null
     */
    public function findUserByConfirmationToken($token);

    /**
     * Returns a collection with all user instances.
     *
     * @return \Traversable
     */
    public function findUsers();

    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Reloads a user.
     *
     * @param UserInterface $user
     */
    public function reloadUser(UserInterface $user);

    /**
     * Updates a user.
     *
     * @param UserInterface $user
     */
    public function updateUser(UserInterface $user);

    /**
     * Updates the canonical username and email fields for a user.
     *
     * @param UserInterface $user
     */
    public function updateCanonicalFields(UserInterface $user);

    /**
     * Updates a user password if a plain password is set.
     *
     * @param UserInterface $user
     */
    public function updatePassword(UserInterface $user);
}
