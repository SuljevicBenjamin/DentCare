var UserService = {

  /* =========================
     TOKEN HANDLING
  ========================= */

  getToken: function () {
    return localStorage.getItem("user_token");
  },

  setToken: function (token) {
    localStorage.setItem("user_token", token);
  },

  clearToken: function () {
    localStorage.removeItem("user_token");
  },

  authHeaders: function () {
    var token = UserService.getToken();
    return token ? { "Authorization": "Bearer " + token } : {};
  },

  /* =========================
     USER STATE
  ========================= */

  currentUser: function () {
    var token = UserService.getToken();
    if (!token) return null;
    return Utils.parseJwt(token)?.user || null;
  },

  isLoggedIn: function () {
    return !!UserService.getToken();
  },

  isAdmin: function () {
    var user = UserService.currentUser();
    return user && user.role === "admin";
  },

  /* =========================
     INIT
  ========================= */

  init: function () {
    var token = UserService.getToken();
    if (token) {
      window.location.replace("index.html");
    }
  },

  /* =========================
     FORM HANDLERS
  ========================= */

  handleLogin: function (e) {
    e.preventDefault(); // 🔴 STOP PAGE RELOAD

    var form = document.getElementById("login-form");
    if (!form) return;

    var entity = Object.fromEntries(new FormData(form).entries());
    UserService.login(entity);
  },

  handleRegister: function (e) {
    e.preventDefault(); // 🔴 STOP PAGE RELOAD

    var form = document.getElementById("register-form");
    if (!form) return;

    var entity = Object.fromEntries(new FormData(form).entries());
    UserService.register(entity);
  },

  /* =========================
     API CALLS
  ========================= */

  login: function (entity) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",

      success: function (result) {
        console.log("LOGIN SUCCESS:", result);

        UserService.setToken(result.data.token);

        if (window.NavbarService && typeof window.NavbarService.refreshOnLogin === "function") {
          window.NavbarService.refreshOnLogin();
        }

        window.location.replace("index.html");
      },

      error: function (xhr) {
        toastr.error(xhr?.responseJSON?.message || "Login failed");
      }
    });
  },

  register: function (entity) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/register",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",

      success: function () {
        toastr.success("Registered successfully. You can log in now.");
        UserService.clearToken();
        window.location.hash = "login";
      },

      error: function (xhr) {
        toastr.error(xhr?.responseJSON?.message || "Registration failed");
      }
    });
  },

  /* =========================
     LOGOUT
  ========================= */

  logout: function () {
    UserService.clearToken();

    if (window.NavbarService && typeof window.NavbarService.refreshOnLogout === "function") {
      window.NavbarService.refreshOnLogout();
    }

    window.location.hash = "login";
  }
};
