$(document).ready(function () {
  var serverUrl = "http://localhost/madiba_panel/madiba_server/api/";
  const urlPath = "http://localhost/madiba_panel/admin/";

  let tableAllBooks;
  // $("#all_books_table").DataTable();
  // codes to activate active link

  const paths = "/madiba_panel/admin/";
  const home = paths + "index.php";
  const users = paths + "users.php";
  const events = paths + "events.php";
  const books = paths + "books.php";
  const news = paths + "news.php";
  const allbooks = paths + "allbooks.php";

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
  if (window.location.pathname === allbooks) {
    $("li#allbooks").attr("id", "activated");
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
            "[" +
            res[r].age_range +
            "]" +
            "</option>"
        );
      }
    },
  });

  // get book categories by user class

  $("select#selectUserClass").on("change", function () {
    console.log($(this).val());
  });
  $.ajax({
    type: "GET",
    url: serverUrl + "book/read.book.categories.php",
    dataType: "JSON",
    success: function (response) {
      const res = response.data;
      console.log("user classes", res);
      for (let r in res) {
        $("select#selectBookCategory").append(
          '<option value="' +
            res[r].id +
            '">' +
            res[r].title +
            "[" +
            res[r].age_range +
            "]" +
            "</option>"
        );
      }
    },
  });
  // end get book categories

  //  BOOKS STUFF

  // get all books categories from db

  const booksCategoryIconUrl = serverUrl + "book/";
  const allBookIconUrl = serverUrl + "book/";

  $.ajax({
    type: "GET",
    url: serverUrl + "/book/read.book.categories.php",
    dataType: "JSON",
    beforeSend: function () {
      $("div#loader").show();
    },
    complete: function () {
      $("div#loader").hide();
    },
    success: function (response) {
      const res = response.data;
      console.log("booksCategory", res);

      for (r in res) {
        $("div#books_catgeory").append(
          ' <div class="col-sm-6 col-md-3"   >\n' +
            '<div class="card card-stats card card-round"  >\n' +
            '<div class="card-body">\n' +
            '<div class="row">\n' +
            '<div class="col-5">\n' +
            '<div class="icon-big text-center">\n' +
            "<img src = " +
            booksCategoryIconUrl +
            res[r].icon_image +
            " style= 'height: 150px;width: 150px; margin:15px 0px;'>\n" +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-7 col-stats">\n' +
            '<div class="numbers">\n' +
            '<p class="card-category">' +
            res[r].title +
            "</p>\n" +
            '<p class="card-category">' +
            res[r].age_range +
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
            '<a href="allbooks.php" class="btn btn-primary btn-border btn-round" data-catidview ="' +
            res[r].id +
            '" id="book_category_card">View </a>\n' +
            "</div>\n" +
            "<div class='col-md-4'>\n" +
            '<button class="btn btn-info btn-border btn-round" data-catid ="' +
            res[r].id +
            '" id="book_category_cardEdit" data-toggle="modal" data-target="#updateCategory">Edit</button\n>' +
            "</div>\n" +
            "<div class='col-md-4'>\n" +
            '<button class="btn btn-danger btn-border btn-round" data-catid ="' +
            res[r].id +
            '" id="book_category_cardDelete">Delete</button\n>' +
            '<center><br/><div class="spinner-border text-primary" role="status" id="loaderDelete" style="display:none;">\n' +
            '<span class="sr-only">Loading...</span>\n' +
            "</center></div>\n" +
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
    var categoryLang = $("input#categoryLang").val();

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
      beforeSend: function () {
        $("div#loaderAdd").show();
      },
      complete: function () {
        $("div#loaderAdd").hide();
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
  $("div#books_catgeory").on(
    "click",
    "button#book_category_cardDelete",
    function () {
      var categoryIdDel = $(this).data("catid");
      var dataDel = {
        id: categoryIdDel,
      };
      $.ajax({
        type: "POST",
        url: serverUrl + "/book/delete.book.category.php",
        data: JSON.stringify(dataDel),
        dataType: "JSON",
        beforeSend: function () {
          $("div#loaderDelete").show();
        },
        complete: function () {
          $("div#loaderDelete").hide();
        },
        success: function (response) {
          const res = response;
          console.log("res", res);
          setTimeout(function () {
            window.location = window.location;
          }, 2000);
        },
      });
    }
  );
  // end of delete book category

  // update book category

  $("div#books_catgeory").on(
    "click",
    "button#book_category_cardEdit",
    function () {
      var catIdUpdate = $(this).data("catid");

      $.ajax({
        type: "POST",
        cache: false,

        url:
          serverUrl + "/book/read.single.book.category.php?id=" + catIdUpdate,
        dataType: "JSON",
        beforeSend: function () {
          $("div#loaderUpdateClass").show();
        },
        complete: function () {
          $("div#loaderUpdateClass").hide();
        },
        success: function (response) {
          console.log(response);
          const res = response;

          $("form#my-form-update").html(
            '<div class="row">\n' +
              '<div class="col-sm-12">\n' +
              '<div class="form-group form-floating-label"><br/>\n' +
              '<input id="categoryTitles" type="text"  value="' +
              res.title +
              '" class="form-control input-border-bottom"  >\n' +
              '<label for="inputFloatingLabel" class="placeholder">Title</label>\n' +
              "</div>\n" +
              "</div>\n" +
              '<div class="col-md-6 pr-0">\n' +
              '<div class="form-group form-floating-label"><br/>\n' +
              '<input id="categoryBookNumberss" type="number"  value="' +
              res.number_of_books +
              '"class="form-control input-border-bottom" required>\n' +
              '<label for="inputFloatingLabel" class="placeholder">Number of Books</label>\n' +
              "</div>\n" +
              "</div>\n" +
              '<div class="col-md-6">\n' +
              '<div class="form-group form-floating-label"></br>\n' +
              '<input id="categoryLangs" type="text" value="' +
              res.languages +
              '" class="form-control input-border-bottom" required>\n' +
              '<label for="inputFloatingLabel" class="placeholder">Languages</label>\n' +
              "</div>\n" +
              "</div>\n" +
              '<div class="col-md-6">\n' +
              '<div class="form-group form-floating-label"></br>\n' +
              '<select class="form-control input-border-bottom" id="selectUserClass" required>\n' +
              '<option value="0">Select User Class</option>\n' +
              "</select>\n" +
              '<label for="selectFloatingLabel" class="placeholder">User Class</label>\n' +
              "</div>\n" +
              "</div>\n" +
              '<div class="col-md-6">\n' +
              '<div class="form-group form-floating-label"></br>\n' +
              '<input id="categoryIconz" type="file" class="form-control input-border-bottom" required>\n' +
              '<label for="inputFloatingLabel" class="placeholder">Icon Image</label>\n' +
              "</div>\n" +
              "</div>\n" +
              "</div>\n" +
              "</div>\n" +
              '<div class="modal-footer no-bd">\n' +
              '<input id="updateCategory" class="btn btn-primary" type="submit" value="Update">\n' +
              '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\n' +
              "</div>\n" +
              "<center>\n" +
              '<div class="spinner-border text-primary" role="status" id="loaderUpd" style="display: none;">\n' +
              '<span class="sr-only">Loading...</span>\n' +
              "</div>\n" +
              "</center>"
          );

          $.ajax({
            type: "GET",
            url: serverUrl + "/user/read.user.class.php",
            dataType: "JSON",
            success: function (response) {
              const res = response.data;
              console.log("user selectable", res);
              for (let r in res) {
                $("select#selectUserClass").append(
                  '<option value="' +
                    res[r].id +
                    '">' +
                    res[r].classe_title +
                    "[" +
                    res[r].age_range +
                    "]" +
                    "</option>"
                );
              }
            },
          });
        },
      });
    }
  );

  $("input#updateCategory").click(function (event) {
    event.preventDefault();
    var form = $("#my-form-update")[0];

    var title = $("input#categoryTitles").val();
    var numbers = $("input#categoryBookNumberss").val();
    var lang = $("input#categoryLangs").val();
    var classes = $("select#selectUserClass").val();
    var icon = $("input#categoryIconz")[0].files[0];

    // get data

    var updateBookCatData = new FormData(form);

    updateBookCatData.append("title", title);
    updateBookCatData.append("number_of_books", numbers);
    updateBookCatData.append("languages", lang);
    updateBookCatData.append("avatar", icon);
    updateBookCatData.append("user_classesId", classes);

    $.ajax({
      url: serverUrl + "book/update.book.category.php",
      data: updateBookCatData,
      cache: false,
      contentType: false,
      processData: false,
      type: "POST",
      beforeSend: function () {
        $("div#loaderUpd").show();
      },
      complete: function () {
        $("div#loaderUpd").hide();
      },
      success: function (data) {
        swal("Done!", "Category was succesfully Updated !", "success");
        $("div#updateCategory").modal("hide");

        setTimeout(function () {
          window.location = window.location;
        }, 3000);
      },
    });
    // Display the key/value pairs
    for (var pair of updateBookCatData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  });
  // end of update book category

  // create new book

  var userClassIdNew;
  $("select#selectUserClass").change(function () {
    userClassIdNew = $(this).val();
  });
  $("input#addBook").click(function () {
    event.preventDefault();

    var form = $("#my-form-add-book")[0];

    var title = $("input#bookTitle").val();
    var numbers = $("input#bookNumbers").val();
    var authors = $("input#authors").val();
    var userclasses = userClassIdNew;
    var iconBook = $("input#bookIcon")[0].files[0];

    var bookCategory = $("select#selectBookCategory").val();
    var bookLang = $("input#bookLang").val();
    var bookSummary = $("textarea#summary").val();
    console.log(iconBook);

    var createBookData = new FormData(form);

    createBookData.append("title", title);
    createBookData.append("numbers", numbers);
    createBookData.append("authors", authors);
    createBookData.append("avatar", iconBook);
    createBookData.append("summary", bookSummary);
    createBookData.append("book_categoryId", bookCategory);
    createBookData.append("user_classesId", userclasses);
    createBookData.append("isAvailable", 1);
    createBookData.append("language", bookLang);

    $.ajax({
      url: serverUrl + "book/create.book.php",
      data: createBookData,
      cache: false,
      contentType: false,
      processData: false,
      type: "POST",
      beforeSend: function () {
        $("div#loaderAddBook").show();
      },
      complete: function () {
        $("div#loaderAddBook").hide();
      },
      success: function (data) {
        if (data.error) {
          swal("Done!", data.message, "error");
        } else {
          swal("Done!", "Book was succesfully Added !", "success");
          $("div#addNewBook").modal("hide");
        }

        setTimeout(function () {
          window.location.replace(urlPath + "allbooks.php");
        }, 2000);
      },
    });
    // Display the key/value pairs
    for (var pair of createBookData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  });
  // end create new book

  // read all books

  var availabilityBook;
  tableAllBooks = $("#all_books_table").DataTable({
    columnDefs: [{ width: 150, targets: 8 }],
  });
  $.ajax({
    type: "GET",
    url: serverUrl + "book/read.books.php",
    dataType: "JSON",
    beforeSend: function () {
      $("div#loaderAllBooks").show();
    },
    complete: function () {
      $("div#loaderAllBooks").hide();
    },
    success: function (response) {
      const res = response.data;

      for (let r in res) {
        switch (res[r].thisBookIsAvailable) {
          case 1:
            retuavailabilityBook = "Available";
            break;
          case 0:
            availabilityBook = "Not Available";
            break;
          default:
            availabilityBook = "Available";
        }
        console.log("all books classes", res);
        tableAllBooks.row.add([
          '<div class="avatar ">\n' +
            '<img src="' +
            allBookIconUrl +
            res[r].image +
            '" alt="..." class="avatar-img rounded-circle">\n' +
            "</div>\n",
          res[r].title,
          res[r].numbers,
          res[r].authors,
          res[r].languages,
          res[r].book_category,
          res[r].user_class + "(" + res[r].age_range + ")",
          availabilityBook,
          '<button type="button"  data-bookId = "' +
            res[r].id +
            '"  id="viewBookDetail" class="btn btn-icon btn-round btn-primary" data-toggle="modal" data-target="#viewSingleBook">\n' +
            '<i class="fa fa-eye"></i>\n' +
            "</button>\n" +
            '<button type="button"  id="updateSingleBookbtn" data-bookId= "' +
            res[r].id +
            '" class="btn btn-icon btn-round btn-info" data-toggle="modal" data-target="#updateSingleBook">\n' +
            '<i class="fa fa-pen"></i>\n' +
            "</button>\n" +
            '<button type="button" class="btn btn-icon btn-round btn-danger ">\n' +
            '<i class="fa fa-trash"></i>\n' +
            "</button>",
        ]);
      }
      tableAllBooks.draw();
    },
  });

  // end read all books

  // read single book
  $("#all_books_table").on("click", "button#viewBookDetail", function () {
    const bookIdView = $(this).data("bookid");
    $.ajax({
      type: "GET",
      url: serverUrl + "book/read.single.book.php?id=" + bookIdView,
      dataType: "JSON",
      success: function (response) {
        const res = response;
        console.log("book detail", res);
        $("p#book_title").html(res.title);
        $("div#book_detail_div").html(
          '<div class="avatar avatar-xxl">\n' +
            "<img src=" +
            allBookIconUrl +
            res.image +
            ' alt="..." class="avatar-img rounded">\n' +
            "</div>\n" +
            '<ul class="specification-list">\n' +
            "<li>\n" +
            '<span class="name-specification">Number of Books:</span>\n' +
            '<span class="status-specification">' +
            res.numbers +
            "</span>\n" +
            "</li>\n" +
            "<li>\n" +
            '<span class="name-specification">Authors:</span>\n' +
            '<span class="status-specification">' +
            res.authors +
            "</span>\n" +
            "</li>\n" +
            "<li>\n" +
            '<span class="name-specification">Languages</span>\n' +
            '<span class="status-specification">' +
            res.languages +
            "</span>\n" +
            "</li>\n" +
            "<li>\n" +
            '<span class="name-specification">Class:</span>\n' +
            '<span class="status-specification">' +
            res.user_class +
            "</span>\n" +
            "</li>\n" +
            "<li>\n" +
            '<span class="name-specification">Age:</span>\n' +
            '<span class="status-specification">' +
            res.age_range +
            "</span>\n" +
            "</li>\n" +
            "</ul>"
        );
      },
    });
  });

  // end read single book

  // update single book

  $("#all_books_table").on("click", "button#updateSingleBookbtn", function () {
    const updateBookId = $(this).data("bookid");

    //  grab user class again

    $.ajax({
      type: "GET",
      url: serverUrl + "user/read.user.class.php",
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
              "[" +
              res[r].age_range +
              "]" +
              "</option>"
          );
        }
      },
    });

    $.ajax({
      type: "GET",
      url: serverUrl + "book/read.single.book.php?id=" + updateBookId,
      dataType: "JSON",
      beforeSend: function () {
        $("div#loadersingleBookInfoForm").show();
      },
      complete: function () {
        $("div#loadersingleBookInfoForm").hide();
      },
      success: function (response) {
        console.log("single book info", response);
        $("form#my-form-update-book").html(
          '<div class="row">\n' +
            '<div class="col-sm-12">\n' +
            '<div class="form-group ">\n' +
            '<label for="inputFloatingLabel" class="placeholder">Title</label>\n' +
            '<input id="bookTitle" type="text" value= "' +
            response.title +
            '" class="form-control input-border-bottom" required>\n' +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-md-6 pr-0">\n' +
            '<div class="form-group ">\n' +
            '<label for="inputFloatingLabel" class="placeholder">Number of Books</label>\n' +
            '<input id="bookNumbers" value= "' +
            response.numbers +
            '" type="number" class="form-control input-border-bottom" required>\n' +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-md-6">\n' +
            '<div class="form-group ">\n' +
            '<label for="inputFloatingLabel" class="placeholder">Authors</label>\n' +
            '<input id="authors" type="text"   value="' +
            response.authors +
            '"  class="form-control input-border-bottom" required>\n' +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-md-6">\n' +
            '<div class="form-group ">\n' +
            '<label for="inputFloatingLabel" class="placeholder">Icon Image</label>\n' +
            '<input id="bookIcon" type="file" class="form-control input-border-bottom" required>\n' +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-md-6">\n' +
            '<div class="form-group ">\n' +
            '<label for="selectFloatingLabel" class="placeholder">User Class</label>\n' +
            '<select class="form-control input-border-bottom" id="selectUserClass" required>\n' +
            '<option value="0">Select User Class</option>\n' +
            "</select>\n" +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-md-6">\n' +
            '<div class="form-group ">\n' +
            '<label for="selectFloatingLabel" class="placeholder">Book Category</label>\n' +
            '<select class="form-control input-border-bottom" id="selectBookCategory" required>\n' +
            '<option value="0">Select Book Category</option>\n' +
            "</select>\n" +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-md-6">\n' +
            '<div class="form-group ">\n' +
            '<label for="inputFloatingLabel" class="placeholder">Languages</label>\n' +
            '<input id="bookLang" value="' +
            response.languages +
            '" type="text" class="form-control input-border-bottom" required>\n' +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-md-12">\n' +
            '<div class="form-group">\n' +
            '<label for="comment">Summary</label>\n' +
            '<textarea class="form-control" id="summary" rows="5">' +
            response.summary +
            "</textarea>\n" +
            "</div>\n" +
            "</div>\n" +
            "</div>\n" +
            "</div>\n" +
            '<div class="modal-footer no-bd">\n' +
            '<input id="addBook" class="btn btn-primary" type="submit" value="Add">\n' +
            '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\n' +
            "</div>\n" +
            "<center>\n" +
            '<div class="spinner-border text-primary" role="status" id="loaderAddBook" style="display: none;">\n' +
            '<span class="sr-only">Loading...</span>\n' +
            "</div>\n" +
            "</center>"
        );
      },
    });
  });
  // event.preventDefault();

  // var form = $("#my-form-update-book")[0];

  // var title = $("input#bookTitle").val();
  // var numbers = $("input#bookNumbers").val();
  // var authors = $("input#authors").val();
  // var userclasses = userClassIdNew;
  // var iconBook = $("input#bookIcon")[0].files[0];

  // var bookCategory = $("select#selectBookCategory").val();
  // var bookLang = $("input#bookLang").val();
  // var bookSummary = $("textarea#summary").val();
  // console.log(iconBook);

  // var updateBookData = new FormData(form);

  // updateBookData.append("title", title);
  // updateBookData.append("numbers", numbers);
  // updateBookData.append("authors", authors);
  // updateBookData.append("avatar", iconBook);
  // updateBookData.append("summary", bookSummary);
  // updateBookData.append("book_categoryId", bookCategory);
  // updateBookData.append("user_classesId", userclasses);
  // updateBookData.append("isAvailable", 1);
  // updateBookData.append("language", bookLang);

  // end update single book

  // BOOK STUFF ENDS
  $.ajax({
    type: "GET",
    url: serverUrl + "/user/read.user.category.php",
    dataType: "JSON",
    beforeSend: function () {
      $("div#loaderUserCategory").show();
    },
    complete: function () {
      $("div#loaderUserCategory").hide();
    },
    success: function (response) {
      const res = response.data;
      console.log("user category", res);

      for (let r in res) {
        $("div#all_user_categories").append(
          '<div class="col-6 col-sm-4 col-lg-2">\n' +
            '<div class="card">\n' +
            '<div class="dropdown">\n' +
            '<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
            "</button>\n" +
            '<div class="dropdown-menu" aria-labelledby="dropdownMenu2">\n' +
            '<button data-userCatId= "' +
            res[r].id +
            '" class="dropdown-item" type="button" id="userCategoryDel">Delete</button>\n' +
            '<button data-userCatId= "' +
            res[r].id +
            '" class="dropdown-item" type="button" id="userCategoryEdit" data-toggle="modal" data-target="#updateNewUserCat">Edit</button>\n' +
            "</div>\n" +
            "</div>\n" +
            '<div class="card-body p-5 text-center">\n' +
            '<div class="text-center text-success">\n' +
            "<p> Rwf /Month</p></div>\n" +
            '<div class="h1 m-0">' +
            res[r].membership_fees +
            "</div>\n" +
            '<div class="text-muted mb-3">' +
            res[r].title +
            "</div>\n" +
            '<input type="text" value="' +
            res[r].id +
            '"  id="userCatId" hidden>\n' +
            "</div>\n" +
            "</div>\n" +
            "</div>\n" +
            "</div>"
        );
      }
    },
  });

  // add new user category

  $("input#addNewUserCat").click(function (e) {
    e.preventDefault();

    const title = $("input#userCatTitle");
    const membership = $("input#userCatMembershipFees");

    const newUserCatData = {
      title: title.val(),
      membership_fees: membership.val(),
    };

    $.ajax({
      type: "POST",
      cache: false,
      data: JSON.stringify(newUserCatData),
      url: serverUrl + "/user/create.user.category.php",
      dataType: "JSON",
      beforeSend: function () {
        $("div#loaderAddUserCategory").show();
      },
      complete: function () {
        $("div#loaderAddUserCategory").hide();
      },
      success: function (response) {
        const res = response;
        console.log("res", res);
        setTimeout(function () {
          window.location = window.location;
        }, 3000);
      },
    });
  });

  // end add new user category

  // delete new user Category
  $("div#all_user_categories").on(
    "click",
    "button#userCategoryDel",
    function () {
      const newUserCatId = $(this).data("usercatid");
      console.log(newUserCatId);
      const userCatIdDel = {
        id: newUserCatId,
      };
      $.ajax({
        type: "POST",
        cache: false,
        data: JSON.stringify(userCatIdDel),
        url: serverUrl + "/user/delete.user.category.php",
        dataType: "JSON",
        success: function (response) {
          const res = response;
          console.log("res", res);
          setTimeout(function () {
            window.location = window.location;
          }, 3000);
        },
      });
    }
  );

  // end of delete new user Category

  // update user category
  $("div#all_user_categories").on(
    "click",
    "button#userCategoryEdit",
    function () {
      const userCatId = $(this).data("usercatid");
      $.ajax({
        type: "POST",
        cache: false,
        url: serverUrl + "/user/read.single.user.category.php?id=" + userCatId,
        dataType: "JSON",
        beforeSend: function () {
          $("div#loaderupdateUserCategory").show();
        },
        complete: function () {
          $("div#loaderupdateUserCategory").hide();
        },
        success: function (response) {
          const res = response;
          console.log("res", res);
          $("form#updateUserCategoryForm").html(
            '<div class="row">\n' +
              '<input id="userCatId" value="' +
              res.id +
              '" type="text" class="form-control" placeholder="fill title" hidden>\n' +
              '<div class="col-md-6 pr-0">\n' +
              '<div class="form-group form-group-default">\n' +
              "<label>Title</label>\n" +
              '<input id="UpduserCatTitle" value="' +
              res.title +
              '" type="text" class="form-control" placeholder="fill title">\n' +
              "</div>\n" +
              "</div>\n" +
              '<div class="col-md-6 pr-0">\n' +
              '<div class="form-group form-group-default">\n' +
              "<label>Membership fees</label>\n" +
              '<input id="UpduserCatMembershipFees" value="' +
              res.membership_fees +
              '" type="number" class="form-control" placeholder="fill membership">\n' +
              "</div>\n" +
              "</div>\n" +
              "</div>\n" +
              '<div class="modal-footer no-bd">\n' +
              '<input type="submit" id="UpdNewUserCat" class="btn btn-primary" value="Update">\n' +
              '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\n' +
              "</div>\n" +
              "<center>\n" +
              '<div class="spinner-border text-primary" role="status" id="loaderupdateUserCategory" style="display: none;">\n' +
              '<span class="sr-only">Loading...</span>\n' +
              "</div>\n" +
              "</center>"
          );
        },
      });
    }
  );

  $("form#updateUserCategoryForm").on(
    "click",
    "input#UpdNewUserCat",
    function (e) {
      e.preventDefault();
      const title = $("input#UpduserCatTitle").val();
      const mmship = $("input#UpduserCatMembershipFees").val();
      const id = $("input#userCatId").val();

      const dataUpd = {
        id: id,
        title: title,
        membership_fees: mmship,
      };

      $.ajax({
        type: "POST",
        cache: false,
        data: JSON.stringify(dataUpd),
        url: serverUrl + "user/update.user.category.php",
        dataType: "JSON",
        beforeSend: function () {
          $("div#loaderupdateUserCategory").show();
        },
        complete: function () {
          $("div#loaderupdateUserCategory").hide();
        },
        success: function (response) {
          const res = response;
          console.log("res", res);
          setTimeout(function () {
            window.location = window.location;
          }, 3000);
        },
      });
    }
  );

  // end update user category

  //  get user classes
  $.ajax({
    type: "POST",
    cache: false,
    url: serverUrl + "user/read.user.class.php",
    dataType: "JSON",
    beforeSend: function () {
      $("div#loaderUserClasses").show();
    },
    complete: function () {
      $("div#loaderUserClasses").hide();
    },
    success: function (response) {
      const res = response.data;
      console.log("user classes", res);

      for (let u in res) {
        $("div#all_user_classes").append(
          '<div class="col-md-4">\n' +
            '<div class="card card-dark bg-secondary2">\n' +
            '<div class="card-body curves-shadow" id="user_class_card">\n' +
            "<h1>" +
            res[u].classe_title +
            "</h1>\n" +
            '<h5 class="op-8">User Category:' +
            res[u].user_category_title +
            "</h5>\n" +
            '<h5 class="op-8">Age:' +
            res[u].age_range +
            "</h5>\n" +
            '<div class="pull-right">\n' +
            '<h3 class="fw-bold op-8">' +
            res[u].membership_fees +
            " RWF</h3>\n" +
            "</div>\n" +
            '<button type="button" class="btn btn-icon btn-round btn-danger" data-classid= "' +
            res[u].id +
            '" id="delete_user_class">\n' +
            '<i class="fa fa-trash"></i>\n' +
            "</button>\n" +
            "</div>\n" +
            '<center><br/><div class="spinner-border text-info" role="status" id="loaderDeleteUserCat" style="display:none;">\n' +
            '<span class="sr-only">Loading...</span>\n' +
            "</center>\n" +
            "</div>\n" +
            "</div>"
        );
      }
    },
  });
  // end get user classes

  // delete user class

  $("div#all_user_classes").on(
    "click",
    "button#delete_user_class",
    function () {
      const id = $(this).data("classid");
      console.log(id);
      const dataDel = {
        id: id,
      };

      $.ajax({
        type: "DELETE",
        url: serverUrl + "user/delete.user.category.php",
        dataType: "JSON",
        data: JSON.stringify(dataDel),
        beforeSend: function () {
          $("div#loaderDeleteUserCat").show();
        },
        complete: function () {
          $("div#loaderDeleteUserCat").hide();
        },
        success: function (response) {
          const res = response.data;
          // setTimeout(function () {
          //   window.location = window.location;
          // }, 3000);
        },
      });
    }
  );
  // end delete user class
  $.ajax({
    type: "GET",
    url: serverUrl + "/user/read.user.category.php",
    dataType: "JSON",
    success: function (response) {
      const res = response.data;
      console.log("user classes", res);
      for (let r in res) {
        $("select#selectUserCategory").append(
          '<option value="' + res[r].id + '">' + res[r].title + "</option>"
        );
      }
    },
  });

  $("form#newUserClassForm").on(
    "click",
    "input#addNewUserClassButton",
    function (e) {
      e.preventDefault();
      const title = $("input#userClassTitle");
      const userCat = $("select#selectUserCategory");
      const age = $("input#userClassAge");

      const dataNewClass = {
        title: title.val(),
        user_categoryId: userCat.val(),
        age_range: age.val(),
      };

      $.ajax({
        type: "POST",
        url: serverUrl + "user/create.user.class.php",
        dataType: "JSON",
        data: JSON.stringify(dataNewClass),
        cache: false,
        beforeSend: function () {
          $("div#loaderAddUserClass").show();
        },
        complete: function () {
          $("div#loaderAddUserClass").show();
        },
        success: function (response) {
          const res = response;
        },
      });
    }
  );


});
