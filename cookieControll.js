var card = []
var total = 0.00
var total_qty = 0

const refreshCardData = () => {
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
        }else{
            setCookie()
        }
    }
    card = (JSON.parse(val).order_items)
    card.map((item)=>{
        total += item.price * item.qty
        total_qty +=  item.qty
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
        card[idx].qty += qty
    }else{
        card.push(item)
    }
    setCookie()
    refreshCardData()
}

const updateToCard = (item,qty)=>{
    refreshCardData()
    const idx = isExists(item.p_id)
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

refreshCardData()