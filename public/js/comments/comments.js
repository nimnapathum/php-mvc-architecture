$(document).ready(function(){
    // adding a comment
    $('#send-btn').click(function(event){
        event.preventDefault();
        
        // check wheather comment input field is empty or not
        if(!($('#post-comment').val() == 0)){
            $.ajax({
                url: URLROOT+'/Comments/comment/'+CURRENT_POST,
                method: 'post',
                data: $('form').serialize(),
                dataType: "text",
                success: function(comment){
                    // for testing purpose
                    $('#msg').text(comment);
                }
            });

            // refresh the entire comment thread
            $.ajax({
                url: URLROOT+'/Comments/showComments/'+CURRENT_POST,
                dataType: "html",
                success: function(results){
                    // for testing purpose
                    $('#results').html(results);
                }
            });

            // input field to null
            $('#post-comment').val('');
        }
    });

    // onload show existing comments
    $.ajax({
        url: URLROOT+'/Comments/showComments/'+CURRENT_POST,
        dataType: "html",
        success: function(results){
            // for testing purpose
            $('#results').html(results);
        }
    });
});

// delete function
function deleteComment(commentID){
    $.ajax({
        url: URLROOT+'/Comments/deleteComment/'+commentID,
        method: 'post',
        data: $('form').serialize(),
        dataType: "text",
        success: function(response){
            location.reload();
        }
    });
}

// comment interactions
// likes
