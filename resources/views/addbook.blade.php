<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add book</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Assuming your CSS file is in a folder named 'css' --> --}}
</head>
<div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
    {{-- <input type="image" border=50px src=hello.jpg> --}}
    <form action="POST">
        <label for="ISBN">ISBN</label>
            <input type="text" name="ISBN" id=ISBN onkeyup="validate(this.value)" placeholder=123456789012 required>
            <p id=isbnvalidate></p>
        <label for="Title">Title</label>
            <input type="text" name="Title" required>
            <label for="Author">Author</label>
        <div id="AuthorOption">
        <input type="text" placeholder="Author" name="Author[]" required>
        </div>
        


        <label for="Category">Category</label>
            <input type="text" name="Category" required>
        <label for="Description">Description</label>
            <input type="text" name="Description" required>
        <label for="BookCover">Book Cover URL</label>
            <input type="text" name="BookCover" required>

            <br>
        <button type="button" onclick="callApi()" id=autofillBtn disabled> Autofill </button>
        <button onclick="addAuthor()">Add Author</button>
    <button onclick="removeAuthor()">Remove Author</button>

        <button type="submit">Add book</button>
    </form>
    <script>
         var authors=1;
        function validate(isbn){
            var isbnhtml = document.getElementById("isbnvalidate");
            var autofillbtn = document.getElementById("autofillBtn");
            if (isbn.trim() == "") {
                isbnhtml.innerHTML = "Please enter ISBN!"
                // autofillbtn.disabled = true;
                return
            }
            if (isNaN(isbn)){
                isbnhtml.innerHTML = "Invalid format! Only include digits."
                autofillbtn.disabled = true;
                return;
            }
            if (isbn.length != 13){
                isbnhtml.innerHTML = "ISBN should be 13 Digits!"
                autofillbtn.disabled = true;
                return;
            } else {
                isbnhtml.innerHTML = ""
                autofillbtn.disabled = false;
            }
        }

        async function callApi(){
            var isbn = document.getElementById("ISBN").value;
            validate(isbn)

            try {
                // API request to fetch book details
                const response = await fetch('https://www.googleapis.com/books/v1/volumes?q=ISBN:' + isbn);
                // Parse response JSON
                const data = await response.json();
                // Extract book information from the api request
                const bookInfo = await data.items[0].volumeInfo;

                // fill book form field
                document.getElementsByName("Title")[0].value = bookInfo.title;
                numAuthors = bookInfo.authors.length;
                document.getElementsByName("Author[]")[0].value = bookInfo.authors[0];
                for (let i = 1 ; i < numAuthors; i++)
                {
                    addAuthor();
                    document.getElementsByName("Author[]")[i].value = bookInfo.authors[i];
                }
                
                document.getElementsByName("Category")[0].value = bookInfo.categories[0];
                document.getElementsByName("Description")[0].value = bookInfo.description;
                var pic = bookInfo.imageLinks.thumbnail;
                if (pic != ""){
                    document.getElementsByName("BookCover")[0].value = pic;  
                } else {
                    // secondAPI()
                }
  
            } catch (error) {
                console.error('Error fetching book details:', error);
            }
        }
        function addAuthor() {
            ++authors
            // Get the container element
            const container = document.getElementById('AuthorOption');
            
            // Create a new input element
            const inputField = document.createElement('input');
            
            // Set the input field attributes
            inputField.type = 'text';
            inputField.name = 'Author[]';
            inputField.placeholder="Author "+authors; 
            
            
            // Add the input field to the container
            container.appendChild(inputField);
        }

        // Function to remove the last input text field
        function removeAuthor() {
            // Get the container element
            const container = document.getElementById('AuthorOption');
            
            // Get all input fields from the container
            const inputFields = container.getElementsByTagName('input');
            
            // Check if there is more than one input field
            if (inputFields.length > 1) {
                // Remove the last input field
                container.removeChild(inputFields[inputFields.length - 1]);
                --authors
            }
        }
        // async function secondAPI(){

        // }
    </script>
</div>