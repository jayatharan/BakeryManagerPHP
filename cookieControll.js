var card = []
var total = 0.00
var total_qty = 0

const refreshCardData = () => {
    var allcookies = document.cookie;
    // Get all the cookies pairs in an array
    cookiearray = allcookies.split(';');
    // Now take key value pair out of this array
    var val;
    var cardExist = false;
    for (var i = 0; i < cookiearray.length; i++) {
        name = cookiearray[i].split('=')[0];
        value = cookiearray[i].split('=')[1];
        if(name.trim() == "card"){
            cardExist = true;
            val = value
        }
        if(!cardExist){
            setCookie()
        }
    }
    card = (JSON.parse(val).order_items)
    total = 0
    total_qty = 0

    card.map((item)=>{
        total += parseFloat(item.price) * parseInt(item.qty)
        total_qty +=  parseInt(item.qty)
    })
}

const setCookie = () => {
    var cookievalue = {
        "order_items":card
    }
    document.cookie = "card=" + JSON.stringify(cookievalue)+";";
}

const addToCard = (item,qty)=>{
    refreshCardData()
    const idx = isExists(item.p_id)
    if( idx != -1){
        card[idx].qty = parseInt(card[idx].qty) + parseInt(qty)
    }else{
        card.push(item)
    }
    setCookie()
    refreshCardData()
    updateDetails()
}

const updateToCard = (p_id,qty)=>{
    refreshCardData()
    const idx = isExists(p_id)
    if( idx != -1){
        if( qty > 0 ){
            card[idx].qty = qty
        }else{
            card.splice(idx, 1)
        }
    }
    setCookie()
    refreshCardData()
}

const isExists = (p_id) => {
    var index = -1;
    card.map((item,idx)=>{
        if(item.p_id == p_id){
            index = idx
        }
    })
    return index;
}

const clearCard = () => {
    card = []
    setCookie()
    refreshCardData()
}

const addUserData = () => {

}

const getCardData = ()=>{
    var allcookies = document.cookie;
    // Get all the cookies pairs in an array
    cookiearray = allcookies.split(';');
    // Now take key value pair out of this array
    var val;
    for (var i = 0; i < cookiearray.length; i++) {
        name = cookiearray[i].split('=')[0];
        value = cookiearray[i].split('=')[1];
        if(name.trim() == "card"){
            val = value
        }
    }
    data = (JSON.parse(val).order_items)
    
    return data; 
}

const getTotal = () => total;

const getTotalQty = () => total_qty;

const updateDetails = () => {
            document.getElementById("total").innerText = getTotal().toFixed(2);
            document.getElementById("total_qty").innerText = getTotalQty();
        }

refreshCardData()