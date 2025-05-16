const AjaxForms = document.querySelectorAll(".AjaxForm");

AjaxForms.forEach((forms) => {
  forms.addEventListener("submit", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "¿Deseas realiza esta Acción?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Aceptar",
      cancelButtonText: "Cancelar",
      allowOutsideClick: true,
    }).then((result) => {
      if (result.isConfirmed) {
        let data = new FormData(this);
        let method = this.getAttribute("method");
        let action = this.getAttribute("action");

        let header = new Headers();

        let config = {
          method: method,
          headers: header,
          mode: "cors",
          cache: "no-cache",
          body: data,
        };

        fetch(action, config)
          .then((response) => response.json())
          .then((response) => {
            return ajaxAlert(response);
          });
      }
    });
  });
});