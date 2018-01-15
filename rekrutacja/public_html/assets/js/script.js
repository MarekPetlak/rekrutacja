
var base_url = window.location.protocol + '//' + window.location.host;
var path_array = window.location.pathname.split('/');
for (i = 0; i < path_array.length; i++) {
   base_url += i == 0 ? '' : '/';
   base_url += path_array[i];

   if (i == 3) {
      break;
   }
}

$(function () {
   $('.ucfirst').blur(function () {
      var value = capitalizeFirstLetter($(this).val());
      $(this).val(value);
   });
   $("#data").datepicker({
      dateFormat: "yy-mm-dd",
      altFormat: "yy-mm-dd"
   });
   
   if ($("#driverlicense").length > 0) {
      $("#driverlicense").validate(
              {
                 errorClass: "alert-danger",
                 errorElement: "p",
                 rules: {
                    category: {
                       required: true,
                       maxlength: 5
                    }
                 },
                 messages: {
                    category: {
                       required: "Wpisz nazwę kategorii",
                       maxlength: "Nazwa kategorii może się składać maksymalnie z 5 znaków."
                    }
                 }
              }
      );
      $('#save').on('click', function () {
         if ($("#driverlicense").valid()) {
            saveData('driverlicenses');
         }
      });
   }

   if ($("#user").length > 0) {
      $("#user").validate(
              {
                 errorClass: "alert-danger",
                 errorElement: "p",
                 rules: {
                    fname: {
                       required: true,
                       maxlength: 20
                    },
                    lname: {
                       required: true,
                       maxlength: 40
                    }
                 },
                 messages: {
                    fname: {
                       required: "Wpisz imię",
                       maxlength: "Imię może się składać maksymalnie z 20 znaków."
                    },
                    lname: {
                       required: "Wpisz nazwisko",
                       maxlength: "Nazwisko kategorii może się składać maksymalnie z 40 znaków."
                    }
                 },
              }
      );

      $('#save').on('click', function () {
         if ($("#user").valid()) {
            saveData('users');
         }
      });
   }


   $("#search").autocomplete({
      source: base_url + '/autocomplete',
      minLength: 1,
      select: function (event, ui) {
                     window.location.href = base_url + '/preview/' + ui.item.id;

      }
   });
});

function saveData(mode) {
   var values = $('form').serialize();
   $.ajax({
      url: base_url + '/update',
      method: 'POST',
      data: values,
      cache: false,
      success: function (response) {
         if (isNaN(response)) {
            alert(response);
         } else {
            window.location.href = base_url + '/preview/' + response;
         }
      },
      error: function (response) {
         alert(response);
      }
   });
}

function deleteData(id, mode) {
   if (typeof id === 'number') {

      if (mode == 'categories') {
         var question = 'kategorię';
      } else {
         var question = 'użytkownika'
      }

      if (confirm('Czy usunąć ' + question + ' o id: ' + id)) {


         $.ajax({
            url: base_url + '/delete',
            method: 'POST',
            data: {value: id},
            cache: false,
            success: function (response) {
               if (response.length == 0) {
                  $('#row-' + id).remove();
               } else {
                  alert(response);
               }
            },
            error: function (response) {
               alert(response);
            }
         });
      }
   }
}

function capitalizeFirstLetter(string) {
   return string[0].toUpperCase() + string.slice(1);
}


