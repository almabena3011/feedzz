
 //finding Hashtag
 document.querySelectorAll(".captions").forEach(function(el){
    let renderedText = el.innerHTML.replace(/#(\w+)/g, "<a href='/search?query=%23$1'>#$1</a>");
    el.innerHTML = renderedText
})
// function like(id){
//     const el = document.getElementById('post-btn-' + id)
//     // Route dari follow
//     fetch('/like/' + id) 
//         .then(response => response.json())
//         .then(data => { 
//             el.innerText = (data.status == 'LIKE') ? 'unlike' : 'like'
//         });
// }


//parameter type merupakan default dari jenis elemen yang dikirim.
function like(id, type="POST"){
    let likesCount = 0;
    let el = '';
   
    if(type == 'POST'){
        el = document.getElementById('post-btn-' + id)
        likesCount = document.getElementById('post-likescount-' + id)
       
    } else {
        el = document.getElementById('comment-btn-' + id)
        likesCount = document.getElementById('comment-likescount-' + id)
    }
     

    // Route dari like
    fetch('/like/' + type + '/' + id) 
        
        .then(response => response.json())
        .then(data => { 
            let currentCount = 0
            if(data.status == 'LIKE'){
                currentCount = parseInt(likesCount.innerHTML) + 1
                el.innerText = 'unlike'
            } else {
                currentCount = parseInt(likesCount.innerHTML) - 1
                el.innerText = 'like'
            }
            likesCount.innerHTML = currentCount
        });
        
}

function follow(id, el){
    // Route dari follow
    fetch('/follow/' + id)
        .then(response => response.json())
        .then(data => { 
                let followsCount = document.getElementById('totalFollower') 
                let currentCount = 0
                if(data.status == 'FOLLOW'){
                    currentCount = parseInt(followsCount.innerHTML) + 1
                    el.innerText = 'UNFOLLOW'
                } else {
                    currentCount = parseInt(followsCount.innerHTML) - 1
                    el.innerText = 'FOLLOW'
                }
                followsCount.innerHTML = currentCount
        });
}