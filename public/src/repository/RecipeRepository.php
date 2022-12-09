<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Recipe.php';

class RecipeRepository extends Repository
{

    public function getRecipe(int $id): ?Recipe
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipe WHERE id_recipe = :id
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
            INSERT INTO recipes (title, description, skladnik1, skladnik2, skladnik3, skladnik4, skladnik5, skladnik6, skladnik7, skladnik8, skladnik9, skladnik10, image, created_at, id_assigned_by)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, getIDbyEmail(?))
        ');

        //TODO you should get this value from logged user session
        $userRepository = new UserRepository();
        $assignedByEmail = $userRepository->getUserSession($_COOKIE['id_session'])->getEmail();

        $stmt->execute([
            $recipe->getTitle(),
            $recipe->getDescription(),
            $recipe->getSkladnik1(),
            $recipe->getSkladnik2(),
            $recipe->getSkladnik3(),
            $recipe->getSkladnik4(),
            $recipe->getSkladnik5(),
            $recipe->getSkladnik6(),
            $recipe->getSkladnik7(),
            $recipe->getSkladnik8(),
            $recipe->getSkladnik9(),
            $recipe->getSkladnik10(),
            $recipe->getImage(),
            $date->format('Y-m-d'),
            $assignedByEmail
        ]);
    }

    public function getRecipes(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipes;
        ');
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($recipes as $recipe) {
            $result[] = new Recipe(
                $recipe['title'],
                $recipe['description'],
                $recipe['skladnik1'],
                $recipe['skladnik2'],
                $recipe['skladnik3'],
                $recipe['skladnik4'],
                $recipe['skladnik5'],
                $recipe['skladnik6'],
                $recipe['skladnik7'],
                $recipe['skladnik8'],
                $recipe['skladnik9'],
                $recipe['skladnik10'],
                $recipe['image'],
                $recipe['like'],
                $recipe['dislike'],
                $recipe['id_recipe']
            );
        }
        return $result;
    }

    public function getRecipeByTitle(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipes WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function like(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE recipes SET "like" = "like" + 1 WHERE id_recipe = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function dislike(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE recipes SET dislike = dislike + 1 WHERE id_recipe = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}