
    /* Code for changing active 
    link on clicking */
    var btns = 
        $("#navigation .navbar-nav .nav-link");

    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click",
                              function () {
            var current = document
                .getElementsByClassName("active");

            current[0].className = current[0]
                .className.replace(" active", "");

            this.className += " active";
        });
    }
