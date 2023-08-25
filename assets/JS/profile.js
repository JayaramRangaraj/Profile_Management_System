function swapForms() {
    var showcase = document.getElementById('div1');
    var input = document.getElementById('div2');
    if (showcase.classList.contains('view')) 
    { 
        showcase.classList.remove('view');
        showcase.classList.add('hide');
      
        input.classList.remove('hide'); 
        input.classList.add('view');
    }
  }

function showProfile()
{
    var showcase = document.getElementById('div1');
    var input = document.getElementById('div2');
    if (showcase.classList.contains('hide')) 
    { 
        showcase.classList.remove('hide');
        showcase.classList.add('view');
      
        input.classList.remove('view');
        input.classList.add('hide');
    }
}