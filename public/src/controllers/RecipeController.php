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
    {//chcemy pobrac contentType, ktory zostal wyslany w protokole HTTP w naglowku w funkcji fetch w dodatkowych parametrach i on mial wartos: application/json (plik search.js)
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : ''; //tworzymy nowa zmienna, ktora mozemy sobie pobrac za pomoca zmiennej SERVER, ktora bedzie dostepna pod kluczem CONTENT_TYPE, ale musimy to zabezpieczyc odpowiednio dlatego na samym poczatku sprawdzamy czy ta zmienna serwerowa zostala ustawiona za pomoca opcji isset, nastepnie jezeli ta zmienna zostala ustawiona to wowczas bedziemy chcieli ją zwrocic , natomiast jezeli nie zostala ustawiona to chcemy przypisac jej wartosc pusta a w funkcji trim przycinamy odpowiednio ta wartosc, ktora otrzymamy z zmiennej CONTENT_TYPE

        if ($contentType === "application/json") { //w bloku if sprawdzamy czy contentType zostal faktycznie ustawiony na wartosc application.json czyli wartosc naglowka z funkcji fetch
            $content = trim(file_get_contents("php://input")); //nastepnie musimy w jakis sposob pobrac content, ktory wysylalismy w bodym w protokole HTTP i mozemy to pobrac rownierz tworzac sobie zmienna $content ale tym razem mozemy to zrobic za pomoca funkcji file_get_contents(tutaj podajemy skad chcemy to pobrac, a chcemy to pobrac z "php://input" - to jest wartosc taka stala), a calosc opakowywujemy sobie w funkcje trim. //w taki sposob pobierzemt wartosc body
            $decoded = json_decode($content, true); //ale musimy bo wartosc body zostala wyslana w formie javaScript Object Notation w formacie JSON wiec musimy sobie taka wartosc zdecodowac. //tworzymy zmienna $decoded i za pomoca funkcji json_decode(wrzucamy sobie do srodka $content i jako drugi parametr dajemy true co oznacza ze chcemy to wrzucic do listy asocjacyjnej)

            header('Content-type: application/json'); //musimy ustawic wczesniej naglowki, czyli ustawiamy naglowek Content-type: application/json
            http_response_code(200); //ustawiamy kod odpowiedzi na 200 czyli ze wszystko przebieglo pomyslnie
            //i po takim ustawieniu zwrocimy sobie wszystkie przepisy, ktore wyszukalismy za pomoca tego zapytania w getRecipeByTitle w bazie danych
            echo json_encode($this->recipeRepository->getRecipeByTitle($decoded['search'])); //zwracamy nasza wartosc czyli wszystkie te przepisy, ktore zwroci nam zapytanie search w recipeRepository // my skorzystamy sobie z tego repozytorium w naszym kontrolerze, wywolujemy sobie metode getProjectByTitle(to slowko wpisywane do searchbaru mozemy sobie pobrac z tablicy asocjacyjnej odwolujac sie po luczu search), czyli po prostu zamienilismy tutaj obiekt javaScriptowy na tablice asocjacyjna php i w taki sposob przekazujemy ta wartosc, my chcemy zwracac jsona, dlatego wszystko opakowywujemy w funkcje json_encode
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