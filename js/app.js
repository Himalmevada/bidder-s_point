// $(document).ready(function () {});

// Bootstrap Notify

function info_message(message) {
  const notyf = new Notyf({
    position: {
      x: "right",
      y: "top",
    },
    types: [
      {
        type: "info",
        background: "#0948B3",
        icon: {
          className: "fas fa-info-circle",
          tagName: "span",
          color: "#fff",
        },
        duration: 4000,
        dismissible: false,
      },
    ],
  });
  notyf.open({
    type: "info",
    message: message,
  });
}

function error_message(message) {
  const notyf = new Notyf({
    position: {
      x: "right",
      y: "top",
    },
    types: [
      {
        type: "error",
        background: "#FA5151",
        icon: {
          className: "fas fa-times",
          tagName: "span",
          color: "#fff",
        },
        duration: 4000,
        dismissible: false,
      },
    ],
  });
  notyf.open({
    type: "error",
    message: message,
  });
}

function warning_message(message) {
  const notyf = new Notyf({
    position: {
      x: "right",
      y: "top",
    },
    types: [
      {
        type: "warning",
        background: "#F5B759",
        icon: {
          className: "fas fa-exclamation-triangle",
          tagName: "span",
          color: "#fff",
        },
        duration: 4000,
        dismissible: false,
      },
    ],
  });
  notyf.open({
    type: "warning",
    message: message,
  });
}

function success_message(message) {
  const notyf = new Notyf({
    position: {
      x: "right",
      y: "top",
    },
    types: [
      {
        type: "info",
        background: "#262B40",
        icon: {
          className: "fas fa-comment-dots",
          tagName: "span",
          color: "#fff",
        },
        duration: 4000,
        dismissible: false,
      },
    ],
  });
  notyf.open({
    type: "success",
    message: message,
  });
}
