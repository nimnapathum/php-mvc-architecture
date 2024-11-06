// comment interactions
// likes

function addCommentLikes(commentID){
    if($('#comment-likes-'+commentID).hasClass('active')){
        $('#comment-likes-'+commentID).removeClass('active');   
        decCommentLikes(commentID);
    }else{
        if($('#comment-dislikes-'+commentID).hasClass('active')){
            $('#comment-dislikes-'+commentID).removeClass('active');  
             decCommentDislikes(commentID);
        }
        $('#comment-likes-'+commentID).addClass('active');  
        incCommentLikes(commentID);
    }
}

function addCommentDislikes(commentID){
    if($('#comment-dislikes-'+commentID).hasClass('active')){
        $('#comment-dislikes-'+commentID).removeClass('active');  
        decCommentDislikes(commentID);
    }else{
        if($('#comment-likes-'+commentID).hasClass('active')){
            $('#comment-likes-'+commentID).removeClass('active');  
            decCommentLikes(commentID);
        }
        $('#comment-dislikes-'+commentID).addClass('active'); 
        incCommentDislikes(commentID);
    }
}

function incCommentLikes(commentID){
    $.ajax({
        url: URLROOT+'/Comments/incCommentsLikes/'+commentID,
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(likes){
            $('#comment-likes-count-'+commentID).text(likes);
        }
    })
}

function decCommentLikes(commentID){
    $.ajax({
        url: URLROOT+'/Comments/decCommentsLikes/'+commentID,
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(likes){
            $('#comment-likes-count-'+commentID).text(likes);
        }
    })
}

function incCommentDislikes(commentID){
    $.ajax({
        url: URLROOT+'/Comments/incCommentsDislikes/'+commentID,
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(dislikes){
            $('#comment-dislikes-count-'+commentID).text(dislikes);
        }
    })
}

function decCommentDislikes(commentID){
    $.ajax({
        url: URLROOT+'/Comments/decCommentsDislikes/'+commentID,
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(dislikes){
            $('#comment-dislikes-count-'+commentID).text(dislikes);
        }
    })
}
 
 