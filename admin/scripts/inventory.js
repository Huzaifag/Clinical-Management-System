const add_form = document.getElementById('add_form');
const edit_form = document.getElementById('edit_form');
add_form.addEventListener('submit', (e) =>{
  e.preventDefault();
  add_inventory();
})

edit_form.addEventListener('submit', (e) =>{
  e.preventDefault();
  update_inventory();
})

function get_inventory(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/inventory_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
     // console.log(this.responseText);
      document.getElementById('inventory_data').innerHTML = this.responseText;
    };
    xhr.send('get_inventory');
  }

  
  function add_inventory() {
    let data = new FormData();
    let inventory_data = ['iName', 'iDescription', 'iquantity', 'category', 'ex_data'];

    for (let i = 0; i < inventory_data.length; i++) {
        data.append(inventory_data[i], add_form[inventory_data[i]].value);
    }

    data.append('add_inventory', ''); // This will trigger isset($_POST['add_inventory'])

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/inventory_crud.php", true);
    xhr.onload = function () {
        if(this.responseText == '1') {
            console.log(this.responseText);
            var modalEl = document.getElementById('add_modal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            alert('Item added to Inventory');
            get_inventory();
            add_form.reset();
        } else {
            console.log(this.responseText);
            alert('Failed to add item to Inventory');
        }
    };
    xhr.send(data);
}

function del_inventory(val){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/inventory_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
     // console.log(this.responseText);
      if(this.responseText == 1){
        alert('Item deleted from Inventory');
        get_inventory();
      }
      else{
        alert('Failed to delete item from Inventory');
      }
    };
    xhr.send('del_inventory=' + val);
}

function edit(val){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/inventory_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
     
      let data = JSON.parse(this.responseText)
      console.log(data);
      edit_form.elements['inventory_id'].value = data.inventory_id;
      edit_form.elements['iName_edit'].value = data.item_name;
      edit_form.elements['iDescription_edit'].value = data.description;
      edit_form.elements['iquantity_edit'].value = data.quantity;
      edit_form.elements['ex_data_edit'].value = data.expiration_data;
    };
    xhr.send('edit_inventory=' + val);
}

function update_inventory(){
  let data = new FormData();
    let inventory_data = ['inventory_id','iName_edit', 'iDescription_edit', 'iquantity_edit', 'category_edit', 'ex_data_edit'];

    for (let i = 0; i < inventory_data.length; i++) {
        data.append(inventory_data[i], edit_form[inventory_data[i]].value);
    }

    data.append('update_inventory', ''); // This will trigger isset($_POST['add_inventory'])

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/inventory_crud.php", true);
    xhr.onload = function () {
        if(this.responseText == '1') {
            console.log(this.responseText);
            var modalEl = document.getElementById('edit_modal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            alert('Item Updated in Inventory');
            get_inventory();
            add_form.reset();
        } else {
            console.log(this.responseText);
            alert('Failed to update item in Inventory');
        }
    };
    xhr.send(data);
}

function search(){
  const category = document.getElementById('search_categories').value;
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/inventory_crud.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    // console.log(this.responseText);
     document.getElementById('inventory_data').innerHTML = this.responseText;
   };
    xhr.send('search_inventory=' + category);
}

window.onload = ()=> {
  get_inventory();
}