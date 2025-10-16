var app = $.spapp({
    defaultView: "page1",
    templateDir: "./pages/"
});

// HOME
app.route({
    view: "page1",
    load: "main.html",
    onCreate: function() { main_js(); },
    onReady: function() { nav("pg1"); }
});

// ABOUT
app.route({
    view: "page2",
    load: "about.html",
    onReady: function() { nav("pg2"); }
});

// SERVICES
app.route({
    view: "page3",
    load: "service.html",
    onReady: function() { nav("pg3"); }
});

// PRICE
app.route({
    view: "page4",
    load: "price.html",
    onReady: function() { nav("pg4"); }
});

// TEAM
app.route({
    view: "page5",
    load: "team.html",
    onReady: function() { nav("pg5"); }
});

// APPOINTMENT
app.route({
    view: "page6",
    load: "appointment.html",
    onReady: function() { nav("pg6"); }
});



// CONTACT
app.route({
    view: "page7",
    load: "contact.html",
    onReady: function() { nav("pg7"); }
});


// REGISTER
app.route({
    view: "page8",
    load: "register.html",
    onReady: function() { nav("pg8"); }
});


// LOGIN

app.run();  
app.route({
    view: "page9",
    load: "login.html",
    onReady: function() { nav("pg9"); }
});

//if (window.location.hash == "") {
//    window.location.hash = '#page1';
//}





/*
var app =$.spapp({
    defaultView:"page1",
    templateDir:"./pages/"
});




app.route({
    view: "page1",
    onCreate: function() {main_js()},
    onReady: function() {nav("pg1");}
});

app.route({
    view: "page2",
    
    onReady: function() {nav("pg2");}
})

app.route({
    view: "page3",
    onReady: function() {nav("pg3");}
});

app.route({
    view: "page4",
    onCreate: function() {},
    onReady: function() {nav("pg4");}
})

app.route({
    view: "page5",
    onCreate: function() {},
    onReady: function() {nav("pg5");}
})


app.route({
    view: "page6",
    onCreate: function() {},
    onReady: function() {nav("pg6");}
})


app.route({
    view: "page7",
    onCreate: function() {},
    onReady: function() {nav("pg7");}
})


app.route({
    view: "page8",
    onCreate: function() {},
    onReady: function() {nav("pg8");}
})

app.run();
*/
/*
//const pg=["page1","page2","page3","page4","page5"];

$(document).ready(function() {
    
    var currentPage = window.location.hash || "#page1"; 
    $("#" + currentPage.substring(1)).addClass("active"); 

    
    $(".nav_links a").on("click", function(e) {
        e.preventDefault(); 

        
        $(".nav_links a").removeClass("active");

        
        $(this).addClass("active");

        
        window.location.hash = $(this).attr("href");
    });
});
*/

