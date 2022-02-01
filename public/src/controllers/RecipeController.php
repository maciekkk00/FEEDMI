<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Recipe.php';
require_once __DIR__.'/../repository/RecipeRepository.php';

class RecipeController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../../public/uploads/';

    private $messages = [];
    private $recipeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->recipeRepository = new RecipeRepository();
    }

    public function recipes()
    {
        $recipes=$this->recipeRepository->getRecipes();
        $this->render('recipes', ['recipes' => $recipes]);
    }

    public function addRecipe()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $recipe = new Recipe($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->recipeRepository->addRecipe($recipe);

            return $this->render('recipes', [
                'recipes' => $this->recipeRepository->getRecipes(),
                'messages' => $this->messages, 'recipe' => $recipe
            ]);
        }
        return $this->render('add-recipe', ['messages' => $this->messages]);
    }

    private function validate(array $file): bool
    {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large for destination file system.';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported.';
            return false;
        }

        return true;
    }
}