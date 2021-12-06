<?php

/**
 * (PHP or any other OOP language) Define the classes and their methods (including parameters and return types) 
 * for a system that consist of a bookshelf, books, magazines, and notebooks. 
 * The bookshelf should allow store and retrieval of the items, reporting on the 
 * state of the bookshelf (how many items it has, how many more items it can hold), and searching 
 * for items based on the page contents. 
 * The other items should allow reading of a single page given the page number that returns the text of the page. 
 * A book has an accessible title and author. A magazine has an accessible name and publication date. A notebook has an accessible owner. *
 */


 /**
  * Interface Area
  */


interface iBookShelf
{
    public function getName(): string;
    public function getLimit(): int;
    public function getWorks(): array;
    public function findWorkByName(string $name): ?Work;
    public function searchWorksByPage(string $query): array;
    public function storeWork(Work $book): void;
    public function getAvailableSpace(): int;
    public function getBusySpace(): int;
}

interface iPage
{
    public function getNumber(): int;
    public function getContent(): string;
}

interface iWork
{
    public function getName(): string;
    public function getPages(): array;
    public function getPageContent(int $pageId): ?Page;
}



 /**
  * Main Classes Area
  */


class BookShelf implements iBookShelf
{
    private string $name;
    private int $limit;
    private array $bookInventory;

    public function __construct(string $name, int $limit)
    {
        $this->name = $name;
        $this->limit = $limit;
        $this->bookInventory = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getWorks(): array
    {
        return $this->bookInventory;
    }

    public function findWorkByName(string $name): ?Work
    {
        foreach ($this->bookInventory as $book) {
            if ($book->getName() === $name) {
                return $book;
            }
        }
        return null;
    }

    public function searchWorksByPage(string $query): array
    {
        $result = [];
        foreach ($this->bookInventory as $book) {
            foreach ($book->getPages() as $page) {
                if (str_contains($page->getContent(), $query)) {
                    $result[] = $book;
                }
            }
        }
        return $result;
    }

    public function storeWork(Work $work): void
    {
        if ($this->checkLimit()) {
            $this->bookInventory[] = $work;
        } else {
            echo "limit reached!" . PHP_EOL;
        }
    }

    public function getAvailableSpace(): int
    {
        return ($this->limit - $this->getBusySpace());
    }

    public function getBusySpace(): int
    {
        return count($this->bookInventory);
    }

    private function checkLimit(): bool
    {
        if (count($this->bookInventory) == $this->limit) {
            return false;
        }
        return true;
    }
}

class Page implements iPage
{
    private int $number;
    private string $content;

    public function __construct(int $number, string $content)
    {
        $this->number = $number;
        $this->content = $content;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}

class Work implements iWork
{
    protected string $name;
    protected array $pages;

    public function __construct(string $name, array $pages)
    {
        $this->name = $name;
        foreach ($pages as $index => $pageContent) {
            $this->pages[] = new Page($index + 1, $pageContent);
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPages(): array
    {
        return $this->pages;
    }

    public function getPageContent(int $pageId): ?Page
    {
        foreach ($this->pages as $page) {
            if ($page->getNumber() === $pageId) {
                return $page;
            }
        }
        return null;
    }
}

class Book extends Work
{
    public string $title;
    public string $author;

    public function __construct(string $title, array $pages, string $author)
    {
        parent::__construct($title, $pages);
        $this->title = $title;
        $this->author = $author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}

class Magazine extends Work
{
    public DateTime $publicationDate;

    public function __construct(string $name, array $pages, DateTime $publicationDate)
    {
        parent::__construct($name, $pages);
        $this->publicationDate = $publicationDate;
    }

    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }
}

class NoteBook extends Work
{
    public string $owner;

    public function __construct(string $name, array $pages, string $owner)
    {
        parent::__construct($name, $pages);
        $this->owner = $owner;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }
}

 /**
  * Debug Area
  */

// create bookshelf
$bookShelf = new BookShelf('BookShelf A', 10);

// store books
$bookShelf->storeWork(new Book('Harry Potter', ['page content 1', 'page content 2'], 'Lucas Rocha'));
$bookShelf->storeWork(new Book('Lord of Rings', ['page content 1', 'page content 2', 'page content 3', 'page content 4'], 'John Brown'));
$bookShelf->storeWork(new Book('Lake House', ['page content 1', 'page content 2', 'page content 3 - batman', 'page content 4'], 'Willian Gold'));
$bookShelf->storeWork(new Book('Moby Dick', ['page content 1', 'page content 2', 'page content 3', 'page content 4'], 'Pedro Fernandis'));
$bookShelf->storeWork(new Book('Broken Glass', ['page content 1', 'page content 2', 'page content 3 - batman', 'page content 4'], 'Sara Brock'));

// store magazines
$bookShelf->storeWork(new Magazine('Magazine 1', ['page content 1', 'page content 2'], new DateTime('NOW')));
$bookShelf->storeWork(new Magazine('Magazine 2', ['page content 1', 'page content 2'], new DateTime('NOW')));

// store notebooks
$bookShelf->storeWork(new NoteBook('Notebook 1', ['page content 1', 'page content 2'], 'Steve Dalton'));
$bookShelf->storeWork(new NoteBook('Notebook 2', ['page content 1', 'page content 2'], 'Mathias Berwig'));
$bookShelf->storeWork(new NoteBook('Notebook 3', ['page content 1', 'page content 2'], 'Paul Hering'));


$allWorks = $bookShelf->getWorks();

echo "######################################" . PHP_EOL;

echo "All Works: " . PHP_EOL;
print_r($allWorks);

echo "######################################" . PHP_EOL;

// limit reached
$bookShelf->storeWork(new Book('A Little Life', ['page content 1', 'page content 2'], 'Jeff Gray'));

echo "######################################" . PHP_EOL;

echo "BookShelf '{$bookShelf->getName()}' Works: " . PHP_EOL;
foreach ($allWorks as $index => $book) {
    echo $index + 1 . ": " . $book->getName() . PHP_EOL;
}

echo "######################################" . PHP_EOL;

echo "BookShelf Available Space: {$bookShelf->getAvailableSpace()} Works " . PHP_EOL;
echo "BookShelf Busy Space: {$bookShelf->getBusySpace()} Works " . PHP_EOL;

echo "######################################" . PHP_EOL;

$query = 'batman';
$searchResult = $bookShelf->searchWorksByPage($query);
echo "Search '$query' inside BookShelf '{$bookShelf->getName()}': " . PHP_EOL;
foreach ($searchResult as $index => $book) {
    echo "> Work " . $index + 1 . ": " . $book->getName() . PHP_EOL;
    foreach ($book->getPages() as $page) {
        echo ">>>>> Page number: " . $page->getNumber() . PHP_EOL;
        echo ">>>>> Page content: " . $page->getContent() . PHP_EOL;
    }
    echo "------------------" . PHP_EOL;
}

echo "######################################" . PHP_EOL;
$name = 'Lord of Rings';
$searchByNameResult = $bookShelf->findWorkByName($name);
echo "Search name '$name' inside BookShelf '{$bookShelf->getName()}': " . PHP_EOL;
$pageNumber = 2;
if ($searchByNameResult) {
    echo "> Work:  " .  $searchByNameResult->getName() . PHP_EOL;
    echo ">> Get Page Content By Page Number. Page Number: " . $pageNumber . PHP_EOL;
    $pageResult = $searchByNameResult->getPageContent($pageNumber);
    echo ">>> Page content: " . ($pageResult->getContent() ?: 'Not Found') . PHP_EOL;
}
