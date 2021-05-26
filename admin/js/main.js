$(document).ready(function () {
  var serverUrl = "http://localhost/madiba_panel/madiba_server/api/";
  const urlPath = "http://localhost/madiba_panel/admin/";

  // codes to activate active link

  const paths = "/madiba_panel/admin/";
  const home = paths + "index.php";
  const users = paths + "users.php";
  const events = paths + "events.php";
  const books = paths + "books.php";
  const news = paths + "news.php";

  if (window.location.pathname === home) {
    $("li#home").attr("id", "activated");
  }
  if (window.location.pathname === users) {
    $("li#users").attr("id", "activated");
  }
  if (window.location.pathname === events) {
    $("li#events").attr("id", "activated");
  }
  if (window.location.pathname === books) {
    $("li#books").attr("id", "activated");
  }
  if (window.location.pathname === news) {
    $("li#events").attr("id", "activated");
  }

  // wiring process

  //  get user classes info
  $.ajax({
    type: "GET",
    url: serverUrl + "/user/read.user.class.php",
    dataType: "JSON",
    success: function (response) {
      const res = response.data;
      console.log("user classes", res);
      for (let r in res) {
        $("select#selectUserClass").append(
          '<option value="' +
            res[r].id +
            '">' +
            res[r].classe_title +
            "</option>"
        );
      }
    },
  });

  //  BOOKS STUFF

  // get all books categories from db

  const booksCategoryIconUrl = serverUrl + "book/";

  $.ajax({
    type: "GET",
    url: serverUrl + "/book/read.book.categories.php",
    dataType: "JSON",
    beforeSend: function(){
      $("div#loader").show();
    },
    complete: function(){
      $("div#loader").hide();
    },
    success: function (response) {
      const res = response.data;
      console.log("booksCategory", res);

      for (r in res) {
        $("div#books_catgeory").append(
          ' <div class="col-sm-6 col-md-3"  style="cursor:pointer;">\n' +
            '<div class="card card-stats card card-round"  >\n' +
            '<div class="card-body">\n' +
            '<div class="row">\n' +
            '<div class="col-5">\n' +
            '<div class="icon-big text-center">\n' +
            "<img src = " +
            booksCategoryIconUrl +
            res[r].icon_image +
            " style= 'height: 50px;width: 50px;'>\n" +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-7 col-stats">\n' +
            '<div class="numbers">\n' +
            '<p class="card-category">' +
            res[r].title +
            "</p>\n" +
            '<p class="card-category">' +
            res[r].userClass +
            "</p>\n" +
            '<h4 class="card-title">' +
            res[r].number_of_books +
            " Books</h4>\n" +
            "</div>\n" +
            "</div>\n" +
            "</div>\n" +
            "<div class='col-md-12'>\n" +
            "<div class='row'>\n" +
            "<div class='col-md-4'>\n" +
            '<button class="btn btn-primary btn-border btn-round" data-catid ="' +
            res[r].id +
            '" id="book_category_card">View </button\n>' +
            "</div>\n" +
            "<div class='col-md-4'>\n" +
            '<button class="btn btn-info btn-border btn-round" data-catid ="' +
            res[r].id +
            '" id="book_category_card">Edit</button\n>' +
            "</div>\n" +
            "<div class='col-md-4'>\n" +
            '<button class="btn btn-danger btn-border btn-round" data-catid ="' +
            res[r].id +
            '" id="book_category_cardDelete">Delete</button\n>' +
            "</div>\n" +
            "</div>\n" +
            "</div>\n" +
            "</div>\n" +
            "</div>\n" +
            "</div>"
        );
      }
    },
  });
  // end of getting books category

  // get all books from single category

  $("div#books_catgeory").on("click", "button#book_category_card", function () {
    const catId = $(this).data("catid");
    console.log(catId);
  });

  $.ajax({
    type: "GET",
    url: serverUrl + "book/read.books.php",
    dataType: "JSON",
    success: function (response) {
      const res = response;
      console.log("res", res);
      $("h4#all_books_panel").html(response.length);
    },
  });

  // add new book category
  var userClassId;
  $("select#selectUserClass").change(function () {
    userClassId = $(this).val();
  });

  $("input#addCategory").click(function (event) {
    event.preventDefault();
    // Get form
    var form = $("#my-form")[0];
    // get data

    var icon = $("input#categoryIcon")[0].files[0];
    var categoryTitle = $("input#categoryTitle").val();
    var categoryNumBooks = $("input#categoryBookNumbers").val();
    var categoryLang = $("input#categoryTitle").val();

    // FormData object
    var newBookCatData = new FormData(form);

    newBookCatData.append("title", categoryTitle);
    newBookCatData.append("number_of_books", categoryNumBooks);
    newBookCatData.append("languages", categoryLang);
    newBookCatData.append("avatar", icon);
    newBookCatData.append("user_classesId", userClassId);

    // disabled the submit button
    $("#input#addCategory").attr("disabled", "disabled");
    $.ajax({
      url: serverUrl + "book/create.book.category.php",
      data: newBookCatData,
      cache: false,
      contentType: false,
      processData: false,
      type: "POST",
      beforeSend: function(){
        $("div#loader").show();
      },
      complete: function(){
        $("div#loader").hide();
      },
      success: function (data) {
        swal("Done!", "Category was succesfully added !", "success");
        $("div#addNewCategory").modal("hide");
        swal.close();
        setTimeout(function () {
          window.location = window.location;
        }, 3000);
      },
    });
    // Display the key/value pairs
    for (var pair of newBookCatData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  });

  // end add new book category


  // delete book category 


  // end of delete book category 

  // BOOK STUFF ENDS
});
