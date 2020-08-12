$(document).ready(function () {
    $(".signin_tab").click(function () {
            $(".login_div").show();
            $(".register_div").hide();
        }),
        $(".signup_tab").click(function () {
            $(".register_div").show();
            $(".login_div").hide();
        });
});