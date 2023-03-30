const search2 = document.querySelector('input[placeholder="search post"]'); //w pierwszej kolejnosci jest to nasz input z placeholderem "search recipe"
const blogContainer2 = document.querySelector(".blogs"); //do tej stalej przypisujemy nasze wszystkie przepisy, ktore znajduja sie w sekcji o klasie recipes
//na poczatku tworzymy dwie stale do ktorych chcemy przypisac elementy html, ktore znajduja sie w pliku widoku recipes.php

search2.addEventListener("keyup", function (event) { //do naszej stalej search dodajemy Event i będzimy chcieli po wpisaniu hasla, po zatwierdzeniu enterem czyli event keyup wykonac zapytanie fetch. Czyli chcemy zrobic na poczatku event, w ktorym po zatwierdzeniu enterem pobierzemy wartosc wpisanego hasla i przekazemy ją na backend
    if (event.key === "Enter") { //sprawdzamy w ifie czy faktycznie zostal nacisniety enter, mozemy to zrobic za pomoca event i klucza key, porównujemy to nasteonie z "Enter"
        event.preventDefault(); //jezli ten enter zostal nacisniety to zapobiegamy kolejnym akcjom, ktore moglby tutaj zostac wykonane za pomoca funkcji preventDefault

        const data = {search2: this.value}; //tworzymy obiekt javascriptowy data, który przekazemy na backend, ten obiekt bedzie zawieral klucz search: do którego przypiszemy wartosc, ktora wpisalismy do searchbaru. Taka wartosc mozemy pobrac za pomoca opcji this i on wskaze nam ten element dom, który zostal aktualnie uruchomiony przez event czyli to bedzie nasz input searchbaru i z tego searchbaru pobieramy sobie wartosc poprzez parametr value

        fetch("/search2", { //nastepnie wykonujemy metode fetch (my już wiemy na podstawie index.php, ze taki fetch bedziemy wykonywali pod url: search)
            method: "POST", //dodatkowa opcja jest metoda POST, poniewaz my musimy przekazac na backed slowko, ktore wpisalismy w searchbaru
            headers: {
                'Content-Type': 'application/json' //poniewaz bedziemy przekazywali JSONa musimy dodac naglowek do protokolu HTTP, ze obiekt ktory przesylamy czyli ten content jest typu application/json
            },
            body: JSON.stringify(data) //teraz przekazujemy sobie te dane, musimy przekonwertowac to do formatu JSON, poniewaz taki format mozemy jedynie przekazac na backend //takie zapytanie fetch() pozwoli nam odwolac sie do metody search z naszego kontrolera a my w tej metodzie search wywolamy sobie metode getRecipeByTitle() z naszego repozytorium
        }).then(function (response) {  //poniewaz my chcemy odebrac te przepisy w jakis sposob to mozemy to zrobic za pomoca bloku then
            return response.json(); //gdzie chcemy odebrac response i odczytac go jako json //tak zkonwertowane dane do postaci obiektu javaScriptowego mozemy odebrac sobie w kolenym bloku then
        }).then(function (blogs) { //tutaj zapisujemy, ze przyjmiemy sobie parametr recipes, to bedzie ten parametr, ktory zostal zwrocony w bloku wyzej czyli to co zostanie zwrocone przez response.json
            blogContainer2.innerHTML = ""; //w tej metodzie, w tym ostatnim bloku musimy usunac sobie wszystko to co mamy juz wczytane na wstepie do recipesContainera z php czyli wszystkie przepisy musimy sobie wyczyscic, poniewaz my chcemy zaladowac tylko te przepisy, ktore zostaly wyszukane, czyscimy ten contener, ktory pobralismy za pomoca querSelectora opcją innerHTML przypisujac pusty string
            loadBlogs(blogs) //niemniej jednak te wszystkie przepisy, ktore mamy chcemy w jakis sposob wczytac do naszej strony HTML i robimy to w osobnej funkcji loadRecipes do ktorej przekazemy wczytane projekty
        });
    }
});

