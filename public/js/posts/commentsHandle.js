$(document).ready(function() {
    const commentField = $(".add-comment-section");
    const commentBtn = $(".comment-btn");

    commentBtn.on("click", function() {
        if (commentBtn.hasClass("active")) {
            commentBtn.removeClass("active");
            commentField.hide();
        } else {
            commentBtn.addClass("active");
            commentField.show();
        }
    });
});
