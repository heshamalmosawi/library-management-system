<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;

class AddBookTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_adds_a_new_book_with_valid_data()
    {
        // Prepare the input data
        $data = [
            'ISBN' => '9781234567897',
            'Title' => 'Sample Book',
            'Author' => ['John Doe', 'Jane Doe'],
            'Category' => 'Fiction',
            'BookCover' => 'http://example.com/bookcover.jpg',
            'publisher' => 'Sample Publisher',
            'publish_year' => 2021,
            'Description' => 'This is a sample book description.',
            'total_copies' => 10,
            'num_of_pages' => 200,
            'location' => 'A1'
        ];

        // Make the HTTP POST request to the addBook route
        $response = $this->post('/addbook', $data);

        // Check that the response redirects to the homepage with a success message
        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Add book successful!');

        $book = Book::where('ISBN', $data['ISBN'])->first();
        // Verify that the book was added to the database
        $this->assertDatabaseHas('books', [
            'ISBN' => $data['ISBN'],
            'title' => $data['Title'],
            'author' => implode(', ', $data['Author']),
            'bookcover_url' => $data['BookCover'],
            'publisher' => $data['publisher'],
            'category' => $data['Category'],
            'publish_date' => $data['publish_year'],
            'abstract' => $data['Description'],
            'available_copies' => $data['total_copies'],
            'total_copies' => $data['total_copies'],
            'location' => $data['location'],
            'numOfPages' => $data['num_of_pages'],
            'is_archived' => false,
        ]);

        $book->delete();
    }

    /** @test */
    public function it_requires_valid_data()
    {
        // Prepare invalid input data (missing required fields)
        $data = [];

        // Make the HTTP POST request to the addBook route
        $response = $this->post('/addbook', $data);

        // Check that the response contains validation errors
        ($response)->assertSessionHasErrors([
            'ISBN',
            'Title',
            'Category',
            'BookCover',
            'publisher',
            'publish_year',
            'Description',
            'total_copies',
            'num_of_pages',
        ]);
    }
}
