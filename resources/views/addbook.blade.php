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
            <input type="text" name="Author" required>
        <label for="Category">Category</label>
            <input type="text" name="Category" required>
        <label for="Description">Description</label>
            <input type="text" name="Description" required>
        <label for="BookCover">Book Cover URL</label>
            <input type="text" name="BookCover" required>

            <br>
        <button type="button" onclick="callApi()" id=autofillBtn disabled> Autofill </button>
        <button type="button" onclick="addAuthor()" id=addAuthor > Add authors </button>
        <button type="button" onclick="RemoveAuthor()" id=RemoveAuthor > Remove authors </button>

        <button type="submit">Add book</button>
    </form>
    <script>
        var numAuthorsOption = 1;
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
                numAuthors = bookInfo.authors[0].length;
                addAuthor()
                document.getElementsByName("Author")[0].value = bookInfo.authors[0];
                document.getElementsByName("Category")[0].value = bookInfo.categories[0];
                document.getElementsByName("Description")[0].value = bookInfo.description;
                var pic = bookInfo.imageLinks.thumbnail;
                if (pic != ""){
                    document.getElementsByName("BookCover")[0].value = pic;  
                } else {
                    // secondAPI()
                }
                document.getElementByName("")  
            } catch (error) {
                console.error('Error fetching book details:', error);
            }
        }
        // async function secondAPI(){

        // }
    </script>
</div>