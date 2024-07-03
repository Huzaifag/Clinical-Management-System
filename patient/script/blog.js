let blog_form = document.getElementById('blog_form');
let blog_edit_form = document.getElementById('blog_edit_form');
blog_form.addEventListener('submit' ,function(e){
  e.preventDefault();
  add_blog();
});
blog_edit_form.addEventListener('submit' ,function(e){
    e.preventDefault();
    update_blog();
  });

function add_blog() {
  let data = new FormData();
  data.append('add_blog', '');
  data.append('title', blog_form.elements['title'].value);
  data.append('image', blog_form.elements['image'].files[0]);
  data.append('blog', blog_form.elements['blog'].value);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/blog_crud.php", true);
  xhr.onload = function() {
      if (xhr.status === 200) {
          if (xhr.responseText === '1') {
              alert('New Post has been added');
              blog_form.reset();
              get_blogs();
          } else {
              alert('Something went wrong');
          }
      } else {
          alert('Error: ' + xhr.status);
      }
      var modalEl = document.getElementById('post_blog'); // Corrected the ID
      var modal = bootstrap.Modal.getInstance(modalEl);
      modal.hide();
  };
  xhr.onerror = function() {
      alert('error', 'Network error occurred');
  };
  xhr.send(data);
}

function get_blogs(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/blog_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function(){
         // console.log(this.responseText);
          document.getElementById('blogs_container').innerHTML = this.responseText;
      };
      xhr.send('get_blogs');
}
function delete_post(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/blog_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function(){
         // console.log(this.responseText);
         if(this.responseText == 1){
            alert('Post has been deleted');
            get_blogs();
            } 
        else {
            alert('Something went wrong');
            }
      };
      xhr.send('delete_blogs=' + val);
}

function edit_post(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/blog_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function(){
        console.log(this.responseText);
        const data = JSON.parse(this.responseText);
        blog_edit_form.elements['id'].value = data.blog_id;
        blog_edit_form.elements['title_edit'].value = data.title;
        blog_edit_form.elements['blog_edit'].value = data.body;
      };
      xhr.send('edit_blog=' + val);
}

function update_blog(){
    let data = new FormData();
    data.append('update_blog', '');
    data.append('blog_id', blog_edit_form.elements['id'].value);
    data.append('title_edit', blog_edit_form.elements['title_edit'].value);
    data.append('blog_edit', blog_edit_form.elements['blog_edit'].value);
  
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/blog_crud.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (this.responseText == 1) {
                alert('Post has been Updated');
                blog_edit_form.reset();
                get_blogs();
            } else {
                alert('Something went wrong');
            }
        } else {
            alert('Error: ' + xhr.status);
        }
        var modalEl = document.getElementById('edit_post_blog'); // Corrected the ID
        var modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();
    };
    xhr.onerror = function() {
        alert('error', 'Network error occurred');
    };
    xhr.send(data);
}

window.onload = ()=>{
    get_blogs();
}