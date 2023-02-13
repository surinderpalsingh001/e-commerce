function create_tr(table_id){
    let table_body = document.getElementById(table_id);
    first_tr = table_body.firstElementChild
    tr_clone = first_tr.cloneNode(true);
    

    table_body.append(tr_clone);

    clean_first_tr(table_body.firstElementChild);
    
}
function clean_first_tr(firtsTr){
    let children = firtsTr.children;

    children = Array.isArray(children) ? children: Object.values(children);
    children.forEach(x=> {
        console.log(x);
        
    });
}

function remove_tr(e){
    console.log("r->",this,e);
    if(e.closest('tbody').childElementCount == 1){
        
        alert("You Don't Have Permission to Delete this?")
    }
    else{
        e.closest('tr').remove();
    }
    

}