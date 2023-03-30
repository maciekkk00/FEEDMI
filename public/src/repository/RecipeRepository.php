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
            SELECT * FROM recipes WHERE LOWER(title) LIKE :search  
        ');                                                                             //tworzymy zmienna $stmt, nastepnie odwolujemy sie do naszej bazy danych, w ktorej dokonujemy polaczenia,a nastepnie na tym polaczaniu tworzymy sobie zapytanie
                                                                                        //zapytanie to SELECT, który bedzie wybieral wszystkie kolumny z tabelki recipes, gdzie i tutaj zamieniamy kolumne title na male litery i równamy do :search
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
                                                                                        //wyzej za ten klucz :search z zapytania sql wstawiamy ten argument przekazany do funkcji w repozytorium w metodzie getRecipeByTitle
                                                                                         //robimy to za pomoca funkcji bindParam
        $stmt->execute();
                                                                                         //wykonujemy to zapytanie

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                                        //zwracamy sobie tablice asocjacyjne, które i tak zostaną skonwertowane przez nas w pozniejszym etapie na obiekt JSON
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

    public function getRecipeBySkladnik(string $searchString1)
    {
       // $searchString1 = '%' . strtolower($searchString1) . '%';
        $tablica = explode(", ", $searchString1);
        $sk1 =  '%'.strtolower($tablica[0]).'%';
        $sk2 =  '%'.strtolower($tablica[1]).'%';
        $sk3 =  '%'.strtolower($tablica[2]).'%';
        $sk4 =  '%'.strtolower($tablica[3]).'%';
        $sk5 =  '%'.strtolower($tablica[4]).'%';
        $sk6 =  '%'.strtolower($tablica[5]).'%';
        $sk7 =  '%'.strtolower($tablica[6]).'%';
        $sk8 =  '%'.strtolower($tablica[7]).'%';
        $sk9 =  '%'.strtolower($tablica[8]).'%';
        $sk10 =  '%'.strtolower($tablica[9]).'%';
        //$sk2 = $tablica[1];
        //$tablicaCount =count($tablica);

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipes WHERE (LOWER(skladnik1) LIKE :zmienna1 OR LOWER(skladnik2) LIKE :zmienna1 OR LOWER(skladnik3) LIKE :zmienna1 OR LOWER(skladnik4) LIKE :zmienna1 OR LOWER(skladnik5) LIKE :zmienna1 OR LOWER(skladnik6) LIKE :zmienna1 OR LOWER(skladnik7) LIKE :zmienna1 OR LOWER(skladnik8) LIKE :zmienna1 OR LOWER(skladnik9) LIKE :zmienna1 OR LOWER(skladnik10) LIKE :zmienna1) 
            AND (LOWER(skladnik1) LIKE :zmienna2 OR LOWER(skladnik2) LIKE :zmienna2 OR LOWER(skladnik3) LIKE :zmienna2 OR LOWER(skladnik4) LIKE :zmienna2 OR LOWER(skladnik5) LIKE :zmienna2 OR LOWER(skladnik6) LIKE :zmienna2 OR LOWER(skladnik7) LIKE :zmienna2 OR LOWER(skladnik8) LIKE :zmienna2 OR LOWER(skladnik9) LIKE :zmienna2 OR LOWER(skladnik10) LIKE :zmienna2) 
            AND (LOWER(skladnik1) LIKE :zmienna3 OR LOWER(skladnik2) LIKE :zmienna3 OR LOWER(skladnik3) LIKE :zmienna3 OR LOWER(skladnik4) LIKE :zmienna3 OR LOWER(skladnik5) LIKE :zmienna3 OR LOWER(skladnik6) LIKE :zmienna3 OR LOWER(skladnik7) LIKE :zmienna3 OR LOWER(skladnik8) LIKE :zmienna3 OR LOWER(skladnik9) LIKE :zmienna3 OR LOWER(skladnik10) LIKE :zmienna3) 
            AND (LOWER(skladnik1) LIKE :zmienna4 OR LOWER(skladnik2) LIKE :zmienna4 OR LOWER(skladnik3) LIKE :zmienna4 OR LOWER(skladnik4) LIKE :zmienna4 OR LOWER(skladnik5) LIKE :zmienna4 OR LOWER(skladnik6) LIKE :zmienna4 OR LOWER(skladnik7) LIKE :zmienna4 OR LOWER(skladnik8) LIKE :zmienna4 OR LOWER(skladnik9) LIKE :zmienna4 OR LOWER(skladnik10) LIKE :zmienna4) 
            AND (LOWER(skladnik1) LIKE :zmienna5 OR LOWER(skladnik2) LIKE :zmienna5 OR LOWER(skladnik3) LIKE :zmienna5 OR LOWER(skladnik4) LIKE :zmienna5 OR LOWER(skladnik5) LIKE :zmienna5 OR LOWER(skladnik6) LIKE :zmienna5 OR LOWER(skladnik7) LIKE :zmienna5 OR LOWER(skladnik8) LIKE :zmienna5 OR LOWER(skladnik9) LIKE :zmienna5 OR LOWER(skladnik10) LIKE :zmienna5)
            AND (LOWER(skladnik1) LIKE :zmienna6 OR LOWER(skladnik2) LIKE :zmienna6 OR LOWER(skladnik3) LIKE :zmienna6 OR LOWER(skladnik4) LIKE :zmienna6 OR LOWER(skladnik5) LIKE :zmienna6 OR LOWER(skladnik6) LIKE :zmienna6 OR LOWER(skladnik7) LIKE :zmienna6 OR LOWER(skladnik8) LIKE :zmienna6 OR LOWER(skladnik9) LIKE :zmienna6 OR LOWER(skladnik10) LIKE :zmienna6) 
            AND (LOWER(skladnik1) LIKE :zmienna7 OR LOWER(skladnik2) LIKE :zmienna7 OR LOWER(skladnik3) LIKE :zmienna7 OR LOWER(skladnik4) LIKE :zmienna7 OR LOWER(skladnik5) LIKE :zmienna7 OR LOWER(skladnik6) LIKE :zmienna7 OR LOWER(skladnik7) LIKE :zmienna7 OR LOWER(skladnik8) LIKE :zmienna7 OR LOWER(skladnik9) LIKE :zmienna7 OR LOWER(skladnik10) LIKE :zmienna7) 
            AND (LOWER(skladnik1) LIKE :zmienna8 OR LOWER(skladnik2) LIKE :zmienna8 OR LOWER(skladnik3) LIKE :zmienna8 OR LOWER(skladnik4) LIKE :zmienna8 OR LOWER(skladnik5) LIKE :zmienna8 OR LOWER(skladnik6) LIKE :zmienna8 OR LOWER(skladnik7) LIKE :zmienna8 OR LOWER(skladnik8) LIKE :zmienna8 OR LOWER(skladnik9) LIKE :zmienna8 OR LOWER(skladnik10) LIKE :zmienna8) 
            AND (LOWER(skladnik1) LIKE :zmienna9 OR LOWER(skladnik2) LIKE :zmienna9 OR LOWER(skladnik3) LIKE :zmienna9 OR LOWER(skladnik4) LIKE :zmienna9 OR LOWER(skladnik5) LIKE :zmienna9 OR LOWER(skladnik6) LIKE :zmienna9 OR LOWER(skladnik7) LIKE :zmienna9 OR LOWER(skladnik8) LIKE :zmienna9 OR LOWER(skladnik9) LIKE :zmienna9 OR LOWER(skladnik10) LIKE :zmienna9) 
            AND (LOWER(skladnik1) LIKE :zmienna10 OR LOWER(skladnik2) LIKE :zmienna10 OR LOWER(skladnik3) LIKE :zmienna10 OR LOWER(skladnik4) LIKE :zmienna10 OR LOWER(skladnik5) LIKE :zmienna10 OR LOWER(skladnik6) LIKE :zmienna10 OR LOWER(skladnik7) LIKE :zmienna10 OR LOWER(skladnik8) LIKE :zmienna10 OR LOWER(skladnik9) LIKE :zmienna10 OR LOWER(skladnik10) LIKE :zmienna10)
        '); //tworzymy zmienna $stmt, nastepnie odwolujemy sie do naszej bazy danych, w ktorej dokonujemy polaczenia,a nastepnie na tym polaczaniu tworzymy sobie zapytanie
        //zapytanie to SELECT, który bedzie wybieral wszystkie kolumny z tabelki recipes, gdzie i tutaj zamieniamy kolumne title na male litery i równamy do :search
//        for($i=0; $i<$tablicaCount; $i++)
//        {
//            $stmt->bindParam(':search1', $tablica[$i], PDO::PARAM_STR);
//            $stmt->execute();
//        }
        $stmt->bindParam(':zmienna1', $sk1, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna2', $sk2, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna3', $sk3, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna4', $sk4, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna5', $sk5, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna6', $sk6, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna7', $sk7, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna8', $sk8, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna9', $sk9, PDO::PARAM_STR);
        $stmt->bindParam(':zmienna10', $sk10, PDO::PARAM_STR);
        //$stmt->bindParam(':kupa', $sk2, PDO::PARAM_STR);
        //$stmt->bindParam(':kupa', $sk2, PDO::PARAM_STR);
        //$stmt->bindParam(':search2', $tablica[1], PDO::PARAM_STR);
        //wyzej za ten klucz :search z zapytania sql wstawiamy ten argument przekazany do funkcji w repozytorium w metodzie getRecipeByTitle
        //robimy to za pomoca funkcji bindParam
        $stmt->execute();

        //wykonujemy to zapytanie

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        //zwracamy sobie tablice asocjacyjne, które i tak zostaną skonwertowane przez nas w pozniejszym etapie na obiekt JSON
    }
}