var authors = 1; //number of authors starts minimally at 1

// This function validates the ISBN input dynamically
function validate(isbn) {
    var isbnhtml = document.getElementById("isbnvalidate");
    var autofillbtn = document.getElementById("autofillBtn");

    // if ISBN is empty, Not a number, or not 13 digits, give validation message and block autofill button.
    isbn = isbn.trim(); // trimming beginning and ending spaces.
    if (isbn == "") {
        isbnhtml.innerHTML = "Please enter ISBN!";
        autofillbtn.disabled = true;
        return;
    }
    if (isNaN(isbn)) {
        isbnhtml.innerHTML = "Invalid format! Only include digits.";
        autofillbtn.disabled = true;
        return;
    }
    if (isbn.length != 13) {
        isbnhtml.innerHTML = "ISBN should be 13 Digits!";
        autofillbtn.disabled = true;
        return;
    } else {
        // if reached this point, then format is valid.
        isbnhtml.innerHTML = "";
        autofillbtn.disabled = false;
    }
}

// This function calls google boooks API primarly and open library API secondary in case of any errors, then fills data dynamically.
async function callApi() {
    var isbn = document.getElementById("ISBN").value;
    validate(isbn); // revalidating just in case!

    try {
        // API request to fetch book details
        const response = await fetch(
            "https://www.googleapis.com/books/v1/volumes?q=ISBN:" + isbn
        );
        // Parse response JSON
        const data = await response.json();
        // Extract book information from the api request
        const bookInfo = await data.items[0].volumeInfo;

        // filling book form fields
        document.getElementsByName("Title")[0].value = bookInfo.title;
        numAuthors = bookInfo.authors.length;
        document.getElementsByName("Author[]")[0].value = bookInfo.authors[0];

        fillAuthorFields(numAuthors, bookInfo);

        document.getElementsByName("Category")[0].value =
            bookInfo.categories[0];
        document.getElementsByName("Description")[0].value =
            bookInfo.description;
        var pic = bookInfo.imageLinks.thumbnail;
        if (pic != "") {
            document.getElementsByName("BookCover")[0].value = pic;
        } else {
            // secondAPI()
        }

        document.getElementsByName("num_of_pages")[0].value =
            bookInfo.pageCount;
        document.getElementsByName("publisher")[0].value = bookInfo.publisher;

        let publish_year = new Date(bookInfo.publishedDate).getFullYear();
        document.getElementsByName("publish_year")[0].value = publish_year;
    } catch (error) {
        console.error("Error fetching book details:", error);
    }
}

// This function fills in multiple authors as needed, and removing extra unnecessary fields
function fillAuthorFields(numAuthors, bookInfo) {
    for (let i = 1; i < numAuthors; i++) {
        if (!document.getElementsByName("Author[]")[i]) {
            addAuthor();
        }
        document.getElementsByName("Author[]")[i].value = bookInfo.authors[i];
    }

    numOfAuthorFields = document.getElementsByName("Author[]").length;
    for (let i = numOfAuthorFields - 1; i >= numAuthors; i--) {
        removeAuthor();
    }
}

// This function adds author text fields as needed on call.
function addAuthor() {
    ++authors;
    // Get the container element
    const container = document.getElementById("AuthorOption");

    // Create a new input element
    const inputField = document.createElement("input");

    // Set the input field attributes
    inputField.type = "text";
    inputField.name = "Author[]";
    inputField.placeholder = "Author " + authors;

    // Add the input field to the container
    container.appendChild(inputField);
}

// This function removes the last input text field
function removeAuthor() {
    // Get the container element
    const container = document.getElementById("AuthorOption");

    // Get all input fields from the container
    const inputFields = container.getElementsByTagName("input");

    // Check if there is more than one input field
    if (inputFields.length > 1) {
        // Remove the last input field
        container.removeChild(inputFields[inputFields.length - 1]);
        --authors;
    }
}

// async function secondAPI(){

// }
