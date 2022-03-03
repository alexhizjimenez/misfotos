$(document).ready(function () {
  $.ajaxSetup({
    headers: { "X-CSRF-Token": $("meta[name=_token]").attr("content") },
  });
  $(".deleteFoto").on("click", function (e) {
    e.preventDefault();
    let idFoto = e.target.dataset.id;
    console.log(idFoto);
    Swal.fire({
      title: "¿Estas seguro de eliminar esto?",
      text: "No se podra reinvertir",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¿Desea eliminar esto?",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/api/v1/photo/${idFoto}`,
          type: "delete",
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(response);
            if (response.success) {
              Swal.fire(response.message);
              location.reload();
            } else {
              Swal.fire(response.message);
            }
          },
        });
      }
    });

    $("#formFotos").trigger("reset");
  });

  $(".statusFoto").on("click", function (e) {
    e.preventDefault();
    let idFoto = e.target.dataset.id;
    console.log(idFoto);
    Swal.fire({
      title: "¿Estas seguro de cambiar el estatus de este elemento?",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Cambiar estado",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/api/v1/photo/status/${idFoto}`,
          type: "put",
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(response);
            if (response.success) {
              Swal.fire(response.message);
              location.reload();
            } else {
              Swal.fire(response.message);
            }
          },
        });
      }
    });

    $("#formFotos").trigger("reset");
  });
});
