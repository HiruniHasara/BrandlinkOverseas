function search(){
    var input, filter, table, tr, td, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    tab = document.getElementById("contentdiv");
    card = tab.getElementsByClassName("card");

    for (i = 0; i < card.length; i++) {
        itemname = card[i].getElementsByTagName("h3") ; 
        for(j=0 ; j<itemname.length ; j++)
        {
        let tdata = itemname[j] ;
        if (tdata) {
            if (tdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
            card[i].style.display = "";
            break ; 
            } else {
            card[i].style.display = "none";
            }
        } 
        }
    }
}