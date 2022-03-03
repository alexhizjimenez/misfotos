$(document).ready(function () {
  $.ajaxSetup({
    headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
  });
  $("#save").on("click", function (e) {
    e.preventDefault();
    let formData = new FormData();
    formData.append("title", $("#title").val());
    formData.append("description", $("#description").val());
    formData.append("category_id", $("#category_id").val());
    formData.append("user_id", $("#user_id").val());
    formData.append("photo", $("#photo")[0].files[0]);
    console.log(formData);
    $.ajax({
      url: "/api/v1/photo",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response.success);
        if (response.success) {
          Swal.fire(response.message);
        } else {
          Swal.fire(response.message);
        }
      },
    });
    $("#formFotos").trigger("reset");
  });

  $("#update").on("click", function (e) {
    e.preventDefault();
    let idFoto = e.target.dataset.id;
    let formData = new FormData();
    formData.append("title", $("#title").val());
    formData.append("description", $("#description").val());
    formData.append("category_id", $("#category_id").val());
    formData.append("user_id", $("#user_id").val());
    formData.append("photo", $("#photo")[0].files[0]);
    console.log(formData);
    $.ajax({
      url: `/api/v1/photo/${idFoto}`,
      type: "put",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response.success);
        if (response.success) {
          Swal.fire(response.message);
        } else {
          Swal.fire(response.message);
        }
      },
    });
    $("#formFotos").trigger("reset");
  });
});
