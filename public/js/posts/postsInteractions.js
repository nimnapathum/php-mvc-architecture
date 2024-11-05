function addLikes(postID){
    if($('#post-likes-'+postID).hasClass('active')){
        $('#post-likes-'+postID).removeClass('active');   
        decPostLikes(postID);  
    }else{
        if($('#post-dislikes-'+postID).hasClass('active')){
            $('#post-dislikes-'+postID).removeClass('active');  
            decPostDislikes(postID);   
        }
        $('#post-likes-'+postID).addClass('active');  
        incPostLikes(postID); 
    }
}

function addDislikes(postID){
    if($('#post-dislikes-'+postID).hasClass('active')){
        $('#post-dislikes-'+postID).removeClass('active');  
        decPostDislikes(postID);
    }else{
        if($('#post-likes-'+postID).hasClass('active')){
            $('#post-likes-'+postID).removeClass('active');  
            decPostLikes(postID);
        }
        $('#post-dislikes-'+postID).addClass('active'); 
        incPostDislikes(postID);
    }
}

function incPostLikes(postID){
    $.ajax({
        url: URLROOT+'/Posts/incPostsLikes/'+postID,
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(likes){
            $('#posts-likes-count-'+postID).text(likes);
        }
    })
}

function decPostLikes(postID){
    $.ajax({
        url: URLROOT+'/Posts/decPostsLikes/'+postID,
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(likes){
            $('#posts-likes-count-'+postID).text(likes);
        }
    })
}

function incPostDislikes(postID){
    $.ajax({
        url: URLROOT+'/Posts/incPostsDislikes/'+postID,
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(dislikes){
            $('#posts-dislikes-count-'+postID).text(dislikes);
        }
    })
}

function decPostDislikes(postID){
    $.ajax({
        url: URLROOT+'/Posts/decPostsDislikes/'+postID,
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(dislikes){
            $('#posts-dislikes-count-'+postID).text(dislikes);
        }
    })
}
 
 