<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeScreenController extends AbstractController
{
    /**
     * @Route("/recipe/add", name="add_new_recipe", methods={"GET", "POST"})
     */
    public function addRecipe($request){
        $entityManager = $this->getDoctrine()->getManager();

        $data=json_decode($request->getContent(), true);

        $newRecipe = new Recipe();
        $newRecipe->setSnackname($data['snackname']);
        $newRecipe->setImage($data['image']);
        $newRecipe->setIngredients($data['ingredients']);
        $newRecipe->setInstructions($data['instructions']);

        $entityManager->persist($newRecipe);

        $entityManager->flush();

        return new Response('trying to add new recipe...' . $newRecipe->getId());
    }

    /**
     * @Route("/recipe/all", name="get_all_recipe", methods={"GET"})
     */
    public function getAllRecipe(){
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();

        $response = [];

        foreach($recipes as $recipe) {
            $response[] = array(
                'id' => $recipe->getId(),
                'snackname' => $recipe->getSnackname(),
                'image'=> $recipe->getImage(),
                'ingredients' => $recipe->getIngredients(),
                'instructions' => $recipe->getInstructions()
            );
        }

        return $this->json($response);
    }

    /**
     * @Route("/recipe/find/{id}", name="find_a_recipe", methods={"GET"})
     */
    public function findRecipe($id) {
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            return $this->json([
                'id' => $recipe->getId(),
                'snackname' => $recipe->getSnackname(),
                'image' => $recipe->getImage(),
                'ingredients' => $recipe->getIngredients(),
                'instructions' => $recipe->getInstructions()
            ]);
        }
    }

    /**
     * @Route("/recipe/edit/{id}/{name}", name="edit_a_recipe", methods={"PUT"})
     */
    public function editRecipe($id, $snackname) {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            $recipe->setSnackname($snackname);
            $entityManager->flush();

            return $this->json([
                'message' => 'Edited a recipe with id ' . $id
            ]);
        }
    }

    /**
     * @Route("/recipe/remove/{id}", name="remove_a_recipe", methods={"DELETE"})
     */
    public function removeRecipe($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            $entityManager->remove($recipe);
            $entityManager->flush();

            return $this->json([
                'message' => 'Removed the recipe with id ' . $id
            ]);
        }
    }
}
