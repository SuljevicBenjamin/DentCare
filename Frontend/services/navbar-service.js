var NavbarService = {
    init: function() {
        this.updateNavbar();
    },

    updateNavbar: function() {
        var token = localStorage.getItem("user_token");
        var role = null;

        if (token) {
            var payload = Utils.parseJwt(token);
            if (payload && payload.user) {
                role = payload.user.role;
            }
        }

        var html = '';
        html += '<li><a href="#page1" class="nav-item nav-link">Home</a></li>';
        html += '<li><a href="#page2" class="nav-item nav-link">About</a></li>';
        html += '<li><a href="#page3" class="nav-item nav-link">Service</a></li>';
        html += '<div class="nav-item dropdown">';
        html += '  <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>';
        html += '  <div class="dropdown-menu m-0">';
        html += '    <a href="#page4" class="dropdown-item">Pricing Plan</a>';
        html += '    <a href="#page5" class="dropdown-item">Our Dentist</a>';
        html += '    <a href="#page6" class="dropdown-item">Appointment</a>';
        html += '    <a href="#page7" class="dropdown-item">Contact</a>';
        html += '  </div>';
        html += '</div>';

        if (!token) {
            html += '<li><a href="#page8" class="nav-item nav-link">Register</a></li>';
            html += '<li><a href="#page9" class="nav-item nav-link">Login</a></li>';
        }

        if (token) {
            if (role === "admin") {
                html += '<li><a href="#page10" class="nav-item nav-link">Admin</a></li>';
            } else if (role === "user") {
                html += '<li><a href="#page11" class="nav-item nav-link">My Appointments</a></li>';
            }
            html += '<li><button class="btn btn-link nav-link" style="padding-left:0;" onclick="UserService.logout()">Logout</button></li>';
        }

        $('.navbar-nav.nav').html(html);
    },
    
    refreshOnLogin: function() {
        this.updateNavbar();
    },
    
    refreshOnLogout: function() {
        this.updateNavbar();
    }
};

$(document).ready(function() {
    NavbarService.init();
});