<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<User>
 *
 * @method        User|Proxy                     create(array|callable $attributes = [])
 * @method static User|Proxy                     createOne(array $attributes = [])
 * @method static User|Proxy                     find(object|array|mixed $criteria)
 * @method static User|Proxy                     findOrCreate(array $attributes)
 * @method static User|Proxy                     first(string $sortedField = 'id')
 * @method static User|Proxy                     last(string $sortedField = 'id')
 * @method static User|Proxy                     random(array $attributes = [])
 * @method static User|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method static User[]|Proxy[]                 all()
 * @method static User[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static User[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static User[]|Proxy[]                 findBy(array $attributes)
 * @method static User[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static User[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UserFactory extends ModelFactory
{
    private $passwordHasher;
    private ?\Transliterator $transliterator;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->transliterator = \Transliterator::create('Any-Latin; Latin-ASCII');
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $nom = self::faker()->lastName();
        $prenom = self::faker()->firstName();
        $nom = $this->normalizeName($nom);
        $prenom = $this->normalizeName($prenom);
        $variable = self::faker()->numerify();
        $email = "user-$variable@example.com";

        return [
            'allergene' => AllergeneFactory::random(),
            'email' => $email,
            'nom' => $nom,
            'password' => 'test',
            'prenom' => $prenom,
            'roles' => [],
            'dateNais' => self::faker()->dateTimeBetween('-50 years', '-18 years'),
            'tel' => self::faker()->numerify('06########'),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (User $user) {
                $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }

    protected function normalizeName(string $name): string
    {
        preg_replace('/[^a-zA-Z]/', '-', $name);

        return $this->transliterator->transliterate($name);
    }
}
