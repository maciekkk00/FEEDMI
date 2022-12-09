<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Recipe.php';
require_once __DIR__.'/../repository/RecipeRepository.php';

class RecipeController extends AppController { //cala logika naszego uploadu

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../uploads/';

    private $messages = []; //do tej zmiennej bedziemy dodawali nasze zmienne, nasze komunikaty dotyczace walidacji
    private $recipeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->recipeRepository = new RecipeRepository();
    }

    public function recipes()
    {
        $recipes=$this->recipeRepository->getRecipes();
        $defaultController = new DefaultController();
        if ($defaultController->isLoged())
            $this->render('recipes', ['recipes' => $recipes]);
        else
            $defaultController->login();

    }

    public function addRecipe()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) { //sprawdzamy czy zostala wykonana metoda post

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $recipe = new Recipe($_POST['title'], $_POST['description'], $_POST['skladnik1'], $_POST['skladnik2'], $_POST['skladnik3'], $_POST['skladnik4'], $_POST['skladnik5'], $_POST['skladnik6'], $_POST['skladnik7'], $_POST['skladnik8'], $_POST['skladnik9'], $_POST['skladnik10'], $_FILES['file']['name']);
            $this->recipeRepository->addRecipe($recipe);

            return $this->render('recipes', [
                'recipes' => $this->recipeRepository->getRecipes(),
                'messages' => $this->messages, 'recipe' => $recipe
            ]);
        }
        $defaultController=new DefaultController();

        if ($defaultController->isLoged())
            return $this->render('add-recipe', ['messages' => $this->messages]);
        else
            $defaultController->login();
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->recipeRepository->getRecipeByTitle($decoded['search']));
        }
    }

    public function like(int $id) {
        $this->recipeRepository->like($id);
        http_response_code(200);
    }

    public function dislike(int $id) {
        $this->recipeRepository->dislike($id);
        http_response_code(200);
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