function loadBlogs(blogs) {
    blogs.forEach(blog => { //po wszystkich przepisach, które otrzymalismy z zapytania na backendzie bedziemt sobie iterowali w petli forEach, bedziemy iterowali po pojedynczym przepisie
        console.log(blog); //mozemy sobie go wyswietlic w consol logu
        createBlog(blog); // wtym miejsu bedziemy wstawic taki projekt do HTMLa i robimy to w tej funkcji createRecipe
    });
}

function createBlog(blog) { //do tej funkcji nie przekazujemy juz calej listy przepisow tylko jeden przepis
    //aby stworzyc taki przepis skorzystamy z czegos takiego jak klonowanie templatek z poziomu HTMLa
    //zeby storzyc taka templatke HTMLowa wracamy do pliku recipes.php, kopiujemy szablon pojedynczego projektu i wklejamy na sam koniec i opakowywujemy go tagiem template i usuwamy w nim wszystko to co jest zwiazane z wczytywaniem bezposrednio z php i wstawiamy zamiast tego takie maski. ktore bedziemy podmieniali
    //majac taki szablon bedziemy w stanie w latwy sposob dostac sie do niego za pomoca querySelectora, nastepnie skopiujemy go i podmienimy odpowiednie dane na te które otrzymalismy z backendu
    const template2 = document.querySelector("#blog-template"); // za pomoca querySelectora wczytujemy sobie ten template, który przed chwila otrzymalismy odwolujac sie do niego po #klasie

    const clone = template2.content.cloneNode(true); //taka templatke mozemy sobie sklonowac za pomoca funkcji clone ale my musimy skopiowac sobie content tego szablonu czyli wszystko to co znajduje się wewnątrz tagu template, mozemy to zrobic za pomoca funkcji cloneNode(), true dlatego zeby zachowac te zagniezdzenia w htmlu (przeszukiwanie w głąb)
    //teraz na podstawie tego clonu, który mamy stworzony możemy wyszukać sobie rzeczy, które chcemy podstawic
    const div = clone.querySelector("div");
    div.id = blog.id;
    const image = clone.querySelector("img"); //tworzymy uchwyt na wszystkie rzeczy z osobna np tutaj na zdj, robimy to wyszukujac bezposrednio na tym clonie za pomoca querySelectora znacznika img
    image.src = `/public/uploads/${blog.image}`; //teraz mozemy taki obrazek sobie ustawic za pomoca odwolania do atrybutu src
    const title = clone.querySelector("h2"); //uchwyt na tytul
    title.innerHTML = blog.title; //wstrzykujemy sobie do niego wartosc za pomoca takiego odwolania jak innerHTML, recipe.title itd. to sa nazwy kolumn, ktore pobralismy z bazy danych za pomoca naszego recipeRepository i tego zapytania, ktore zapisalismy
    const description = clone.querySelector("p");
    description.innerHTML = blog.description;
    const like = clone.querySelector(".fa-heart");
    like.innerText = blog.like;
    const dislike = clone.querySelector(".fa-thumbs-down");
    dislike.innerText = blog.dislike;
    //majac stowrzona taka kopie, ktora zostala uzupelniona poszczegolnymi danymi mozemy wrzuucic sobie do kontenera, ktory wczesniej pobralismy za pomoca querySelectora (2 linijka tego pliku), ten kontener zostanie wyczyszczony wiec nie bedzie w nim juz wczesniej wczytanych przez php przepisow, bedzie to czysty obszar w tym widoku
    //mozemy dodac sobie do tego widoku recznie nowy projekt, ktory stworzylismy recznie
    blogContainer2.appendChild(clone); //odwolujemy sie do recipeContainer na ktorym wywolujemy opcje appendChild i wrzucamy ten clone do naszego dokumentu
}