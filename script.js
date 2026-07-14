function confirmDelete(){

    return confirm("Are you sure you want to delete this user?");

}


function confirmStatus(){

    return confirm("Change user status?");

}


function validateForm(){

    let name = document.getElementById("name").value;
    let age = document.getElementById("age").value;


    if(name == "" || age == ""){

        alert("Please fill all fields");
        return false;

    }

    return true;

}



function searchUser(){

    let input = document.getElementById("search");

    let filter = input.value.toLowerCase();

    let table = document.getElementById("userTable");

    let rows = table.getElementsByTagName("tr");


    for(let i = 1; i < rows.length; i++){

        let name = rows[i].getElementsByTagName("td")[1];


        if(name){

            let text = name.textContent || name.innerText;


            if(text.toLowerCase().includes(filter)){

                rows[i].style.display = "";

            } else {

                rows[i].style.display = "none";

            }

        }

    }

}