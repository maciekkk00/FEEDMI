const search1 = document.querySelector('input[placeholder="enter the ingredients you have"]'); //w pierwszej kolejnosci jest to nasz input z placeholderem "search recipe"
const recipeContainer1 = document.querySelector(".recipes"); //do tej stalej przypisujemy nasze wszystkie przepisy, ktore znajduja sie w sekcji o klasie recipes
//na poczatku tworzymy dwie stale do ktorych chcemy przypisac elementy html, ktore znajduja sie w pliku widoku recipes.php
search1.addEventListener("keyup", function (event) { //do naszej stalej search dodajemy Event i będzimy chcieli po wpisaniu hasla, po zatwierdzeniu enterem czyli event keyup wykonac zapytanie fetch. Czyli chcemy zrobic na poczatku event, w ktorym po zatwierdzeniu enterem pobierzemy wartosc wpisanego hasla i przekazemy ją na backend
    if (event.key === "Enter") { //sprawdzamy w ifie czy faktycznie zostal nacisniety enter, mozemy to zrobic za pomoca event i klucza key, porównujemy to nasteonie z "Enter"
        event.preventDefault(); //jezli ten enter zostal nacisniety to zapobiegamy kolejnym akcjom, ktore moglby tutaj zostac wykonane za pomoca funkcji preventDefault

        const data = {search1: this.value}; //tworzymy obiekt javascriptowy data, który przekazemy na backend, ten obiekt bedzie zawieral klucz search: do którego przypiszemy wartosc, ktora wpisalismy do searchbaru. Taka wartosc mozemy pobrac za pomoca opcji this i on wskaze nam ten element dom, który zostal aktualnie uruchomiony przez event czyli to bedzie nasz input searchbaru i z tego searchbaru pobieramy sobie wartosc poprzez parametr value

        fetch("/search1", { //nastepnie wykonujemy metode fetch (my już wiemy na podstawie index.php, ze taki fetch bedziemy wykonywali pod url: search)
            method: "POST", //dodatkowa opcja jest metoda POST, poniewaz my musimy przekazac na backed slowko, ktore wpisalismy w searchbaru
            headers: {
                'Content-Type': 'application/json' //poniewaz bedziemy przekazywali JSONa musimy dodac naglowek do protokolu HTTP, ze obiekt ktory przesylamy czyli ten content jest typu application/json
            },
            body: JSON.stringify(data) //teraz przekazujemy sobie te dane, musimy przekonwertowac to do formatu JSON, poniewaz taki format mozemy jedynie przekazac na backend //takie zapytanie fetch() pozwoli nam odwolac sie do metody search z naszego kontrolera a my w tej metodzie search wywolamy sobie metode getRecipeByTitle() z naszego repozytorium
        }).then(function (response) {  //poniewaz my chcemy odebrac te przepisy w jakis sposob to mozemy to zrobic za pomoca bloku then
            return response.json(); //gdzie chcemy odebrac response i odczytac go jako json //tak zkonwertowane dane do postaci obiektu javaScriptowego mozemy odebrac sobie w kolenym bloku then
        }).then(function (recipes) { //tutaj zapisujemy, ze przyjmiemy sobie parametr recipes, to bedzie ten parametr, ktory zostal zwrocony w bloku wyzej czyli to co zostanie zwrocone przez response.json
            recipeContainer1.innerHTML = ""; //w tej metodzie, w tym ostatnim bloku musimy usunac sobie wszystko to co mamy juz wczytane na wstepie do recipesContainera z php czyli wszystkie przepisy musimy sobie wyczyscic, poniewaz my chcemy zaladowac tylko te przepisy, ktore zostaly wyszukane, czyscimy ten contener, ktory pobralismy za pomoca querSelectora opcją innerHTML przypisujac pusty string
            loadRecipes1(recipes) //niemniej jednak te wszystkie przepisy, ktore mamy chcemy w jakis sposob wczytac do naszej strony HTML i robimy to w osobnej funkcji loadRecipes do ktorej przekazemy wczytane projekty
        });
    }
});

function loadRecipes1(recipes) {
    recipes.forEach(recipe => { //po wszystkich przepisach, które otrzymalismy z zapytania na backendzie bedziemt sobie iterowali w petli forEach, bedziemy iterowali po pojedynczym przepisie
        console.log(recipe); //mozemy sobie go wyswietlic w consol logu
        createRecipe1(recipe); // wtym miejsu bedziemy wstawic taki przepis do HTMLa i robimy to w tej funkcji createRecipe
    });
}

