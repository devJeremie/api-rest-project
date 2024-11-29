<?php 

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LoginController extends AbstractController
{
     // Définition de la route pour l'API de connexion
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function ApiLogin() {
        // Récupération de l'utilisateur actuellement authentifié
        $user = $this->getUser ();
 
        // Vérification si l'utilisateur est une instance de la classe User
        if (!$user instanceof User) {
             // Retourne une réponse JSON avec une erreur si l'utilisateur n'est pas valide
             return new JsonResponse(['error' => 'Invalid user type'], 500);
         }
 
        // Préparation des données de l'utilisateur à retourner
        $userData = [
            'email' => $user->getEmail(), // Récupération de l'email de l'utilisateur
            'first_name' => $user->getFirstName(), // Récupération du prénom de l'utilisateur
            'last_name' => $user->getLastName(), // Récupération du nom de famille de l'utilisateur
        ];
 
        // Retourne les données de l'utilisateur sous forme de réponse JSON
        return $this->json($userData);
        //return new JsonResponse(json_encode($userData, JSON_THROW_ON_ERROR));
    }
}