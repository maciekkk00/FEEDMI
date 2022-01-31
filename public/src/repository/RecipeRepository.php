<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Recipe.php';

class RecipeRepository extends Repository
{

    public function getRecipe(int $id): ?Recipe
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipe WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($recipe == false) {
            return null;
        }

        return new Recipe(
            $recipe['title'],
            $recipe['description'],
            $recipe['image']
        );
    }

    public function addRecipe(Recipe $recipe): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO recipes (title, description, image, created_at, id_assigned_by)
            VALUES (?, ?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session
        $assignedById = 1;

        $stmt->execute([
            $recipe->getTitle(),
            $recipe->getDescription(),
            $recipe->getImage(),
            $date->format('Y-m-d'),
            $assignedById
        ]);
    }
}