function createRecipe1(recipe) { //do tej funkcji nie przekazujemy juz calej listy przepisow tylko jeden przepis
    //aby stworzyc taki przepis skorzystamy z czegos takiego jak klonowanie templatek z poziomu HTMLa
    //zeby storzyc taka templatke HTMLowa wracamy do pliku recipes.php, kopiujemy szablon pojedynczego projektu i wklejamy na sam koniec i opakowywujemy go tagiem template i usuwamy w nim wszystko to co jest zwiazane z wczytywaniem bezposrednio z php i wstawiamy zamiast tego takie maski. ktore bedziemy podmieniali
    //majac taki szablon bedziemy w stanie w latwy sposob dostac sie do niego za pomoca querySelectora, nastepnie skopiujemy go i podmienimy odpowiednie dane na te które otrzymalismy z backendu
    const template1 = document.querySelector("#recipe-template"); // za pomoca querySelectora wczytujemy sobie ten template, który przed chwila otrzymalismy odwolujac sie do niego po #klasie

    const clone = template1.content.cloneNode(true); //taka templatke mozemy sobie sklonowac za pomoca funkcji clone ale my musimy skopiowac sobie content tego szablonu czyli wszystko to co znajduje się wewnątrz tagu template, mozemy to zrobic za pomoca funkcji cloneNode(), true dlatego zeby zachowac te zagniezdzenia w htmlu (przeszukiwanie w głąb)
    //teraz na podstawie tego clonu, który mamy stworzony możemy wyszukać sobie rzeczy, które chcemy podstawic
    const div = clone.querySelector("div");
    div.id = recipe.id;
    const image = clone.querySelector("img"); //tworzymy uchwyt na wszystkie rzeczy z osobna np tutaj na zdj, robimy to wyszukujac bezposrednio na tym clonie za pomoca querySelectora znacznika img
    image.src = `/public/uploads/${recipe.image}`; //teraz mozemy taki obrazek sobie ustawic za pomoca odwolania do atrybutu src
    const title = clone.querySelector("h2"); //uchwyt na tytul
    title.innerHTML = recipe.title; //wstrzykujemy sobie do niego wartosc za pomoca takiego odwolania jak innerHTML, recipe.title itd. to sa nazwy kolumn, ktore pobralismy z bazy danych za pomoca naszego recipeRepository i tego zapytania, ktore zapisalismy
    const description = clone.querySelector("p");
    description.innerHTML = recipe.description;
    const sklad1 = clone.getElementById("s1");
    sklad1.innerHTML = recipe.skladnik1;
    const sklad2 = clone.getElementById("s2");
    sklad2.innerHTML = recipe.skladnik2;
    const sklad3 = clone.getElementById("s3");
    sklad3.innerHTML = recipe.skladnik3;
    const sklad4 = clone.getElementById("s4");
    sklad4.innerHTML = recipe.skladnik4;
    const sklad5 = clone.getElementById("s5");
    sklad5.innerHTML = recipe.skladnik5;
    const sklad6 = clone.getElementById("s6");
    sklad6.innerHTML = recipe.skladnik6;
    const sklad7 = clone.getElementById("s7");
    sklad7.innerHTML = recipe.skladnik7;
    const sklad8 = clone.getElementById("s8");
    sklad8.innerHTML = recipe.skladnik8;
    const sklad9 = clone.getElementById("s9");
    sklad9.innerHTML = recipe.skladnik9;
    const sklad10 = clone.getElementById("s10");
    sklad10.innerHTML = recipe.skladnik10;
    const like = clone.querySelector(".fa-heart");
    like.innerText = recipe.like;
    const dislike = clone.querySelector(".fa-thumbs-down");
    dislike.innerText = recipe.dislike;
    //majac stowrzona taka kopie, ktora zostala uzupelniona poszczegolnymi danymi mozemy wrzuucic sobie do kontenera, ktory wczesniej pobralismy za pomoca querySelectora (2 linijka tego pliku), ten kontener zostanie wyczyszczony wiec nie bedzie w nim juz wczesniej wczytanych przez php przepisow, bedzie to czysty obszar w tym widoku
    //mozemy dodac sobie do tego widoku recznie nowy projekt, ktory stworzylismy recznie
    recipeContainer.appendChild(clone); //odwolujemy sie do recipeContainer na ktorym wywolujemy opcje appendChild i wrzucamy ten clone do naszego dokumentu
}