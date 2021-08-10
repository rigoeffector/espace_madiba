$(document).ready(function () {

  //created by Rigoeffector Ninja 2021
  var serverUrl = "https://madiba.isoko250.com/madiba_server/api/";
  const urlPath = "https://madiba.isoko250.com/madiba_panel/admin/";

  // var serverUrl = "http://localhost/madiba_panel/madiba_server/api/";
  // const urlPath = "http://localhost/madiba_panel/madiba_panel/admin/";

  let allEvents, allVideos, allAudios, allNews;

  // codes to activate active link

  const paths = "/madiba_panel/admin/";
  const home = paths + "index.php";
  const users = paths + "users.php";
  const events = paths + "events.php";
  const books = paths + "books.php";
  const news = paths + "news.php";
  const allbooks = paths + "allbooks.php";
  const classes = paths + "usersClasses.php";
  const audioBooks = paths + "audiobooks.php";
  const videoBooks = paths + "videobooks.php";
  const eventCats = paths + "eventCategories.php";
  const settings = paths + "settings.php";
  const reports = paths + "reports.php";
  const sliders = paths + "sliders.php";
  const usersRegister = paths + "registereduser.php";
  if (window.location.pathname === home) {
    $("li#home").attr("id", "activated");
  }
  if (window.location.pathname === usersRegister) {
    $("li#usersReg").attr("id", "activated");
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
    $("li#news").attr("id", "activated");
  }
  if (window.location.pathname === allbooks) {
    $("li#allbooks").attr("id", "activated");
  }
  if (window.location.pathname === classes) {
    $("li#usersClasses").attr("id", "activated");
  }
  if (window.location.pathname === audioBooks) {
    $("li#audiobooks").attr("id", "activated");
  }
  if (window.location.pathname === videoBooks) {
    $("li#videobooks").attr("id", "activated");
  }
  if (window.location.pathname === eventCats) {
    $("li#eventsCat").attr("id", "activated");
  }
  if (window.location.pathname === settings) {
    $("li#settings").attr("id", "activated");
  } if (window.location.pathname === reports) {
    $("li#reports").attr("id", "activated");
  } if (window.location.pathname === sliders) {
    $("li#sliders").attr("id", "activated");
  }


  // wiring process

  // get registered users 

  $.ajax({
    type: "GET",
    url: serverUrl + "user/read.user.register.php",
    dataType: "JSON",
    beforeSend: function () {
      $("div#loaderUser").show();
    }, complete: function () {
      $("div#loaderUser").hide();
    },
    success: function (response) {
      const res = response.data;
      console.log("reg users", res);
      for (let r in res) {
        switch (res[r].isMembershipPaid) {
          case "1":
            res[r].isMembershipPaid = "Paid";
            break;
          case "0":
            res[r].isMembershipPaid = "Not Paid";
            break;
          default:
            console.log("No data of membership");

        }
        $("#all_users_table").DataTable().row.add([res[r].fname,
        res[r].lname,
        res[r].address,
        res[r].phone,
        res[r].membership_fees,
        res[r].isMembershipPaid,
        res[r].class_title,
        res[r].email,
        res[r].age_range,

        ]);
      }
      $("#all_users_table").DataTable().draw();
    },
  });



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
          "[" +
          res[r].user_category_title +
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
      console.log("book cats", res);
      for (let r in res) {
        $("select#selectBookCategory").append(
          '<option value="' +
          res[r].id +
          '">' +
          res[r].title +
          "[ " +
          res[r].age_range +
          " ]" +
          "[ " +
          res[r].userCategory +
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
  const allEventsIconUrl = serverUrl + "events/";
  const allVideoUrl = serverUrl + "book/videos/";
  const allAudioUrl = serverUrl + "book/audios/";
  const allNewsUrl = serverUrl + "news/";
  const allSliderUrl = serverUrl + "slider/slider/";


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
      if (response.data.length > 0) {
        for (r in res) {
          $("div#books_catgeory").append('<div class="col-md-4 col-lg-4">\n' +
            '<div class="card" style="width: 18rem;">\n' +
            '<img class="card-img-top" style="height: 200px;" src="' + booksCategoryIconUrl + res[r].icon_image + '" alt="Card image cap">\n' +
            '<div class="card-body">\n' +
            '<h3 class="card-title">' + res[r].title + '</h3>\n' +
            '<p class="card-text">' + res[r].number_of_books + ' Books</p>\n' +
            '<p class="card-text" >' + res[r].userCategory + ' Category</p>\n' +
            '<p class="card-text" >' + res[r].languages + ' Books</p>\n' +
            '<p class="card-text">  ' + res[r].userClass + ' [ ' +
            res[r].age_range + '] ages</p>\n' +

            '<div class="row">\n' +
            '<div class="col-md-4">\n' +
            '<Button class="btn btn-danger" data-catid ="' +
            res[r].id +
            '" id="book_category_cardDelete">Delete</Button>\n' +
            '</div>\n' +
            '<div class="col-md-4">\n' +
            '<a href="view.books.categories.php?id=' + res[r].id + '" class="btn btn-primary" data-catid ="' +
            res[r].id +
            '" id="book_category_cardDelete">View </a>\n' +
            '</div>\n' +
            '<div class="col-md-4">\n' +
            '<Button class="btn btn-warning" data-catid ="' +
            res[r].id +
            '"  id="book_category_cardEdit" data-toggle="modal" data-target="#updateCategory" style="display:block;">Edit </Button>\n' +
            '</div>\n' +
            '</div>\n' +
            '</div>\n' +
            '</div>\n' +
            '</div>\n'

          );
        }
      } else {
        $("div#warningInfoBookCategory").show();
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
        if (!data.error) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
          })
          $("div#addNewCategory").modal("hide");
          setTimeout(function () {
            window.location = window.location;
          }, 2000);
        }
        else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
          })
        }



      },
      error: function (xhr, ajaxOptions, thrownError) {
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'something went wrong try again',
          showConfirmButton: false,
          timer: 1500
        })
      }
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

      Swal.fire({
        title: 'Do you really want to delete this book category?',
        showDenyButton: true,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: `DELETE`,
        denyButtonText: `DON'T DELETE`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

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
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Book category is successfully delted',
                showConfirmButton: false,
                timer: 1500
              })
              setTimeout(function () {
                window.location = window.location;
              }, 2000);
            },
            error: function (xhr, ajaxOptions, thrownError) {
              Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'something went wrong try again',
                showConfirmButton: false,
                timer: 1500
              })
            }
          });

        } else if (result.isDenied) {
          Swal.fire('Book category is not deleted', '', 'info')
        }
      });
    });
  // end of delete book category

  // update book category
  var userClassIdOnChnage = null;
  $("form#my-form-update").on("change", "select#selectUserClass", function () {
    userClassIdOnChnage = this.value;
    console.log(userClassIdOnChnage)
  });

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
            '<input id="idBookCat" type="text"  hidden value="' + res.id + '">\n' +
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
            '<div class="col-md-6" style="display:none;">\n' +
            '<div class="form-group form-floating-label"></br>\n' +
            '<select class="form-control input-border-bottom" id="selectUserClass" required>\n' +
            '<option value="0">Select User Class</option>\n' +
            "</select>\n" +
            '<label for="selectFloatingLabel" class="placeholder">User Class</label>\n' +
            "</div>\n" +
            "</div>\n" +
            '<div class="col-md-6" style="display:none;">\n' +
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
                  "[" +
                  res[r].user_category_title +
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

  $("div#updateCategory").on("click", "input#updateCategory", function (event) {
    event.preventDefault();
    // var form = $("#my-form-update")[0];

    var title = $("form#my-form-update");
    var numbers = $("input#categoryBookNumberss");
    var lang = $("input#categoryLangs");
    // var classes = $("select#selectUserClass").val();
    var catideDIT = $("input#idBookCat");

    // var icon = $("input#categoryIconz")[0].files[0];

    // console.log(icon)

    // get data

    // var updateBookCatData = new FormData(form);

    // updateBookCatData.append("title", title);
    // updateBookCatData.append("number_of_books", numbers);
    // updateBookCatData.append("languages", lang);
    // // updateBookCatData.append("avatar", icon);
    // updateBookCatData.append("user_classesId", userClassIdOnChnage);



    // if (userClassIdOnChnage !== "0") {
    // console.log(userClassIdOnChnage)
    // console.log(formData);
    var formDataEdit = {
      id: catideDIT.val(),
      title: title.val(),
      number_of_books: numbers.val(),
      languages: lang.val()
    };
    console.log(formDataEdit);
    $.ajax({
      url: serverUrl + "book/update.book.category.php",
      type: "POST",
      data: JSON.stringify(formDataEdit),
      dataType: "json",
      beforeSend: function () {
        $("div#loaderUpd").show();
      },
      complete: function () {
        $("div#loaderUpd").hide();
      },
      success: function (data) {

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: data.message,
          showConfirmButton: false,
          timer: 1500
        })
        $("div#updateCategory").modal("hide");
        // setTimeout(function () {
        //   window.location = window.location;
        // }, 3000);

      },
    });
    // Display the key/value pairs
    // for (var pair of updateBookCatData.entries()) {
    //   console.log(pair[0] + ", " + pair[1]);
    // }
    // } else {
    //   return false;
    // }


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

    if (title == "") {
      $("span#bookTitleValid").show();
      setTimeout(function () {
        $("span#bookTitleValid").hide();
      }, 2000);
    }
    if (numbers == "") {
      $("span#bookNumbersValid").show();
      setTimeout(function () {
        $("span#bookNumbersValid").hide()
      }, 2000);
    }
    if (authors == "") {
      $("span#bookAuthorsValid").show();
      setTimeout(function () {
        $("span#bookAuthorsValid").hide();
      }, 2000)
    }
    if (iconBook == "") {
      $("span#bookIconValid").show();
      setTimeout(function () {
        $("span#bookIconValid").hide();
      }, 2000)
    }

    if (bookLang == "") {
      $("span#bookLangValid").show();
      setTimeout(function () {
        $("span#bookLangValid").hide();
      }, 2000)
    }
    if (bookSummary == "") {
      $("span#bookSummaryValid").show();
      setTimeout(function () {
        $("span#bookSummaryValid").hide();
      }, 2000)
    }
    else {
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
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: data.message,
              showConfirmButton: false,
              timer: 1500
            })
          } else {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: data.message,
              showConfirmButton: false,
              timer: 1500
            })
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
    }


  });
  // end create new book


  //view book by category

  $("div#books_catgeory ").on("click", "a#book_category_card", function () {
    const idToViewBook = $(this).data("catidview");

    localStorage.setItem("idToViewBookByCategory", idToViewBook);
  });

  var retrievedidToViewBookByCategory = localStorage.getItem('idToViewBookByCategory');



  var url = new URL(window.location);
  var cid = url.searchParams.get("id");

  $.ajax({
    url: serverUrl + "book/read.book.by.category.php?id=" + cid,
    cache: false,
    contentType: false,
    processData: false,
    type: "GET",
    beforeSend: function () {
      $("div#loaderAddBook").show();
    },
    complete: function () {
      $("div#loaderAddBook").hide();
    },
    success: function (data) {
      const res = data.data;
      console.log("book by category", data);
      for (let r in res) {
        switch (res[r].thisBookIsAvailable) {
          case "1":
            availabilityBook = "Available";
            break;
          case "0":
            availabilityBook = "Not Available or borrowed";
            break;
          default:
            availabilityBook = "Available";
        }
        console.log("all books classes", res);
        $("#all_books_by_cat_table").DataTable().row.add([
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
          availabilityBook

        ]);
      }
      $("#all_books_by_cat_table").DataTable().draw();
    }
  });



  // end view book by category 

  // read all books

  var availabilityBook;

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
          case "1":
            availabilityBook = "Available";
            break;
          case "0":
            availabilityBook = "Not Available or borrowed";
            break;
          default:
            availabilityBook = "Available";
        }
        console.log("all books info", res);
        $("#all_books_table").DataTable().row.add([
          '<div class="avatar ">\n' +
          '<img src="' +
          allBookIconUrl +
          res[r].image +
          '" alt="..." class="avatar-img rounded-circle">\n' +
          "</div>\n",
          res[r].title,
          res[r].numbers,
          res[r].taken_book,
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
          '" class="btn btn-icon btn-round btn-info" data-toggle="modal" data-target="#updateSingleBook" style="display:block;">\n' +
          '<i class="fa fa-pen"></i>\n' +
          "</button>\n" +
          '<button type="button" id="deleteSingleBookbtn"  data-bookId= "' +
          res[r].id +
          '" class="btn btn-icon btn-round btn-danger ">\n' +
          '<i class="fa fa-trash"></i>\n' +
          '</button>\n' +
          '<button type="button" id="updatebookStatus"  data-bookId= "' +
          res[r].id +
          '" class="btn btn-icon btn-round btn-warning"  data-toggle="modal" data-target="#exampleModal">\n' +
          '<i class="fa fa-info"></i>\n' +
          "</button>",
        ]);
      }
      $("#all_books_table").DataTable().draw();
    },
  });



  $.ajax({
    type: "GET",
    url: serverUrl + "book/read.borrowed.books.php",
    dataType: "JSON",
    beforeSend: function () {
      $("div#loaderAllBooks").show();
    },
    complete: function () {
      $("div#loaderAllBooks").hide();
    },
    success: function (response) {
      const res = response.data;
      console.log("Borrowed nbooks", res);
      for (let r in res) {
        console.log("all books info", res);
        $("table#all_books_table_history").DataTable().row.add([
          '<div class="avatar ">\n' +
          '<img src="' +
          allBookIconUrl +
          res[r].bookIcon +
          '" alt="..." class="avatar-img rounded-circle">\n' +
          "</div>\n",
          res[r].fname + " " + res[r].lname,
          res[r].address,
          res[r].phone,
          res[r].userClassTitle,
          res[r].bookTitle,
          res[r].bookAuthor,
          res[r].bookStatus,
          '<button type="button"  data-bookId = "' +
          res[r].id +
          '"  id="viewBookDetailBorrowed" class="btn btn-icon btn-round btn-primary" data-toggle="modal" data-target="#showDetailBorrowed">\n' +
          '<i class="fa fa-eye"></i>\n' +
          "</button>"
        ]);
      }
      $("table#all_books_table_history").DataTable().draw();
    },
  });



  $("table#all_books_table_history").on("click", "button#viewBookDetailBorrowed", function (e) {
    console.log($(this).data('bookid'));

    $.ajax({
      type: "GET",
      url: serverUrl + "book/read.borrow.book.php?id=" + $(this).data('bookid'),
      beforeSend: function () {
        $("div#loaderSingleDetailBorrow").show();
      },
      complete: function () {
        $("div#loaderSingleDetailBorrow").hide();
      },
      success: function (response) {
        console.log("Single info", response);
        $("div#singleInfoDetail").html('<img src="' +
          allBookIconUrl +
          response.data.bookIcon +
          '" alt="..." class="avatar-img rounded">\n' +
          "</div>\n" +
          '<ul class="list-group"><h4>User information</h4>\n' +
          '<h6>First Name: ' + response.data.fname + '</h6>\n' +
          '<h6>Last  Name: ' + response.data.lname + '</h6>\n' +
          '<h6>Email: ' + response.data.email + '</h6>\n' +
          '<h6>Address: ' + response.data.address + '</h6>\n' +
          '<h6>User Class: ' + response.data.userClassTitle + '</h6>\n' +
          '<h6>Age range: ' + response.data.userClassAge + '</h6></li>\n' +
          '<h4>Book information</h4>\n' +
          '<h6>Book Title: ' + response.data.bookTitle + '</h6>\n' +
          '<h6>Book Author: ' + response.data.bookAuthor + '</h6>\n' +
          '<h6>Book Catgeory: ' + response.data.bookCategorTitle + '</h6>\n' +
          '<h6>Book Summary: ' + response.data.bookSummary + '</h6>\n' +
          '<h6>Number of Borrowed books: ' + response.data.number_of_book_borrowed + '</h6>\n' +
          '<h6>Borrowed time: ' + response.data.createdTime + '</h6>\n' +
          '<h6>Return time: ' + response.data.return_date + '</h6>\n' +
          ' <span class="badge badge-warning" style="    height: 45px;width: 100px;line-height: 40px;">' + response.data.bookStatus + '</span></li>\n' +
          '</ul>');
      }
    });



  });
  // end read all books

  // update book status from client 

  $("#all_books_table").on("click", "button#updatebookStatus", function (e) {
    e.preventDefault();
    console.log($(this).data('bookid'));
    $("input#bookIdNow").val($(this).data('bookid'));
    $("input#searchPhonetxt").val("");
    $("div#userPhoneNumber").hide();
    $("div#responseToUpdate").hide();
  });





  $("div#updateBookSform").on("click", "button#searchCustomer", function (e) {
    e.preventDefault();

    var phoneUser = $("input#searchPhonetxt").val();
    var numberOfBookBoroowed = $("input#booksBorrowedNm");
    if (phoneUser !== "") {
      console.log(phoneUser);
      $.ajax({
        type: "GET",
        url: serverUrl + "/user/search.user.by.phoneoremail.php?phone=" + phoneUser,
        dataType: "JSON",
        beforeSend: function () {
          $("div#loadupdateBSloader").show();
        },
        complete: function () {
          $("div#loadupdateBSloader").hide();
        },
        success: function (response) {
          console.log("Registered users=", response);
          $("div#responseToUpdate").html("<h3><b>User Information</b></h3><p>Address: " + response.fname + "</p>\n" +
            "<p>Address: " + response.address + "</p>\n" +
            "<p>Address: " + response.phone + "</p>\n" +
            '<input id="userSearchedID"  value =' + response.id + ' hidden=true type="text" class="form-control" placeholder="Enter phone number">'
          );
          $("div#responseToUpdate").show();
          $("div#userPhoneNumber").show();
        }
      });
    }
    else {
      $("div#responseToUpdate").hide();
      $("span#userphoneValidSh").show();
      setTimeout(function () {
        $("span#userphoneValidSh").hide();
      }, 2000);
    }
  });

  $("input#searchPhonetxt").on("input", function (e) {
    if ($(this).val() == "") {
      $("div#responseToUpdate").hide();
    }
  });


  $("input#updateBookSTS").click(function (e) {
    e.preventDefault();
    console.log('sawaa');

    const userID = $("input#userSearchedID").val();
    const bookId = $("input#bookIdNow").val();
    const dataReady = {
      userId: userID,
      bookId: bookId,
      status: "1"
    }
    $.ajax({
      type: "POST",
      url: serverUrl + "book/update.borrow.info.php",
      dataType: "JSON",
      data: JSON.stringify(dataReady),
      beforeSend: function () {
        $("div#loadupdateBSloader").show();
      },
      complete: function () {
        $("div#loadupdateBSloader").hide();
      },
      success: function (response) {
        $("div#exampleModal").modal("hide");
        console.log("Message", response);
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: response.message,
          showConfirmButton: false,
          timer: 3000
        });
        setTimeout(function () {
          window.location = window.location;
        }, 3000);
      }
    });


  })



  // SAVE STATUS FOR BOOOK 

  // input#userSearchedID







  //delete single book 

  $("#all_books_table").on("click", "button#deleteSingleBookbtn", function (e) {
    e.preventDefault();
    console.log($(this).data('bookid'));
    var idDelBook = $(this).data('bookid');
    const datadelBook = {
      id: idDelBook
    };

    Swal.fire({
      title: 'Do you really want to delete this book?',
      showDenyButton: true,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: `DELETE`,
      denyButtonText: `DON'T DELETE`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {


        Swal.fire('Deleted!', '', 'success');
        $.ajax({
          type: "DELETE",
          url: serverUrl + "book/delete.book.php",
          dataType: "JSON",
          data: JSON.stringify(datadelBook),
          beforeSend: function () {
            $("div#delSingleBook").show();
          },
          complete: function () {
            $("div#delSingleBook").hide();
          },
          success: function (response) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Book is successfully Deleted',
              showConfirmButton: false,
              timer: 1500
            });
            setTimeout(function () {
              window.location = window.location;
            }, 3000);
          }
        });


      } else if (result.isDenied) {
        Swal.fire('Book is not deleted', '', 'info')
      }
    });
  });


  // end delete single book 

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



  $("#all_books_table").on("click", "button#updateSingleBookbtn", function (e) {
    e.preventDefault();
    const updateBookId = $(this).data("bookid");
    var form = $("#my-form-update-book")[0];
    var titles = document.getElementById("input#bookTitles");



    //  grab user class again

    $.ajax({
      type: "GET",
      url: serverUrl + "user/read.user.class.php",
      dataType: "JSON",
      success: function (response) {
        const res = response.data;
        console.log("user classes", res);
        for (let r in res) {
          $("#all_books_table form#my-form-update-book #selectUserClass").append('<option value="' +
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
          '<input id="bookIdForEdit" hidden type="text" value= "' + response.id + '">\n' +
          '<div class="form-group ">\n' +
          '<label for="inputFloatingLabel" class="placeholder">Title</label>\n' +
          '<input id="bookTitlesEdit" type="text" value= "' +
          response.title +
          '" class="form-control input-border-bottom" required>\n' +
          "</div>\n" +
          "</div>\n" +
          '<div class="col-md-6 pr-0">\n' +
          '<div class="form-group ">\n' +
          '<label for="inputFloatingLabel" class="placeholder">Number of Books</label>\n' +
          '<input id="bookNumbersEdit" value= "' +
          response.numbers +
          '" type="number" class="form-control input-border-bottom" required>\n' +
          "</div>\n" +
          "</div>\n" +
          '<div class="col-md-6">\n' +
          '<div class="form-group ">\n' +
          '<label for="inputFloatingLabel" class="placeholder">Authors</label>\n' +
          '<input id="authorsEdit" type="text"   value="' +
          response.authors +
          '"  class="form-control input-border-bottom" required>\n' +
          "</div>\n" +
          "</div>\n" +
          '<div class="col-md-6" style="display:none">\n' +
          '<div class="form-group ">\n' +
          '<label for="inputFloatingLabel" class="placeholder">Icon Image</label>\n' +
          '<input id="bookIcon" type="file" class="form-control input-border-bottom" required>\n' +
          "</div>\n" +
          "</div>\n" +
          '<div class="col-md-6" style="display:none">\n' +
          '<div class="form-group ">\n' +
          '<label for="selectFloatingLabel" class="placeholder">User Class</label>\n' +
          '<select class="form-control input-border-bottom" id="selectUserClassUpdates" required>\n' +
          '<option value="0">Select User Class</option>\n' +
          "</select>\n" +
          "</div>\n" +
          "</div>\n" +
          '<div class="col-md-6" style="display:none">\n' +
          '<div class="form-group ">\n' +
          '<label for="selectFloatingLabel" class="placeholder">Book Category</label>\n' +
          '<select class="form-control input-border-bottom" id="selectBookCategory" required>\n' +
          '<option value="0">Select Book Category</option>\n' +
          "</select>\n" +
          "</div>\n" +
          "</div>\n" +
          '<div class="col-md-12">\n' +
          '<div class="form-group ">\n' +
          '<label for="inputFloatingLabel" class="placeholder">Languages</label>\n' +
          '<input id="bookLangEdit" value="' +
          response.languages +
          '" type="text" class="form-control input-border-bottom" required>\n' +
          "</div>\n" +
          "</div>\n" +
          '<div class="col-md-12">\n' +
          '<div class="form-group">\n' +
          '<label for="comment">Summary</label>\n' +
          '<textarea class="form-control" id="summaryEdit" rows="5">' +
          response.summary +
          "</textarea>\n" +
          "</div>\n" +
          "</div>\n" +
          "</div>\n" +
          "</div>\n" +
          '<div class="modal-footer no-bd">\n' +
          '<input id="updateBook" class="btn btn-primary" type="submit" value="Update">\n' +
          '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\n' +
          "</div>\n" +
          "<center>\n" +
          '<div class="spinner-border text-primary" role="status" id="loaderupdateBook" style="display: none;">\n' +
          '<span class="sr-only">Loading...</span>\n' +
          "</div>\n" +
          "</center>"
        );
      },
    });
  });


  $("#my-form-update-book").on("click", "input#updateBook", function (e) {
    e.preventDefault();
    var bookIdEdit = $("input#bookIdForEdit");
    var booktitleEdit = $("input#bookTitlesEdit");
    var bookNumEdit = $("input#bookNumbersEdit");
    var bookAuthorEdit = $("input#authorsEdit");
    var bookLangEdit = $("input#bookLangEdit");
    var bookSummaryEdit = $("textarea#summaryEdit");

    const dataSubmit = {
      id: bookIdEdit.val(),
      title: booktitleEdit.val(),
      numbers: bookNumEdit.val(),
      authors: bookAuthorEdit.val(),
      summary: bookSummaryEdit.val(),
      languages: bookLangEdit.val()
    }

    console.log(dataSubmit);

    $.ajax({
      type: "POST",
      url: serverUrl + "book/update.book.php",
      data: JSON.stringify(dataSubmit),
      dataType: "JSON",
      beforeSend: function () {
        $("div#loaderupdateBook").show();
      },
      complete: function () {
        $("div#loaderupdateBook").hide();
      },
      success: function (response) {
        console.log(response);
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: response.message,
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout(function () {
          window.location = window.location;
        }, 3000);
      }
    });



  })
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
      if (res.length > 0) {
        for (let r in res) {
          $("div#all_user_categories").append(
            '<div class="col-6 col-sm-4 col-lg-4">\n' +
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

            '<div class="text-muted mb-3"><p style="font-size: 12px;">Description:' +
            res[r].description +
            "</p></div>\n" +
            '<input type="text" value="' +
            res[r].id +
            '"  id="userCatId" hidden>\n' +
            "</div>\n" +
            "</div>\n" +
            "</div>\n" +
            "</div>"
          );
        }
      }
      else {
        $("div#warningInfoCategory").show();
      }


    },
  });

  // add new user category
  $("input#userCatMembershipFees").on("input", function (e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    return this.value;
  })

  $("input#addNewUserCat").click(function (e) {
    e.preventDefault();

    const title = $("input#userCatTitle");
    const membership = $("input#userCatMembershipFees");
    const descriptioncategory = $("textarea#userCatDescription");

    if (title.val() == '') {
      $("span#subscriptionTitleValid").show();
      setTimeout(function () {
        $("span#subscriptionTitleValid").hide();
      }, 2000);
    }

    if (descriptioncategory.val() == '') {
      $("span#subscriptionDescValid").show();
      setTimeout(function () {
        $("span#subscriptionDescValid").hide();
      }, 2000);
    }
    if (membership.val() == '') {
      $("span#subscriptionFeesValid").show();
      setTimeout(function () {
        $("span#subscriptionFeesValid").hide();
      }, 2000);
    } else {
      const newUserCatData = {
        title: title.val(),
        membership_fees: membership.val(),
        description: descriptioncategory.val()
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
          $("input#addNewUserCat").attr("disabled", true);
          if (response.success) {
            const res = response;
            console.log("res", res);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: response.message,
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(function () {
              window.location = window.location;
            }, 1000)
          }


        }, error: function (xhr, ajaxOptions, thrownError) {
          $("input#addNewUserCat").attr("disabled", false);
          Swal.fire({
            position: 'top-end',
            icon: 'danger',
            title: 'something went wrong try again',
            showConfirmButton: false,
            timer: 1500
          })
        }
      });
    }

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

      Swal.fire({
        title: 'Do you really want to delete this user category?',
        showDenyButton: true,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: `DELETE`,
        denyButtonText: `DON'T DELETE`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            cache: false,
            data: JSON.stringify(userCatIdDel),
            url: serverUrl + "/user/delete.user.category.php",
            dataType: "JSON",
            success: function (response) {
              const res = response;
              console.log("res", res);
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'User Category is successfully deleted',
                showConfirmButton: false,
                timer: 1500
              })
              setTimeout(function () {
                window.location = window.location;
              }, 3000);
            },
          });
        }
      })
    });

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
          console.log("respose user categories", res);
          $("form#updateUserCategoryForm").html(
            '<div class="row">\n' +
            '<input id="userCatIdUpdates" value="' +
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
            '<div class="col-md-12 pr-0">\n' +
            '<div class="form-group form-group-default">\n' +
            "<label>Description</label>\n" +
            '<input id="UpduserCatDescription" value="' +
            res.description +
            '" type="text" class="form-control" placeholder="fill description">\n' +
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


  // update user subscription 
  $("form#updateUserCategoryForm").on(
    "click",
    "input#UpdNewUserCat",
    function (e) {
      e.preventDefault();
      const title = $("input#UpduserCatTitle").val();
      const desc = $("input#UpduserCatDescription").val();
      const mmship = $("input#UpduserCatMembershipFees").val();
      const id = $("input#userCatIdUpdates").val();

      const dataUpd = {
        id: id,
        title: title,
        description: desc,
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
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'User Category is successfully updated',
            showConfirmButton: false,
            timer: 1500
          })
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
      if (res.length > 0) {
        for (let u in res) {
          $("div#all_user_classes").append(
            '<div class="col-md-4">\n' +
            '<div class="card card-light bg-success text-white">\n' +
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
            '<button type="button" class="btn btn-icon btn-round btn-success"   data-toggle="modal" data-target="#editUserClass" data-classid= "' +
            res[u].id +
            '" id="update_user_class">\n' +
            '<i class="fa fa-pen"></i>\n' +
            "</button>\n" +
            "</div>\n" +
            '<center><br/><div class="spinner-border text-info" role="status" id="loaderDeleteUserCat" style="display:none;">\n' +
            '<span class="sr-only">Loading...</span>\n' +
            "</center>\n" +
            "</div>\n" +
            "</div>"
          );
        }
      } else {
        $("div#warningInfoClassCategory").show();
      }


    },
  });
  // end get user classes

  // update user class 
  const selectUserCat = [];
  var reponseArry = []
  $("div#all_user_classes").on("click", "button#update_user_class", function (e) {
    e.preventDefault();
    const userClassIdLoader = $(this).data('classid');


    $.ajax({
      type: "GET",
      url: serverUrl + "/user/read.user.category.php",
      dataType: "JSON",
      beforeSend: function () {
        $("div#loaderupdateUserCat").show();
      },
      complete: function () {
        $("div#loaderupdateUserCat").hide();
      },
      success: function (response) {
        const res = response.data;
        console.log("user classes selected", res);
        selectUserCat.push(res);
        reponseArry = selectUserCat[0];
        console.log(reponseArry)
      },
    });



    $.ajax({
      type: "POST",
      cache: false,
      url: serverUrl + "user/read.user.class.php",
      dataType: "JSON",
      beforeSend: function () {
        $("div#loaderSingleUserClass").show();
        $("form#updateUserClass").hide();
      },
      complete: function () {
        $("div#loaderSingleUserClass").hide();
        $("form#updateUserClass").show();
      },
      success: function (response) {
        $("form#updateUserClass").html('<div class="row" id="formUser">\n' +
          '<div class="col-md-6 pr-0">\n' +
          '<div class="form-group ">\n' +
          '<input id="userUpClassIdEdit" hidden type="text" class="form-control" placeholder="fill title" value="' + response.data[0].id + '">\n' +
          '<label>Title</label>\n' +
          '<input id="userUpClassTitleEdit" type="text" class="form-control" placeholder="fill title" value="' + response.data[0].classe_title + '">\n' +
          '</div>\n' +
          '</div>\n' +
          '<div class="col-md-6 pr-0">\n' +
          '<div class="form-group ">\n' +
          '<div class="form-group form-floating-label">\n' +
          '<select class="form-control " id="selectUserCategoryUpdate" required style="margin-top: 23px;">\n' +
          '<option value="0">Select User Category</option>\n' +
          '</select>\n' +
          '<label for="selectFloatingLabel" class="placeholder">User Category</label>\n' +
          '</div>\n' +
          '</div>\n' +
          '</div>\n' +
          '<div class="col-md-12 pr-0">\n' +
          '<div class="form-group ">\n' +
          '<label>Age Range</label>\n' +
          '<input id="userUpClassAgeEdit" type="text" class="form-control" placeholder="fill age" value="' + response.data[0].age_range + '">\n' +
          '</div>\n' +
          '</div>\n' +
          '</div>\n' +
          '<div class="modal-footer no-bd">\n' +
          '<input type="submit" id="updateUserClassButton" class="btn btn-primary" value="Save">\n' +
          '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\n' +
          '</div>\n' +
          '<center>\n' +
          '<div class="spinner-border text-primary" role="status" id="loaderUpdateUserClass" style="display: none;">\n' +
          '<span class="sr-only">Loading...</span>\n' +
          '</div>\n' +
          '</center>');

        for (let r in reponseArry) {

          $(" select#selectUserCategoryUpdate").append(
            '<option value="' + reponseArry[r].id + '">' + reponseArry[r].title + "</option>"
          );
        }

      }


    });
  });



  $("form#updateUserClass").on("click", "input#updateUserClassButton", function (e) {
    e.preventDefault();
    console.log("sawa");
    var idEdit = $("input#userUpClassIdEdit");
    var titleEdit =  $("input#userUpClassTitleEdit");
    var classEdit = $("select#selectUserCategoryUpdate");
    var ageEdit = $("input#userUpClassAgeEdit");
    const dataMiner = {
      id: idEdit.val(),
      title: titleEdit.val(),
      user_categoryId: classEdit.val(),
      age_range: ageEdit.val()
  }
    

  console.log(dataMiner);

    $.ajax({
      type: "POST",
      url: serverUrl + "user/update.user.class.php",
      dataType: "JSON",
      data: JSON.stringify(dataMiner),
      beforeSend: function () {
        $("div#loaderUpdateUserClass").show();
      },
      complete: function () {
        $("div#loaderUpdateUserClass").hide();
      },
      success: function (response) {
        const res = response.data;
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: response.message,
          showConfirmButton: false,
          timer: 1500
        })
        setTimeout(function () {
          window.location = window.location;
        }, 3000);
      },
    });
  });

  // end update user class 

  // delete user class

  $("div#all_user_classes").on(
    "click",
    "button#delete_user_class",
    function () {
      const id = $(this).data("classid");
      console.log(id);
      const dataToDelUserClass = {
        id: id
      };
      Swal.fire({
        title: 'Do you really want to delete this book category?',
        showDenyButton: true,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: `DELETE`,
        denyButtonText: `DON'T DELETE`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: serverUrl + "user/delete.user.class.php",
            dataType: "JSON",
            data: JSON.stringify(dataToDelUserClass),
            beforeSend: function () {
              $("div#loaderDeleteUserCat").show();
            },
            complete: function () {
              $("div#loaderDeleteUserCat").hide();
            },
            success: function (response) {
              const res = response.data;
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              })
              setTimeout(function () {
                window.location = window.location;
              }, 3000);
            },
          });
        }
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

  $("select#selectUserCategory").on("input", function () {
    console.log($(this).val());
    if ($(this).val() !== '0') {
      return $(this).val();
    }
    else {
      $("span#usercategoryClassValid").show();
      setTimeout(function () {
        $("span#usercategoryClassValid").hide();
      }, 2000);
    }

  })


  // add new user class 
  $("input#userClassAge").on("input", function (value) {
    this.value = this.value.replace(/[^0-9\-\+]/g, '');
    console.log(this.value);
    return this.value;
  });
  $("form#newUserClassForm").on(
    "click",
    "input#addNewUserClassButton",
    function (e) {
      e.preventDefault();
      const title = $("input#userClassTitle");
      const userCat = $("select#selectUserCategory");
      const age = $("input#userClassAge");

      // validations js 

      if (title.val() == '') {
        $("span#userclassTitleValid").show();
        setTimeout(function () {
          $("span#userclassTitleValid").hide();
        }, 2000);
      }
      if (age.val() == '') {
        $("span#userclassAgeRangeValid").show();
        setTimeout(function () {
          $("span#userclassAgeRangeValid").hide();
        }, 2000);
      }


      // end of validations 

      if (title.val() !== '' && age.val() !== '') {

        $("input#addNewUserClassButton").attr("disabled", false);

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
            $("input#addNewUserClassButton").attr("disabled", true);
            const res = response;
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: response.message,
              showConfirmButton: false,
              timer: 1500
            })

            setTimeout(function () {
              window.location = window.location;
            }, 2000);

          }, error: function (xhr, ajaxOptions, thrownError) {
            $("input#addNewUserClassButton").attr("disabled", false);
            Swal.fire({
              position: 'top-end',
              icon: 'danger',
              title: 'something went wrong try again',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      } else {
        $("input#addNewUserClassButton").attr("disabled", true);
        setTimeout(function () {
          $("input#addNewUserClassButton").attr("disabled", false);
        }, 2000);
      }


    }
  );

  // events stuff 

  tableAllEventsData = $("#allEvents").DataTable();

  // read all events 
  $.ajax({
    type: "GET",
    url: serverUrl + "events/read.events.php",
    dataType: "JSON",
    cache: false,
    beforeSend: function () {
      $("div#loaderAllEvents").show();
    },
    complete: function () {
      $("div#loaderAllEvents").hide();
    },
    success: function (response) {
      const res = response.data;
      console.log('Events=', res)
      if (res.length > 0) {
        for (let r in res) {
          tableAllEventsData.row.add([
            '<div class="avatar ">\n' +
            '<img src="' +
            allEventsIconUrl +
            res[r].image +
            '" alt="..." class="avatar-img rounded-circle">\n' +
            "</div>\n",
            res[r].title,
            res[r].description,
            res[r].location,
            res[r].time,
            res[r].date,
            res[r].price,
            res[r].available_places,
            '<button type="button"  data-eventId = "' +
            res[r].id +
            '"  id="viewEventDetail" class="btn btn-icon btn-round btn-primary" data-toggle="modal" data-target="#singleEventInfo">\n' +
            '<i class="fa fa-eye"></i>\n' +
            "</button>\n" +
            '<button type="button"  id="updateSingleBookbtn" data-eventId= "' +
            res[r].id +
            '" class="btn btn-icon btn-round btn-info" style="display:none;" data-toggle="modal" data-target="#updateSingleEvent">\n' +
            '<i class="fa fa-pen"></i>\n' +
            "</button>\n" +
            '<button type="button"  id="deleteEventDetail"  class="btn btn-icon btn-round btn-danger " data-eventId= "' + res[r].id + '">\n' +
            '<i class="fa fa-trash"></i>\n' +
            "</button>",
          ]);
          tableAllEventsData.draw();
        }
      } else {
        $("div#warningInfoEvents").show();
        $("div#allEvents_wrapper").hide();
      }


    }

  });

  // end read all evenst 

  // create events 

  // get all events categories first 
  $.ajax({
    type: "POST",
    url: serverUrl + "events/read.events.categories.php",
    dataType: "JSON",
    cache: false,

    success: function (response) {
      const res = response.data;
      for (let r in res) {
        $("select#evCategory").append("<option value=" + res[r].id + ">" + res[r].title + "</option>")
      }
    },
  });



  $("button#addNewEvent").click(function (e) {
    e.preventDefault();
    var form = $("#my-form-event")[0];
    const evTitle = $("input#evTitle").val();
    const evCat = $("select#evCategory").val();
    const evLoc = $("input#eveLocation").val();
    const evTime = $("input#evTime").val();
    const evDate = $("input#eveDate").val();
    const evFree = $("select#evFree").val();
    const evPrice = $("input#evePrice").val();
    const evPlaces = $("input#eveAvailable_places").val();
    const files = $("input#evIcon")[0].files[0];
    const evDesc = $("textarea#evdescription").val();

    // validation

    if (evTitle == "") {
      $("span#title_event_valid").show();
      setTimeout(function () {
        $("span#title_event_valid").hide();
      }, 2000);
    }
    if (evCat == "") {
      $("span#cat_event_valid").show();
      setTimeout(function () {
        $("span#cat_event_valid").hide();
      }, 2000);
    }
    if (evLoc == "") {
      $("span#loc_event_valid").show();
      setTimeout(function () {
        $("span#loc_event_valid").hide();
      }, 2000);
    }

    if (evTime == "") {
      $("span#time_event_valid").show();
      setTimeout(function () {
        $("span#time_event_valid").hide();
      }, 2000);
    }
    if (evDate == "") {
      $("span#desc_event_valid").show();
      setTimeout(function () {
        $("span#desc_event_valid").hide();
      }, 2000);
    }
    if (evPrice == "") {
      $("span#price_event_valid").show();
      setTimeout(function () {
        $("span#price_event_valid").hide();
      }, 2000);
    }
    if (evPlaces == "") {
      $("span#avplc_event_valid").show();
      setTimeout(function () {
        $("span#avplc_event_valid").hide();
      }, 2000);
    }

    if (evDesc == "") {
      $("span#desc_event_valid").show();
      setTimeout(function () {
        $("span#desc_event_valid").hide();
      }, 2000);
    }

    else {
      // FormData object
      var newEvent = new FormData(form);

      newEvent.append("title", evTitle);
      newEvent.append("description", evDesc);
      newEvent.append("categoryId", evCat);
      newEvent.append("avatar", files);
      newEvent.append("location", evLoc);
      newEvent.append("time", evTime);
      newEvent.append("date", evDate);
      newEvent.append("is_free", evFree);
      newEvent.append("price", evPrice);
      newEvent.append("available_places", evPlaces);


      $.ajax({
        url: serverUrl + "events/create.event.php",
        data: newEvent,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        beforeSend: function () {
          $("div#addNewEventLoader").show();
        },
        complete: function () {
          $("div#addNewEventLoader").hide();
        },
        success: function (data) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
          })
          $("div#addNewEvent").modal("hide");

          setTimeout(function () {
            window.location = window.location;
          }, 3000);
        },
      });
      // Display the key/value pairs
      for (var pair of newEvent.entries()) {
        console.log(pair[0] + ", " + pair[1]);
      }
    }



  })



  // end create events 



  // create event category 


  $("input#addNewEventCat").click(function (e) {
    e.preventDefault();
    const evCatTitle = $("input#eventCatTitle").val();
    if (evCatTitle == "") {
      $("span#eventCatTitleValid").show();
      $("input#addNewEventCat").attr("disabled", true);
      setTimeout(function () {
        $("span#eventCatTitleValid").hide();
        $("input#addNewEventCat").attr("disabled", false);
      }, 2000);
    }

    else {
      const d = {
        title: evCatTitle
      }
      $.ajax({
        url: serverUrl + "events/create.event.category.php",
        data: JSON.stringify(d),
        type: "POST",
        beforeSend: function () {
          $("div#loaderNewEventCat").show();
        },
        complete: function () {
          $("div#loaderNewEventCat").hide();
        },
        success: function (response) {
          $("input#addNewEventCat").attr("disabled", true);
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: response.message,
            showConfirmButton: false,
            timer: 2000
          })
          $("div#addNewEventCat").modal("hide");
          // swal.close();
          setTimeout(function () {
            window.location = window.location;
          }, 3000);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          $("input#addNewEventCat").attr("disabled", false);
          Swal.fire({
            position: 'top-end',
            icon: 'danger',
            title: 'something went wrong try again',
            showConfirmButton: false,
            timer: 1500
          })
        }
      });
    }


  });

  // end create event category 


  // view single event info 
  var statusEvent;
  $("#allEvents").on("click", "button#viewEventDetail", function () {
    const eventId = $(this).data("eventid");
    console.log(eventId);


    $.ajax({
      type: "GET",
      url: serverUrl + "events/read.single.event.php?id=" + eventId,
      dataType: "JSON",
      beforeSend: function () {
        $("div#loaderSingleEvent").show();

      },
      complete: function () {
        $("div#loaderSingleEvent").hide();
      },
      success: function (response) {
        const res = response;

        switch (res.status) {
          case "1":
            statusEvent = "New";
            break;
          case "0":
            statusEvent = "Ended";
            break;
          default:
            statusEvent = "New";
        }
        console.log("Single Event Info", statusEvent);


        $("#singleInfo").html('<div class="container">\n' +
          '<div class="col-md-12">\n' +
          '<div class="row">\n' +
          '<div class="icon-big text-center">\n' +
          "<img src = " +
          allEventsIconUrl +
          res.image +
          " style= 'height: 150px;width: 150px; margin:15px 0px;'>\n" +
          "</div>\n" +
          '<div class="col-md-6">\n' +
          '<p>Title:</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>' + res.title + '</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>Location:</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>' + res.location + '</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>Time:</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>' + res.time + '</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>Date:</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>' + res.date + '</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>Category:</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>' + res.category + '</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>Price:</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>' + res.price + '</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>Availble Places:</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>' + res.available_places + '</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<p>Status:</p>\n' +
          '</div>\n' +
          '<div class="col-md-6">\n' +
          '<span class= "badge badge-warning">' + statusEvent + '</span>\n' +
          '</div>\n' +
          '</div>\n' +
          '</div>\n' +
          '</div>');
      },
    });
  });
  // end of single event info 

  // delete event single info 





  $("#allEvents").on("click", "button#deleteEventDetail", function (e) {
    const eventIDinfo = $(this).data('eventid');
    const dataToDelEvent = {
      id: eventIDinfo
    };
    e.preventDefault();
    confirmDelete(dataToDelEvent);

  });

  // ene delete event single info 



  function confirmDelete(data) {

    Swal.fire({
      title: 'Do you really want to delete this event info?',
      showDenyButton: true,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: `DELETE`,
      denyButtonText: `DON'T DELETE`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: serverUrl + "events/delete.event.php",
          dataType: "JSON",
          data: JSON.stringify(data),
          beforeSend: function () {
            $("div#deleteSingleEvent").show();

          },
          complete: function () {
            $("div#deleteSingleEvent").hide();

          },
          success: function () {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Event is successfully deleted',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(function () {
              window.location = window.location;
            }, 2000);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
              position: 'top-end',
              icon: 'danger',
              title: 'something went wrong try again',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      }

    },
      function () {
        return false;
      }
    )
  }


  // end of events stuff 


  // read events categories 
  tableAllEventsCatData = $("#allEventsCats").DataTable();
  $.ajax({
    type: "POST",
    url: serverUrl + "events/read.events.categories.php",
    dataType: "JSON",

    beforeSend: function () {
      $("div#loaderAllEventsCats").show();

    },
    complete: function () {
      $("div#loaderAllEventsCats").hide();

    },
    success: function (response) {
      console.log("All events Categories", response);
      if (response.data.length > 0) {
        const res = response.data;
        for (let r in res) {
          tableAllEventsCatData.row.add([

            res[r].title,

            '<button type="button"  id="updateSingleBookbtn" data-eventId= "' +
            res[r].id +
            '" class="btn btn-icon btn-round btn-info"  data-toggle="modal" data-target="#updateEventCat">\n' +
            '<i class="fa fa-pen"></i>\n' +
            "</button>\n" +
            '<button type="button"  id="deleteEventCatDetail"  class="btn btn-icon btn-round btn-danger " data-eventId= "' + res[r].id + '">\n' +
            '<i class="fa fa-trash"></i>\n' +
            "</button>",
          ]);
          tableAllEventsCatData.draw();
        }

      } else {
        $("div#allEventsCats_wrapper").hide();
        $("div#warningInfoEventsCat").show()
      }
    }
  });


  // end read events categories 
  // delete event category 
  $("table#allEventsCats").on("click", "button#deleteEventCatDetail", function () {
    const idEventCat = $(this).data('eventid');
    const dataToDelEventCat = {
      id: idEventCat
    };

    Swal.fire({
      title: 'Do you really want to delete this event category?',
      showDenyButton: true,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: `DELETE`,
      denyButtonText: `DON'T DELETE`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: serverUrl + "events/delete.event.category.php",
          dataType: "JSON",
          data: JSON.stringify(dataToDelEventCat),
          cache: false,
          beforeSend: function () {
            $("div#loaderdelEventsCats").show();

          },
          complete: function () {
            $("div#loaderdelEventsCats").hide();

          },
          success: function (response) {
            setTimeout(function () {
              window.location = window.location;
            }, 2000);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Event category is successfully deleted',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      }
    });

  })

  // end delete event category 

  // update event category

  $("table#allEventsCats").on("click", "button#updateSingleBookbtn", function () {
    const idEventCat = $(this).data('eventid');
    $.ajax({
      type: "GET",
      url: serverUrl + "events/read.single.event.category.php?id=" + idEventCat,
      dataType: "JSON",
      cache: false,
      beforeSend: function () {
        $("div#loaderNewEventUpCat").show();

      },
      complete: function () {
        $("div#loaderNewEventUpCat").hide();

      },
      success: function (response) {
        console.log(response)
        $("form#updateEventCategoryForm").html('<div class="row">\n' +
          '<div class="col-md-12 pr-0">\n' +
          '<div class="form-group ">\n' +
          '<label>Title</label>\n' +
          '<input id="eventCatUpId" type="text" class="form-control" placeholder="fill title" value="' + response.id + '" hidden>\n' +
          '<input id="eventCatUpTitle" type="text" class="form-control" placeholder="fill title" value="' + response.title + '">\n' +
          '</div>\n' +
          '</div>\n' +
          '</div>\n' +
          '<div class="modal-footer no-bd">\n' +
          '<input type="submit" id="updateEventCat" class="btn btn-primary" value="Update">\n' +
          '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>\n' +
          '</div>\n' +
          '<center>\n' +
          '<div class="spinner-border text-primary" role="status" id="loaderUpCatEvent" style="display:none;">\n' +
          '<span class="sr-only">Loading...</span>\n' +
          '</div>\n' +
          '</center>');
      }
    })
  });




  $("form#updateEventCategoryForm").on("click", "input#updateEventCat", function (e) {
    const eventIdUp = $("input#eventCatUpId");
    const eventTtUp = $("input#eventCatUpTitle");
    e.preventDefault();
    const idTosum = eventIdUp.val();
    const titToSum = eventTtUp.val();

    const dataToUpEvCat = {
      id: idTosum,
      title: titToSum
    }

    console.log(dataToUpEvCat);

    $.ajax({
      type: "POST",
      url: serverUrl + "events/update.event.category.php",
      dataType: "JSON",
      data: JSON.stringify(dataToUpEvCat),
      cache: false,
      beforeSend: function () {
        $("div#loaderUpCatEvent").show();

      },
      complete: function () {
        $("div#loaderUpCatEvent").hide();

      },
      success: function (response) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Event category is successfully updated',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout(function () {
          window.location = window.location;
        }, 2000);

      }
    });

  });

  // admin update info 




  // check if password are matching before updating info 

  $("form#my-admin_update_info").on("input", "input#admin_Conf_password", function () {
    console.log($(this).val());
    var oldadminPassword = $("input#admin_password").val();
    if (oldadminPassword !== $(this).val()) {
      $("span#match-pswwd").show();

      setTimeout(function () {
        $("span#match-pswwd").hide();
      }, 2000)
    }
    else {
      $("span#matching-pswwd").show();

      setTimeout(function () {
        $("span#matching-pswwd").hide();
      }, 2000);
    }

  });


  $("form#my-admin_update_info").on("click", "input#updateAdmin", function (e) {
    e.preventDefault();
    // Get form
    var form = $("form#my-admin_update_info")[0];
    // get data

    var profileImg = $("input#admin_profile")[0].files[0];
    var adminUsername = $("input#admin_username").val();
    var adminPassword = $("input#admin_password").val();
    var adminId = $("input#adminId").val();


    // FormData object
    var newBookCatData = new FormData(form);

    newBookCatData.append("id", adminId);
    newBookCatData.append("username", adminUsername);
    newBookCatData.append("password", adminPassword);
    newBookCatData.append("avatar", profileImg);


    // disabled the submit button

    $.ajax({
      url: serverUrl + "user/admin.update.profile.php",
      data: newBookCatData,
      cache: false,
      contentType: false,
      processData: false,
      type: "POST",
      beforeSend: function () {
        $("div#updateAdminLoader").show();
      },
      complete: function () {
        $("div#updateAdminLoader").hide();
      },
      success: function (data) {
        if (!data.error) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Admin info updated successfully',
            showConfirmButton: false,
            timer: 1500
          })
          $("div#addNewCategory").modal("hide");
          setTimeout(function () {
            window.location = window.location;
          }, 3000);
        }
        else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
          })
        }



      },
      error: function (xhr, ajaxOptions, thrownError) {
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'something went wrong try again',
          showConfirmButton: false,
          timer: 1500
        })
      }
    });
    // Display the key/value pairs
    for (var pair of newBookCatData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }



  })




  // end update admin info 


  // create videos book 

  $("form#newVideoForm").on("click", "input#addNewVideo", function (e) {
    e.preventDefault();
    // Get form
    var form = $("form#newVideoForm")[0];
    // get data

    var videoFile = $("input#videoFile")[0].files[0];
    var videoTitle = $("input#videoTitle").val();
    var videoAuhor = $("input#videoAuthor").val();
    var videoUClass = $("select#selectUserClass").val();
    var videoSummary = $("textarea#summaryVideo").val();
    var videoUCategory = $("select#selectUserCategory").val();
    var videoBCategory = $("select#selectBookCategory").val();


    // FormData object
    var newVideoData = new FormData(form);


    newVideoData.append("title", videoTitle);
    newVideoData.append("author", videoAuhor);
    newVideoData.append("user_classesId", videoUClass);
    newVideoData.append("my_video", videoFile);
    newVideoData.append("summary", videoSummary);
    newVideoData.append("user_categoryId", videoUCategory);
    newVideoData.append("bookCategoryId", videoBCategory);


    // disabled the submit button

    $.ajax({
      url: serverUrl + "book/create.video.book.php",
      data: newVideoData,
      cache: false,
      contentType: false,
      processData: false,
      type: "POST",
      beforeSend: function () {
        $("div#loaderVideo").show();
      },
      complete: function () {
        $("div#loaderVideo").hide();
      },
      success: function (data) {
        if (!data.error) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Video info is successfully added',
            showConfirmButton: false,
            timer: 1500
          })
          $("div#addNewVideo").modal("hide");
          setTimeout(function () {
            window.location = window.location;
          }, 3000);
        }
        else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
          })
        }



      },
      error: function (xhr, ajaxOptions, thrownError) {
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'something went wrong try again',
          showConfirmButton: false,
          timer: 1500
        })
      }
    });
    // Display the key/value pairs
    for (var pair of newVideoData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  });



  // end create videos books 


  // read videos books 

  allVideos = $("table#allVideoInfo").DataTable({
    columnDefs: [{ width: 150, targets: 4 }],
  });
  $.ajax({
    url: serverUrl + "book/read.videos.book.php",
    cache: false,
    contentType: false,
    processData: false,
    type: "GET",
    beforeSend: function () {
      $("div#viewVideoLoader").show();
    },
    complete: function () {
      $("div#viewVideoLoader").hide();
    },
    success: function (data) {
      const res = data.data;

      console.log('Videos Books=', res);
      for (let r in res) {
        allVideos.row.add([
          res[r].title,
          res[r].userClassTitle,
          res[r].summary,
          res[r].age_range,
          ' <video  style =" height: 100px;"src="' + allVideoUrl +
          res[r].video_url + '" controls>' +
          '</video>' +
          res[r].id,
          '<button type="button" id="deleteSingleVideo"  data-videoId= "' +
          res[r].id +
          '" class="btn btn-icon btn-round btn-danger ">\n' +
          '<i class="fa fa-trash"></i>\n' +
          "</button>",
        ]);
      }
      allVideos.draw();

    }
  });
  // end read videos books 
  // delete video info 



  $("table#allVideoInfo").on("click", "button#deleteSingleVideo", function () {

    Swal.fire({
      title: 'Do you really want to delete this Video ?',
      showDenyButton: true,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: `DELETE`,
      denyButtonText: `DON'T DELETE`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        var dataTodelVideo = $(this).data("videoid");
        var dataDelVid = {
          id: dataTodelVideo,
        };

        console.log(dataDelVid)
        $.ajax({
          type: "POST",
          url: serverUrl + "book/delete.video.book.php",
          data: JSON.stringify(dataDelVid),
          dataType: "JSON",
          beforeSend: function () {
            $("div#loaderDeleteVideo").show();
          },
          complete: function () {
            $("div#loaderDeleteVideo").hide();
          },
          success: function (response) {
            const res = response;
            console.log("res", res);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Video  is successfully deleted',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(function () {
              window.location = window.location;
            }, 2000);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'something went wrong try again',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });

      } else if (result.isDenied) {
        Swal.fire('Video  is not deleted', '', 'info')
      }
    });
  });

  // end delete video info 

  // create audio books 

  $("form#newAudioForm").on("click", "input#addNewAudio", function (e) {
    e.preventDefault();
    // Get form
    var form = $("form#newAudioForm")[0];
    // get data

    var audioFile = $("input#audioFile")[0].files[0];
    var audioTitle = $("input#audioTitle").val();
    var AudioAuhor = $("input#audioAuthor").val();
    var AudioUClass = $("select#selectUserClass").val();
    var AudioSummary = $("textarea#summaryAudio").val();
    var AudioUCategory = $("select#selectUserCategory").val();
    var AudioBCategory = $("select#selectBookCategory").val();


    // FormData object
    var newAudioData = new FormData(form);


    newAudioData.append("title", audioTitle);
    newAudioData.append("author", AudioAuhor);
    newAudioData.append("user_classesId", AudioUClass);
    newAudioData.append("my_audio", audioFile);
    newAudioData.append("summary", AudioSummary);
    newAudioData.append("user_categoryId", AudioUCategory);
    newAudioData.append("bookCategoryId", AudioBCategory);


    // disabled the submit button

    $.ajax({
      url: serverUrl + "book/create.audio.book.php",
      data: newAudioData,
      cache: false,
      contentType: false,
      processData: false,
      type: "POST",
      beforeSend: function () {
        $("div#loaderAudio").show();
      },
      complete: function () {
        $("div#loaderAudio").hide();
      },
      success: function (data) {
        if (!data.error) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Audio info is successfully added',
            showConfirmButton: false,
            timer: 1500
          })
          $("div#addNewAudio").modal("hide");
          setTimeout(function () {
            window.location = window.location;
          }, 3000);
        }
        else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
          })
        }



      },
      error: function (xhr, ajaxOptions, thrownError) {
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'something went wrong try again',
          showConfirmButton: false,
          timer: 1500
        })
      }
    });
    // Display the key/value pairs
    for (var pair of newAudioData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  });
  // end create audio books 

  // read audio books

  allAudios = $("table#allAudioInfo").DataTable({
    columnDefs: [{ width: 150, targets: 4 }],
  });
  $.ajax({
    url: serverUrl + "book/read.audios.book.php",
    cache: false,
    contentType: false,
    processData: false,
    type: "GET",
    beforeSend: function () {
      $("div#viewAudioLoader").show();
    },
    complete: function () {
      $("div#viewAudioLoader").hide();
    },
    success: function (data) {
      console.log('Audio Book=', data.data);
      const res = data.data;
      for (let r in res) {
        allAudios.row.add([
          res[r].title,
          res[r].userClassTitle,
          res[r].bookCategory,
          res[r].languages,
          ' <audio  style =" height: 100px;"src="' + allAudioUrl + res[r].audio_url + '" controls></audio>',
          '<button type="button" id="deleteSingleAudio"  data-audioid= "' +
          res[r].id +
          '" class="btn btn-icon btn-round btn-danger ">\n' +
          '<i class="fa fa-trash"></i>\n' +
          "</button>"
        ]);
      }
      allAudios.draw();

    }
  });

  // end read audio books 

  // delete audio books 


  $("table#allAudioInfo").on("click", "button#deleteSingleAudio", function () {

    Swal.fire({
      title: 'Do you really want to delete this Audio ?',
      showDenyButton: true,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: `DELETE`,
      denyButtonText: `DON'T DELETE`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        var dataAudioId = $(this).data("audioid");
        var audioData = {
          id: dataAudioId,
        };

        console.log(audioData)
        $.ajax({
          type: "POST",
          url: serverUrl + "book/delete.audio.book.php",
          data: JSON.stringify(audioData),
          dataType: "JSON",
          beforeSend: function () {
            $("div#loaderDeleteAudio").show();
          },
          complete: function () {
            $("div#loaderDeleteAudio").hide();
          },
          success: function (response) {
            const res = response;
            console.log("res", res);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Audio  is successfully delted',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(function () {
              window.location = window.location;
            }, 2000);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'something went wrong try again',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });

      } else if (result.isDenied) {
        Swal.fire('Audio  is not deleted', '', 'info')
      }
    });
  });


  // news information 

  $.ajax({
    url: serverUrl + "news/read.news.php",
    type: "GET",
    beforeSend: function () {
      $("div#loaderdeNewsPOST").show();
    },
    complete: function () {
      $("div#loaderdeNewsPOST").hide();
    },
    success: function (data) {
      const res = data.data;
      console.log('News INFO=', data.data);
      for (let r in res) {
        $("#allNewInfo").DataTable().row.add([
          '<div class="avatar ">\n' +
          '<img src="' +
          allNewsUrl +
          res[r].image +
          '" alt="..." class="avatar-img rounded-circle">\n' +
          "</div>\n",
          res[r].title,
          res[r].summary,
          '<button type="button" id="deleteNewPost"  data-postid= "' +
          res[r].id +
          '" class="btn btn-icon btn-round btn-danger ">\n' +
          '<i class="fa fa-trash"></i>\n' +
          "</button>",
        ]);
      }
      $("#allNewInfo").DataTable().draw();

    }
  });

  // create news 


  $("form#newPost").on("click", "input#addNewsInfo", function (e) {
    e.preventDefault();
    console.log("hello");

    // Get form
    var form = $("form#newPost")[0];
    // get data
    var icon = $("input#newsCaption")[0].files[0];
    var newTitle = $("input#newsTtile").val();
    var newDesc = $("textarea#newsDescription").val();

    // FormData object
    var newPostData = new FormData(form);
    newPostData.append("title", newTitle);
    newPostData.append("summary", newDesc);
    newPostData.append("avatar", icon);

    $.ajax({
      url: serverUrl + "news/create.news.php",
      data: newPostData,
      cache: false,
      contentType: false,
      processData: false,
      type: "POST",
      beforeSend: function () {
        $("div#loaderNews").show();
      },
      complete: function () {
        $("div#loaderNews").hide();
      },
      success: function (data) {
        if (!data.error) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: "Post is Created Successfully",
            showConfirmButton: false,
            timer: 1500
          })
          $("div#addNewCategory").modal("hide");
          setTimeout(function () {
            window.location = window.location;
          }, 2000);
        }
        else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: "Something went wrong, make sure you uploaded a file",
            showConfirmButton: false,
            timer: 1500
          })
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'something went wrong try again',
          showConfirmButton: false,
          timer: 1500
        })
      }
    });
    // Display the key/value pairs
    for (var pair of newPostData.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  });

  // delete new post 


  $("#allNewInfo").on("click", "button#deleteNewPost", function (e) {
    const newId = $(this).data('postid');
    console.log(newId);
    Swal.fire({
      title: 'Do you really want to delete this post?',
      showDenyButton: true,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: `DELETE`,
      denyButtonText: `DON'T DELETE`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        var postDele = {
          id: newId,
        };
        $.ajax({
          type: "POST",
          url: serverUrl + "news/delete.php",
          data: JSON.stringify(postDele),
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
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Post is successfully deleted',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(function () {
              window.location = window.location;
            }, 2000);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'something went wrong try again',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      }
      else if (result.isDenied) {
        Swal.fire('Post is not deleted', '', 'info')
      }
    });

  });


  // READ SLIDERS INFO 

  $.ajax({
    type: "GET",
    url: serverUrl + "slider/read.sliders.php",
    dataType: "JSON",
    beforeSend: function () {
      $("div#loaderSlider").show();
    },
    complete: function () {
      $("div#loaderSlider").hide();
    },
    success: function (response) {
      const res = response.data;
      console.log("SLIDERS", res);
      for (let r in res) {
        $("#all_sliders-info").DataTable().row.add([
          '<div class="avatar ">\n' +
          '<img src="' +
          allSliderUrl +
          res[r].image +
          '" alt="..." class="avatar-img rounded-circle">\n' +
          "</div>\n",
          res[r].title,
          res[r].caption,
          res[r].description,
          '<button type="button" id="deleteSlider"  data-sliderId= "' +
          res[r].id +
          '" class="btn btn-icon btn-round btn-danger ">\n' +
          '<i class="fa fa-trash"></i>\n' +
          "</button>",
        ]);
      }
      $("#all_sliders-info").DataTable().draw();

    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(xhr)
    }
  });

  // delete a slider 
  $("#all_sliders-info").on("click", "button#deleteSlider", function (e) {
    const sliderId = $(this).data('sliderid');
    console.log('eeeee')

    Swal.fire({
      title: 'Do you really want to delete this slider?',
      showDenyButton: true,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: `DELETE`,
      denyButtonText: `DON'T DELETE`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        var sliderDel = {
          id: sliderId,
        };
        $.ajax({
          type: "POST",
          url: serverUrl + "slider/delete.slider.php",
          data: JSON.stringify(sliderDel),
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
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Slider is successfully deleted',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(function () {
              window.location = window.location;
            }, 2000);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'something went wrong try again',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      }
      else if (result.isDenied) {
        Swal.fire('slider is not deleted', '', 'info')
      }
    });

  });


});
  // end delete audio books
