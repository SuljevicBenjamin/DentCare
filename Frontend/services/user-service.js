var UserService = {
    getToken: function() {
      return localStorage.getItem("user_token");
    },
    setToken: function(token) {
      localStorage.setItem("user_token", token);
    },
    clearToken: function() {
      localStorage.removeItem("user_token");
    },
    authHeaders: function() {
      var t = UserService.getToken();
      return t ? { "Authentication": t } : {};
    },
    currentUser: function() {
      var t = UserService.getToken();
      return Utils.parseJwt(t)?.user || null;
    },
    isLoggedIn: function() {
      return !!UserService.getToken();
    },
    isAdmin: function() {
      var u = UserService.currentUser();
      return u && (u.role === 'admin');
    },
    init: function () {
      var token = localStorage.getItem("user_token");
      if (token && token !== undefined) {
        window.location.replace("index.html");
      }
    },
    handleLogin: function() {
      var form = document.getElementById("login-form");
      if (!form) return;
      var entity = Object.fromEntries(new FormData(form).entries());
      UserService.login(entity);
    },
    handleRegister: function() {
      var form = document.getElementById("register-form");
      if (!form) return;
      var entity = Object.fromEntries(new FormData(form).entries());
      console.log("Register form data:", entity);
      UserService.register(entity);
    },
    login: function (entity) {
      $.ajax({
        url: Constants.PROJECT_BASE_URL + "auth/login",
        type: "POST",
        data: entity,
        success: function (result) {
          console.log(result);
          UserService.setToken(result.data.token);
          if (window.NavbarService && typeof window.NavbarService.refreshOnLogin === 'function') {
            window.NavbarService.refreshOnLogin();
          }
          window.location.replace("index.html");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          toastr.error(XMLHttpRequest?.responseText ?  XMLHttpRequest.responseText : 'Error');
        },
      });
    },
    register: function(entity) {
      $.ajax({
        url: Constants.PROJECT_BASE_URL + "auth/register",
        type: "POST",
        data: entity,
        success: function (result) {
          toastr.success("Registered successfully. You can log in now.");
          localStorage.removeItem("user_token");
          window.location.hash ="login";
        },
        error: function (XMLHttpRequest) {
          toastr.error(XMLHttpRequest?.responseText ? XMLHttpRequest.responseText : 'Error');
        }
      });
    },
   
   
    logout: function () {
      localStorage.clear();
      if (window.NavbarService && typeof window.NavbarService.refreshOnLogout === 'function') {
        window.NavbarService.refreshOnLogout();
      }
      window.location.hash ="login";
    },
}