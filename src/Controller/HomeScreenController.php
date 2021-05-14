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
     * @Route("/recipe/add", name="add_new_recipe", methods={"POST"})
     */
    public function addRecipe($request): Response{
        $entityManager = $this->getDoctrine()->getManager();

        $newRecipe = new Recipe();
        $newRecipe->setSnackname('Omelette');
        $newRecipe->setIngredients('eggs, oil');
        $newRecipe->setInstructions('easy');

        $newRecipe = $request->query-get("snackname");

        $newRecipe1 = new Recipe();
        $newRecipe1->setSnackname('waffle');
        $newRecipe1->setIngredients('eggs, oil, flour, butter, sugar');
        $newRecipe1->setInstructions('medium');

        $entityManager->persist($newRecipe);
        $entityManager->persist($newRecipe1);

        $entityManager->flush();

        return new Response($newRecipe);

        return new Response('trying to add new recipe...' . $newRecipe1->getId() . $newRecipe->getId());
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
     * @Route("/recipe/find/{id}", name="find_a_recipe", methods={"PUT"})
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
                'image'=> $recipe->getImage(),
                'ingredients' => $recipe->getIngredients(),
                'instructions' => $recipe->getInstructions()
            ]);
        }
    }

    /**
     * @Route("/recipe/edit/{id}/{snackname}", name="edit_a_recipe", methods={"PUT"})
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
