
document.addEventListener('DOMContentLoaded', () => {

    //沒有子留言，就不顯示hide/show
    var isExplorer = document.querySelectorAll('.main_review')
    var Explorer = document.querySelectorAll('.sub_review_explorer')
        for ( var i = 0; i<isExplorer.length; i++){
            if ( isExplorer[i].nextElementSibling.firstElementChild === null){
                Explorer[i].style.display = 'none'
            }
        }
    // 顯示/隱藏子留言
    document.querySelector('.container').addEventListener('click', e => {
        if ( e.target.value === 'hide' ){
            e.target.previousSibling.previousSibling.style.display = 'none'
            e.target.value = 'show'
        }
        else if ( e.target.value === 'show' ){
            e.target.previousSibling.previousSibling.style.display = 'block'
            e.target.value = 'hide'
        }
    })

  

})

    
