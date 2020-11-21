<?php

namespace App\Repository;

use App\Entity\Utilisateurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Utilisateurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateurs[]    findAll()
 * @method Utilisateurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateursRepository extends ServiceEntityRepository
{

    private $manager;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Utilisateurs::class);
        $this->manager = $manager;
    }

    public function saveUtilisateur($firstname, $lastname, $mail, $phone, $gender, $city)
    {
        $newUtilisateur = new Utilisateurs();

        $newUtilisateur -> setFirstname($firstname);
        $newUtilisateur -> setLastname($lastname);
        $newUtilisateur -> setMail($mail);
        $newUtilisateur -> setCity($city);
        $newUtilisateur -> setGender($gender);
        $newUtilisateur -> setPhone($phone);

        $this->manager->persist($newUtilisateur);
        $this->manager->flush();
    }

    public function updateUtilisateur(Utilisateurs $utilisateur): Utilisateurs
    {
        $this->manager->persist($utilisateur);
        $this->manager->flush();

        return $utilisateur;
    }

    public function removeUtilisateur(Utilisateurs $utilisateur)
    {
        $this->manager->remove($utilisateur);
        $this->manager->flush();
    }
}
