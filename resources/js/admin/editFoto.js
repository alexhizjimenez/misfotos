$(document).ready(function () {
  $.ajaxSetup({
    headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
  });
  $("#update").on("click", function (e) {
    e.preventDefault();
    let idFoto = e.target.dataset.id;
    let formDataUpdate = new FormData();
    formDataUpdate.append("title", $("#title").val());
    formDataUpdate.append("description", $("#description").val());
    formDataUpdate.append("category_id", $("#category_id").val());
    formDataUpdate.append("user_id", $("#user_id").val());
    if ($("#photo")[0].files[0] != undefined) {
      formDataUpdate.append("photo", $("#photo")[0].files[0]);
    }
    formDataUpdate.append("id", idFoto);

    $.ajax({
      url: `/api/v1/photo/updated`,
      type: "post",
      data: formDataUpdate,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);
        if (response.success) {
          Swal.fire(response.message);
          $("#formFotos").trigger("reset");
          setTimeout(() => {
            location.reload();
          }, 1000);
        } else {
          Swal.fire(response.message);
        }
      },
      error: function (data) {
        var errorsHtml = "";
        var errors = data.responseJSON;
        $.each(errors.errors, function (key, value) {
          errorsHtml += value;
          errorsHtml += "<br>";
        });
        Swal.fire(errorsHtml);
      },
    });
  });
});
